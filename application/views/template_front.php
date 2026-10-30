<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SiLelo &mdash; Platform Lelang Online Terkurasi &amp; Terpercaya #1 di Indonesia</title>
	<meta name="description" content="SiLelo adalah platform lelang online terpercaya di Indonesia dengan kurasi produk mewah, elektronik, otomotif, jam tangan, dan barang koleksi bergaransi resmi.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<!-- Google Fonts - Plus Jakarta Sans & Outfit -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="<?= base_url('assets/front_end/') ?>vendor/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="<?= base_url('assets/front_end/') ?>vendor/font-awesome/css/font-awesome.min.css">
	<!-- Bootstrap Select-->
	<link rel="stylesheet" href="<?= base_url('assets/front_end/') ?>vendor/bootstrap-select/css/bootstrap-select.min.css">
	<!-- owl carousel-->
	<link rel="stylesheet" href="<?= base_url('assets/front_end/') ?>vendor/owl.carousel/assets/owl.carousel.css">
	<link rel="stylesheet" href="<?= base_url('assets/front_end/') ?>vendor/owl.carousel/assets/owl.theme.default.css">
	<!-- theme stylesheet-->
	<link rel="stylesheet" href="<?= base_url('assets/front_end/') ?>css/style.default.css" id="theme-stylesheet">
	<!-- Custom stylesheet - Premium Design System-->
	<link rel="stylesheet" href="<?= base_url('assets/front_end/') ?>css/custom.css">
	<!-- Favicon and apple touch icons-->
	<link rel="shortcut icon" href="<?= base_url('assets/front_end/') ?>img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('assets/front_end/') ?>img/apple-touch-icon-152x152.png">
	<!-- Tweaks for older IEs-->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
	<div id="all">
		<!-- Top bar-->
		<div class="top-bar">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-5 d-none d-md-block">
						<div class="top-announcement">
							<span class="badge-premium-pill"><i class="fa fa-shield"></i> RESMI</span>
							<span class="announcement-text text-truncate">Platform Lelang Online Terkurasi #1 &bull; Transparan &amp; Bergaransi</span>
						</div>
					</div>
					<div class="col-lg-6 col-md-7 col-12">
						<div class="top-bar-right d-flex justify-content-md-end justify-content-center align-items-center">
							<a href="tel:+622188997700" class="top-hotline d-none d-xl-inline-flex align-items-center text-decoration-none mr-3">
								<i class="fa fa-phone text-warning mr-2"></i> <span class="hotline-num">+62 (21) 8899-7700</span>
							</a>
							<div class="top-auth-actions d-inline-flex align-items-center">
								<?php
								if ($this->session->userdata('loggedIn') == true) {
								?>
									<a href="<?= base_url('profile') ?>" class="top-btn top-btn-user"><i class="fa fa-user-circle mr-1"></i> <span>Akun Saya</span></a>
								<?php
								} else {
								?>
									<a href="<?= base_url('home/register') ?>" class="top-btn top-btn-bidder"><i class="fa fa-user mr-1"></i> <span>Masuk Bidder</span></a>
									<a href="<?= base_url('pelelang') ?>" class="top-btn top-btn-pelelang ml-2"><i class="fa fa-gavel mr-1"></i> <span>Portal Pelelang</span></a>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<?php
		include "home/data_menu.php";
		echo $contents;
		?>
		<!-- FOOTER -->
		<footer class="main-footer">
			<div class="container">
				<div class="row footer-content-grid">
					<!-- Col 1: Brand & About -->
					<div class="col-lg-4 col-md-6 footer-col">
						<div class="footer-brand mb-3">
							<span class="footer-logo-text"><i class="fa fa-gavel text-warning"></i> Si<span>Lelo</span></span>
							<span class="badge-curated">ONLINE AUCTION</span>
						</div>
						<p class="footer-desc">
							SiLelo adalah marketplace lelang online terkemuka di Indonesia yang mempertemukan pelelang terverifikasi dengan penawar dalam ekosistem lelang yang transparan, aman, dan bergaransi resmi.
						</p>
						<div class="footer-trust-badges mt-3">
							<div class="trust-pill"><i class="fa fa-lock text-success"></i> Rekening Bersama Escrow</div>
							<div class="trust-pill"><i class="fa fa-check-circle text-info"></i> Kurasi Fisik 100% Asli</div>
						</div>
					</div>

					<!-- Col 2: Panduan Bidding -->
					<div class="col-lg-2 col-md-6 footer-col">
						<h4 class="footer-title">Panduan &amp; Info</h4>
						<ul class="list-unstyled footer-links">
							<li><a href="<?= base_url('home/about') ?>"><i class="fa fa-angle-right"></i> Cara Ikut Lelang</a></li>
							<li><a href="<?= base_url('home/about') ?>"><i class="fa fa-angle-right"></i> Mekanisme Deposit</a></li>
							<li><a href="<?= base_url('home/about') ?>"><i class="fa fa-angle-right"></i> Sistem Outbid Live</a></li>
							<li><a href="<?= base_url('home/kontak') ?>"><i class="fa fa-angle-right"></i> Verifikasi Akun</a></li>
							<li><a href="<?= base_url('home/kontak') ?>"><i class="fa fa-angle-right"></i> Kebijakan Privasi</a></li>
						</ul>
					</div>

					<!-- Col 3: Kategori Populer -->
					<div class="col-lg-3 col-md-6 footer-col">
						<h4 class="footer-title">Kategori Populer</h4>
						<ul class="list-unstyled footer-links">
							<li><a href="<?= base_url('home/kategori/elektronik') ?>"><i class="fa fa-angle-right"></i> Elektronik &amp; Gadget</a></li>
							<li><a href="<?= base_url('home/kategori/fashion') ?>"><i class="fa fa-angle-right"></i> Jam Tangan &amp; Fashion</a></li>
							<li><a href="<?= base_url('home/kategori/otomotif') ?>"><i class="fa fa-angle-right"></i> Otomotif &amp; Aksesoris</a></li>
							<li><a href="<?= base_url('home/kategori/antik-dan-koleksi') ?>"><i class="fa fa-angle-right"></i> Barang Antik &amp; Koleksi</a></li>
							<li><a href="<?= base_url('home/kategori/hobi-dan-olahraga') ?>"><i class="fa fa-angle-right"></i> Hobi, Seni &amp; Olahraga</a></li>
						</ul>
					</div>

					<!-- Col 4: Hubungi Kami -->
					<div class="col-lg-3 col-md-6 footer-col">
						<h4 class="footer-title">Pusat Layanan</h4>
						<div class="footer-contact-info">
							<p><i class="fa fa-map-marker text-warning"></i> SiLelo Tower Level 18, Jl. Jend. Sudirman Kav. 28, Jakarta Selatan</p>
							<p><i class="fa fa-phone text-warning"></i> Hotline: <strong>+62 (21) 8899-7700</strong></p>
							<p><i class="fa fa-envelope text-warning"></i> Email: <strong>support@silelo.id</strong></p>
							<p><i class="fa fa-clock-o text-warning"></i> Operasional: <strong>24/7 Bidding Live</strong></p>
						</div>
					</div>
				</div>
			</div>

			<div class="copyrights">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 text-center text-lg-left">
							<p class="mb-0">&copy; <?= date('Y') ?> <strong>SiLelo</strong> &mdash; Indonesia's Premier Online Auction Platform. All rights reserved.</p>
						</div>
						<div class="col-lg-6 text-center text-lg-right mt-2 mt-lg-0">
							<div class="payment-badges-strip">
								<span class="pay-tag">BCA</span>
								<span class="pay-tag">MANDIRI</span>
								<span class="pay-tag">BNI</span>
								<span class="pay-tag">BRI</span>
								<span class="pay-tag">QRIS</span>
								<span class="pay-tag badge-ssl"><i class="fa fa-lock"></i> SSL 256-BIT</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- Javascript files-->
	<script src="<?= base_url('assets/front_end/') ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/popper.js/umd/popper.min.js"> </script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/jquery.cookie/jquery.cookie.js"> </script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/waypoints/lib/jquery.waypoints.min.js"> </script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/jquery.counterup/jquery.counterup.min.js"> </script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
	<script src="<?= base_url('assets/front_end/') ?>js/jquery.parallax-1.1.3.js"></script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
	<script src="<?= base_url('assets/front_end/') ?>vendor/jquery.scrollto/jquery.scrollTo.min.js"></script>
	<script src="<?= base_url('assets/front_end/') ?>js/front.js"></script>
</body>

</html>
