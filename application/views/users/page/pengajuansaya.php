<?php $this->load->view('users/componen/head'); ?>
<?php $this->load->view('php/function'); ?>
<?php $c_users= $this->session->userdata('c_users'); $users= $this->M_users->getusers($c_users); foreach($users as $husers); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-external-link"></i> Data Pengajuan Saya</h3>
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
                      <th>AKSI</th>
	                  <th>STATUS</th>
	                </tr>
                </thead>
                <tbody>
                	<?php $pengsaya= $this->M_users->pengajuansaya($husers->c_users); $vr=1; foreach($pengsaya as $hpengsaya){ ?>
                	<tr>
                		<td><?php echo $vr; ?></td>
                		<?php if($hpengsaya->status=='reject'){
                			echo '<td style="background-color: #d33724;color:#fff;">'.hari($hpengsaya->mulai).'</td>';
                		} else if($hpengsaya->status=='pending'){
                			echo '<td style="background-color: #00a65a;color:#fff;">'.hari($hpengsaya->mulai).'</td>';
                		} else if($hpengsaya->status=='approve'){
                			echo '<td style="background-color: #005384;color:#fff;">'.hari($hpengsaya->mulai).'</td>';
                		} else if($hpengsaya->status=='batal'){
                            echo '<td>'.hari($hpengsaya->mulai).'</td>';
                        } else{
                            echo '<td>'.hari($hpengsaya->mulai).'</td>';
                        }?>
                		<td><?php echo date('d-m-Y H:i:s',strtotime($hpengsaya->mulai)); ?></td>
                		<td><?php echo date('d-m-Y H:i:s',strtotime($hpengsaya->selesai)); ?></td>
                		<td><?php echo $hpengsaya->ruangan; ?></td>
                		<td><?php echo $hpengsaya->keperluan; ?></td>
                        <?php $dt=date('Y-m-d H:i:s'); if($hpengsaya->selesai<=$dt || $hpengsaya->status=='reject' || $hpengsaya->status=='batal' || $hpengsaya->status=='approve'){  echo '<td>-</td>'; }
                        else{ ?>
                            <td><a onclick="getpengajuan('<?php echo $hpengsaya->c_pengajuan; ?>')" class="btn btn-xs bg-green"><i class="fa fa-edit"></i></a> <a onclick="batal('<?php echo $hpengsaya->c_pengajuan; ?>')" class="btn btn-xs bg-red">Cancel</a></td>
                        <?php } ?>
                		<td><?php if($hpengsaya->status=='reject'){echo '<span class="badge bg-red">Reject</span>';} else if($hpengsaya->status=='pending'){echo '<span class="badge bg-green">Pending...</span>';} else if($hpengsaya->status=='approve'){echo '<span class="badge bg-blue">Approve</span>';} else if($hpengsaya->status=='batal'){echo '<span class="badge bg-navy">Dibatalkan</span>';} else{echo '<span class="badge bg-grey">NO Respon</span>';}?></td>
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
if($this->session->flashdata('on')=='gagal'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"red",title: "Gagal Memproses",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='edit'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Pengajuan Berhasil Diperbaharui",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='batal'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"red",title: "Pengajuan Berhasil Dibatalkan",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
?>
<script type="text/javascript">
   function tutup(){
      $('#formedit')[0].reset();
      $('#formbatal')[0].reset();
      $('#editpengajuan').modal('hide');
      $('#batal').modal('hide');
    }
  function getpengajuan(id){
      $.ajax({
        url : "<?php echo base_url(); ?>users/getpengajuan2/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_pengajuan"]').val(data.c_pengajuan);
          $('[name="c_users"]').val(data.c_users);
          $('[name="c_ruangan"]').val(data.c_ruangan);
          $('[name="ruangan"]').val(data.ruangan);
          $('[name="keterangan"]').val(data.keterangan);
          $('[name="m"]').val(data.mulai);
          $('[name="s"]').val(data.selesai);
          $('[name="mulai"]').val(data.mulai);
          $('[name="selesai"]').val(data.selesai);
          $('[name="keperluan"]').val(data.keperluan);
          $('#editpengajuan').modal('show');
        },
      });
  }
  function batal(id){
      $.ajax({
        url : "<?php echo base_url(); ?>users/getpengajuan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="c_users"]').val(data.c_users);
            $('[name="c_pengajuan"]').val(data.c_pengajuan);          
            $('#batal').modal('show');
        },
      });
  }
  function lanjutbatal(){
      $.ajax({
        url : "<?php echo base_url(); ?>users/batalpengajuan",
        type: "POST",
        data: $('#formedit').serialize(),
        dataType: "JSON",
        success: function(data){
          location.reload();
        },
      });
    }
</script>
<div id="editpengajuan" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-pencil-square-o"></i> Edit Pengajuan</h4>
        </div>
        <form id="formedit" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>users/editpengajuan">
        <input type="hidden" name="c_pengajuan" value="">
        <input type="hidden" name="c_users" value="">
        <input type="hidden" name="c_ruangan" value="">
          <div class="modal-body">
            <div class="form-group">
              <label>RUANGAN</label>
              <input type="text" name="ruangan" class="form-control" placeholder="" readonly="">
            </div>
            <div class="form-group">
              <label>KETERANGAN</label>
              <input type="text" name="keterangan" class="form-control" placeholder="" readonly="">
            </div>
            <div class="form-group">
                <label>MULAI</label>
                <div class="input-group date form_datetime" data-date="<?php echo date('d-m-Y H:i:s'); ?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input name="m" class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                </div>
                <input type="hidden" name="mulai" id="dtp_input1" value="" />
            </div>
            <div class="form-group">
                <label>SELESAI</label>
                <div class="input-group date form_datetime" data-date="<?php echo date('d-m-Y H:i:s'); ?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input2">
                    <input name="s" class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                </div>
                <input type="hidden" name="selesai" id="dtp_input2" value="" />
            </div>
            <div class="form-group">
              <label>KEPERLUAN</label>
              <input type="text" name="keperluan" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>BERKAS PENGAJUAN</label> <label class="pull-right"><input type="checkbox" name="tg" class="flat" value="ya"> (*Centang jika tidak ingin mengganti Berkas Pengajuan)</label></label>
              <input type="file" name="berkas" class="form-control">
            </div>
          </div>      
        <div class="modal-footer">
          <button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i> Simpan</button> 
          <a class="btn btn-default btn-sm" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
        </form>
    </div>
</div>
</div>
<div id="batal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-pencil-square-o"></i> Konfirmasi Pembatalan Pengajuan</h4>
        </div>
        <form id="formbatal" enctype="multipart/form-data">
        <input type="hidden" name="c_users" value="">
        <input type="hidden" name="c_pengajuan" value="">
          <div class="modal-body">
            <p>Apakah Anda Yakin Membatalkan Pengajuan Ini?<br>Anda tidak bisa melakukan aksi untuk pengajuan ini</p>
          </div>
        </form>      
        <div class="modal-footer">
          <button class="btn btn-primary btn-sm" onclick="lanjutbatal()"><i class="glyphicon glyphicon-ok"></i> Lanjutkan</button> 
          <a class="btn btn-default btn-sm" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('users/componen/foot'); ?>
