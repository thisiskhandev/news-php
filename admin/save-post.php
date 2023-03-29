<?php

include "config.php";
session_start();

if (isset($_FILES['fileToUpload'])) {
    // echo "<pre>";
    // print_r($_FILES['fileToUpload']);
    // echo "</pre>";

    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);
    $file_ext = strtolower($file_ext);

    $extensions = array("jpeg", "png", "jpg");

    // If file extension is not matched with the following extensions.
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension is not allowed please use only PNG, JPEG, JPG formats only!";
    }

    // If file size is greater than 2mb
    if ($file_size > 2097152) { #bytes
        $errors[] = "The file size should be less than 2mb";
    }

    // If there are no errors while uploading file proceed to queries
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);

        $title = mysqli_escape_string($conn, $_POST['post_title']);
        $desc = mysqli_escape_string($conn, $_POST['postdesc']);
        $cat = mysqli_escape_string($conn, $_POST['category']);
        $date = date("d M, Y");
        $author = $_SESSION['user_id'];
        // $file_name = mysqli_escape_string($conn, $file_name);

        $sql = "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('{$title}', '{$desc}', {$cat}, '{$date}', {$author}, '{$file_name}');";
        $sql .= "UPDATE category SET post = post + 1 WHERE cat_id = {$cat};";
        $sql .= "UPDATE users SET num_of_posts = num_of_posts + 1 WHERE user_id = {$author}";

        if (mysqli_multi_query($conn, $sql)) {
            header("location: $HOST_NAME/post.php");
        } else {
            echo 'Query Failed!';
        }
    } else {
        print_r($errors);
    }
} else {
    header("location: $HOST_NAME/post.php");
}
