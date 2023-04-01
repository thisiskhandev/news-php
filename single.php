<?php include 'header.php';
!$_GET['id'] ? header("location: $BASE_URL") : $id = mysqli_escape_string($conn, $_GET['id']);
$sql = "SELECT post_id, title, description, first_name, last_name, username, post_date, post_img, cat_name, cat_id
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
                                        <a href="<?php echo $BASE_URL ?>/category.php?id=<?php echo $keys['cat_id'] ?>"><?php echo $keys['cat_name'] ?></a>
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
                                <article class="description">
                                    <?php echo $keys['description']; ?>
                                </article>
                            </div>
                        </div>
                        <div class="post-container" style="margin: 10px 0 0 0;">
                            <div class="pagination_single">

                                <!-- Previous Available Post -->
                                <?php
                                # This will find the previous available post id
                                $sqlPrevPost = "SELECT IFNULL(MAX(post_id), MIN(post_id) - 1) AS prev_id
                                FROM post
                                WHERE post_id < {$id}";
                                $queryPrevPost = mysqli_query($conn, $sqlPrevPost) or die("Query Failed: Previous Post");
                                $resulqPrevPost = mysqli_fetch_assoc($queryPrevPost)['prev_id'];
                                if (!$resulqPrevPost) {
                                    echo "";
                                } else {
                                ?>
                                    <a href="<?php echo $BASE_URL . "/single.php?id=" . $resulqPrevPost  ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</a>
                                <?php } ?>

                                <a href="<?php echo $BASE_URL ?>">Read All Posts</a>

                                <!-- Next Available Post -->
                                <?php
                                # This will find the next available post id
                                $sqlNextPost = "SELECT IFNULL(MIN(post_id), MAX(post_id) + 1) AS next_id
                                FROM post
                                WHERE post_id > {$id}";
                                $queryNextPost = mysqli_query($conn, $sqlNextPost) or die("Query Failed: Next Post");
                                $resulqNextPost = mysqli_fetch_assoc($queryNextPost)['next_id'];
                                if (!$resulqNextPost) {
                                    echo "";
                                } else {
                                ?>
                                    <a href="<?php echo $BASE_URL . "/single.php?id=" . $resulqNextPost  ?>">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="mt-5 alert alert-danger" role="alert">No Post Found!</div>';
                }
                ?>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>