<?php
  $hak = $this->session->userdata('hak_akses');
  $uid = $this->session->userdata('id_user');
  $nama = $this->session->userdata('nama_lengkap');
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-dashboard text-warning"></i> Dashboard <?= ($hak == 'pelelang') ? 'Mitra Pelelang' : 'Administrator' ?>
      <small>Pusat Kontrol SiLelo</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <!-- Welcome Hero Banner -->
    <div class="box box-solid" style="background: linear-gradient(135deg, #090e17, #1e293b); color: #fff; border-radius: 12px; border: 1px solid rgba(245, 158, 11, 0.3); margin-bottom: 24px;">
      <div class="box-body" style="padding: 24px 28px;">
        <div class="row" style="display:flex; align-items:center; flex-wrap:wrap;">
          <div class="col-md-8">
            <span class="label label-warning" style="font-size:11px; padding:4px 10px; letter-spacing:0.06em; text-transform:uppercase;">
              <i class="fa fa-certificate"></i> <?= ($hak == 'pelelang') ? 'Mitra Pelelang Terverifikasi' : 'Super Administrator' ?>
            </span>
            <h2 style="font-weight:800; margin:10px 0 6px 0; color:#fff; font-size:1.5rem;">
              Selamat Datang, <?= htmlspecialchars($nama) ?>!
            </h2>
            <p style="color:#cbd5e1; margin:0; font-size:13.5px;">
              <?= ($hak == 'pelelang') 
                ? 'Kelola lot kurasi, pantau penawaran bidding live, dan monitor invoice transaksi Anda secara real-time.' 
                : 'Pusat moderasi lot lelang, validasi deposit bidder, dan verifikasi invoice pembayaran resmi SiLelo.' ?>
            </p>
          </div>
          <div class="col-md-4 text-right" style="margin-top:10px;">
            <?php if($hak == 'pelelang'){ ?>
              <a href="<?= base_url('back_end/barang/add_produk') ?>" class="btn btn-warning btn-md" style="font-weight:700; border-radius:6px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);">
                <i class="fa fa-plus-circle"></i> Tambah Lot
              </a>
              <a href="<?= base_url('home/pelelang/'.$uid) ?>" target="_blank" class="btn btn-default btn-md" style="margin-left:4px; font-weight:600; border-radius:6px; background:rgba(255,255,255,0.1); color:#fff; border:1px solid rgba(255,255,255,0.2);">
                <i class="fa fa-external-link"></i> Etalase
              </a>
            <?php } else { ?>
              <a href="<?= base_url('back_end/barang/admin_baru') ?>" class="btn btn-warning btn-md" style="font-weight:700; border-radius:6px;">
                <i class="fa fa-check-square-o"></i> Moderasi Lot
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>


    

<?php
    if ($hak == 'pelelang') {
      $tot = $this->db->query("SELECT COUNT(*) as j FROM abe_produk WHERE id_pelelang = '$uid'")->row()->j;
      $live = $this->db->query("SELECT COUNT(*) as j FROM abe_produk WHERE id_pelelang = '$uid' AND status = 'lelang'")->row()->j;
      $sold = $this->db->query("SELECT COUNT(*) as j FROM abe_produk WHERE id_pelelang = '$uid' AND status = 'sold out'")->row()->j;
      $bids = $this->db->query("SELECT COUNT(*) as j FROM abe_lelang_bidder b JOIN abe_produk p ON b.id_barang = p.id_produk WHERE p.id_pelelang = '$uid'")->row()->j;
    ?>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-navy" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $tot ?></h3><p style="color:#94a3b8; font-size:12px; margin:0;">TOTAL LOT SAYA</p></div>
          <div class="icon"><i class="fa fa-cubes"></i></div>
          <a href="<?= base_url('back_end/barang') ?>" class="small-box-footer">Katalog Barang <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $live ?></h3><p style="font-size:12px; margin:0;">LOT SEDANG LIVE</p></div>
          <div class="icon"><i class="fa fa-gavel"></i></div>
          <a href="<?= base_url('back_end/barang') ?>" class="small-box-footer">Lelang Aktif <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $sold ?></h3><p style="font-size:12px; margin:0;">LOT TERJUAL</p></div>
          <div class="icon"><i class="fa fa-check-circle"></i></div>
          <a href="<?= base_url('back_end/transaksi') ?>" class="small-box-footer">Transaksi Lunas <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-purple" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $bids ?></h3><p style="font-size:12px; margin:0;">TAWARAN MASUK</p></div>
          <div class="icon"><i class="fa fa-users"></i></div>
          <a href="<?= base_url('back_end/transaksi/invoice') ?>" class="small-box-footer">Data Invoice <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Active Lots Table -->
    <div class="box box-default" style="border-radius:8px; border-top:3px solid #f59e0b;">
      <div class="box-header with-border">
        <h3 class="box-title" style="font-weight:700;"><i class="fa fa-cubes text-warning"></i> Status Lot Produk Terkini</h3>
        <div class="box-tools pull-right">
          <a href="<?= base_url('back_end/barang/add_produk') ?>" class="btn btn-xs btn-warning"><i class="fa fa-plus"></i> Tambah Lot</a>
        </div>
      </div>
      <div class="box-body no-padding table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr style="background:#f8fafc; font-size:12px;">
              <th style="width:50px;">Foto</th>
              <th>Nama Produk</th>
              <th>Harga Buka</th>
              <th>Status</th>
              <th style="width:100px; text-align:center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $my_lots = $this->db->query("SELECT * FROM abe_produk WHERE id_pelelang = '$uid' ORDER BY id_produk DESC LIMIT 6")->result();
              if(!empty($my_lots)){
                foreach($my_lots as $lot){
                  $foto = $this->db->query("SELECT file_foto FROM abe_foto_produk WHERE id_produk = '$lot->id_produk' LIMIT 1")->row_array();
                  $foto_url = get_foto_produk(!empty($foto['file_foto']) ? $foto['file_foto'] : null);
                  $b_cls = ($lot->status == 'lelang') ? 'label-warning' : (($lot->status == 'sold out') ? 'label-success' : 'label-default');
            ?>
              <tr>
                <td><img src="<?= $foto_url ?>" style="width:40px; height:30px; object-fit:cover; border-radius:4px;"></td>
                <td><strong><?= $lot->nama_produk ?></strong></td>
                <td><strong>Rp <?= number_format($lot->harga_produk, 0, ',', '.') ?></strong></td>
                <td><span class="label <?= $b_cls ?>"><?= strtoupper($lot->status) ?></span></td>
                <td class="text-center">
                  <a href="<?= base_url('back_end/barang/edit_produk/'.$lot->id_produk) ?>" class="btn btn-xs btn-default"><i class="fa fa-pencil text-primary"></i></a>
                  <a href="<?= base_url('home/produk/katalog/'.$lot->id_produk) ?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-eye text-warning"></i></a>
                </td>
              </tr>
            <?php 
                }
              } else {
                echo '<tr><td colspan="5" class="text-center" style="padding:24px; color:#94a3b8;">Belum ada produk terdaftar.</td></tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="box-footer text-center">
        <a href="<?= base_url('back_end/barang') ?>" style="font-weight:700; color:#f59e0b;">Lihat Seluruh Barang &rarr;</a>
      </div>
    </div>

    <?php } else {
      $bidders = $this->db->query("SELECT COUNT(*) as j FROM users")->row()->j;
      $pelelangs = $this->db->query("SELECT COUNT(*) as j FROM abe_pelelang")->row()->j;
      $active_auctions = $this->db->query("SELECT COUNT(*) as j FROM abe_produk WHERE status = 'lelang'")->row()->j;
      $invs = $this->db->query("SELECT COUNT(*) as j FROM abe_invoice WHERE status = 'transfer'")->row()->j;
    ?>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $bidders ?></h3><p style="font-size:12px; margin:0;">TOTAL BIDDER</p></div>
          <div class="icon"><i class="fa fa-users"></i></div>
          <a href="<?= base_url('back_end/users/bidder_aktif') ?>" class="small-box-footer">Kelola Bidder <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-purple" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $pelelangs ?></h3><p style="font-size:12px; margin:0;">PELELANG AKTIF</p></div>
          <div class="icon"><i class="fa fa-handshake-o"></i></div>
          <a href="<?= base_url('back_end/users/pelelang_aktif') ?>" class="small-box-footer">Kelola Pelelang <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $active_auctions ?></h3><p style="font-size:12px; margin:0;">LOT AKTIF LIVE</p></div>
          <div class="icon"><i class="fa fa-gavel"></i></div>
          <a href="<?= base_url('back_end/barang/admin_aktif') ?>" class="small-box-footer">Lelang Berjalan <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red" style="border-radius:8px;">
          <div class="inner" style="padding:14px;"><h3><?= $invs ?></h3><p style="font-size:12px; margin:0;">INVOICE VALIDASI</p></div>
          <div class="icon"><i class="fa fa-credit-card"></i></div>
          <a href="<?= base_url('back_end/deposit/invoice') ?>" class="small-box-footer">Verifikasi Invoice <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <?php } ?>
  </section>
</div>