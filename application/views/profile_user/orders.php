<?php
  $id       = $this->session->userdata('id');
  $sql_user = "SELECT * FROM users WHERE id = '$id'";
  $bidder   = $this->db->query($sql_user)->row_array();

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
              <span class="badge-premium-pill mb-2"><i class="fa fa-gavel mr-1"></i> AKTIVITAS BIDDING</span>
              <h1 class="h2 page-title">Riwayat Tawaran Saya</h1>
              <p class="text-muted mb-0">Pantau seluruh riwayat penawaran harga dan status lot lelang yang Anda ikuti secara live.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Akun</a></li>
                <li class="breadcrumb-item active">Tawaran Saya</li>
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
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-list-alt text-warning mr-2"></i> Daftar Tawaran Lot Lelang</h4>
                  <a href="<?= base_url('home/kategori/elektronik') ?>" class="btn btn-sm btn-outline-warning font-weight-bold">
                    <i class="fa fa-search mr-1"></i> Telusuri Lot Baru
                  </a>
                </div>

                <div class="table-responsive">
                  <table class="table table-lux mb-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Lot Produk</th>
                        <th>Waktu Bidding</th>
                        <th>Tawaran Anda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql_bidder = "SELECT alb.*, ap.nama_produk, ap.status as status_produk, ak.url_kategori,
                                              (SELECT file_foto FROM abe_foto_produk WHERE id_produk = ap.id_produk ORDER BY id_foto_produk ASC LIMIT 1) as file_foto
                                       FROM abe_lelang_bidder alb
                                       JOIN abe_produk ap ON alb.id_barang = ap.id_produk
                                       JOIN abe_kategori ak ON ap.id_kategori = ak.id_kategori
                                       WHERE alb.id_bidder = '$id'
                                       ORDER BY alb.id_lelang_bidder DESC";
                        $bids = $this->db->query($sql_bidder)->result();
                        $no = 1;
                        if(empty($bids)){
                      ?>
                        <tr>
                          <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa fa-gavel text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="mb-2">Anda belum mengajukan penawaran pada lot lelang manapun.</p>
                            <a href="<?= base_url() ?>" class="btn btn-sm btn-warning">Ikuti Lelang Sekarang</a>
                          </td>
                        </tr>
                      <?php
                        }else{
                        foreach ($bids as $row) {
                          $img_src = get_foto_produk($row->file_foto);
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="<?= $img_src ?>" alt="<?= $row->nama_produk ?>" class="rounded shadow-xs mr-3" style="width: 50px; height: 42px; object-fit: cover;">
                            <div>
                              <a href="<?= base_url('home/produk/').$row->url_kategori.'/'.$row->id_barang ?>" class="font-weight-bold text-dark text-decoration-none">
                                <?= (strlen($row->nama_produk) > 30) ? substr($row->nama_produk, 0, 30).'...' : $row->nama_produk ?>
                              </a>
                            </div>
                          </div>
                        </td>
                        <td class="text-muted small"><?= date('d M Y, H:i', strtotime($row->tanggal)) ?> WIB</td>
                        <td class="font-weight-bold text-dark">Rp <?= number_format($row->harga_lelang, 0, ',', '.') ?></td>
                        <td>
                          <?php if($row->status == 'menang' || $row->status == 'pemenang'){ ?>
                            <span class="badge-status badge-status-success"><i class="fa fa-trophy mr-1"></i> Menang</span>
                          <?php } else { ?>
                            <span class="badge-status badge-status-info"><i class="fa fa-clock-o mr-1"></i> Ditawar</span>
                          <?php } ?>
                        </td>
                        <td>
                          <a href="<?= base_url('home/produk/').$row->url_kategori.'/'.$row->id_barang ?>" class="btn btn-xs btn-outline-dark" title="Lihat Lot">
                            <i class="fa fa-eye"></i>
                          </a>
                        </td>
                      </tr>
                      <?php
                          $no ++;
                        }
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
                  <h4 class="customer-sidebar-name"><?= !empty($bidder['first_name']) ? $bidder['first_name'].' '.$bidder['last_name'] : 'Bidder SiLelo' ?></h4>
                  <div class="customer-sidebar-role">Verified Bidder</div>
                  <div class="customer-balance-box">
                    <span class="balance-caption">Saldo Jaminan Aktif</span>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="balance-amount">Rp <?= number_format($jumlah, 0, ',', '.') ?></span>
                      <a href="<?= base_url('profile') ?>" class="btn btn-xs btn-warning font-weight-bold px-2 py-1">
                        Top Up
                      </a>
                    </div>
                  </div>
                </div>

                <ul class="customer-nav-list">
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile') ?>"><i class="fa fa-user"></i> <span>Akun &amp; Profil</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/rekomendasi') ?>"><i class="fa fa-star"></i> <span>Minat Kategori</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item active">
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
   
