<?php $c_users= $this->session->userdata('c_users'); $users= $this->M_users->getusers($c_users); foreach($users as $husers); ?>
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
        $(".jnotif").load('<?php echo base_url('users/jumlahnotif/').$c_users; ?>');
      },2000);
    var auto_refresh2= setInterval(
      function(){
        $(".notifatas").load('<?php echo base_url('users/notifatas/').$c_users; ?>');
      },2000);  
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><i class="fa fa-star-o"></i></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Users</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning jnotif"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda Mempunyai <span class="jnotif"></span> Notifikasi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu notifatas">
                  
                </ul>
              </li>
              <li class="footer"><a href="<?php echo base_url('users/notifikasi') ?>">Lihat Semua</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>theme/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $husers->nama; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $husers->nama; ?>
                  <small>Register Sejak <?php echo date('d-m-Y H:i',strtotime($husers->at)); ?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url(); ?>users/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>users/logout" class="btn btn-default btn-flat">Sign out</a>
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
          <p><?php echo $husers->nama; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo base_url('users'); ?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('users/ruangan'); ?>">
            <i class="fa fa-university"></i> <span>Ruangan</span>
            
          </a>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-external-link"></i> <span>Pengajuan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('users/allpengajuan'); ?>"><i class="fa fa-circle-o"></i> Semua Pengajuan</a></li>
            <li><a href="<?php echo base_url('users/pengajuansaya'); ?>"><i class="fa fa-circle-o"></i> Pengajuan Saya</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url('users/notifikasi'); ?>">
            <i class="fa fa-bell"></i> <span>Notifikasi</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green jnotif"></small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('users/calender'); ?>">
            <i class="fa fa-calendar"></i> <span>Calender</span>
            
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>