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
              <span class="badge-premium-pill mb-2"><i class="fa fa-credit-card mr-1"></i> FAKTUR &amp; PEMBAYARAN</span>
              <h1 class="h2 page-title">Tagihan &amp; Invoice Lelang</h1>
              <p class="text-muted mb-0">Daftar invoice untuk seluruh lot lelang yang Anda menangkan.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Akun</a></li>
                <li class="breadcrumb-item active">Tagihan &amp; Invoice</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div id="customer-orders" class="col-lg-8">
              <?php if($this->session->flashdata('sukses')){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <i class="fa fa-check-circle mr-1"></i> <?= $this->session->flashdata('sukses'); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
              <?php }elseif($this->session->flashdata('gagal')){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="fa fa-exclamation-circle mr-1"></i> <?= $this->session->flashdata('gagal'); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
              <?php } ?>
              <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-file-text-o text-warning mr-2"></i> Daftar Tagihan Lot</h4>
                </div>

                <div class="table-responsive">
                  <table class="table table-lux mb-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Lot Produk Pemenang</th>
                        <th>Tanggal Terbit</th>
                        <th>Nominal Tagihan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $id_user = $this->session->userdata('id');
                        $sql_invoice = "SELECT ai.*, ap.nama_produk,
                                               (SELECT file_foto FROM abe_foto_produk WHERE id_produk = ap.id_produk ORDER BY id_foto_produk ASC LIMIT 1) as file_foto
                                        FROM abe_invoice ai
                                        JOIN abe_produk ap ON ai.id_produk = ap.id_produk
                                        WHERE ai.id_user = '$id_user'
                                        ORDER BY ai.id_invoice DESC";
                        $invoices = $this->db->query($sql_invoice)->result();
                        $no = 1;
                        if(empty($invoices)){
                      ?>
                        <tr>
                          <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa fa-file-text-o text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="mb-0">Belum ada tagihan atau invoice lelang saat ini.</p>
                          </td>
                        </tr>
                      <?php
                        }else{
                        foreach ($invoices as $row) {
                          $img_src = get_foto_produk($row->file_foto);
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="<?= $img_src ?>" alt="<?= $row->nama_produk ?>" class="rounded shadow-xs mr-3" style="width: 50px; height: 42px; object-fit: cover;">
                            <div>
                              <span class="badge badge-light border text-muted px-1 small mb-1 d-inline-block">#<?= $row->no_invoice ?></span>
                              <div class="font-weight-bold text-dark">
                                <?= (strlen($row->nama_produk) > 28) ? substr($row->nama_produk, 0, 28).'...' : $row->nama_produk ?>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="text-muted small"><?= date('d M Y, H:i', strtotime($row->tgl_buat)) ?> WIB</td>
                        <td class="font-weight-bold text-dark">Rp <?= number_format($row->harga_produk, 0, ',', '.') ?></td>
                        <td>
                          <?php if($row->status == 'belum bayar'){ ?>
                            <span class="badge-status badge-status-warning"><i class="fa fa-clock-o mr-1"></i> Menunggu Bayar</span>
                          <?php } else { ?>
                            <span class="badge-status badge-status-success"><i class="fa fa-check-circle mr-1"></i> Lunas</span>
                          <?php } ?>
                        </td>
                        <td>
                          <a href="<?= base_url('profile/invoice/').$row->id_produk ?>" class="btn btn-sm btn-outline-warning font-weight-bold">
                            <i class="fa fa-file-text-o mr-1"></i> Invoice
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
                  <h4 class="customer-sidebar-name"><?= !empty($bidder_row['first_name']) ? $bidder_row['first_name'].' '.$bidder_row['last_name'] : 'Bidder SiLelo' ?></h4>
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
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/orders') ?>"><i class="fa fa-gavel"></i> <span>Tawaran Saya</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item active">
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
   

