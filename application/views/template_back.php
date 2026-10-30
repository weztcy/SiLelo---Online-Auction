<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard SiLelo Premier Auction</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="<?= base_url('assets/front_end/img/favicon.ico') ?>" type="image/x-icon" />
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url('assets/back_end/css/bootstrap.min.css') ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/back_end/css/AdminLTE.min.css') ?>">
	<!-- AdminLTE Skins -->
	<link rel="stylesheet" href="<?= base_url('assets/back_end/css/_all-skins.min.css') ?>">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@700&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style type="text/css">
		body, .main-sidebar, .content-wrapper { font-family: 'Plus Jakarta Sans', sans-serif !important; }
		.skin-blue .main-header .navbar { background-color: #090e17 !important; border-bottom: 1px solid rgba(245, 158, 11, 0.25); }
		.skin-blue .main-header .logo { background-color: #05070c !important; font-family: 'Cinzel', serif; font-weight: 800; letter-spacing: -0.02em; border-bottom: 1px solid rgba(245, 158, 11, 0.25); }
		.skin-blue .main-header .logo:hover { background-color: #000000 !important; }
		.skin-blue .main-sidebar { background-color: #0f172a !important; }
		.skin-blue .sidebar-menu>li.header { background: #090d16 !important; color: #64748b; font-weight: 700; letter-spacing: 0.08em; }
		.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a { background: rgba(245, 158, 11, 0.1) !important; color: #f59e0b !important; border-left-color: #f59e0b !important; }
		.content-wrapper { background-color: #f1f5f9 !important; }
		.user-panel .image img { width: 45px !important; height: 45px !important; object-fit: cover; border-radius: 50%; }
		.user-menu .user-image { width: 25px !important; height: 25px !important; object-fit: cover; border-radius: 50%; }
		.user-menu .user-header img { width: 90px !important; height: 90px !important; object-fit: cover; border-radius: 50%; }
	</style>
	<!-- DataTables & Datepicker -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?= base_url('dashboard') ?>" class="logo">
				<span class="logo-mini"><b>Si</b>L</span>
				<span class="logo-lg"><b>Si</b><span style="color:#f59e0b;">Lelo</span></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<?php
				$foto = $this->session->userdata('foto');
				$tgl = $this->session->userdata('tgl_daftar');
				$hak_akses = $this->session->userdata('hak_akses');
				?>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?= base_url() ?>assets/foto/<?= $foto ?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?= $this->session->userdata('nama_lengkap') ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?= base_url() ?>assets/foto/<?= $foto ?>" class="img-circle" alt="User Image">
									<p>
										<small>Member since <?= date('F ,Y', strtotime($tgl)) ?></small>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?= base_url() ?>dashboard/profile_<?= $hak_akses ?>" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?= base_url() ?>dashboard/logout_<?= $hak_akses ?>" class="btn btn-default btn-flat">Sign out</a>
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
		<?php
		include "dashboard/data_menu.php";
		echo $contents;
		?>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 2.4.0
			</div>
			<strong>Copyright &copy; <?= date('Y') ?> <a href="#">SiLelo Management System</a>.</strong> All rights reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<div class="tab-pane" id="control-sidebar-home-tab">
				</div>
				<!-- /.tab-pane -->
				<!-- Stats tab content -->
				<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
				<!-- /.tab-pane -->
				<!-- Settings tab content -->
				<div class="tab-pane" id="control-sidebar-settings-tab">
				</div>
				<!-- /.tab-pane -->
			</div>
		</aside>
		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<!-- Bootstrap 3.3.7 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets/back_end/js/adminlte.min.js') ?>"></script>
	<!-- DataTables & Datepicker JS -->
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>
</html>

