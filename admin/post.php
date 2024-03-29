<?php include "header.php";
include "config.php";
$limit = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;
// echo $offset;

if ($_SESSION['user_role'] == 1) {
    $sql = "SELECT post_id, title, excerpt, description, cat_name, cat_id, post_date, username, post_img, user_id FROM post p 
        LEFT JOIN category cat ON p.category = cat.cat_id
        LEFT JOIN users usr ON p.author = usr.user_id
        ORDER BY p.post_id DESC LIMIT {$offset}, {$limit}";
    $result = mysqli_query($conn, $sql) or die("Posts view Query failed!");
} elseif ($_SESSION['user_role'] == 0) {
    // echo $_SESSION['user_role']; // Current User Login Role if 0 === Editor if 1 === Admin
    // echo $_SESSION['user_id']; // Current User Login ID
    $sql = "SELECT post_id, title, excerpt, description, cat_name, cat_id, post_date, username, post_img, user_id FROM post p 
        LEFT JOIN category cat ON p.category = cat.cat_id
        LEFT JOIN users usr ON p.author = usr.user_id
        WHERE author = {$_SESSION['user_id']}
        ORDER BY p.post_id DESC LIMIT {$offset}, {$limit}";
    $result = mysqli_query($conn, $sql) or die("Posts view Query failed!");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <!-- <div class="filter" style="width: 300px;">
                    <select class="form-control" name="" id="">
                        <option value="" disabled selected>Filter by</option>
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                    </select>
                </div> -->
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description (Excerpt)</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            // echo "<pre>";
                            // $imgName = mysqli_fetch_assoc($result)['post_img'];
                            // $imgName = explode(".", $imgName);
                            // print_r($imgName[0]);
                            // echo "</pre>";
                            foreach ($result as $keys) {
                                // Get image name before dot
                                $imgName = explode(".", $keys['post_img']);
                                $imgName = $imgName[0];
                        ?>
                                <tr>
                                    <td class='id'><?php echo $keys['post_id'] ?></td>
                                    <td style="text-align: center;"><img width="50" src="upload/<?php echo $keys['post_img'] ?>" alt="<?php echo $imgName ?>" loading="lazy"></td>
                                    <td><?php echo $keys['title'] ?></td>
                                    <td><?php echo substr($keys['excerpt'], 0, 90) ?>...</td>
                                    <!-- <td><div><?php echo substr($keys['description'], 0, 50) ?>...</div></td> -->
                                    <td><?php echo $keys['cat_name'] ? $keys['cat_name'] : "Undefined" ?></td>
                                    <td><?php echo $keys['post_date'] ?></td>
                                    <td><?php echo $keys['username'] ?></td>
                                    <td class='edit'><a href='edit-post.php?id=<?php echo $keys['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href="delete-post.php?id=<?php echo $keys['post_id'] . '&uid=' . $keys['user_id'] . '&cid=' . $keys['cat_id'] ?>"><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<div class="mt-5 error_alert alert alert-danger" role="alert">No Post Found! <strong>Add first</strong></div>';
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $sql1 = "SELECT post_id FROM post WHERE author = {$_SESSION['user_id']}";
                    $result1 = mysqli_query($conn, $sql1) or die("Pagination Calculation Query failed!");
                    if (mysqli_num_rows($result1)) {
                        $total_records = mysqli_num_rows($result1);
                        // $limit = 3;
                        $total_page = ceil($total_records / $limit);
                        // echo $total_page;
                        echo "<ul class='pagination admin-pagination'>";
                        # Prev page
                        if ($page > 1) {
                            echo "<li><a href=post.php?page=" . ($page - 1) . ">Prev</a></li>";
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            # Adding Active class in active page number.
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo "<li class='$active'><a href='post.php?page=$i'>$i</a></li>";
                        }
                        # Next page btn
                        if ($total_page > $page) {
                            echo "<li><a href=post.php?page=" . (++$page) . ">Next</a></li>";
                        }
                        echo "</ul>";
                        // echo "total page: " .  $total_page . "<br> Current page: " . $page;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>