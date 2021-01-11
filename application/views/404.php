<?php
/* SOURCE CODE FOR ERROR 404 */
require_once 'header.php';              // CALL HEADER SCRIPT
require_once 'menubar.php';             // CALL MENU BAR SCRIPT
require_once 'titlebar.php';            // CALL TITLE BAR SCRIPT
?>
<div class="error-page">
    <h2 class="headline text-warning"> 404</h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

        <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?php echo base_url();?>">return to home</a>
        </p>
    </div>
    <!-- /.error-content -->
</div>
<!-- /.error-page -->
<?php
/* LOAD FOOTER SCRIPT */
require_once 'footer.php';
?>