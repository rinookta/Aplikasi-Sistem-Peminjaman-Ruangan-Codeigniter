<?php $this->load->view('users/componen/head'); ?>
<?php $c_users= $this->session->userdata('c_users'); $users= $this->M_users->getusers($c_users); foreach($users as $husers); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"> <i class="fa fa-university"></i> Data Ruangan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped example">
                <thead>
                <tr class="text-center">
                  <th width="5%">NO</th>
                  <th>RUANGAN</th>
                  <th>KETERANGAN</th>
                  <th>STATUS</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
    	          <?php $ruangan= $this->M_users->ruangan(); $vr=1; foreach($ruangan as $hruangan){
                $cekpeng= $this->M_users->cekpengajuan($hruangan->c_ruangan); ?>
                <tr>
                  <td><?php echo $vr; ?></td>
                  <td><?php echo $hruangan->ruangan; ?></td>
                  <td><?php echo $hruangan->keterangan; ?></td>
                  <?php
                  if(!empty($cekpeng)){ foreach($cekpeng as $hcekpeng);
                    if($hcekpeng->status=='reject' or $hcekpeng->status=='batal'){
                      echo '<td>Tidak Terpakai</td>';
                      ?>
                      <td>
                        <button class="btn btn-xs bg-navy" onclick="detail('<?php echo $hruangan->c_ruangan; ?>')"><i class="fa fa-search"></i></button>
                        <a onclick="buatpengajuan('<?php echo $hruangan->c_ruangan; ?>')" class="btn btn-xs bg-blue"><i class="fa fa-cloud-upload"></i> Buat Pengajuan</a>
                      </td>
                      <?php
                    }
                    else if($hcekpeng->status=='pending' or $hcekpeng->status==''){
                      echo '<td>Dalam Pengajuan</td>';
                      ?>
                      <td><button class="btn btn-xs bg-navy" onclick="detail('<?php echo $hruangan->c_ruangan; ?>')"><i class="fa fa-search"></i></button></td>
                      <?php
                    }
                    else if($hcekpeng->status=='approve'){
                      echo '<td>Terpakai</td>';
                      ?>
                      <td><button class="btn btn-xs bg-navy" onclick="detail('<?php echo $hruangan->c_ruangan; ?>')"><i class="fa fa-search"></i></button></td>
                      <?php
                    }
                  }
                  else{
                    echo '<td>Tidak Terpakai</td>';
                    ?>
                      <td>
                        <button class="btn btn-xs bg-navy" onclick="detail('<?php echo $hruangan->c_ruangan; ?>')"><i class="fa fa-search"></i></button>
                        <a onclick="buatpengajuan('<?php echo $hruangan->c_ruangan; ?>')" class="btn btn-xs bg-blue"><i class="fa fa-cloud-upload"></i> Buat Pengajuan</a>
                      </td>
                      <?php
                  }?>
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
if($this->session->flashdata('on')=='add'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Berhasil Memproses Pengajuan",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
?>
<script type="text/javascript">
   function tutup(){
      $('#addpengajuan')[0].reset();
      $('#buatpengajuan').modal('hide');
      $('#modaldetail').modal('hide');
    }
  function buatpengajuan(id){
      $.ajax({
        url : "<?php echo base_url(); ?>users/getruangan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_ruangan"]').val(data.c_ruangan);
          $('[name="ruangan"]').val(data.ruangan);
          $('[name="keterangan"]').val(data.keterangan);
          $('#buatpengajuan').modal('show');
        },
      });
  }
  function detail(id){
      $.ajax({
        url : "<?php echo base_url(); ?>users/getruangan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('#ruangan').text(data.ruangan);
          $('#keterangan').text(data.keterangan);
          if(data.gambar==''){
            $('#gambar').html('<img class="img-thumbnail" width="90%" id="profile-pre" src="<?php echo base_url(); ?>theme/assets/img/df.jpg" alt="Gambar Ruangan"/>');
          }
          else{
            $('#gambar').html('<img class="img-thumbnail" style="width:50%;height:200px;" id="profile-pre" src="<?php echo base_url(); ?>'+data.gambar+'" alt="Gambar Ruangan"/>');
          }
          $('#modaldetail').modal('show');
        },
      });
    }
</script>
<div id="buatpengajuan" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-pencil-square-o"></i> Buat Pengajuan</h4>
        </div>
        <form id="addpengajuan" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>users/addpengajuan">
        <input type="hidden" name="c_users" value="<?php echo $husers->c_users; ?>">
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
                    <input class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                </div>
                <input type="hidden" name="mulai" id="dtp_input1" value="" />
            </div>
            <div class="form-group">
                <label>SELESAI</label>
                <div class="input-group date form_datetime" data-date="<?php echo date('d-m-Y H:i:s'); ?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input2">
                    <input class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                </div>
                <input type="hidden" name="selesai" id="dtp_input2" value="" />
            </div>
            <div class="form-group">
              <label>KEPERLUAN</label>
              <input type="text" name="keperluan" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label>BERKAS PENGAJUAN</label>
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
<div id="modaldetail" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-maroon">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"><i class="fa fa-university"></i> Detail Ruangan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>RUANGAN</label>
            <p id="ruangan"></p>
            <label>KETERANGAN</label>
            <p id="keterangan"></p>
            <label>GAMBAR</label>
            <p id="gambar"></p>
          </div>
        </div>
        <div class="modal-footer"> 
          <button class="btn btn-default" onclick="tutup()">Tutup</button>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('users/componen/foot'); ?>
