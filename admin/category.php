<?php include "header.php";
include_once "unauth.php";
$limit = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;
// echo $offset;
$sql = "SELECT * FROM category ORDER BY cat_id DESC LIMIT {$offset}, {$limit}";
$result = mysqli_query($conn, $sql) or die("Fetching Query for Category failed!");
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $keys) {
                                // print_r($keys);
                        ?>
                                <tr>
                                    <td class='id'><?php echo $keys['cat_id'] ?></td>
                                    <td><?php echo $keys['cat_name'] ?></td>
                                    <td><?php echo $keys['post'] ?></td>
                                    <td class='edit'><a href="update-category.php?id=<?php echo $keys['cat_id'] ?>"><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href="delete-category.php?id=<?php echo $keys['cat_id'] ?>"><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                $sql1 = "SELECT * FROM users";
                $result1 = mysqli_query($conn, $sql1) or die("Pagination Calculation Query failed!");
                if (mysqli_num_rows($result1)) {
                    $total_records = mysqli_num_rows($result1);
                    // $limit = 3;
                    $total_page = ceil($total_records / $limit);
                    // echo $total_page;
                    echo "<ul class='pagination admin-pagination'>";
                    # Prev page
                    if ($page > 1) {
                        echo "<li><a href=category.php?page=" . ($page - 1) . ">Prev</a></li>";
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        # Adding Active class in active page number.
                        if ($i == $page) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo "<li class='$active'><a href='category.php?page=$i'>$i</a></li>";
                    }
                    # Next page btn
                    if ($total_page > $page) {
                        echo "<li><a href=category.php?page=" . (++$page) . ">Next</a></li>";
                    }
                    echo "</ul>";
                    // echo "total page: " .  $total_page . "<br> Current page: " . $page;
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>