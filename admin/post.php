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
$sql = "SELECT * FROM post
        LEFT JOIN category ON post.category = category.cat_id
        LEFT JOIN users ON post.author = users.user_id
        ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
$result = mysqli_query($conn, $sql) or die("Posts view Query failed!");

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
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $keys) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo $keys['post_id'] ?></td>
                                    <td><?php echo $keys['title'] ?></td>
                                    <td><?php echo $keys['description'] ?></td>
                                    <td><?php echo $keys['cat_name'] ?></td>
                                    <td><?php echo $keys['post_date'] ?></td>
                                    <td><?php echo $keys['username'] ?></td>
                                    <td class='edit'><a href='edit-post.php?id=<?php echo $keys['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $keys['post_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            }
                        }
                        // mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
                <?php
                $sql1 = "SELECT * FROM post";
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
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>