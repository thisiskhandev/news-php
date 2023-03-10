<?php

include "config.php";
session_start();
if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
    # ERROR WHILE UPDATE POST AS UPLOADED IMAGE!
} else {
    $errors = array();
    $file_name = $_FILES['new-image']['name'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_size = $_FILES['new-image']['size'];
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);
    $file_ext = strtolower($file_ext);

    $extensions = array("jpeg", "png", "jpg");

    // If file extension is not matched with the following extensions.
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension is not allowed please use only PNG, JPEG, JPG formats only!";
        die();
    }

    // If file size is greater than 2mb
    if ($file_size > 2097152) {
        $errors[] = "The file size should be less than 2mb";
        die();
    }

    // If there are no errors while uploading file proceed to queries
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);

        $post_id = mysqli_escape_string($conn, $_POST['post_id']);
        $title = mysqli_escape_string($conn, $_POST['post_title']);
        $desc = mysqli_escape_string($conn, $_POST['postdesc']);
        $cat = mysqli_escape_string($conn, $_POST['category']);
        $date = date("d M, Y");
        // $file_name = mysqli_escape_string($conn, $file_name);

        echo $sql = "UPDATE post SET title = '{$title}', description = '{$desc}', category = {$cat}, post_date = '{$date}', post_img = '{$file_name}'
        WHERE post_id = {$post_id}";
        // $sql .= "UPDATE category SET post = post + 1 WHERE cat_id = {$cat}";

        if (mysqli_multi_query($conn, $sql)) {
            header("location: $HOST_NAME/post.php");
        } else {
            echo 'Query Failed!';
        }
    } else {
        print_r($errors);
        die();
    }
}
