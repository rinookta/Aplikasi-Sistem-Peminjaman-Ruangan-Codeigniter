<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('admin/componen/head'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"> <i class="fa fa-university"></i> Data Ruangan</h3>
              <span style="float:right;">
                <button class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i> Ruangan</button>
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped example">
                <thead>
                <tr class="text-center">
                  <th width="5%">NO</th>
                  <th>RUANGAN</th>
                  <th>KETERANGAN</th>
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                <?php $vr=1; $ruangan= $this->M_admin->ruangan(); foreach($ruangan as $hruangan){ ?>
                <tr>
                  <td><?php echo $vr; ?></td>
                  <td><?php echo $hruangan->ruangan; ?></td>
                  <td><?php echo $hruangan->keterangan; ?></td>
                  <td><button class="btn btn-xs bg-navy" onclick="detail('<?php echo $hruangan->c_ruangan; ?>')"><i class="fa fa-search"></i></button> <a onclick="edit('<?php echo $hruangan->c_ruangan; ?>')" class="btn btn-xs bg-green"><i class="fa fa-edit"></i></a> <a onclick="hapus('<?php echo $hruangan->c_ruangan; ?>')" class="btn btn-xs bg-red"><i class="fa fa-trash"></i></a></td>
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
if($this->session->flashdata('on')=='add'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Ruangan Berhasil Ditambahkan",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='gagal'){
   echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"red",title: "Gagal Memproses",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='edit'){
   echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"green",title: "Ruangan Berhasil Diperbaharui",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='delete'){
   echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Ruangan Berhasil Dihapus",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
?>
<script type="text/javascript">
  var saveas;
    function tutup(){
      $('#form')[0].reset();
      $('#modaladd').modal('hide');
      $('#modaledit').modal('hide');
      $('#modaldetail').modal('hide');
      $('#modalhapus').modal('hide');
    }
    function add(){
      saveas= 'add';
      $('#form')[0].reset();
      $('#modaladd').modal('show');
    }
    function edit(id){
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getruangan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_ruangan"]').val(data.c_ruangan);
          $('[name="ruangan"]').val(data.ruangan);
          $('[name="keterangan"]').val(data.keterangan);
          $('#modaledit').modal('show');
        },
      });
    }
    function hapus(id){
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getruangan/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_ruangan"]').val(data.c_ruangan);
          $('#ruangan1').text(data.ruangan);
          $('#keterangan1').text(data.keterangan);
          $('#modalhapus').modal('show');
        },
      });
    }
    function detail(id){
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getruangan/" + id,
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
<div id="modaladd" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"><i class="fa fa-university"></i> Tambah Data Ruangan</h4>
        </div>
        <form id="form" method="post" action="<?php echo base_url('admin/addruangan') ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label>RUANGAN</label>
            <input type="text" name="ruangan" class="form-control" placeholder="" required="">
          </div>
          <div class="form-group">
            <label>KETERANGAN</label>
            <input type="text" name="keterangan" class="form-control" placeholder="" required="">
          </div>
          <div class="form-group">
            <img class="img-thumbnail" style="width:50%;height:200px;" id="profile-pre2" src="<?php echo base_url(); ?>theme/assets/img/df.jpg" alt="Gambar Ruangan"/><br><br>
            <label>GAMBAR</label>
            <input id="profile-id2" type="file" name="gambar" class="form-control" placeholder="">
          </div>
        </div>        
        <div class="modal-footer">
          <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button> 
          <a class="btn btn-danger" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
        </form>
    </div>
</div>
</div>
<div id="modaledit" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"><i class="fa fa-university"></i> Edit Data Ruangan</h4>
        </div>
        <form id="form" method="post" action="<?php echo base_url('admin/editruangan') ?>" enctype="multipart/form-data">
        <input type="hidden" name="c_ruangan" value="">
        <div class="modal-body">
          <div class="form-group">
            <label>RUANGAN</label>
            <input type="text" name="ruangan" class="form-control" placeholder="" required="">
          </div>
          <div class="form-group">
            <label>KETERANGAN</label>
            <input type="text" name="keterangan" class="form-control" placeholder="" required="">
          </div>
          <div class="form-group">
            <label>GAMBAR</label> <label class="pull-right"><input type="checkbox" name="tg" class="flat" value="ya"> (*Centang jika tidak ingin mengganti gambar")</label>
            <input id="profile-id" type="file" name="gambar" class="form-control" placeholder="">
          </div>
        </div>        
        <div class="modal-footer">
          <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Simpan</button> 
          <a class="btn btn-danger" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
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
<div id="modalhapus" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-maroon">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"><i class="fa fa-university"></i> Konfirmasi Hapus Ruangan</h4>
        </div>
        <form method="post" action="<?php echo base_url('admin/delruangan'); ?>">
        <input type="hidden" value="" name="c_ruangan">
        <div class="modal-body">
          <div class="form-group">
            <h5>Apakah Anda Yakin Untuk Menghapus Data Ini?</h5>
            <p id="ruangan1"></p>
            <p id="keterangan1"></p>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary"><i class="fa fa-check"></i> Lanjutkan</button> 
          <a class="btn btn-danger" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Batal</a>
        </div>
        </form>
    </div>
</div>
</div>
<?php $this->load->view('admin/componen/foot'); ?>