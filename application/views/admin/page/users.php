<?php $this->load->view('admin/componen/head'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
    	<div class="box box-info">
    		<div class="box-header with-border">
    			<h3 class="box-title"> <i class="fa fa-users"></i> Data Users</h3>
    		</div>
    		<div class="box-body table-responsive">
    			<table class="table table-bordered table-striped example">
    				<thead>
    					<tr>
    						<th>NAMA</th>
    						<th>EMAIL</th>
    						<th>NOTELP</th>
    						<th>INSTANSI</th>
                <th>USERNAME</th>
                <th>PASSWORD</th>
                <th>REGISTER</th>
                <th>STATUS</th>
                <th>AKSI</th>
    					</tr>
    				</thead>
    				<tbody>
              <?php $users= $this->M_admin->users(); foreach($users as $husers){ ?>
              <tr>
                  <td><?php echo $husers->nama; ?></td>
                  <td><?php echo $husers->email; ?></td>
                  <td><?php echo $husers->notelp; ?></td>
                  <td><?php echo $husers->instansi; ?></td>
                  <td><?php echo $husers->username; ?></td>
                  <td><?php echo $husers->p; ?></td>
                  <td><?php echo $husers->at; ?></td>
                  <td><?php echo $husers->status; ?></td>
                  <td>
                      <?php if($husers->status=='aktif' or $husers->status=='pending'){ ?>
                          <button onclick="nonaktif('<?php echo $husers->c_users; ?>')" class="btn btn-xs bg-red"><i class="fa fa-times-circle"></i></button>
                      <?php }else if($husers->status=='nonaktif'){ ?>
                          <button onclick="aktif('<?php echo $husers->c_users; ?>')" class="btn btn-xs bg-blue"><i class="fa fa-check"></i></button>
                      <?php } ?>
                  </td>
              </tr>
              <?php } ?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </section>
    <!-- /.content -->
  </div>
<?php
if($this->session->flashdata('on')=='nonaktif'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"red",title: "Status Akun Dirubah Menjadi Nonaktif",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='aktif'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Status Akun Dirubah Menjadi Aktif",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
?>
<script type="text/javascript">
    var saveas;
    function tutup(){
      $('#form')[0].reset();
      $('#modalopsi').modal('hide');
    }
    function nonaktif(id){
      saveas= 'nonaktif';
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getusers/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_users"]').val(data.c_users);
          $(".modal-title").html('<i class="fa fa-users"></i> Konfirmasi Nonaktif Users');
          $("#pesan").text('Apakah Anda Yakin Akan Merubah Status Akun Menjadi Nonaktif?');
          $('#modalopsi').modal('show');
        },
      });
    }
    function aktif(id){
      saveas= 'aktif';
      $.ajax({
        url : "<?php echo base_url(); ?>admin/getusers/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="c_users"]').val(data.c_users);
          $(".modal-title").html('<i class="fa fa-users"></i> Konfirmasi Aktif Users');
          $("#pesan").text('Apakah Anda Yakin Akan Merubah Status Akun Menjadi Aktif?');
          $('#modalopsi').modal('show');
        },
      });
    }
    function lanjut(){
      if(saveas== 'nonaktif'){
        var url= "<?php echo base_url();?>admin/nonaktifusers";
      }
      else if(saveas== 'aktif'){
        var url= "<?php echo base_url();?>admin/aktifusers";
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
        <input type="hidden" name="c_users" value="">
          <div class="modal-body">
            <p id="pesan"></p>
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