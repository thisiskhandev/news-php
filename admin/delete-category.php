<?php

include_once "config.php";
$_GET['id'] ? $catID =  mysqli_real_escape_string($conn, $_GET['id']) : header("location: $HOST_NAME/category.php");
$sql = "DELETE FROM category WHERE cat_id = {$catID}";
$result = mysqli_query($conn, $sql) or die("Can't delete the category Query Failed!");
if ($result) {
    header("location: $HOST_NAME/category.php");
}
