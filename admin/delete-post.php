<?php

include "config.php";

$post_id = $_GET['id'];
$cat_id = $_GET['cid'];
$user_id = $_GET['uid'];

$sql1 = "SELECT * FROM post WHERE post_id  = {$post_id}";
$result = mysqli_query($conn, $sql1) or die("Query failed result");
foreach ($result as $keys) {
    $sql = "DELETE FROM post WHERE post_id = {$post_id};";
    $sql .= " UPDATE category SET post = post - 1 WHERE cat_id = {$cat_id};";
    $sql .= " UPDATE users SET num_of_posts = num_of_posts - 1 WHERE user_id = {$user_id}";
    if (mysqli_multi_query($conn, $sql)) {
        if (file_exists("upload/" . $keys['post_img'])) {
            echo "file deleted!";
        }
        header("location: $HOST_NAME/post.php");
    } else {
        echo "Delete Query failed!";
    }
}