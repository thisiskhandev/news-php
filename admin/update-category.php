<?php include "header.php";
include_once "unauth.php";
$_GET['id'] ? $catID = mysqli_escape_string($conn, $_GET['id']) : header("location: $HOST_NAME/category.php");
if (isset($_POST['submit'])) {
    $cat_name = mysqli_escape_string($conn, $_POST['cat_name']);
    // $cat_id = mysqli_escape_string($conn, $_POST['cat_id']);
    $sqlUpdate = "UPDATE category SET cat_name = '{$cat_name}' WHERE cat_id = {$catID}";
    $result = mysqli_query($conn, $sqlUpdate) or die("Update Query failed!");
    if ($result) {
        header("location: $HOST_NAME/category.php");
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <!-- <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="<?php echo $catID ?>" disabled>
                    </div> -->
                    <div class="form-group">
                        <label>Category Name</label>
                        <?php
                        $sql = "SELECT cat_name FROM category WHERE cat_id = {$catID}";
                        $result1 = mysqli_query($conn, $sql) or die("Show category field Query failed!");
                        if (mysqli_num_rows($result1) > 0)
                            foreach ($result1 as $keys) {
                                // print_r($keys);
                                echo '<input type="text" name="cat_name" class="form-control" value="' . $keys['cat_name'] . '" placeholder="" required>';
                            }
                        ?>

                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>