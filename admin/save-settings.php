<?php
include "config.php";
session_start();
// If both logo and fav icon not selected
if (empty($_FILES['new-logo']['name']) && empty($_FILES['new-fav']['name'])) {
    $site_logo = mysqli_escape_string($conn, $_POST['old-logo']);
    $site_fav = mysqli_escape_string($conn, $_POST['old-fav']);
    $site_name = mysqli_escape_string($conn, $_POST['site_name']);
    $site_footer = mysqli_escape_string($conn, $_POST['site_footer']);

    $sql = "UPDATE settings SET 
    site_name = '{$site_name}',
    site_logo = '{$site_logo}',
    site_fav = '{$site_fav}',
    site_footer = '{$site_footer}'";

    if (mysqli_query($conn, $sql)) {
        header("location: $HOST_NAME/post.php");
    } else {
        echo "Query failed: Existing log & fav";
    }
} elseif (empty($_FILES['new-fav']['name'])) { // If logo selected only
    $errors = array();
    // Site Logo
    $file_logo_name = $_FILES['new-logo']['name'];
    $file_tmp = $_FILES['new-logo']['tmp_name'];
    $file_size = $_FILES['new-logo']['size'];
    $tmp = explode('.', $file_logo_name);
    $file_ext = end($tmp);
    $file_ext = strtolower($file_ext);

    $extensions = array("jpeg", "png", "jpg", "svg");

    // If file extension is not matched with the following extensions.
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension is not allowed please use only PNG, JPEG, JPG formats only!";
        die();
    }

    // If file size is greater than 2mb
    if ($file_size > 2097152) {
        $errors[] = "Logo size should not be greater than 2mb!";
        die();
    }

    if (empty($errors)) {
        move_uploaded_file($file_tmp, "images/" . $file_logo_name);
        $site_fav = mysqli_escape_string($conn, $_POST['old-fav']);
        $site_name = mysqli_escape_string($conn, $_POST['site_name']);
        $site_footer = mysqli_escape_string($conn, $_POST['site_footer']);

        $sql = "UPDATE settings SET 
        site_name = '{$site_name}',
        site_logo = '{$file_logo_name}',
        site_fav = '{$site_fav}',
        site_footer = '{$site_footer}'";

        if (mysqli_query($conn, $sql)) {
            header("location: $HOST_NAME/post.php");
        } else {
            echo "Query failed: Existing fav & New Logo";
        }
    } else {
        print_r($errors);
    }
} elseif (empty($_FILES['new-logo']['name'])) { // If Fav selected only
    $errors = array();
    // Site Fav
    $file_fav_name = $_FILES['new-fav']['name'];
    $file_tmp = $_FILES['new-fav']['tmp_name'];
    $file_size = $_FILES['new-fav']['size'];
    $tmp = explode('.', $file_fav_name);
    $file_ext = end($tmp);
    $file_ext = strtolower($file_ext);

    $extensions = array("jpeg", "png", "jpg");

    // If file extension is not matched with the following extensions.
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension is not allowed please use only PNG, JPEG, JPG formats only!";
        die();
    }

    // If logo file size is greater than 1mb
    if ($file_size > 1050000) {
        $errors[] = "Fav size should not be greater than 1mb!";
        die();
    }

    if (empty($errors)) {
        move_uploaded_file($file_tmp, "images/" . $file_fav_name);
        $site_logo = mysqli_escape_string($conn, $_POST['old-logo']);
        $site_name = mysqli_escape_string($conn, $_POST['site_name']);
        $site_footer = mysqli_escape_string($conn, $_POST['site_footer']);

        $sql = "UPDATE settings SET 
        site_name = '{$site_name}',
        site_logo = '{$site_logo}',
        site_fav = '{$file_fav_name}',
        site_footer = '{$site_footer}'";

        if (mysqli_query($conn, $sql)) {
            header("location: $HOST_NAME/post.php");
        } else {
            echo "Query failed: Existing Logo & New Fav icon";
        }
    } else {
        print_r($errors);
    }
} else {
    $errors = array();
    // Site Logo
    $file_logo_name = $_FILES['new-logo']['name'];
    $file_tmp = $_FILES['new-logo']['tmp_name'];
    $file_size = $_FILES['new-logo']['size'];
    $tmp = explode('.', $file_logo_name);
    $file_ext = end($tmp);
    $file_ext = strtolower($file_ext);

    // Site fav
    $file_fav_name = $_FILES['new-fav']['name'];
    $file_tmp_2 = $_FILES['new-fav']['tmp_name'];
    $file_size_2 = $_FILES['new-fav']['size'];
    $tmp_2 = explode('.', $file_fav_name);
    $file_ext_2 = end($tmp_2);
    $file_ext_2 = strtolower($file_ext_2);

    $extensions = array("jpeg", "png", "jpg");

    // If file extension is not matched with the following extensions.
    if (in_array($file_ext, $extensions) === false && in_array($file_ext_2, $extensions) === false) {
        $errors[] = "This extension is not allowed please use only PNG, JPEG, JPG formats only!";
        die();
    }

    // If logo file size is greater than 2mb and Fav icon should not greater than 1mb
    if ($file_size > 2097152 && $file_size_2 > 1050000) {
        $errors[] = "Minimium file size is not meet!";
        die();
    }


    // If there are no errors while uploading file proceed to queries
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "images/" . $file_logo_name);
        move_uploaded_file($file_tmp_2, "images/" . $file_fav_name);

        $site_name = mysqli_escape_string($conn, $_POST['site_name']);
        $site_footer = mysqli_escape_string($conn, $_POST['site_footer']);

        $sql = "UPDATE settings SET 
        site_name = '{$site_name}',
        site_logo = '{$file_logo_name}',
        site_fav = '{$file_fav_name}',
        site_footer = '{$site_footer}'";

        if (mysqli_multi_query($conn, $sql)) {
            header("location: $HOST_NAME/post.php");
        } else {
            echo 'Query Failed: New logo and fav';
        }
    } else {
        print_r($errors);
    }
}
