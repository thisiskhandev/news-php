<?php include 'header.php';
!$_GET['id'] ? header("location: $BASE_URL") : $id = $_GET['id'];
$sql = "SELECT post_id, title, description, first_name, last_name, username, post_date, post_img, cat_name 
FROM post p 
LEFT JOIN category cat ON p.category = cat.cat_id
LEFT JOIN users usr ON p.author = usr.user_id 
WHERE post_id = {$id}";
$result = mysqli_query($conn, $sql) or die("Query failed!");
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $keys) {
                        // echo "<pre>";
                        // print_r($keys);
                        // echo "</pre>";
                        $defaultPath = "admin/images/404-shot.webp";
                        $imagePath = "admin/upload/" . $keys['post_img'];
                ?>
                        <div class="post-container">
                            <div class="post-content single-post">
                                <h3><?php echo $keys['title'] ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?php echo $keys['cat_name'] ?>
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
                                <img src="<?php echo !file_exists($imagePath) ? $defaultPath : $imagePath ?>" alt="<?php echo !file_exists($imagePath) ? "Image not found 404" : substr($keys['post_img'], 0, -4) ?>" />
                                <p class="description">
                                    <?php echo $keys['description']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="post-container" style="margin: 10px 0 0 0;">
                            <div class="pagination_single">
                                <!-- ERROR NEED A PROPER SQL QUERY FOR PREV AND NEXT -->
                                <a href="<?php echo $BASE_URL . "/single.php?id=" . $keys['post_id'] - 1  ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</a>
                                <a href="<?php echo $BASE_URL ?>">Read All Posts</a>
                                <a href="<?php echo $BASE_URL . "/single.php?id=" . $keys['post_id'] + 1  ?>">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>