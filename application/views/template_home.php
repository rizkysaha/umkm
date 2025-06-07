<?php 
	
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UMKM Lasem</title>
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

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
	<style>
		.square {
		  width: 100px; /* Set the square size */
		  height: 100px; /* Same as width */
		  overflow: hidden; /* Hides the overflowing parts of the image */
		  position: relative;
		}

		.square img {
		  width: 100%; /* Ensures the image fills the container */
		  height: auto; /* Maintains aspect ratio */
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%); /* Centers the image */
		}
		#cari::placeholder {
			color: white;
		}

	</style>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed ">
<div class="wrapper">
	<nav class="main-header navbar navbar-expand-md navbar-light navbar-success">
	    <div class="container">
	      <a href="<?php echo base_url(); ?>" class="navbar-brand">
	        <img src="<?php echo base_url() ?>assets/images/icon2.png" alt="UMKM" class="brand-image img-circle elevation-3" style="opacity: .8">
	        <span class="brand-text font-weight-light text-white">UMKM Lasem</span>
	      </a>

	      <button class="navbar-toggler order-1 collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	      </button>

	      <div class="navbar-collapse order-3 collapse" id="navbarCollapse" style="">
	        <!-- Left navbar links -->
	        <ul class="navbar-nav">
	          <li class="nav-item">
	            <a href="<?php echo base_url(); ?>" class="nav-link text-white">Beranda</a>
	          </li>
	          <li class="nav-item">
	            <a href="<?php echo base_url('mitra/list'); ?>" class="nav-link text-white">Mitra</a>
	          </li>
	          <li class="nav-item">
	            <a href="<?php echo base_url('Kontak'); ?>" class="nav-link text-white">Kontak</a>
	          </li>
	          <li class="nav-item">
	            <a href="<?php echo base_url('Blog'); ?>" class="nav-link text-white">Blog</a>
	          </li>
	        </ul>

	        
	      </div>

	      <!-- Right navbar links -->
	      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
	        <!-- SEARCH FORM -->
	        <form method="post" action="<?php echo base_url('cari'); ?>" class="form-inline ml-0 ml-md-3">
	          <div class="input-group input-group-sm">
	            <input class="form-control form-control-navbar text-white" type="search" id="cari" name="cari" placeholder="Cari produk, mitra" aria-label="Cari produk, mitra" value="<?php echo $this->input->post('cari') ?>">
	            <div class="input-group-append">
	              <button class="btn btn-navbar text-white" type="submit">
	                <i class="fas fa-search"></i>
	              </button>
	            </div>
	          </div>
	        </form>
	        <!-- Notifications Dropdown Menu -->

	        
	        <?php 
	        if($this->session->userdata('id')==""||!$this->session->userdata('is_login')){ ?>
	        <li class="nav-item dropdown">
	          <a class="nav-link text-white" data-toggle="dropdown" href="javascript:void(0);" onclick='javascript:$("#modal_login").modal("show");'>
	            Login
	          </a>
	        </li>
	        <?php
	        } else {
	        	$user_id = $this->session->userdata('id');
	        	$getUser = $this->M_model->getUser($user_id);
	        	$keranjang = $this->db->query("SELECT count(id) as total from keranjang where user_id = '".$user_id."'")->row();
	        	if($keranjang && $keranjang->total>0){
	        		$total_count = '<span class="badge badge-warning navbar-badge">'.$keranjang->total.'</span>';
	        	} else {
	        		$total_count = '';
	        	}
	        ?>
	        <li class="nav-item">
	          <a class="nav-link text-white" href="<?php echo base_url('cart') ?>">
	            <i class="fa fa-shopping-cart"></i>
	            <?php echo $total_count; ?>
	          </a>
	        </li>
	        <li class="nav-item dropdown">
		        <a class="nav-link text-white" data-toggle="dropdown" href="#" aria-expanded="false">
		          <i class="fa fa-user"></i>
		          <span class="d-none d-lg-inline"><?php echo $getUser->nama; ?></span>
		        </a>
		        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
		          <span class="dropdown-item dropdown-header"><?php echo $getUser->nama; ?></span>
		          <div class="dropdown-divider"></div>
		          <a href="<?php echo base_url('User/alamat'); ?>" class="dropdown-item">
		            <i class="fas fa-address-card mr-2"></i> Alamat
		          </a>
		          <div class="dropdown-divider"></div>
		          <a href="<?php echo base_url('User/pesanan'); ?>" class="dropdown-item">
		            <i class="fas fa-file-alt mr-2"></i> Pesanan
		          </a>

		          <div class="dropdown-divider"></div>
		          <a href="<?php echo base_url('User/logout'); ?>" class="dropdown-item dropdown-footer"><i class="fa fa-sign-out-alt"></i>Sign out</a>
		        </div>
		      </li>

	        
	        <?php
	        } ?>
	        
	        
	      </ul>
	    </div>
	  </nav>
	<!-- Navbar -->
	<!-- <nav class="main-header navbar navbar-light navbar-success d-none">
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
	</nav> -->
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
	    <div class="container mb-3">
	    	<?php
		  	echo $contents;
		  	?>
	    </div>
	</div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright © 2025 <a href="#">UMKM.LASEM.WEB.ID</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="modal_login">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<div class="card-body login-card-body">
			      <p class="login-box-msg">Login untuk memulai</p>

			      <form id="form_modal_login">
			        <div class="input-group mb-3">
			          <input type="email" class="form-control" name="modal_username" id="modal_username" placeholder="Enter username">
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-user"></span>
			            </div>
			          </div>
			        </div>
			        <div class="input-group mb-3">
			          <input type="password" class="form-control" name="modal_password" id="modal_password" placeholder="Password">
			          <div class="input-group-append">
			            <div class="input-group-text">
			              <span class="fas fa-lock"></span>
			            </div>
			          </div>
			        </div>
			        <div class="row">
			          <div class="col-12">
			            <button type="button" class="btn btn-primary btn-block" onclick="login_user()">Login</button>
			          </div>
			          <!-- /.col -->
			        </div>
			      </form>

			      <div class="social-auth-links text-center mb-3">
			        <p>- OR -</p>
			      </div>
			      <!-- /.social-auth-links -->
			      <p class="mb-0">
			        <a href="<?php echo base_url('User/daftar'); ?>" class="text-center">Daftar sebagai user baru</a>
			      </p>
			    </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
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
<script>
	function login_user(){
		var username = $("#modal_username").val();
		var password = $("#modal_password").val();
		$.ajax({
			url 	: '<?php echo base_url('User/login'); ?>',
			type 	: 'POST',
			data 	: { username : username, password : password },
			dataType: 'JSON',
			success : function(data){
				if(data.code==200){
		            window.location.href = '<?php echo base_url() ?>';
		          } else {
		            Toast.fire({
		              icon: 'warning',
		              title: data.ket
		            })
		          }
			},
			error 	: function(data){

			}
		});
	}
</script>
</body>
</html>
