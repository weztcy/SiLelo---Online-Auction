      <?php
        $id_produk = $this->uri->segment(4);
        $uri_kategori = $this->uri->segment(3);
        $status = $record['status'];
        $today = date('Y-m-d');
        $exp = $record['tgl_tutup'];
        $id_pelelang = $record['id_pelelang'];
        $pelelang = $this->db->query("SELECT * FROM abe_pelelang WHERE id_user = '$id_pelelang' ")->row_array();
        $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk'")->result();
        $main_foto = !empty($foto[0]->file_foto) ? $foto[0]->file_foto : 'photogrid.jpg';
        $bids = $this->db->query("SELECT alb.*, u.nama_lengkap, u.email FROM abe_lelang_bidder alb JOIN users u ON alb.id_bidder = u.id WHERE alb.id_barang = '$id_produk' ORDER BY alb.harga_lelang DESC, alb.id_lelang_bidder DESC")->result();
        $bids_count = count($bids);
        $highest_bid = ($bids_count > 0) ? $bids[0]->harga_lelang : $record['harga_produk'];
        $min_next_bid = $highest_bid + 50000;
      ?>

      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-tag"></i> DETAIL LOT LELANG</span>
              <h1 class="h2 page-title"><?= $record['nama_produk'] ?></h1>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('home/kategori/').$uri_kategori ?>">Kategori</a></li>
                <li class="breadcrumb-item active"><?= $record['nama_produk'] ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <!-- LEFT COLUMN: Gallery & Specifications -->
            <div class="col-lg-7 mb-4">
              <div class="detail-gallery-card p-3 bg-white rounded-lg shadow-sm">
                <div class="main-image-wrap mb-3 text-center">
                  <img id="mainDetailImage" src="<?= get_foto_produk($main_foto) ?>" alt="<?= $record['nama_produk'] ?>" class="img-fluid rounded" style="max-height: 480px; object-fit: contain;">
                </div>
                <?php if(count($foto) > 1){ ?>
                  <div class="thumb-carousel d-flex justify-content-center flex-wrap">
                    <?php foreach ($foto as $f) { ?>
                      <div class="thumb-item m-1">
                        <img src="<?= get_foto_produk($f->file_foto) ?>" onclick="document.getElementById('mainDetailImage').src=this.src" class="img-thumbnail" style="width: 70px; height: 70px; object-fit: cover; cursor: pointer;">
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>

              <!-- Product Details Tab/Box -->
              <div class="detail-spec-card mt-4 p-4 bg-white rounded-lg shadow-sm">
                <h4 class="font-weight-bold mb-3"><i class="fa fa-align-left text-warning mr-2"></i> Deskripsi &amp; Spesifikasi Produk</h4>
                <div class="detail-description text-muted">
                  <?= $record['deskripsi'] ?>
                </div>
                <?php if(!empty($record['keterangan'])){ ?>
                  <div class="alert alert-light border mt-3">
                    <strong class="text-dark"><i class="fa fa-info-circle text-info mr-1"></i> Catatan Pelelang:</strong><br>
                    <span class="text-muted"><?= $record['keterangan'] ?></span>
                  </div>
                <?php } ?>
              </div>

              <!-- Bid History Table -->
              <div class="detail-bids-card mt-4 p-4 bg-white rounded-lg shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="font-weight-bold mb-0"><i class="fa fa-history text-warning mr-2"></i> Riwayat Penawaran (<?= $bids_count ?>)</h4>
                  <span class="badge badge-success-soft"><i class="fa fa-check-circle"></i> Transparan &amp; Terbuka</span>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover table-striped mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th>Waktu</th>
                        <th>Penawar (Masked)</th>
                        <th>Jumlah Tawaran</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(empty($bids)){
                          echo "<tr><td colspan='4' class='text-center py-4 text-muted'><i class='fa fa-inbox fa-2x d-block mb-2'></i>Belum ada penawaran yang diajukan. Jadilah yang pertama menawar!</td></tr>";
                        } else {
                          $rank = 1;
                          foreach ($bids as $b) {
                            $email_parts = explode('@', $b->email);
                            $masked_email = substr($email_parts[0], 0, 3) . '***@' . (isset($email_parts[1]) ? $email_parts[1] : 'email.com');
                      ?>
                        <tr class="<?= ($rank == 1) ? 'table-warning font-weight-bold' : '' ?>">
                          <td><small class="text-muted"><?= date('d M Y, H:i', strtotime($b->tanggal)) ?></small></td>
                          <td>
                            <?= $masked_email ?>
                            <?php if($rank == 1){ ?>
                              <span class="badge badge-warning ml-1">Tertinggi</span>
                            <?php } ?>
                          </td>
                          <td class="text-dark">Rp <?= number_format($b->harga_lelang, 0, ',', '.') ?></td>
                          <td>
                            <?php if($rank == 1 && $status == 'sold out'){ ?>
                              <span class="badge badge-success"><i class="fa fa-trophy"></i> Pemenang</span>
                            <?php } else if($rank == 1){ ?>
                              <span class="badge badge-success">Memimpin</span>
                            <?php } else { ?>
                              <span class="badge badge-secondary">Terlampaui</span>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php
                            $rank++;
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- RIGHT COLUMN: Auction Bidding Console -->
            <div class="col-lg-5">
              <div class="bidding-console-card p-4 bg-white rounded-lg shadow-sm sticky-top" style="top: 100px;">
                <!-- Seller Trust Card -->
                <div class="seller-strip d-flex align-items-center mb-3 pb-3 border-bottom">
                  <div class="seller-avatar mr-3">
                    <i class="fa fa-shield fa-2x text-warning"></i>
                  </div>
                  <div>
                    <span class="text-muted small d-block">Pelelang Terverifikasi</span>
                    <a href="<?= base_url('profile/pelelang/').$id_pelelang ?>" class="font-weight-bold text-dark h6 mb-0"><?= $pelelang['nama_lengkap'] ?></a>
                  </div>
                </div>

                <!-- Lot Status Badge -->
                <div class="lot-status-row mb-3 d-flex justify-content-between align-items-center">
                  <div>
                    <?php if($status == 'sold out'){ ?>
                      <span class="badge badge-sold-out p-2"><i class="fa fa-check"></i> LELANG BERAKHIR (SOLD OUT)</span>
                    <?php } else if($status == 'ready'){ ?>
                      <span class="badge badge-coming-soon p-2"><i class="fa fa-clock-o"></i> SEGERA HADIR</span>
                    <?php } else { ?>
                      <span class="badge-live-pulse p-2"><span class="pulse-dot"></span> SEDANG BERLANGSUNG</span>
                    <?php } ?>
                  </div>
                  <div class="text-right">
                    <span class="badge badge-light border"><i class="fa fa-users text-warning mr-1"></i> <?= $bids_count ?> Penawar</span>
                  </div>
                </div>

                <!-- Price Box -->
                <div class="price-console-box p-3 rounded mb-3">
                  <span class="text-muted small d-block"><?= ($status == 'sold out') ? 'Harga Final Terjual' : 'Penawaran Tertinggi Saat Ini' ?></span>
                  <div class="console-price-text">
                    Rp <?= number_format($highest_bid, 0, ',', '.') ?>
                  </div>
                  <div class="text-muted small mt-1">
                    <i class="fa fa-calendar text-warning mr-1"></i> Berakhir: <strong><?= date('d F Y', strtotime($exp)) ?></strong>
                  </div>
                </div>

                <!-- CTA Action Buttons -->
                <div class="bidding-action-wrap mt-4">
                  <?php
                    $user_session = $this->session->userdata('id');
                    if($user_session == ''){
                  ?>
                    <button type="button" class="btn btn-block btn-lg btn-bid-action" data-toggle="modal" data-target="#login-modal">
                      <i class="fa fa-sign-in mr-2"></i> Masuk Untuk Ikut Bidding
                    </button>
                    <p class="text-center text-muted small mt-2">Belum punya akun? <a href="<?= base_url('home/register') ?>">Daftar di sini</a></p>
                  <?php
                    } else {
                      $sql_cek = "SELECT * FROM abe_deposit WHERE id_user = '$user_session' AND status = 'oke'";
                      $deposit = $this->db->query($sql_cek)->num_rows();
                      if($deposit == 0){
                  ?>
                    <button type="button" class="btn btn-block btn-lg btn-warning font-weight-bold" data-toggle="modal" data-target="#deposit-modal">
                      <i class="fa fa-money mr-2"></i> Setor Deposit Untuk Bidding
                    </button>
                    <p class="text-center text-muted small mt-2">Saldo jaminan diperlukan untuk menawar lot ini.</p>
                  <?php
                      } else {
                        if($status == 'sold out'){
                  ?>
                    <button type="button" class="btn btn-block btn-lg btn-secondary" disabled>
                      <i class="fa fa-lock mr-2"></i> Sesi Lelang Telah Ditutup
                    </button>
                  <?php
                        } else if($status == 'ready'){
                  ?>
                    <button type="button" class="btn btn-block btn-lg btn-info" disabled>
                      <i class="fa fa-hourglass-start mr-2"></i> Lelang Segera Dimulai
                    </button>
                  <?php
                        } else {
                  ?>
                    <button type="button" class="btn btn-block btn-lg btn-bid-action pulse-hover" data-toggle="modal" data-target="#bid-modal">
                      <i class="fa fa-gavel mr-2"></i> Ajukan Penawaran Sekarang
                    </button>
                    <div class="text-center mt-2 small text-muted">
                      Minimal penawaran selanjutnya: <strong>Rp <?= number_format($min_next_bid, 0, ',', '.') ?></strong>
                    </div>
                  <?php
                        }
                      }
                    }
                  ?>
                </div>

                <!-- Trust Guarantee Box -->
                <div class="guarantee-box mt-4 p-3 rounded bg-light border">
                  <h6 class="font-weight-bold mb-2 text-dark"><i class="fa fa-shield text-success mr-1"></i> SiLelo Buyer Protection</h6>
                  <ul class="list-unstyled mb-0 small text-muted">
                    <li class="mb-1"><i class="fa fa-check text-success mr-2"></i> Rekening Escrow: Dana aman terlindungi</li>
                    <li class="mb-1"><i class="fa fa-check text-success mr-2"></i> Jaminan 100% barang asli &amp; sesuai fisik</li>
                    <li class="mb-1"><i class="fa fa-check text-success mr-2"></i> Pengiriman berasuransi sampai tujuan</li>
                    <li><i class="fa fa-check text-success mr-2"></i> Layanan mediasi lelang resmi 24/7</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- BID MODAL -->
      <div id="bid-modal" tabindex="-1" role="dialog" class="modal fade">
        <div role="document" class="modal-dialog modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title font-weight-bold"><i class="fa fa-gavel text-warning mr-2"></i> Masukkan Penawaran Anda</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close text-white"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4">
              <div class="lot-info-strip p-3 bg-light rounded mb-3">
                <span class="text-muted small d-block">Barang yang ditawar:</span>
                <strong class="text-dark"><?= $record['nama_produk'] ?></strong>
                <div class="d-flex justify-content-between mt-2 pt-2 border-top">
                  <span class="small text-muted">Tawaran Tertinggi:</span>
                  <span class="font-weight-bold text-dark">Rp <?= number_format($highest_bid, 0, ',', '.') ?></span>
                </div>
              </div>

              <form action="<?= base_url('home/bidder') ?>" method="post">
                <input type="hidden" name="barang" value="<?= $id_produk ?>">
                <input type="hidden" name="kategori" value="<?= $uri_kategori ?>">
                <input type="hidden" name="id_kategori" value="<?= $record['id_kategori'] ?>">

                <div class="form-group">
                  <label class="font-weight-bold">Nominal Tawaran Baru (Rp):</label>
                  <input id="bidInput" type="number" name="harga" min="<?= $min_next_bid ?>" value="<?= $min_next_bid ?>" required class="form-control form-control-lg font-weight-bold text-primary" placeholder="Masukkan jumlah penawaran">
                  <small class="text-muted">Nominal minimal penawaran adalah Rp <?= number_format($min_next_bid, 0, ',', '.') ?></small>
                </div>

                <div class="quick-bid-shortcuts mb-3">
                  <label class="small font-weight-bold text-muted d-block">Tombol Cepat Kenaikan Tawaran:</label>
                  <div class="btn-group btn-group-sm w-100" role="group">
                    <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('bidInput').value = <?= $highest_bid + 50000 ?>">+50rb</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('bidInput').value = <?= $highest_bid + 100000 ?>">+100rb</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('bidInput').value = <?= $highest_bid + 500000 ?>">+500rb</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('bidInput').value = <?= $highest_bid + 1000000 ?>">+1jt</button>
                  </div>
                </div>

                <button type="submit" class="btn btn-block btn-lg btn-bid-action mt-4 font-weight-bold">
                  <i class="fa fa-gavel mr-1"></i> Konfirmasi &amp; Kirim Penawaran
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- LOGIN MODAL -->
      <div id="login-modal" tabindex="-1" role="dialog" class="modal fade">
        <div role="document" class="modal-dialog modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg text-center p-4">
            <div class="modal-body">
              <i class="fa fa-lock fa-3x text-warning mb-3"></i>
              <h4 class="font-weight-bold">Akses Akun Diperlukan</h4>
              <p class="text-muted">Silakan masuk sebagai bidder untuk mulai mengajukan penawaran pada seluruh lot lelang SiLelo.</p>
              <a href="<?= base_url('home/register') ?>" class="btn btn-hero-primary btn-block mb-2"><i class="fa fa-sign-in mr-1"></i> Masuk Sekarang</a>
              <button type="button" data-dismiss="modal" class="btn btn-link text-muted">Batal</button>
            </div>
          </div>
        </div>
      </div>

      <!-- DEPOSIT MODAL -->
      <div id="deposit-modal" tabindex="-1" role="dialog" class="modal fade">
        <div role="document" class="modal-dialog modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg text-center p-4">
            <div class="modal-body">
              <i class="fa fa-credit-card fa-3x text-warning mb-3"></i>
              <h4 class="font-weight-bold">Deposit Jaminan Diperlukan</h4>
              <p class="text-muted">Untuk menjaga keadilan dan komitmen bidding, setiap peserta wajib memiliki saldo deposit aktif. Saldo jaminan ini sepenuhnya aman dan dapat ditarik kembali kapan saja.</p>
              <a href="<?= base_url('profile') ?>" class="btn btn-hero-primary btn-block mb-2"><i class="fa fa-money mr-1"></i> Setor Deposit Sekarang</a>
              <button type="button" data-dismiss="modal" class="btn btn-link text-muted">Nanti Saja</button>
            </div>
          </div>
        </div>
      </div>
