<?php
include_once "config.php";
$userID = mysqli_escape_string($conn, $_GET['id']);
$redirect = header("location: $HOST_NAME/users.php");
$userID ? "" : $redirect;
$sql = "DELETE FROM users WHERE user_id = {$userID}";
$result = mysqli_query($conn, $sql) or die("Delete Query failed!");
$redirect;
mysqli_close($conn);
