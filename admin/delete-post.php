<?php

include "config.php";

$post_id = $_GET['id'];
$cat_id = $_GET['cat'];

$sql1 = "SELECT * FROM post WHERE post_id  = {$post_id}";
$result1 = mysqli_query($conn, $sql1) or die("Query failed result1");
foreach ($result1 as $keys) {
    echo "<pre>";
    print_r($keys);
    echo "</pre>";
}

die();

$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post-1 WHERE cat_id = {$cat_id}";

if (mysqli_multi_query($conn, $sql)) {
    if (file_exists("upload/" . $file)) {
        unlink("upload/" . $file);
        // echo "file deleted!";
    }
    header("location: $HOST_NAME/post.php");
} else {
    echo "Query failed!";
}
