<?php
session_start();
include "config.php";
if (!isset($_SESSION['username'])) {
    header("location: $HOST_NAME");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
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
                    <a href="post.php"><img class="logo" class="img-fluid" width="200" src="images/news.jpg"></a>
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