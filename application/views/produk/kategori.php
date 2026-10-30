      <?php
        $uri          = $this->uri->segment(3);
        $sql_kategori = $this->db->query("SELECT * FROM abe_kategori WHERE url_kategori = '$uri'")->row_array();
        $kategori_nama = !empty($sql_kategori['nama_kategori']) ? $sql_kategori['nama_kategori'] : ucfirst($uri);
        $kategori_id   = !empty($sql_kategori['id_kategori']) ? $sql_kategori['id_kategori'] : 1;
      ?>
      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-folder-open"></i> KATEGORI LELANG</span>
              <h1 class="h2 page-title"><?= $kategori_nama ?></h1>
              <p class="text-muted mb-0">Daftar lot lelang terkurasi dalam kategori <?= strtolower($kategori_nama) ?> dengan jaminan keaslian dan inspeksi fisik.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Kategori</a></li>
                <li class="breadcrumb-item active"><?= $kategori_nama ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="font-weight-bold mb-0">Lot Lelang Tersedia</h4>
                <div class="text-muted small">
                  <?php
                    $count_cat = $this->db->query("SELECT COUNT(*) as jml FROM abe_produk WHERE id_kategori = '$kategori_id'")->row()->jml;
                    echo "Menampilkan <strong>$count_cat</strong> lot produk";
                  ?>
                </div>
              </div>

              <div class="row">
                <?php
                  $sql    = "SELECT * FROM abe_produk WHERE id_kategori = '$kategori_id' ORDER BY id_produk DESC";
                  $produk = $this->db->query($sql)->result();
                  if(empty($produk)){
                    echo "<div class='col-12 text-center py-5'><div class='alert alert-info'>Belum ada lot lelang untuk kategori ini.</div></div>";
                  }
                  foreach ($produk as $row) {
                    $id_produk    = $row->id_produk;
                    $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk' LIMIT 1")->row_array();
                    $bids_count = $this->db->query("SELECT COUNT(*) as jml FROM abe_lelang_bidder WHERE id_barang = '$id_produk'")->row()->jml;
                    $foto_src = get_foto_produk(!empty($foto['file_foto']) ? $foto['file_foto'] : null);
                ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="auction-card h-100 d-flex flex-column">
                      <div class="auction-card-img-wrap">
                        <a href="<?= base_url('home/produk/').$uri.'/'.$id_produk ?>">
                          <img class="auction-card-img" src="<?= $foto_src ?>" alt="<?= $row->nama_produk ?>">
                        </a>
                        <?php if($row->status == 'sold out'){ ?>
                          <span class="badge badge-sold-out"><i class="fa fa-check"></i> TERJUAL</span>
                        <?php } else if($row->status == 'ready'){ ?>
                          <span class="badge badge-coming-soon"><i class="fa fa-clock-o"></i> SEGERA HADIR</span>
                        <?php } else { ?>
                          <span class="badge-live-pulse"><span class="pulse-dot"></span> LIVE</span>
                        <?php } ?>
                        <span class="badge-category-chip"><?= $kategori_nama ?></span>
                      </div>
                      <div class="auction-card-body flex-grow-1">
                        <h4 class="auction-title">
                          <a href="<?= base_url('home/produk/').$uri.'/'.$id_produk ?>"><?= $row->nama_produk ?></a>
                        </h4>
                        <div class="auction-price-box">
                          <span class="price-caption"><?= ($row->status == 'sold out') ? 'Harga Terjual' : 'Tawaran Saat Ini' ?></span>
                          <div class="price-val">Rp <?= number_format($row->harga_produk, 0, ',', '.') ?></div>
                        </div>
                        <div class="auction-meta-bar d-flex justify-content-between align-items-center">
                          <span class="meta-bids"><i class="fa fa-users text-warning"></i> <?= $bids_count ?> Bids</span>
                          <span class="meta-time"><i class="fa fa-calendar-check-o text-muted"></i> <?= date('d M Y', strtotime($row->tgl_tutup)) ?></span>
                        </div>
                      </div>
                      <div class="auction-card-footer">
                        <a href="<?= base_url('home/produk/').$uri.'/'.$id_produk ?>" class="btn btn-block btn-bid-action">
                          <i class="fa fa-gavel mr-1"></i> <?= ($row->status == 'sold out') ? 'Lihat Hasil Lelang' : 'Tawar Sekarang' ?>
                        </a>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <!-- OTHER HOT LOTS -->
        <div class="container mt-5 pt-4 border-top">
          <div class="section-heading-wrap text-center mb-4">
            <span class="section-badge"><i class="fa fa-fire mr-1"></i> REKOMENDASI POPULER</span>
            <h3 class="section-title">Lelang Paling Banyak Dipantau</h3>
          </div>
          <div class="row">
            <?php
              $sql_hot = "SELECT ap.*, COUNT(alb.id_lelang_bidder) as total_bids FROM abe_produk ap LEFT JOIN abe_lelang_bidder alb ON ap.id_produk = alb.id_barang WHERE ap.status = 'lelang' AND ap.id_kategori != '$kategori_id' GROUP BY ap.id_produk ORDER BY total_bids DESC LIMIT 4";
              $hot_produk = $this->db->query($sql_hot)->result();
              foreach ($hot_produk as $row) {
                $id_kat = $row->id_kategori;
                $kat_info = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kat'")->row_array();
                $foto_hot = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '{$row->id_produk}' LIMIT 1")->row_array();
                $foto_src = get_foto_produk(!empty($foto_hot['file_foto']) ? $foto_hot['file_foto'] : null);
            ?>
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="auction-card h-100 d-flex flex-column">
                  <div class="auction-card-img-wrap">
                    <a href="<?= base_url('home/produk/').$kat_info['url_kategori'].'/'.$row->id_produk ?>">
                      <img class="auction-card-img" src="<?= $foto_src ?>" alt="<?= $row->nama_produk ?>">
                    </a>
                    <span class="badge-category-chip"><?= $kat_info['nama_kategori'] ?></span>
                  </div>
                  <div class="auction-card-body flex-grow-1">
                    <h5 class="auction-title">
                      <a href="<?= base_url('home/produk/').$kat_info['url_kategori'].'/'.$row->id_produk ?>"><?= $row->nama_produk ?></a>
                    </h5>
                    <div class="auction-price-box">
                      <span class="price-caption">Tawaran Tertinggi</span>
                      <div class="price-val">Rp <?= number_format($row->harga_produk, 0, ',', '.') ?></div>
                    </div>
                  </div>
                  <div class="auction-card-footer">
                    <a href="<?= base_url('home/produk/').$kat_info['url_kategori'].'/'.$row->id_produk ?>" class="btn btn-block btn-bid-action">
                      <i class="fa fa-gavel mr-1"></i> Tawar Sekarang
                    </a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
