<!-- Footer -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span>© Copyright <?php echo date("Y") . " | "; 
                                    echo $site_footer; ?></span>
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
<script src="./assets/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "textarea.tinymce",
        // menubar: false,
        // statusbar: false,
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });
    // Validation Tinymce Editor
    $(document).ready(function() {
        $('input[name="submit"]').click(function(e) {
            let addPostDesc = tinyMCE.get('mce_0').getContent();
            if (!addPostDesc) {
                e.preventDefault();
                alert("Add Description");
            } else {
                $(this).unbind(e)
            }
        })
    });
</script>
</body>

</html>