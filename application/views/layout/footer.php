</div>
</div> 
<!-- Body Content End -->


<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Loading Time <b>{elapsed_time}</b> seconds. <?php echo (ENVIRONMENT === 'development') ? 'CI Version <b>' . CI_VERSION . '</b>' : '' ?>      
    </div>
    <b>Copyright &copy; 2016-<?php echo date('Y'); ?> <a href="http://freelancerklub.com/">FreelancerKlub.com</a>.</b> All rights reserved.
</footer>

 
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

 
</div>
<!-- ./wrapper -->

<script src="assets/lib/plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="assets/lib/plugins/toast/toastr.min.js" type="text/javascript"></script>
<script src="assets/lib/plugins/sweetalert/sweetalert.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="assets/admin/dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes 
<script src="assets/admin/dist/js/demo.js"></script>-->

<script src="assets/admin/custom_scripts.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () { 
        
        toastr.success('<h1>Request Successfull</h1>', 'Success', {
            html: true
        });
        
        
        jQuery('.js_select2').select2({
            placeholder : '--Select--',
            allowClear: true,
            width: '99%'            
        }); 
        
        jQuery('.js_datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
        });

        jQuery('.js_datepicker_next_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            todayBtn: true,
            startDate: new Date()
        });
                
        $('.navbar-nav li.dropdown').on('mouseover', function (e) {
            $(this).find('ul.dropdown-menu').addClass('show');
        });
        $('.navbar-nav li.dropdown').on('mouseleave', function (e) {
            $(this).find('ul.dropdown-menu').removeClass('show');
        });
    });
</script>
</body>
</html>