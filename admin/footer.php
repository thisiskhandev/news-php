<!-- Footer -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span>© Copyright <?php echo date("Y") ?> News | Powered by <a href="#">Hassan Khan</a></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
<script>
    let error = document.querySelector(".error_alert");
    if (error) {
        setTimeout(() => {
            error.style.display = "none";
            // window.location.href = "add-post.php";
        }, 8000)
    }
</script>
</body>

</html>