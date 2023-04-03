<?php include_once "config.php";
$page = basename($_SERVER['PHP_SELF']);
$currentPageTitle = basename($_SERVER['PHP_SELF']);
/*
if (str_ends_with($page, ".php")) {
    $page = substr($page, 0, -4);
}
$currentPageTitle = basename($_SERVER['PHP_SELF']);
if (str_ends_with($currentPageTitle, ".php")) {
    $currentPageTitle = substr($currentPageTitle, 0, -4);
}
*/

# Settings from DB
$sqlSetting = "SELECT * FROM settings";
$resultSetting = mysqli_query($conn, $sqlSetting) or die("Query failed: Logo & copyright see settings");
// $site_name = mysqli_fetch_assoc($result)['site_name'];
if (mysqli_num_rows($resultSetting) > 0) {
    foreach ($resultSetting as $siteData) {
        $site_name = $siteData['site_name'];
        $site_fav = $siteData['site_fav'];
        $site_logo = $siteData['site_logo'];
        $site_footer = $siteData['site_footer'];
    }
}


if ($page == "index.php") {
    $page = $site_name;
} elseif ($page == "single.php") {
    if ($_GET['id']) {
        $sqlTitle = "SELECT title FROM post WHERE post_id = {$_GET['id']}";
        $resultTitle = mysqli_query($conn, $sqlTitle) or die("Query failed: Post Title");
        $title = mysqli_fetch_assoc($resultTitle);
        // print_r($title);
        $page = $title ? $title['title'] : "Title" . " News";
    } else {
        $page = "No Post Found!";
    }
} elseif ($page == "category.php") {
    if ($_GET['id']) {
        $sqlTitle = "SELECT cat_name FROM category WHERE cat_id = {$_GET['id']}";
        $resultTitle = mysqli_query($conn, $sqlTitle) or die("Query failed: Category Title");
        $title = mysqli_fetch_assoc($resultTitle);
        $page = $title ? $title['cat_name'] : "Category" . " News";
    } else {
        $page = "No Post Found!";
    }
} elseif ($page == "author.php") {
    if ($_GET['aid']) {
        $sqlAuthor = "SELECT author, first_name, last_name FROM post p
        INNER JOIN users ON p.author = users.user_id
        WHERE author = {$_GET['aid']}";
        $resultAuthor = mysqli_query($conn, $sqlAuthor) or die("Query failed: Author name");
        $author = mysqli_fetch_assoc($resultAuthor);
        $page = $author ? $author['first_name'] . " " . $author['last_name'] : "Author" . " News";
    } else {
        $page = "No Post Found!";
    }
}

$page =  ucwords($page); # Capitalize Words

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        <?php if ($currentPageTitle == "index.php") {
            echo $page . " | Hassan Khan";
        } else {
            echo $page . " - " . $site_name . " | Hassan Khan";
        } ?>
    </title>
    <link rel="icon" type="image/x-icon" href="./admin/images/<?php echo $site_fav ? $site_fav : 'fav.jpg' ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="<?php echo $BASE_URL ?>" id="logo"><img src="./admin/images/<?php echo $site_logo ? $site_logo : 'news.jpg' ?>"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>
                        <?php
                        $sql = "SELECT * FROM category WHERE category.post > 0";
                        $result = mysqli_query($conn, $sql) or die("Query failed: Header Category");
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $keys) {
                                if ($currentPageTitle == "category.php" && $_GET['id'] == $keys['cat_id']) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo "<li><a class='$active' href='category.php?id={$keys['cat_id']}'>{$keys['cat_name']}</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->