<?php include "header.php";
include_once "unauth.php";
if (isset($_POST['save'])) {
    $cat_name = mysqli_escape_string($conn, $_POST['cat_name']);
    $sql = "INSERT INTO category (cat_name) VALUES ('{$cat_name}')";
    if (mysqli_query($conn, $sql)) {
        header("location: $HOST_NAME/category.php");
    } else {
        echo '<div class="mt-5 alert alert-danger" role="alert">Cannot add a new category Error!</div>';
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>