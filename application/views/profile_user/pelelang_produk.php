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
              <span class="badge-premium-pill mb-2"><i class="fa fa-gavel mr-1"></i> PORTAL PELELANG</span>
              <h1 class="h2 page-title"><?= !empty($pelelang['nama_lengkap']) ? htmlspecialchars($pelelang['nama_lengkap']) : 'Koleksi Pelelang' ?></h1>
              <p class="text-muted mb-0">Daftar seluruh lot produk lelang aktif yang terkurasi dan sedang berlangsung.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Pelelang</a></li>
                <li class="breadcrumb-item active">Produk Aktif</li>
              </ul>
            </div>
          </div>
        </div>
      </div> 

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div id="customer-account" class="col-lg-8">
              <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-cubes text-warning mr-2"></i> Lot Lelang Sedang Berlangsung</h4>
                  <span class="badge badge-light border text-muted px-2 py-1 small">Live Catalog</span>
                </div>

                <div class="table-responsive">
                  <table class="table table-lux mb-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql_produk = "SELECT * FROM abe_produk WHERE id_pelelang = " . $this->db->escape($id) . " AND status = 'lelang' ORDER BY id_produk DESC";
                        $produk     = $this->db->query($sql_produk)->result();
                        $no = 1;
                        if(empty($produk)){
                      ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada lot lelang aktif saat ini.</td></tr>
                      <?php
                        }else{
                        foreach ($produk as $row) {
                          $id_kategori  = $row->id_kategori;
                          $prod_id      = $row->id_produk;
                          $kategori     = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kategori'")->row_array();
                          $foto         = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$prod_id'")->row_array();
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td>
                          <img src="<?= get_foto_produk(!empty($foto['file_foto']) ? $foto['file_foto'] : null) ?>" style="width: 50px; height: 40px; object-fit: cover; border-radius: 4px;">
                        </td>
                        <td><?= !empty($kategori['nama_kategori']) ? htmlspecialchars($kategori['nama_kategori']) : '-' ?></td>
                        <td>
                          <a href="<?= base_url('home/produk/').clean_url(!empty($kategori['nama_kategori']) ? $kategori['nama_kategori'] : 'produk').'/'.$prod_id ?>" class="font-weight-bold text-dark">
                            <?= htmlspecialchars($row->nama_produk) ?>
                          </a>
                        </td>
                        <td>
                          <span class="badge-status badge-status-success"><i class="fa fa-clock-o mr-1"></i> Live</span>
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
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/pelelang/').$id ?>"><i class="fa fa-user"></i> <span>Profil Pelelang</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item active">
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
