<?php

if ($_SESSION['user_role'] == 0) {
    include "config.php";
    header("location: $HOST_NAME/post.php");
}
