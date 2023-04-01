<?php include "header.php";
include_once "config.php";

$postID = $_GET['id'];

!$postID ? header("location: $HOST_NAME/post.php") : "";

$sql1 = "SELECT post_id, title, description, cat_name, cat_id, post_img FROM post 
INNER JOIN category cat ON post.category = cat.cat_id
WHERE post_id = $postID";
$result1 = mysqli_query($conn, $sql1) or die("Query failed!");

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Edit Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <?php
                if (mysqli_num_rows($result1) > 0) {
                    foreach ($result1 as $keys) {
                        // echo "<pre>";
                        // print_r($keys);
                        // echo "</pre>";
                ?>
                        <form action="save-update-post.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post_title">Title</label>
                                <input type="hidden" name="post_id" value="<?php echo $postID ?>">
                                <input type="text" name="post_title" class="form-control" autocomplete="off" required value="<?php echo $keys['title'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="postdesc">Description</label>
                                <!-- <textarea name="postdesc" class="form-control" rows="10" required><?php echo $keys['description'] ?></textarea> -->
                                <textarea name="postdesc" class="tinymce form-control" rows="10"><?php echo $keys['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control">
                                    <option selected disabled> Select Category</option>
                                    <?php
                                    $sql = "SELECT cat_id, cat_name FROM category";
                                    $result = mysqli_query($conn, $sql) or die("Error in Category Query");
                                    if (mysqli_num_rows($result) > 0) {
                                        foreach ($result as $catname) {
                                            if ($keys['cat_id'] == $catname['cat_id']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option $selected value='{$catname['cat_id']}'>" . $catname['cat_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <div class="">
                                    <img src="upload/<?php echo $keys['post_img'] ?>" width="150" alt="">
                                </div>
                                <input type="file" name="new-image" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="old-image" value="<?php echo $keys['post_img'] ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                        </form>
                <?php
                    }
                }
                ?>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>