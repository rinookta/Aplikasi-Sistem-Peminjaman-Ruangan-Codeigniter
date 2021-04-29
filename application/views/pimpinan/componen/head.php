<?php $c_pimpinan= $this->session->userdata('c_pimpinan'); $pimpinan= $this->M_pimpinan->getpimpinan($c_pimpinan); foreach($pimpinan as $hpimpinan); ?>
<?php $this->load->view('php/function'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikas Pemesanan Ruangan</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>theme/dist/img/avatar5.png">
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/morris.js/morris.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/iCheck/flat/blue.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/select2/dist/css/select2.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <!-- <?php echo base_url(); ?>Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>theme/izi/dist/css/iziToast.min.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>theme/izi/dist/js/iziToast.min.js"></script>
  <!--date time-->
  <link  rel="stylesheet" href="<?php echo base_url(); ?>theme/datetime/css/bootstrap-datetimepicker.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url(); ?>theme/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?php echo base_url(); ?>theme/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
  <script type="text/javascript">
    var auto_refresh= setInterval(
      function(){
        $(".jnotif").load('<?php echo base_url('admin/jumlahnotif'); ?>');
      },2000);
    var auto_refresh2= setInterval(
      function(){
        $(".notifatas").load('<?php echo base_url('admin/notifatas'); ?>');
      },2000);  
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed skin-red">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><i class="fa fa-star-o"></i></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Pimpinan</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>theme/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $hpimpinan->nama; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $hpimpinan->nama; ?>
                  <small></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('pimpinan/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>pimpinan/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $hpimpinan->nama; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo base_url('pimpinan'); ?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            
          </a>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Pengajuan Ruangan</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onclick="opsibulan()"><i class="fa fa-circle-o"></i> Pengajuan Per- Bulan</a></li>
            <li><a href="#" onclick="opsistatus()"><i class="fa fa-circle-o"></i> Pengajuan Per- Status</a></li>
            <li><a href="#" onclick="opsitanggal()"><i class="fa fa-circle-o"></i> Pengajuan Per- Tanggal</a></li>
            <li><a href="<?php echo base_url('pimpinan/allpengajuan'); ?>"><i class="fa fa-circle-o"></i> Seluruh Data</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url('pimpinan/calender'); ?>">
            <i class="fa fa-calendar"></i> <span>Calender</span>
            
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<script type="text/javascript">
    function tutup(){
      $('#form')[0].reset();
      $('#opsibulan').modal('hide');
      $('#opsitanggal').modal('hide');
      $('#opsistatus').modal('hide');
    }
    function opsibulan(){
      $('#opsibulan').modal('show');
    }
    function opsitanggal(){
      $('#opsitanggal').modal('show');
    }
    function opsistatus(){
      $('#opsistatus').modal('show');
    }
</script>
<div id="opsibulan" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-external-link"></i> Pengajuan Per- Bulan</h4>
        </div>
        <form id="form" method="post" action="<?php echo base_url('pimpinan/keperbulan'); ?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label>BULAN</label>
              <select name="bulan" class="form-control select2" style="width:100%;">
                <?php $bini= date('m'); for($i=1; $i<=12; $i++){
                  if($bini==$i){ $sel='selected'; }else{ $sel= '';}
                  echo '<option '.$sel.' value="'.$i.'">'.bulan($i).'</option>';
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label>TAHUN</label>
              <select name="tahun" class="form-control select2" style="width:100%;">
                <?php $yini= date('Y'); $aw= $yini-10; $sam= $yini+10; for($j=$aw; $j<=$sam; $j++){
                  if($yini==$j){ $tahsel='selected'; }else{ $tahsel= '';}
                  echo '<option '.$tahsel.' value="'.$j.'">'.$j.'</option>';
                } ?>
              </select>
            </div>
          </div>      
        <div class="modal-footer">
          <button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i> Lanjutkan</button> 
          <a class="btn btn-default btn-sm" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
        </form>
    </div>
</div>
</div>
<div id="opsitanggal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-external-link"></i> Pengajuan Per- Tanggal</h4>
        </div>
        <form id="form" method="post" action="<?php echo base_url('pimpinan/kepertanggal'); ?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
                <label>MULAI TANGGAL</label>
                <div class="input-group date form_date" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                    <input class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                </div>
                <input type="hidden" name="mulai" id="dtp_input1" value="" />
            </div>
            <div class="form-group">
                <label>SAMPAI TANGGAL</label>
                <div class="input-group date form_date" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="dd MM yyyy" data-link-field="dtp_input2">
                    <input class="form-control" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                </div>
                <input type="hidden" name="sampai" id="dtp_input2" value="" />
            </div>
          </div>      
        <div class="modal-footer">
          <button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-ok"></i> Lanjutkan</button> 
          <a class="btn btn-default btn-sm" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
        </form>
    </div>
</div>
</div>
<div id="opsistatus" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title text-center"><i class="fa fa-external-link"></i> Pengajuan Per- Status</h4>
        </div>
          <div class="modal-body text-center">
            <a href="<?php echo base_url('pimpinan/perstatus/approve'); ?>" class="btn btn-sm bg-blue"><i class="fa fa-check"></i> Approve</a>
            <a href="<?php echo base_url('pimpinan/perstatus/pending'); ?>" class="btn btn-sm bg-green"><i class="fa fa-refresh"></i> Pending</a>
            <a href="<?php echo base_url('pimpinan/perstatus/reject'); ?>" class="btn btn-sm bg-red"><i class="fa fa-circle-o"></i> Reject</a>
            <a href="<?php echo base_url('pimpinan/perstatus/batal'); ?>" class="btn btn-sm bg-navy"><i class="fa fa-close"></i> Batal</a>
            <a href="<?php echo base_url('pimpinan/perstatus/norespon'); ?>" class="btn btn-sm bg-orange"><i class="fa fa-info"></i> No Respon</a>
          </div>      
        <div class="modal-footer">
          <a class="btn btn-default btn-sm" onclick="tutup()"><i class="glyphicon glyphicon-remove"></i> Tutup</a>
        </div>
    </div>
</div>
</div>