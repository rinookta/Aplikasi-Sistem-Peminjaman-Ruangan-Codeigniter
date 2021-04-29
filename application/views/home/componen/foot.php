  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a>Rino Oktavianto</a>.</strong> Aplikasi Pemesanan Ruangan
  </footer>
</div>
<!-- ./wrapper -->
<?php $uricalender= $this->uri->segment(2); if($uricalender!='calender'){ ?>
<script src="<?php echo base_url(); ?>theme/bower_components/jquery/dist/jquery.min.js"></script>
<?php } ?>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>theme/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>theme/dist/js/demo.js"></script>
</body>
</html>