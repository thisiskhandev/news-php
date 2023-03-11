<?php
// It won't redirect to login page if user is already login.
session_start();
if (isset($_SESSION['username'])) {
    include "config.php";
    header("location: $HOST_NAME/post.php");
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <?php
                    if (isset($_POST['login'])) {
                        include "config.php";
                        $user = mysqli_escape_string($conn, $_POST['username']);
                        $password = mysqli_escape_string($conn, md5($_POST['password']));
                        $sql = "SELECT user_id, username, role, password FROM users WHERE username = '{$user}' AND password = '{$password}'";
                        $result = mysqli_query($conn, $sql) or die("Login Query failed!");
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $key) {
                                $_SESSION['username']  = $key['username'];
                                $_SESSION['user_id'] = $key['user_id'];
                                $_SESSION['user_role'] = $key['role'];
                                header("location: $HOST_NAME/post.php");
                            }
                        } else {
                            echo '<div class="mt-5 alert alert-danger" role="alert">Username or password are not matched</div>';
                        }
                    }
                    ?>
                    <!-- /Form  End -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>