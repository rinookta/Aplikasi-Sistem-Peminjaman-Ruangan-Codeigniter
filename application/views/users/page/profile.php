<?php $this->load->view('users/componen/head'); ?>
<?php $c_users= $this->session->userdata('c_users'); $users= $this->M_users->getusers($c_users); foreach($users as $husers); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    	<div class="col-lg-6 col-md-6">
	    	<div class="box box-info">
	    		<div class="box-header with-border">
	    			<h3 class="box-title"> <i class="fa fa-user"></i> Profile</h3>
	    			<span class="pull-right"><button onclick="updateprofile()" class="btn btn-sm bg-green">Update Profile</button></span>
	    		</div>
	    		<div class="box-body table-responsive">
	    			<form id="updateprofile" action="#">
	    				<input type="hidden" name="c_users" value="<?php echo $husers->c_users; ?>">
	    				<div class="form-group">
	    					<label>NAMA</label>
	    					<input class="form-control" type="text" name="nama" value="<?php echo $husers->nama; ?>">
	    				</div>
	    				<div class="form-group">
	    					<label>EMAIL</label>
	    					<input class="form-control" type="text" name="email" value="<?php echo $husers->email; ?>">
	    				</div>
	    				<div class="form-group">
	    					<label>NO TELEPON</label>
	    					<input class="form-control" type="text" name="notelp" value="<?php echo $husers->notelp; ?>">
	    				</div>
	    				<div class="form-group">
	    					<label>INSTANSI</label>
	    					<input class="form-control" type="text" name="instansi" value="<?php echo $husers->instansi; ?>">
	    				</div>
	    			</form>
	    		</div>
	    	</div>
    	</div>
    	<div class="col-lg-6 col-md-6">
	    	<div class="box box-info">
	    		<div class="box-header with-border">
	    			<h3 class="box-title"> <i class="fa fa-lock"></i> Ganti Password</h3>
	    			<span class="pull-right"><button onclick="gantipassword()" class="btn btn-sm bg-green">Update Password</button></span>
	    		</div>
	    		<div class="box-body table-responsive">
	    			<form id="gantipassword">
	    				<input type="hidden" name="c_users" value="<?php echo $husers->c_users; ?>">
	    				<div class="form-group">
	    					<label>PASSWORD LAMA</label>
	    					<input class="form-control" type="text" name="passwordlama" required="">
	    				</div>
	    				<div class="form-group">
	    					<label>PASSWORD BARU</label>
	    					<input class="form-control" type="text" name="passwordbaru" required="">
	    				</div>
	    			</form>
	    		</div>
	    	</div>
    	</div>
    </section>
    <!-- /.content -->
</div>
<?php
if($this->session->flashdata('on')=='updateprofile'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"blue",title: "Profile Berhasil Diperbaharui",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='passwordlama'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"red",title: "Password Lama Tidak Cocok",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='passwordbaru'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"red",title: "Password Baru Tidak Dapat Diproses",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
else if($this->session->flashdata('on')=='sukses'){
  echo '<script type="text/javascript">
  iziToast.show({timeout:5000,color:"green",title: "Password Berhasil Diperbaharui",position: "topLeft",pauseOnHover: true,transitionIn: false,progressBarColor:"#fff"});
</script>';
}
?>
<script type="text/javascript">
	function updateprofile(){
      $.ajax({
        url : "<?php echo base_url(); ?>users/updateprofile",
        type: "POST",
        data: $('#updateprofile').serialize(),
        dataType: "JSON",
        success: function(data){
          location.reload();
        },
      });
    }
    function gantipassword(){
      $.ajax({
        url : "<?php echo base_url(); ?>users/gantipassword",
        type: "POST",
        data: $('#gantipassword').serialize(),
        dataType: "JSON",
        success: function(data){
          location.reload();
        },
      });
    }
</script>
<?php $this->load->view('users/componen/foot'); ?>
