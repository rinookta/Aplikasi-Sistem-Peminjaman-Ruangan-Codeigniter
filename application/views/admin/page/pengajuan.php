<?php $this->load->view('admin/componen/head'); ?>
<?php $this->load->view('php/function'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-external-link"></i> Semua Data Pengajuan</h3>
			</div>
			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped example">
                <thead>
	                <tr class="text-center">
	                  <th width="5%">NO</th>
	                  <th>HARI</th>
	                  <th>MULAI</th>
	                  <th>SELESAI</th>
	                  <th>RUANGAN</th>
	                  <th>KEPERLUAN</th>
	                  <th>PEMINJAM</th>
                    <th>AKSI</th>
	                  <th>STATUS</th>                      
	                </tr>
                </thead>
                <tbody>
                	<?php $allpeng= $this->M_admin->allpengajuan(); $vr=1; foreach($allpeng as $hallpeng){ ?>
                	<tr>
                		<td><?php echo $vr; ?></td>
                		<?php if($hallpeng->status=='reject'){
                      echo '<td style="background-color: #d33724;color:#fff;">'.hari($hallpeng->mulai).'</td>';
                    } else if($hallpeng->status=='pending'){
                      echo '<td style="background-color: #00a65a;color:#fff;">'.hari($hallpeng->mulai).'</td>';
                    } else if($hallpeng->status=='approve'){
                      echo '<td style="background-color: #005384;color:#fff;">'.hari($hallpeng->mulai).'</td>';
                    } else if($hallpeng->status=='batal'){
                      echo '<td>'.hari($hallpeng->mulai).'</td>';
                    } else{
                      echo '<td>'.hari($hallpeng->mulai).'</td>';
                    }?>
                		<td><?php echo date('d-m-Y H:i:s',strtotime($hallpeng->mulai)); ?></td>
                		<td><?php echo date('d-m-Y H:i:s',strtotime($hallpeng->selesai)); ?></td>
                		<td><?php echo $hallpeng->ruangan; ?></td>
                		<td><?php echo $hallpeng->keperluan; ?></td>
                		<td><?php echo $hallpeng->peminjam; ?></td>
                        <td>
                          <?php $dt=date('Y-m-d H:i:s'); if($hallpeng->selesai>=$dt){ ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-info btn-xs">Opsi</button>
                              <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#" onclick="pending('<?php echo $hallpeng->c_pengajuan; ?>')">Pending</a></li>
                                <li><a href="#" onclick="approve('<?php echo $hallpeng->c_pengajuan; ?>')">Approve</a></li>
                                <li><a href="#" onclick="reject('<?php echo $hallpeng->c_pengajuan; ?>')">Reject</a></li>
                              </ul>
                            </div>
                          <?php } ?>
                            <a href="#" onclick="hapus('<?php echo $hallpeng->c_pengajuan; ?>')" class="btn btn-xs bg-red"><i class="fa fa-trash"></i></a>
                        </td>
                		<td><?php if($hallpeng->status=='reject'){echo '<span class="badge bg-red">Reject</span>';} else if($hallpeng->status=='pending'){echo '<span class="badge bg-green">Pending...</span>';} else if($hallpeng->status=='approve'){echo '<span class="badge bg-blue">Approve</span>';} else if($hallpeng->status=='batal'){echo '<span class="badge bg-navy">Dibatalkan</span>';} else{echo '<span class="badge bg-grey">NO Respon</span>';}?></td>
                	</tr>
                	<?php $vr++; } ?>
                </tbody>
            	</table>
			</div>
		</div>
    </section>
    <!-- /.content -->
</div>
<?php
if($this->session->flashdata('on')=='pending'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Status Dirubah Menjadi Pending",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='approve'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Status Dirubah Menjadi Approve",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='reject'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Status Dirubah Menjadi Reject",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='del'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"red",title: "Data Berhasil Dihapus",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
?>
<script type="text/javascript">
    var saveas;
    function tutup(){
      $('#form')[0].reset();
      $('#modalopsi').modal('hide');
    }
    function pending(id){
      saveas= 'pending';
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getpengajuan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_pengajuan"]').val(data.c_pengajuan);
          $('[name="c_users"]').val(data.c_users);
          $(".modal-title").html('<i class="fa fa-external-link"></i> Konfirmasi Pengajuan Pending');
          $("#pesan").text('Apakah Anda Yakin Akan Merubah Status Pengajuan Menjadi Pending?');
          $('#modalopsi').modal('show');
        },
      });
    }
    function approve(id){
      saveas= 'approve';
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getpengajuan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_pengajuan"]').val(data.c_pengajuan);
          $('[name="c_users"]').val(data.c_users);
          $(".modal-title").html('<i class="fa fa-external-link"></i> Konfirmasi Pengajuan Approve');
          $("#pesan").text('Apakah Anda Yakin Akan Merubah Status Pengajuan Menjadi Approve?');
          $('#modalopsi').modal('show');
        },
      });
    }
    function reject(id){
      saveas= 'reject';
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getpengajuan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_pengajuan"]').val(data.c_pengajuan);
          $('[name="c_users"]').val(data.c_users);
          $(".modal-title").html('<i class="fa fa-external-link"></i> Konfirmasi Pengajuan Reject');
          $("#pesan").text('Apakah Anda Yakin Akan Merubah Status Pengajuan Menjadi Reject?');
          $('#modalopsi').modal('show');
        },
      });
    }
    function hapus(id){
      saveas= 'del';
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getpengajuan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_pengajuan"]').val(data.c_pengajuan);
          $('[name="c_users"]').val(data.c_users);
          $(".modal-title").html('<i class="fa fa-external-link"></i> Konfirmasi Hapus Pengajuan');
          $("#pesan").text('Apakah Anda Yakin Akan Menghapus Pengajuan Ini?, Pengajuan dan Berkas Pengajuan Akan Terhapus');
          $('#modalopsi').modal('show');
        },
      });
    }
    function lanjut(){
      if(saveas== 'pending'){
        var url= "<?php echo base_url();?>admin/pendingpengajuan";
      }
      else if(saveas== 'approve'){
        var url= "<?php echo base_url();?>admin/approvepengajuan";
      }
      else if(saveas== 'reject'){
        var url= "<?php echo base_url();?>admin/rejectpengajuan";
      }
      else if(saveas== 'del'){
        var url= "<?php echo base_url();?>admin/delpengajuan";
      }
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data){
          location.reload();
        },
      });
    }
</script>
<div id="modalopsi" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"></h4>
        </div>
        <form id="form">
        <input type="hidden" name="c_pengajuan" value="">
        <input type="hidden" name="c_users" value="">
          <div class="modal-body">
            <p id="pesan"></p>
            <div class="form-group">
              <label>CATATAN</label>
              <textarea class="form-control" name="catatan"></textarea>
            </div>
          </div>       
        <div class="modal-footer">
          <button class="btn btn-primary btn-sm" onclick="lanjut()"><i class="fa fa-check"></i> Lanjukan</button> 
          <a class="btn btn-default btn-sm" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
      </form>
    </div>
</div>
</div>
<?php $this->load->view('admin/componen/foot'); ?>
