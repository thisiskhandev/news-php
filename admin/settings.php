<?php include_once "header.php";
include_once "config.php";
$sql = "SELECT * FROM settings";
$result = mysqli_query($conn, $sql) or die("Query failed: Setting fetch");
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $keys) {
                ?>
                        <form action="save-settings.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="site_name">Website Name</label>
                                <input type="text" name="site_name" class="form-control" autocomplete="off" value="<?php echo $keys['site_name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="site_footer">Copyright Text (Footer)</label>
                                <input type="text" name="site_footer" class="form-control" autocomplete="off" value='<?php echo $keys["site_footer"] ?>' required>
                            </div>
                            <div class="form-group">
                                <label for="site_fav">Site Fav Icon</label>
                                <div style="margin: 10px 0;">
                                    <img src="./images/<?php echo $keys['site_fav'] ?>" alt="Old Fav Icon" width="45">
                                    <input type="hidden" name="old-fav" value="<?php echo $keys['site_fav'] ?>" readonly>
                                </div>
                                <input type="file" name="new-fav" accept=".png, .jpg, .jpeg">
                            </div>
                            <div class="form-group">
                                <label for="site_logo">Site Logo</label>
                                <div style="margin: 10px 0;">
                                    <img src="./images/<?php echo $keys['site_logo'] ?>" alt="Old Logo" width="150">
                                    <input type="hidden" name="old-logo" value="<?php echo $keys['site_logo'] ?>" readonly>
                                </div>
                                <input type="file" name="new-logo" accept=".svg, .png, .jpg, .jpeg">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                        </form>
                <?php
                    }
                } else {
                    echo "<h2>Error while getting settings</h2>";
                }
                ?>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>