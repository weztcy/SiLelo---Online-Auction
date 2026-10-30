<?php
  $id = $this->uri->segment(3);
  if(empty($id)){
    $first_pelelang = $this->db->query("SELECT id_user FROM abe_pelelang WHERE status = 'aktif' ORDER BY id_user ASC LIMIT 1")->row_array();
    $id = !empty($first_pelelang['id_user']) ? $first_pelelang['id_user'] : 1;
  }
  $sql_user = "SELECT * FROM abe_pelelang WHERE id_user = " . $this->db->escape($id);
  $pelelang = $this->db->query($sql_user)->row_array();

  if(empty($pelelang)){
    $first_pelelang = $this->db->query("SELECT * FROM abe_pelelang ORDER BY id_user ASC LIMIT 1")->row_array();
    $pelelang = !empty($first_pelelang) ? $first_pelelang : array(
      'id_user'      => $id,
      'nama_lengkap' => 'SiLelo Official Store',
      'email'        => 'pelelang@silelo.id',
      'status'       => 'aktif',
      'tgl_daftar'   => date('Y-m-d'),
      'alamat'       => 'Gedung SiLelo Tower Lt. 12, Jl. Sudirman Kav. 28, Jakarta Pusat',
      'telpon'       => '081234567890'
    );
    $id = $pelelang['id_user'];
  }
?>

      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-certificate mr-1"></i> VERIFIED PELELANG</span>
              <h1 class="h2 page-title"><?= !empty($pelelang['nama_lengkap']) ? htmlspecialchars($pelelang['nama_lengkap']) : 'Profil Pelelang' ?></h1>
              <p class="text-muted mb-0">Informasi profil resmi, legalitas verifikasi, dan kontak toko pelelang terdaftar.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Pelelang</a></li>
                <li class="breadcrumb-item active">Profil</li>
              </ul>
            </div>
          </div>
        </div>
      </div> 

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div id="customer-account" class="col-lg-8">
              <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-id-card text-warning mr-2"></i> Informasi Toko Pelelang</h4>
                  <span class="badge-status badge-status-success"><i class="fa fa-check-circle mr-1"></i> Terverifikasi</span>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="font-weight-bold small text-dark">Nama Pelelang / Toko</label>
                    <input value="<?= !empty($pelelang['nama_lengkap']) ? htmlspecialchars($pelelang['nama_lengkap']) : '' ?>" readonly type="text" class="form-control bg-light">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="font-weight-bold small text-dark">Email Resmi</label>
                    <input value="<?= !empty($pelelang['email']) ? htmlspecialchars($pelelang['email']) : '' ?>" readonly type="text" class="form-control bg-light">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="font-weight-bold small text-dark">Status Keanggotaan</label>
                    <input value="<?= strtoupper(!empty($pelelang['status']) ? $pelelang['status'] : 'AKTIF') ?> (Official Seller)" readonly type="text" class="form-control bg-light font-weight-bold text-success">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="font-weight-bold small text-dark">Bergabung Sejak</label>
                    <input value="<?= !empty($pelelang['tgl_daftar']) ? date('d F Y', strtotime($pelelang['tgl_daftar'])) : date('d F Y') ?>" readonly type="text" class="form-control bg-light">
                  </div>
                </div>
                <div class="form-group">
                  <label class="font-weight-bold small text-dark">Alamat Galeri / Workshop</label>
                  <textarea readonly class="form-control bg-light" rows="2"><?= !empty($pelelang['alamat']) ? htmlspecialchars($pelelang['alamat']) : '-' ?></textarea>
                </div>
                <div class="form-group mb-0">
                  <label class="font-weight-bold small text-dark">Nomor Kontak / Telepon</label>
                  <input readonly value="<?= !empty($pelelang['telpon']) ? htmlspecialchars($pelelang['telpon']) : '-' ?>" type="text" class="form-control bg-light">
                </div>
              </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-4 mt-4 mt-lg-0">
              <div class="customer-sidebar-card">
                <div class="customer-sidebar-header">
                  <div class="customer-sidebar-avatar">
                    <i class="fa fa-gavel"></i>
                  </div>
                  <h4 class="customer-sidebar-name"><?= !empty($pelelang['nama_lengkap']) ? htmlspecialchars($pelelang['nama_lengkap']) : 'Official Seller' ?></h4>
                  <div class="customer-sidebar-role">Verified Seller</div>
                </div>

                <ul class="customer-nav-list">
                  <li class="customer-nav-item active">
                    <a href="<?= base_url('profile/pelelang/').$id ?>"><i class="fa fa-user"></i> <span>Profil Pelelang</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/pelelang_produk/').$id ?>"><i class="fa fa-cubes"></i> <span>Produk Aktif</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/pelelang_produk_laku/').$id ?>"><i class="fa fa-check-circle"></i> <span>Produk Terjual</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
