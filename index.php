<?php include 'header.php';
include_once "config.php";
$limit = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;
$sql = "SELECT post_id, title, description, first_name, last_name, cat_name, post_date, username, post_img FROM post p 
        LEFT JOIN category cat ON p.category = cat.cat_id
        LEFT JOIN users usr ON p.author = usr.user_id
        ORDER BY p.post_id DESC LIMIT {$offset}, {$limit}";
$result = mysqli_query($conn, $sql) or die("Posts view Query failed!");

?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $keys) {
                            // echo "<pre>";
                            // print_r($keys);
                            // echo "</pre>";
                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php
                                        $defaultPath = "admin/images/404-shot.webp";
                                        $imagePath = "admin/upload/" . $keys['post_img'];
                                        ?>
                                        <a class="post-img" href='single.php?id=<?php echo $keys["post_id"]; ?>'><img src="<?php echo !file_exists($imagePath) ? $defaultPath : $imagePath ?>" alt="<?php echo !file_exists($imagePath) ? "Image not found 404" : substr($keys['post_img'], 0, -4) ?>" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $keys["post_id"]; ?>'><?php echo $keys['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php'><?php echo $keys['cat_name'] == "" ? "Uncategorized" : $keys['cat_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php'><?php echo $keys['first_name'] . " " . $keys['last_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $keys['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo $keys['description']; ?>....
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $keys["post_id"]; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<h2>No Post Found!</h2>";
                    }
                    if (mysqli_num_rows($result) > 0) {
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
                                echo "<li><a href=$BASE_URL?page=" . ($page - 1) . ">Prev</a></li>";
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                # Adding Active class in active page number.
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo "<li class='$active'><a href='$BASE_URL?page=$i'>$i</a></li>";
                            }
                            # Next page btn
                            if ($total_page > $page) {
                                echo "<li><a href=$BASE_URL?page=" . (++$page) . ">Next</a></li>";
                            }
                            echo "</ul>";
                            // echo "total page: " .  $total_page . "<br> Current page: " . $page;
                        }
                    }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php mysqli_close($conn);
include 'footer.php'; ?>