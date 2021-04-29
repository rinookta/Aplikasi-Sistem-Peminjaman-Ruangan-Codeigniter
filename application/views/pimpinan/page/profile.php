<?php $this->load->view('pimpinan/componen/head'); ?>
<?php $c_pimpinan= $this->session->userdata('c_pimpinan'); $pimpinan= $this->M_pimpinan->getpimpinan($c_pimpinan); foreach($pimpinan as $hpimpinan); ?>
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
	    				<input type="hidden" name="c_pimpinan" value="<?php echo $hpimpinan->c_pimpinan; ?>">
	    				<div class="form-group">
	    					<label>NAMA</label>
	    					<input class="form-control" type="text" name="nama" value="<?php echo $hpimpinan->nama; ?>">
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
	    				<input type="hidden" name="c_pimpinan" value="<?php echo $hpimpinan->c_pimpinan; ?>">
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
        url : "<?php echo base_url(); ?>pimpinan/updateprofile",
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
        url : "<?php echo base_url(); ?>pimpinan/gantipassword",
        type: "POST",
        data: $('#gantipassword').serialize(),
        dataType: "JSON",
        success: function(data){
          location.reload();
        },
      });
    }
</script>
<?php $this->load->view('pimpinan/componen/foot'); ?>
