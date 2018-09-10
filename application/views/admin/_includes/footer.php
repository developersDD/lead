</div>
    <script> 
        var appURL = "<?= base_url(); ?>"; 
        var IMAGES_PATH = "<?= IMAGES_PATH; ?>"; 
    </script>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>
    <!-- global js -->
    <script src="<?= THEME_JS_PATH.'jquery-1.11.3.min.js'; ?>" type="text/javascript"></script>
    
    <script src="<?= JS_PATH.'jquery-ui.js'; ?>" type="text/javascript"></script>
    <script src="<?= JS_PATH.'jquery-ui-timepicker-addon.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_JS_PATH.'bootstrap.min.js'; ?>" type="text/javascript"></script>

    <!--livicons-->
    <script src="<?= THEME_VENDORS_PATH.'livicons/minified/raphael-min.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_VENDORS_PATH.'livicons/minified/livicons-1.4.min.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_JS_PATH.'josh.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_JS_PATH.'metisMenu.js'; ?>" type="text/javascript">
    </script>
    <script src="<?= THEME_VENDORS_PATH.'holder-master/holder.js'; ?>" type="text/javascript"></script>
    <!-- end of global js -->
    <!-- begining of page level js -->
    <!--  todolist-->
    <script src="<?= THEME_JS_PATH.'todolist.js'; ?>"></script>
    <!-- EASY PIE CHART JS -->
    <script src="<?= THEME_VENDORS_PATH.'charts/easypiechart.min.js'; ?>"></script>
    <script src="<?= THEME_VENDORS_PATH.'charts/jquery.easypiechart.min.js'; ?>"></script>
    <!--for calendar-->
    <script src="<?= THEME_VENDORS_PATH.'fullcalendar/fullcalendar.min.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_VENDORS_PATH.'fullcalendar/calendarcustom.min.js'; ?>" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
    <script src="<?= THEME_VENDORS_PATH.'charts/jquery.flot.min.js'; ?>" type="text/javascript"></script>
    <script src="<?= THEME_VENDORS_PATH.'charts/jquery.flot.resize.min.js'; ?>" type="text/javascript"></script>
    <!--Sparkline Chart-->
    <script src="<?= THEME_VENDORS_PATH.'charts/jquery.sparkline.js'; ?>"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="<?= THEME_VENDORS_PATH.'countUp/countUp.js'; ?>"></script>
    <!--   maps -->
    <script src="<?= THEME_VENDORS_PATH.'jvectormap/jquery-jvectormap-1.2.2.min.js'; ?>"></script>
    <script src="<?= THEME_VENDORS_PATH.'jvectormap/jquery-jvectormap-world-mill-en.js'; ?>"></script>
    <script src="<?= THEME_VENDORS_PATH.'jscharts/Chart.js'; ?>"></script>
    <script src="<?= THEME_VENDORS_PATH.'datatables/jquery-1.10.7.dataTables.min.js'; ?>"></script>
    <script src="<?= THEME_VENDORS_PATH.'Buttons-master/js/buttons.js'; ?>"></script>

    <script src="<?= SCRIPTS_PATH.'addon-script.js'; ?>"></script>
    <?php $this->load->view('form_loader'); ?>
    <!-- ++++++++++++++++++ Angular Components +++++++++++++++ -->
    <script src="<?= JS_PATH.'simply-toast.min.js' ?>"></script>
    <script src="<?= JS_PATH.'angular.min.js' ?>"></script>
    <!-- Angular Material Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>

    <script src="<?= JS_PATH.'jquery.blockUI.min.js' ?>"></script>
    <script src="<?= JS_PATH.'angular-block-ui.min.js' ?>"></script>
    <script src="<?= JS_PATH.'angular-datatables.min.js'; ?>"></script>
    <!-- ++++++++++++++++++ /Angular Components +++++++++++++++ -->

    <!-- ++++++++++++++++++ Angular Controllers +++++++++++++++ -->
    <script src="<?= NGAPP_PATH.'app.js'; ?>"></script>
    <!-- ++++++++++++++++++ /Angular Controllers +++++++++++++++ -->
    
    <script type="text/javascript">
    $(document).ready(function() {
        var composeHeight = $('#calendar').height() + 21 - $('.adds').height();
        $('.list_of_items').slimScroll({
            color: '#A9B6BC',
            height: composeHeight + 'px',
            size: '5px'
        });
    });
    </script>
    <!-- end of page level js -->
    
    <script>
      var toast_msg = "<?= $this->session->userdata('success'); ?>";//session msg
      if(toast_msg != ''){
        $.simplyToast(toast_msg, 'success');
      }
      
      var toast_msg = "<?= $this->session->userdata('failed'); ?>";//session msg
      if(toast_msg != ''){
        $.simplyToast(toast_msg, 'danger');
      }
    </script>
    <?php $this->session->unset_userdata('success'); ?>
    <?php $this->session->unset_userdata('failed'); ?>
</body>

</html>