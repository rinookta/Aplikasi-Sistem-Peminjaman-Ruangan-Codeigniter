<?php $this->load->view('admin/componen/head'); ?>
<script type="text/javascript">
    var auto_refresh= setInterval(
      function(){
        $(".notif").load('<?php echo base_url('admin/notif'); ?>');
      },2000);  
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
    	<div class="box box-info">
    		<div class="box-header with-border">
    			<h3 class="box-title"> <i class="fa fa-bell-o"></i> Notifikasi</h3>
    		</div>
    		<div class="box-body table-responsive">
    			<table class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th width="5%">NO</th>
    						<th>NAMA</th>
    						<th>KETERANGAN</th>
    						<th>WAKTU</th>
    						<th>AKSI</th>
    					</tr>
    				</thead>
    				<tbody class="notif">

    				</tbody>
    			</table>
    		</div>
    	</div>
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
    function off(){
      $.ajax({
        url : "<?php echo base_url(); ?>admin/offnotifikasi/",
        type: "POST",
        data: $('#formoff').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            $('#formoff')[0].reset();
            location.reload();
        },
      });
  }
</script>
<?php $this->load->view('admin/componen/foot'); ?>
