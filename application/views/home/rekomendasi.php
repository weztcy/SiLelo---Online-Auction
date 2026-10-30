      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-magic mr-1"></i> REKOMENDASI TERKURASI</span>
              <h1 class="h2 page-title">Koleksi Pilihan Sesuai Minat Anda</h1>
              <p class="text-muted mb-0">Daftar lot lelang eksklusif yang dipersonalisasi khusus berdasarkan preferensi kategori dan aktivitas Anda di SiLelo.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Rekomendasi</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <?php
                  $id_user = $this->session->userdata('id');
                  $kategori = [];
                  if (!empty($id_user)) {
                    $kategori = $this->db->query("SELECT ar.*, ap.*, ak.nama_kategori, ak.url_kategori FROM abe_rekomendasi as ar, abe_produk as ap, abe_kategori as ak WHERE ar.bidder = '$id_user' AND ar.kategori = ap.id_kategori AND ar.kategori = ak.id_kategori AND ap.status = 'lelang' ORDER BY rand() LIMIT 12 ")->result();
                  }

                  // If user has not selected interests or not logged in, show popular active lots
                  if (empty($kategori)) {
                    $kategori = $this->db->query("SELECT ap.*, ak.nama_kategori, ak.url_kategori FROM abe_produk as ap JOIN abe_kategori as ak ON ap.id_kategori = ak.id_kategori WHERE ap.status = 'lelang' ORDER BY ap.id_produk DESC LIMIT 12")->result();
                  }

                  if (empty($kategori)) {
                ?>
                  <div class="col-12 text-center py-5">
                    <div class="card p-5 border-0 shadow-sm rounded-lg mx-auto" style="max-width: 500px;">
                      <i class="fa fa-folder-open-o text-muted mb-3" style="font-size: 3rem;"></i>
                      <h4 class="font-weight-bold">Belum Ada Rekomendasi Lot</h4>
                      <p class="text-muted small">Tentukan kategori minat Anda di halaman profil atau jelajahi katalog lot terbaru.</p>
                      <a href="<?= base_url('profile/rekomendasi') ?>" class="btn btn-warning mt-2"><i class="fa fa-star mr-1"></i> Atur Minat Kategori</a>
                    </div>
                  </div>
                <?php
                  } else {
                    foreach ($kategori as $row) {
                      $id_produk = $row->id_produk;
                      $foto = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$id_produk' LIMIT 1")->row_array();
                      $bids_count = $this->db->query("SELECT COUNT(*) as jml FROM abe_lelang_bidder WHERE id_barang = '$id_produk'")->row()->jml;
                      $foto_src = get_foto_produk(!empty($foto['file_foto']) ? $foto['file_foto'] : null);
                ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="auction-card h-100 d-flex flex-column">
                      <div class="auction-card-img-wrap">
                        <a href="<?= base_url('home/produk/').$row->url_kategori.'/'.$id_produk ?>">
                          <img class="auction-card-img" src="<?= $foto_src ?>" alt="<?= $row->nama_produk ?>">
                        </a>
                        <span class="badge-live-pulse"><span class="pulse-dot"></span> LIVE</span>
                        <span class="badge-category-chip"><?= $row->nama_kategori ?></span>
                      </div>
                      <div class="auction-card-body flex-grow-1">
                        <h4 class="auction-title">
                          <a href="<?= base_url('home/produk/').$row->url_kategori.'/'.$id_produk ?>"><?= $row->nama_produk ?></a>
                        </h4>
                        <div class="auction-price-box">
                          <span class="price-caption">Tawaran Saat Ini</span>
                          <div class="price-val">Rp <?= number_format($row->harga_produk, 0, ',', '.') ?></div>
                        </div>
                        <div class="auction-meta-bar d-flex justify-content-between align-items-center">
                          <span class="meta-bids"><i class="fa fa-users text-warning"></i> <?= $bids_count ?> Bids</span>
                          <span class="meta-time"><i class="fa fa-calendar-check-o text-muted"></i> <?= ($row->tgl_tutup && $row->tgl_tutup != '0000-00-00') ? date('d M Y', strtotime($row->tgl_tutup)) : 'Live' ?></span>
                        </div>
                      </div>
                      <div class="auction-card-footer">
                        <a href="<?= base_url('home/produk/').$row->url_kategori.'/'.$id_produk ?>" class="btn btn-block btn-bid-action">
                          <i class="fa fa-gavel mr-1"></i> Tawar Sekarang
                        </a>
                      </div>
                    </div>
                  </div>
                <?php
                    }
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

