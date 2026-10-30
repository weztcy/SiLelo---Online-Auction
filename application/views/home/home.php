      <!-- HERO SECTION -->
      <section class="hero-premium">
        <div class="hero-bg-overlay"></div>
        <div class="container hero-container position-relative">
          <div class="row align-items-center">
            <div class="col-lg-7 text-left text-white hero-content-left">
              <div class="hero-badge-pill mb-3">
                <span class="pulse-dot"></span>
                <span>PLATFORM LELANG TERPERCAYA #1 INDONESIA</span>
              </div>
              <h1 class="hero-title">
                Bidding Transparan,<br>
                Barang Mewah &amp; Koleksi <span class="text-gradient-gold">Terkurasi</span>
              </h1>
              <p class="hero-subtitle">
                Temukan barang impian mulai dari gadget flagship, jam tangan mewah, otomotif, hingga barang antik langka. Seluruh transaksi dijamin aman dengan Rekening Bersama Resmi SiLelo.
              </p>
              <div class="hero-actions d-flex flex-wrap align-items-center mt-4">
                <a href="#live-auctions" class="btn btn-hero-primary mr-3 mb-2"><i class="fa fa-gavel mr-2"></i> Jelajahi Lelang Aktif</a>
                <a href="<?= base_url('home/about') ?>" class="btn btn-hero-secondary mb-2"><i class="fa fa-play-circle mr-2"></i> Cara Kerja Lelang</a>
              </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-right">
              <div class="hero-card-featured">
                <div class="featured-badge"><i class="fa fa-fire text-danger mr-1"></i> LOT UNGGULAN MINGGU INI</div>
                <?php
                  $feat = $this->db->query("SELECT * FROM abe_produk WHERE status = 'lelang' ORDER BY harga_produk DESC LIMIT 1")->row_array();
                  if($feat){
                    $feat_id = $feat['id_produk'];
                    $feat_foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$feat_id' LIMIT 1")->row_array();
                    $feat_bids = $this->db->query("SELECT COUNT(*) as jml FROM abe_lelang_bidder WHERE id_barang = '$feat_id'")->row()->jml;
                    $feat_kat = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '{$feat['id_kategori']}'")->row_array();
                ?>
                  <div class="featured-img-wrap">
                    <img src="<?= get_foto_produk(!empty($feat_foto['file_foto']) ? $feat_foto['file_foto'] : null) ?>" alt="<?= $feat['nama_produk'] ?>" class="img-fluid">
                    <span class="featured-category-chip"><?= $feat_kat['nama_kategori'] ?></span>
                  </div>
                  <div class="featured-details text-left">
                    <h4 class="featured-name"><?= $feat['nama_produk'] ?></h4>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                      <div>
                        <span class="text-muted small d-block">Penawaran Tertinggi</span>
                        <span class="featured-price">Rp <?= number_format($feat['harga_produk'], 0, ',', '.') ?></span>
                      </div>
                      <div class="text-right">
                        <span class="badge-bid-count"><i class="fa fa-users"></i> <?= $feat_bids ?> Bids</span>
                      </div>
                    </div>
                    <a href="<?= base_url('home/produk/').$feat_kat['url_kategori'].'/'.$feat_id ?>" class="btn btn-block btn-featured-bid mt-3"><i class="fa fa-gavel"></i> Ikuti Penawaran</a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <!-- Live Stats Ribbon -->
          <div class="hero-stats-ribbon mt-4">
            <div class="row text-center">
              <div class="col-6 col-md-3 stat-item">
                <div class="stat-num">26+</div>
                <div class="stat-label">Barang Lelang Terkurasi</div>
              </div>
              <div class="col-6 col-md-3 stat-item">
                <div class="stat-num">1.500+</div>
                <div class="stat-label">Lelang Sukses Selesai</div>
              </div>
              <div class="col-6 col-md-3 stat-item">
                <div class="stat-num">Rp 25M+</div>
                <div class="stat-label">Total Nilai Transaksi</div>
              </div>
              <div class="col-6 col-md-3 stat-item">
                <div class="stat-num">100%</div>
                <div class="stat-label">Bergaransi &amp; Escrow Resmi</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- CATEGORIES SECTION -->
      <section class="section-categories py-5">
        <div class="container">
          <div class="section-heading-wrap text-center mb-4">
            <span class="section-badge"><i class="fa fa-th-large mr-1"></i> KATEGORI PILIHAN</span>
            <h2 class="section-title">Katalog Lelang Eksklusif</h2>
            <p class="section-desc">Pilih kategori minat Anda dan ikuti penawaran terbuka dengan harga terbaik.</p>
          </div>
          <div class="row">
            <?php
              $categories = $this->db->query("SELECT * FROM abe_kategori ORDER BY id_kategori ASC")->result();
              $cat_icons = [1 => 'fa-laptop', 2 => 'fa-clock-o', 3 => 'fa-motorcycle', 4 => 'fa-trophy', 5 => 'fa-bicycle'];
              foreach ($categories as $cat) {
                $cid = $cat->id_kategori;
                $icon = isset($cat_icons[$cid]) ? $cat_icons[$cid] : 'fa-tag';
                $cnt = $this->db->query("SELECT COUNT(*) as jml FROM abe_produk WHERE id_kategori = '$cid' AND status = 'lelang'")->row()->jml;
            ?>
              <div class="col-lg col-md-4 col-6 mb-3">
                <a href="<?= base_url('home/kategori/').$cat->url_kategori ?>" class="category-pill-card d-block text-center">
                  <div class="cat-pill-icon"><i class="fa <?= $icon ?>"></i></div>
                  <h6 class="cat-pill-title"><?= $cat->nama_kategori ?></h6>
                  <span class="cat-pill-count"><?= $cnt ?> Aktif</span>
                </a>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <!-- LIVE AUCTIONS SECTION -->
      <section id="live-auctions" class="section-auctions py-5 bg-surface-alt">
        <div class="container">
          <div class="section-heading-wrap d-flex flex-wrap justify-content-between align-items-end mb-4">
            <div>
              <span class="section-badge text-danger"><i class="fa fa-fire mr-1"></i> SEDANG BERLANGSUNG</span>
              <h2 class="section-title mb-0">Lelang Terpopuler Hari Ini</h2>
            </div>
            <div class="mt-2 mt-md-0">
              <span class="text-muted small mr-2">Diperbarui real-time</span>
              <a href="<?= base_url('home/kategori/elektronik') ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-th mr-1"></i> Semua Lot</a>
            </div>
          </div>
          <div class="row">
            <?php
              $sql    = "SELECT * FROM abe_produk WHERE status = 'lelang' ORDER BY id_produk DESC LIMIT 12";
              $produk = $this->db->query($sql)->result();
              foreach ($produk as $row) {
                $id_kategori  = $row->id_kategori;
                $id_produk    = $row->id_produk;
                $kategori = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kategori'")->row_array();
                $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk' LIMIT 1")->row_array();
                $bids_count = $this->db->query("SELECT COUNT(*) as jml FROM abe_lelang_bidder WHERE id_barang = '$id_produk'")->row()->jml;
                $foto_src = get_foto_produk(!empty($foto['file_foto']) ? $foto['file_foto'] : null);
            ?>
              <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="auction-card h-100 d-flex flex-column">
                  <div class="auction-card-img-wrap">
                    <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>">
                      <img class="auction-card-img" src="<?= $foto_src ?>" alt="<?= $row->nama_produk ?>">
                    </a>
                    <span class="badge-live-pulse"><span class="pulse-dot"></span> LIVE</span>
                    <span class="badge-category-chip"><?= $kategori['nama_kategori'] ?></span>
                  </div>
                  <div class="auction-card-body flex-grow-1">
                    <h3 class="auction-title">
                      <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>"><?= $row->nama_produk ?></a>
                    </h3>
                    <div class="auction-price-box">
                      <span class="price-caption">Penawaran Saat Ini</span>
                      <div class="price-val">Rp <?= number_format($row->harga_produk, 0, ',', '.') ?></div>
                    </div>
                    <div class="auction-meta-bar d-flex justify-content-between align-items-center">
                      <span class="meta-bids"><i class="fa fa-users text-warning"></i> <strong><?= $bids_count ?></strong> Bids</span>
                      <span class="meta-time"><i class="fa fa-calendar-check-o text-muted"></i> <?= date('d M Y', strtotime($row->tgl_tutup)) ?></span>
                    </div>
                  </div>
                  <div class="auction-card-footer">
                    <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>" class="btn btn-block btn-bid-action"><i class="fa fa-gavel mr-1"></i> Tawar Sekarang</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

        <?php
          if($this->session->userdata('id') != ''){
            $user = $this->session->userdata('id');
            $query = $this->db->query("SELECT id_kategori FROM abe_kategori_klik WHERE id_bidder = '$user' ORDER BY jumlah_klik DESC LIMIT 1")->row_array(); 
            $kategori_klik = !empty($query['id_kategori']) ? $query['id_kategori'] : 1; 
            $sql = "SELECT * FROM abe_produk WHERE status = 'lelang' AND id_kategori = '$kategori_klik' ORDER BY rand() LIMIT 4";
            $rec_produk = $this->db->query($sql)->result();
            if(!empty($rec_produk)){
        ?>
          <div class="container py-5 border-top">
            <div class="section-heading-wrap d-flex justify-content-between align-items-center mb-4">
              <div>
                <span class="section-badge text-warning"><i class="fa fa-magic mr-1"></i> PERSONALISASI</span>
                <h3 class="section-title mb-0">Rekomendasi Berdasarkan Minat Anda</h3>
              </div>
              <a href="<?= base_url('home/rekomendasi') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="row">
              <?php
                foreach ($rec_produk as $row) {
                  $id_kategori = $row->id_kategori;
                  $id_produk = $row->id_produk;
                  $kategori = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kategori'")->row_array();
                  $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk' LIMIT 1")->row_array();
                  $bids_count = $this->db->query("SELECT COUNT(*) as jml FROM abe_lelang_bidder WHERE id_barang = '$id_produk'")->row()->jml;
                  $foto_src = get_foto_produk(!empty($foto['file_foto']) ? $foto['file_foto'] : null);
              ?>
                <div class="col-lg-3 col-md-6 mb-4">
                  <div class="auction-card h-100 d-flex flex-column">
                    <div class="auction-card-img-wrap">
                      <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>">
                        <img class="auction-card-img" src="<?= $foto_src ?>" alt="<?= $row->nama_produk ?>">
                      </a>
                      <span class="badge-category-chip"><?= $kategori['nama_kategori'] ?></span>
                    </div>
                    <div class="auction-card-body flex-grow-1">
                      <h4 class="auction-title">
                        <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>"><?= $row->nama_produk ?></a>
                      </h4>
                      <div class="auction-price-box">
                        <span class="price-caption">Tawaran Saat Ini</span>
                        <div class="price-val">Rp <?= number_format($row->harga_produk, 0, ',', '.') ?></div>
                      </div>
                      <div class="auction-meta-bar d-flex justify-content-between align-items-center">
                        <span class="meta-bids"><i class="fa fa-users text-warning"></i> <?= $bids_count ?> Bids</span>
                        <span class="meta-time"><i class="fa fa-calendar text-muted"></i> <?= date('d M Y', strtotime($row->tgl_tutup)) ?></span>
                      </div>
                    </div>
                    <div class="auction-card-footer">
                      <a href="<?= base_url('home/produk/').$kategori['url_kategori'].'/'.$row->id_produk ?>" class="btn btn-block btn-bid-action"><i class="fa fa-gavel mr-1"></i> Tawar Sekarang</a>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php
            }
          }
        ?>


      </section>
      <!-- HOW IT WORKS SECTION -->
      <section class="section-how-it-works py-5 bg-white">
        <div class="container">
          <div class="section-heading-wrap text-center mb-5">
            <span class="section-badge"><i class="fa fa-info-circle mr-1"></i> PANDUAN MUDAH</span>
            <h2 class="section-title">Bagaimana Cara Kerja Lelang SiLelo?</h2>
            <p class="section-desc">Hanya 3 langkah sederhana untuk memenangkan lot lelang idaman Anda secara aman dan transparan.</p>
          </div>
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="step-card text-center h-100">
                <div class="step-number">01</div>
                <div class="step-icon-wrap"><i class="fa fa-user-plus"></i></div>
                <h4 class="step-title">Daftar &amp; Setor Deposit</h4>
                <p class="step-desc">Daftar akun bidder dalam 1 menit dan lakukan deposit saldo jaminan. Saldo jaminan sepenuhnya dapat dicairkan kembali (refundable) kapan saja.</p>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="step-card text-center h-100">
                <div class="step-number">02</div>
                <div class="step-icon-wrap"><i class="fa fa-gavel"></i></div>
                <h4 class="step-title">Ajukan Penawaran Terbaik</h4>
                <p class="step-desc">Pilih barang lelang favorit Anda, masukkan nominal bidding secara real-time. Sistem akan mencatat riwayat penawaran secara transparan.</p>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="step-card text-center h-100">
                <div class="step-number">03</div>
                <div class="step-icon-wrap"><i class="fa fa-trophy"></i></div>
                <h4 class="step-title">Menang &amp; Terima Barang</h4>
                <p class="step-desc">Jika Anda penawar tertinggi saat sesi berakhir, Anda resmi menjadi pemenang. Bayar invoice dan barang dikirim aman beransuransi.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- TRUST & SECURITY SECTION -->
      <section class="section-trust py-5 bg-surface-dark text-white">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
              <span class="badge-premium-pill mb-3"><i class="fa fa-shield"></i> JAMINAN KEAMANAN 100%</span>
              <h2 class="trust-heading text-white">Transaksi Aman Tanpa Cemas Dengan Sistem Escrow</h2>
              <p class="trust-sub text-muted-light">SiLelo menerapkan protokol keamanan lelang berstandar industri dengan perlindungan dana penuh dan verifikasi ketat untuk setiap pelelang.</p>
              <ul class="list-unstyled trust-checklist mt-4">
                <li><i class="fa fa-check-circle text-warning mr-2"></i> Rekening Bersama Escrow Resmi SiLelo</li>
                <li><i class="fa fa-check-circle text-warning mr-2"></i> Kurasi fisik &amp; keaslian barang sebelum lelang dibuka</li>
                <li><i class="fa fa-check-circle text-warning mr-2"></i> Perlindungan pembeli: Garansi uang kembali 100%</li>
                <li><i class="fa fa-check-circle text-warning mr-2"></i> Riwayat bidding publik terbuka tanpa bot/manipulasi</li>
              </ul>
            </div>
            <div class="col-lg-7">
              <div class="row">
                <div class="col-sm-6 mb-4">
                  <div class="trust-feature-box">
                    <div class="trust-icon"><i class="fa fa-lock"></i></div>
                    <h5>Rekening Escrow</h5>
                    <p>Dana pelunasan Anda disimpan aman di escrow SiLelo dan baru diteruskan ke pelelang setelah barang tiba dan Anda konfirmasi.</p>
                  </div>
                </div>
                <div class="col-sm-6 mb-4">
                  <div class="trust-feature-box">
                    <div class="trust-icon"><i class="fa fa-certificate"></i></div>
                    <h5>Kurasi Terverifikasi</h5>
                    <p>Seluruh lot lelang melewati pengecekan serial number, kondisi fisik, dan bukti keabsahan kepemilikan.</p>
                  </div>
                </div>
                <div class="col-sm-6 mb-4">
                  <div class="trust-feature-box">
                    <div class="trust-icon"><i class="fa fa-truck"></i></div>
                    <h5>Pengiriman Asuransi</h5>
                    <p>Pengiriman lot pemenang menggunakan ekspedisi rekanan dengan packing kayu dan asuransi total nilai lelang.</p>
                  </div>
                </div>
                <div class="col-sm-6 mb-4">
                  <div class="trust-feature-box">
                    <div class="trust-icon"><i class="fa fa-headphones"></i></div>
                    <h5>Dukungan CS 24/7</h5>
                    <p>Tim support profesional kami siap melayani dan memandu proses bidding Anda setiap saat tanpa hari libur.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- TESTIMONIALS SECTION -->
      <section class="section-testimonials py-5 bg-light-surface">
        <div class="container">
          <div class="section-heading-wrap text-center mb-5">
            <span class="section-badge"><i class="fa fa-star mr-1"></i> TESTIMONI REAL</span>
            <h2 class="section-title">Ulasan Pemenang Lelang Terverifikasi</h2>
            <p class="section-desc">Lihat kepuasan para penawar yang telah berhasil memenangkan lot lelang di SiLelo.</p>
          </div>
          <div class="row">
            <?php
              $reviews = $this->db->query("SELECT ar.*, u.nama_lengkap, u.email, ap.nama_produk FROM abe_review ar JOIN users u ON ar.user_input = u.id JOIN abe_produk ap ON ar.produk = ap.id_produk ORDER BY ar.id_review DESC LIMIT 3")->result();
              foreach ($reviews as $rev) {
            ?>
              <div class="col-md-4 mb-4">
                <div class="review-card h-100 d-flex flex-column">
                  <div class="review-stars mb-3 text-warning">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    <span class="badge badge-success-soft ml-2"><i class="fa fa-check"></i> Terverifikasi</span>
                  </div>
                  <p class="review-text flex-grow-1">&ldquo;<?= $rev->review ?>&rdquo;</p>
                  <div class="review-product-tag small text-muted mb-3">
                    <i class="fa fa-tag text-warning mr-1"></i> Lot: <strong><?= $rev->nama_produk ?></strong>
                  </div>
                  <div class="review-author d-flex align-items-center pt-3 border-top">
                    <div class="author-avatar mr-3">
                      <i class="fa fa-user-circle"></i>
                    </div>
                    <div>
                      <h6 class="mb-0 font-weight-bold"><?= $rev->nama_lengkap ?></h6>
                      <span class="text-muted small">Pemenang Lelang Terverifikasi</span>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>