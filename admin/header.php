<?php
session_start();
include "config.php";
if (!isset($_SESSION['username'])) {
    header("location: $HOST_NAME");
}
$sqlSetting = "SELECT * FROM settings";
$resultSetting = mysqli_query($conn, $sqlSetting) or die("Query failed: Logo & copyright see settings");
// $site_name = mysqli_fetch_assoc($result)['site_name'];
if (mysqli_num_rows($resultSetting) > 0) {
    foreach ($resultSetting as $siteData) {
        $site_name = $siteData['site_name'];
        $site_logo = $siteData['site_logo'];
        $site_footer = $siteData['site_footer'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $site_name ? $site_name : "NEWS" ?> | ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.18/css/froala_editor.min.css" integrity="sha512-zQ/wN068DBWX8DC2RvI4k/NPIQ2rVg1pjCqb5GPNVT12jDPoh2wYhP8P9UqPgLgJtP7V8C8oAIiCgQmUrjfTTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row flex_center">
                <!-- LOGO -->
                <div class="col-md-4">
                    <a href="post.php"><img class="logo" class="img-fluid" width="200" src="images/<?php echo $site_logo ? $site_logo : 'news.jpg' ?>"></a>
                </div>
                <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-md-4 text-center">
                    <h4 class="text-capitalize" style="color: #fff; margin:0;">Welcome, <strong><?php echo $_SESSION['username'] ?></strong></h2>
                </div>
                <div class="col-md-4 text-right">
                    <!-- <div class="col-md-offset-9  col-md-1"> -->
                    <a href="logout.php" class="admin-logout">logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>
                        <?php
                        if ($_SESSION['user_role'] == 1) {
                        ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                            <li>
                                <a href="settings.php">Settings</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    ?>
    <!-- /Menu Bar -->