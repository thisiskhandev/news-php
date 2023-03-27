<?php include 'header.php';

!$_GET['search'] ? header("location: $BASE_URL")  : $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);

$limit = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;
$sql = "SELECT post_id, title, description, first_name, last_name, cat_id, cat_name, post_date, username, post_img FROM post p 
LEFT JOIN category cat ON p.category = cat.cat_id
LEFT JOIN users usr ON p.author = usr.user_id
WHERE p.title LIKE '%{$searchTerm}%' OR p.description LIKE '%{$searchTerm}%'
ORDER BY p.post_id DESC LIMIT {$offset}, {$limit}";
$result = mysqli_query($conn, $sql) or die("Query failed: Search Term");

?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading">Search: <?php echo $searchTerm ?> </h2>
                    <?php if (mysqli_num_rows($result) > 0) {
                        // print_r(mysqli_fetch_assoc($result));
                        foreach ($result as $keys) {
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
                        $sql1 = "SELECT * FROM post
                        WHERE post.title LIKE '%$searchTerm%'";
                        $result1 = mysqli_query($conn, $sql1) or die("Pagination Calculation Query failed!");
                        if (mysqli_num_rows($result1)) {
                            $total_records = mysqli_num_rows($result1);
                            // $limit = 3;
                            $total_page = ceil($total_records / $limit);
                            // echo "Total Page" . $total_page;
                            // echo "<br>Current Page: " . $page;
                            echo "<ul class='pagination admin-pagination'>";
                            # Prev page
                            if ($page > 1) {
                                echo "<li><a href=$BASE_URL/search.php?search=$searchTerm&page=" . (--$page) . ">Prev</a></li>";
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                # Adding Active class in active page number.
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                # ERROR IN COUNTING PAGE
                                echo "<li class=$active><a href=$BASE_URL/search.php?search=$searchTerm&page=$i>$i</a></li>";
                            }
                            # Next page btn
                            if ($total_page > $page) {
                                echo "<li><a href=$BASE_URL/search.php?search=$searchTerm&page=" . (++$page) . ">Next</a></li>";
                            }
                            echo "</ul>";
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