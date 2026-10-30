      <?php
        $uri = $this->uri->segment(2);
      ?>
      <!-- Navbar Start-->
      <header class="nav-holder make-sticky">
        <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
          <div class="container">
            <a href="<?= base_url() ?>" class="navbar-brand-silelo">
              <div class="brand-icon-box">
                <i class="fa fa-gavel"></i>
              </div>
              <div class="brand-text-wrap">
                <span class="brand-title">Si<span class="text-gradient-gold">Lelo</span></span>
                <span class="brand-tagline">PREMIER AUCTION</span>
              </div>
            </a>
            <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler">
              <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
            </button>
            <div id="navigation" class="navbar-collapse collapse">
              <ul class="nav navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item <?= ($uri == '' || $uri == 'index') ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>" class="nav-link"><i class="fa fa-compass mr-1"></i> <span>Eksplor Lelang</span></a>
                </li>

                <li class="nav-item dropdown menu-large <?= ($uri == 'kategori') ? 'active' : '' ?>">
                  <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link"><i class="fa fa-th-large mr-1"></i> <span>Kategori</span> <b class="caret ml-1"></b></a>
                  <ul class="dropdown-menu megamenu shadow-lg">
                    <li>
                      <div class="row align-items-center">
                        <div class="col-lg-5 p-4 border-right d-none d-lg-block">
                          <div class="megamenu-promo">
                            <span class="badge-curated mb-2"><i class="fa fa-star text-warning"></i> PILIHAN TERBAIK</span>
                            <h4 class="promo-heading">Temukan Koleksi &amp; Barang Impian Anda</h4>
                            <p class="promo-sub">Ribuan penawar aktif setiap hari pada 5 kategori lelang terverifikasi dengan inspeksi kondisi fisik 100% transparan.</p>
                            <a href="<?= base_url('home/about') ?>" class="btn-learn-more"><i class="fa fa-arrow-circle-right"></i> Pelajari Cara Bidding</a>
                          </div>
                        </div>
                        <div class="col-lg-7 col-md-12 p-4">
                          <h6 class="text-uppercase font-weight-bold text-muted mb-3 letter-spacing-1">Jelajahi Berdasarkan Kategori</h6>
                          <div class="row">
                            <?php
                              $kategori   = $this->db->query("SELECT * FROM abe_kategori ORDER BY id_kategori ASC")->result();
                              $cat_icons = [
                                1 => 'fa-laptop',
                                2 => 'fa-clock-o',
                                3 => 'fa-motorcycle',
                                4 => 'fa-trophy',
                                5 => 'fa-bicycle'
                              ];
                              foreach ($kategori as $ka) {
                                $nama_kategori = $ka->nama_kategori;
                                $url = $ka->url_kategori;
                                $cat_id = $ka->id_kategori;
                                $icon = isset($cat_icons[$cat_id]) ? $cat_icons[$cat_id] : 'fa-tag';
                                $count = $this->db->query("SELECT COUNT(*) as jml FROM abe_produk WHERE id_kategori = '$cat_id' AND status = 'lelang'")->row()->jml;
                            ?>
                              <div class="col-sm-6 mb-2">
                                <a href="<?= base_url('home/kategori/').$url ?>" class="category-menu-item d-flex align-items-center">
                                  <div class="cat-icon-circle mr-3">
                                    <i class="fa <?= $icon ?>"></i>
                                  </div>
                                  <div class="cat-info">
                                    <span class="cat-name d-block font-weight-bold"><?= $nama_kategori ?></span>
                                    <span class="cat-count text-muted small"><?= $count ?> item aktif</span>
                                  </div>
                                </a>
                              </div>
                            <?php
                              }
                            ?>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                
                <li class="nav-item <?= ($uri == 'about') ? 'active' : '' ?>">
                  <a href="<?= base_url('home/about') ?>" class="nav-link"><i class="fa fa-bookmark-o mr-1"></i> <span>Cara Lelang</span></a>
                </li>

                <?php 
                  if ($this->session->userdata('id') != ''){
                ?>
                <li class="nav-item <?= ($uri == 'rekomendasi') ? 'active' : '' ?>">
                  <a href="<?= base_url('home/rekomendasi') ?>" class="nav-link"><i class="fa fa-fire text-warning mr-1"></i> <span>Rekomendasi</span></a>
                </li>
                <?php
                  }
                ?>

                <li class="nav-item <?= ($uri == 'kontak') ? 'active' : '' ?>">
                  <a href="<?= base_url('home/kontak') ?>" class="nav-link"><i class="fa fa-life-ring mr-1"></i> <span>Bantuan</span></a>
                </li>

                <li class="nav-item nav-btn-cta ml-lg-2">
                  <a href="<?= base_url('pelelang') ?>" class="btn-cta-auction"><i class="fa fa-gavel mr-1"></i> <span>Buka Lelang</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>
      <!-- Navbar End-->