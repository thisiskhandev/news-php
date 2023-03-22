<?php include_once "config.php" ?>
<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <section class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        $sql = "SELECT post_id, title, post_img, cat_name, post_date FROM post p
        LEFT JOIN category cat ON p.category = cat.cat_id
        ORDER BY p.post_id DESC LIMIT 0, 5";
        $result = mysqli_query($conn, $sql) or die("Query failed!");
        if (mysqli_num_rows($result) > 0) {
            foreach ($result as $keys) {
        ?>
                <div class="recent-post">
                    <?php
                    $defaultPath = "admin/images/404-shot.webp";
                    $imagePath = "admin/upload/" . $keys['post_img'];
                    ?>
                    <a class="post-img" href='single.php?id=<?php echo $keys["post_id"]; ?>'><img src="<?php echo !file_exists($imagePath) ? $defaultPath : $imagePath ?>" alt="<?php echo !file_exists($imagePath) ? "Image not found 404" : substr($keys['post_img'], 0, -4) ?>" /></a>
                    <div class="post-content">
                        <h5><a href='single.php?id=<?php echo $keys["post_id"]; ?>'><?php echo $keys['title']; ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php'><?php echo $keys['cat_name'] == "" ? "Uncategorized" : $keys['cat_name']; ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $keys['post_date']; ?>
                        </span>
                        <a class='read-more pull-right' href='single.php?id=<?php echo $keys["post_id"]; ?>'>read more</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </section>
    <!-- /recent posts box -->
</div>