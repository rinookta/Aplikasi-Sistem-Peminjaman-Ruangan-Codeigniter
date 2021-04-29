<?php $this->load->view('users/componen/head'); ?>
<?php $c_users= $this->session->userdata('c_users'); ?>
<script type="text/javascript">
    var auto_refresh= setInterval(
      function(){
        $(".notif").load('<?php echo base_url('users/notif/').$c_users; ?>');
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
    function tutup(){
      $('#formdetail')[0].reset();
      $('#detailnotif').modal('hide');
    }
    function detailnotif(id){
      $.ajax({
        url : "<?php echo base_url(); ?>users/getnotif/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if(data.notif=='reject'){
                var ket= '<b>Reject -</b> Pengajuan Anda di Reject <br>';
            }
            else if(data.notif=='pending'){
                var ket= '<b>Pending -</b> Pengajuan Anda di Pending <br>';
            }
            else if(data.notif=='approve'){
                var ket= '<b>Approve -</b> Pengajuan Anda di Approve <br>';
            }
            else if(data.notif=='delete'){
                var ket= '<b>Delete -</b> Pengajuan Anda di Hapus <br>';
            }
            $("#waktu").html(data.at);
            $("#ket").html(ket);
            $('#catatan').html(data.catatan);         
            $('#detailnotif').modal('show');
        },
      });
    }
</script>
<div id="detailnotif" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-pencil"></i> Catatan</h4>
        </div>
        <form id="formdetail" enctype="multipart/form-data">
          <div class="modal-body">
            <label>Waktu</label>
            <p id="waktu"></p>
            <label>Keterangan</label>
            <p id="ket"></p>
            <label>Catatan</label>
            <p id="catatan"></p>
          </div>
        </form>      
        <div class="modal-footer">
          <a class="btn btn-default btn-sm" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('users/componen/foot'); ?>
