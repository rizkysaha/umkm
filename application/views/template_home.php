
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Paket Terbaik</title>
  <!-- Favicons -->
  <link href="<?php echo base_url() ?>assets/images/icon2.png" rel="icon">
  <link href="<?php echo base_url() ?>assets/images/icon2.png" rel="apple-touch-icon">
  <link href="<?php echo base_url() ?>assets/images/icon2.png" rel="shortcut icon" type="image/x-icon"/>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ion Slider -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-slider/css/bootstrap-slider.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed ">
<div class="wrapper">

	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand-md navbar-light navbar-success">
		<ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="<?php echo base_url('Home'); ?>" class="nav-link text-white">Beranda</a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="<?php echo base_url('Home'); ?>" class="nav-link text-white">Mitra</a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="<?php echo base_url('Home'); ?>" class="nav-link text-white">Kontak Kami</a>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
	      <!-- Navbar Search -->
	      <li class="nav-item">
	        <a class="nav-link text-white" data-widget="navbar-search" href="#" role="button">
	          <i class="fas fa-search"></i>
	        </a>
	        <div class="navbar-search-block" style="display: none;">
	          <form class="form-inline">
	            <div class="input-group input-group-sm">
	              <input class="form-control text-white form-control-navbar" type="search" placeholder="Search" aria-label="Search">
	              <div class="input-group-append">
	                <button class="btn btn-navbar" type="submit">
	                  <i class="fas fa-search"></i>
	                </button>
	                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
	                  <i class="fas fa-times"></i>
	                </button>
	              </div>
	            </div>
	          </form>
	        </div>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="<?php echo base_url('Admin/signin'); ?>" class="nav-link text-white">Sign In</a>
	      </li>
	      
	    </ul>
	  <!--  -->
	</nav>
	<!-- /.navbar -->

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper d-none">
	  <!-- Content Header (Page header) -->
	  <div class="content-header">
	    <div class="container">
	    	
	    </div><!-- /.container-fluid -->
	  </div>
	  <!-- /.content-header -->
	</div>
	<div class="content">
	    <div class="container">
	    	<?php
		  	echo $contents;
		  	?>
	    </div>
	</div>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- Ion Slider -->
<script src="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<!-- Bootstrap slider -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
</body>
</html>
