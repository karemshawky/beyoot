		</div>
<!-- END CONTENT BODY -->
	</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner"> 2018 &copy; <a href="#" title="#" target="_blank"> 4Art studio</a> </div>
	<div class="scroll-to-top"> <i class="icon-arrow-up"></i> </div>
</div>
<!-- END FOOTER -->
</div>
<!--[if lt IE 9]>
        <script src="assets/global/plugins/respond.min.js"></script>
        <script src="assets/global/plugins/excanvas.min.js"></script> 
        <script src="assets/global/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?= BackEndUrl ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= BackEndUrl ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<!-- <script src="assets/global/plugins/moment.min.js" type="text/javascript"></script> -->
<!-- <script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE TABLE LEVEL PLUGINS -->
<script src="<?= BackEndUrl ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/jquery-repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
<!-- <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> -->
<!-- END PAGE TABLE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= BackEndUrl ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= BackEndUrl ?>assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
<script src="<?= BackEndUrl ?>assets/pages/scripts/form-dropzone.min.js" type="text/javascript"></script>
<!-- <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> -->
<!-- <script src="assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?= BackEndUrl ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<!-- <script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script> -->
<!-- <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script> -->
<!-- <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script> -->
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?= BaseUrl ?>templates/responsive_filemanager/tinymce/tinymce.min.js"></script>
<script>
  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
  });
</script>
<script>
  tinymce.init({
      selector: "textarea",theme: "modern",height: 150, directionality :"rtl",
      plugins: [
          "advlist autolink link image lists charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
          "table contextmenu directionality emoticons paste textcolor imagetools responsivefilemanager code"
    ],
    relative_urls: false,
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
    content_css: [ 'http://www.fontstatic.com/f=DroidKufi-Regular'],
    image_advtab: true ,
    
    external_filemanager_path:"<?= BaseUrl ?>templates/responsive_filemanager/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "<?= BaseUrl ?>templates/responsive_filemanager/filemanager/plugin.min.js"}
  });
</script>
<script>
  $('.close').click(function(){
    $(this).parents('li').remove();
  });
</script>

</body>
</html>