<?php include "header.php";

include "config.php";

$sql = "SELECT * FROM users ORDER BY user_id DESC";
$result = mysqli_query($conn, $sql) or die("Users view Query failed!");

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $keys) {
                        ?>
                                <tr>
                                    <td class='id'><?php echo $keys['user_id'] ?></td>
                                    <td><?php echo $keys['first_name'] . " " . $keys['last_name'] ?></td>
                                    <td><?php echo $keys['username'] ?></td>
                                    <td><?php echo $keys['role'] == 1 ? "Admin" : "Editor" ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $keys['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $keys['user_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            }
                        }
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>