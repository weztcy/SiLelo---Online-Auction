<?php
  $id       = $this->session->userdata('id');
  $sql_user = "SELECT * FROM users WHERE id = '$id'";
  $bidder_row = $this->db->query($sql_user)->row_array();

  $sql_deposit = "SELECT * FROM abe_deposit WHERE id_user = '$id' AND status = 'oke'";
  $deposit_row = $this->db->query($sql_deposit)->row_array();
  $jumlah = !empty($deposit_row['jumlah']) ? $deposit_row['jumlah'] : 0;
  $sql_payment = "SELECT * FROM abe_invoice WHERE id_user = '$id' AND status = 'belum bayar'";
  $payment = $this->db->query($sql_payment)->num_rows();
?>
      
      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-star mr-1"></i> PREFERENSI MINAT</span>
              <h1 class="h2 page-title">Kategori Favorit Anda</h1>
              <p class="text-muted mb-0">Pilih kategori lelang yang Anda sukai agar katalog rekomendasi personal menampilkan produk yang paling relevan.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Akun</a></li>
                <li class="breadcrumb-item active">Minat Kategori</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div id="customer-orders" class="col-lg-8">
              <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-sliders text-warning mr-2"></i> Pengaturan Minat Kategori</h4>
                  <span class="badge badge-light border text-muted px-2 py-1 small"><i class="fa fa-check text-success mr-1"></i> Tersimpan Otomatis</span>
                </div>

                <div class="table-responsive">
                  <table class="table table-lux mb-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Katalog Lot</th>
                        <th class="text-center">Pilihan Minat</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $id_user = $this->session->userdata('id');
                        $sql_rekomendasi = $this->db->get('abe_kategori')->result();
                        $no = 1;
                        foreach ($sql_rekomendasi as $row) {
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td>
                          <span class="font-weight-bold text-dark"><?= $row->nama_kategori ?></span>
                        </td>
                        <td>
                          <a href="<?= base_url('home/kategori/').$row->url_kategori ?>" class="btn btn-xs btn-outline-dark" target="_blank">
                            <i class="fa fa-external-link mr-1"></i> Buka Katalog
                          </a>
                        </td>
                        <td class="text-center">
                          <input type="hidden" id="bidder" name="bidder" value="<?= $id_user ?>">
                          <label class="custom-control custom-switch mb-0 d-inline-block">
                            <input type="checkbox" class="custom-control-input" id="cat_<?= $row->id_kategori ?>" <?php check_akses($id_user, $row->id_kategori) ?> onclick="addRekomendasi(<?= $row->id_kategori ?>)">
                            <label class="custom-control-label" for="cat_<?= $row->id_kategori ?>"></label>
                          </label>
                        </td>
                      </tr>
                      <?php
                          $no ++;
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
              <div class="customer-sidebar-card">
                <div class="customer-sidebar-header">
                  <div class="customer-sidebar-avatar">
                    <i class="fa fa-user"></i>
                  </div>
                  <h4 class="customer-sidebar-name"><?= !empty($bidder_row['first_name']) ? $bidder_row['first_name'].' '.$bidder_row['last_name'] : 'Bidder SiLelo' ?></h4>
                  <div class="customer-sidebar-role">Verified Bidder</div>
                  <div class="customer-balance-box">
                    <span class="balance-caption">Saldo Jaminan Aktif</span>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="balance-amount">Rp <?= number_format($jumlah, 0, ',', '.') ?></span>
                      <a href="<?= base_url('profile') ?>" class="btn btn-xs btn-warning font-weight-bold px-2 py-1">Top Up</a>
                    </div>
                  </div>
                </div>

                <ul class="customer-nav-list">
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile') ?>"><i class="fa fa-user"></i> <span>Akun &amp; Profil</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item active">
                    <a href="<?= base_url('profile/rekomendasi') ?>"><i class="fa fa-star"></i> <span>Minat Kategori</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/orders') ?>"><i class="fa fa-gavel"></i> <span>Tawaran Saya</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/payment') ?>">
                      <i class="fa fa-credit-card"></i> <span>Tagihan Lelang</span>
                      <?php if($payment > 0){ ?>
                        <span class="badge badge-danger ml-auto mr-2"><?= $payment ?></span>
                      <?php } else { ?>
                        <i class="fa fa-angle-right ml-auto"></i>
                      <?php } ?>
                    </a>
                  </li>
                  <li class="customer-nav-item border-top mt-2 pt-2">
                    <a href="<?= base_url('home/logout') ?>" class="text-danger"><i class="fa fa-sign-out text-danger"></i> <span>Keluar Akun</span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
  function addRekomendasi(kategori){
    var bidder = $("#bidder").val();
    $.ajax({
      type :'GET',
      url  :'<?= base_url('profile/addrekomendasi') ?>',
      data :'bidder='+bidder+'&kategori='+kategori,
      success:function(html){
        // silently updated
      }
    });
  }
</script>