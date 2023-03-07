<?php include "header.php";
include_once "unauth.php";
include "config.php";
$userID = $_GET['id'];
$userID ? "" : header("location: $HOST_NAME/users.php");
$sql = "SELECT first_name, last_name, username, role FROM users WHERE user_id = {$userID}";
$result = mysqli_query($conn, $sql) or die("Insert Query failed!");


if (isset($_POST['submit'])) {
    // Update user data.
    $id = mysqli_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_escape_string($conn, $_POST['fname']);
    $lname = mysqli_escape_string($conn, $_POST['lname']);
    $user = mysqli_escape_string($conn, $_POST['username']);
    $role = mysqli_escape_string($conn, $_POST['role']);
    $sql1 = "UPDATE users SET first_name = '{$fname}', last_name = '{$lname}', username = '{$user}', role = '{$role}' WHERE user_id = '{$id}'";
    $result1 = mysqli_query($conn, $sql1) or die("Update Query failed!");
    header("location: $HOST_NAME/users.php");
    mysqli_close($conn);
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $keys) {
                        // print_r($keys);
                ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $userID ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" value="<?php echo $keys['first_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" value="<?php echo $keys['last_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $keys['username'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $keys['role']; ?>">
                                    <?php
                                    if ($keys['role'] == 1) {
                                        echo "
                                    <option value='0'>Normal User</option>
                                    <option value='1' selected>Admin</option>";
                                    } else {
                                        echo '<option value="0" selected>Normal User</option>
                                    <option value="1">Admin</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php
                    }
                }
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>