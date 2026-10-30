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
  
  if($this->session->userdata('id') == ''){
    $id_user = 'kosong';
  }else{
    $id_user = $this->session->userdata('id');
  } 
?>

      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-trophy mr-1"></i> ARSIP LOT TERJUAL</span>
              <h1 class="h2 page-title"><?= !empty($pelelang['nama_lengkap']) ? htmlspecialchars($pelelang['nama_lengkap']) : 'Koleksi Pelelang' ?></h1>
              <p class="text-muted mb-0">Daftar produk lelang yang telah berhasil terjual dan dimenangkan oleh bidder terverifikasi.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Pelelang</a></li>
                <li class="breadcrumb-item active">Produk Terjual</li>
              </ul>
            </div>
          </div>
        </div>
      </div> 

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div id="customer-account" class="col-lg-8">
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
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-check-circle-o text-success mr-2"></i> Data Produk Terjual (Sold Out)</h4>
                  <span class="badge badge-light border text-muted px-2 py-1 small">Closed Auctions</span>
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
                        <th>Ulasan / Report</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql_produk = "SELECT * FROM abe_produk WHERE id_pelelang = " . $this->db->escape($id) . " AND status = 'sold out' ORDER BY id_produk DESC";
                        $produk     = $this->db->query($sql_produk)->result();
                        $no = 1;
                        if(empty($produk)){
                      ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada lot lelang yang terjual.</td></tr>
                      <?php
                        }else{
                        foreach ($produk as $row) {
                          $id_kategori  = $row->id_kategori;
                          $prod_id      = $row->id_produk;
                          $kategori     = $this->db->query("SELECT * FROM abe_kategori WHERE id_kategori = '$id_kategori'")->row_array();
                          $kat_nama     = !empty($kategori['nama_kategori']) ? $kategori['nama_kategori'] : '-';
                          $kat_url      = !empty($kategori['url_kategori']) ? $kategori['url_kategori'] : 'elektronik';
                          $foto         = $this->db->query("SELECT * FROM abe_foto_produk WHERE id_produk = '$prod_id' ORDER BY id_foto_produk DESC LIMIT 1")->row_array();
                          $foto_src     = get_foto_produk(!empty($foto['file_foto']) ? $foto['file_foto'] : null);
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td>
                          <img src='<?= $foto_src ?>' class="rounded shadow-xs" style="width: 60px; height: 48px; object-fit: cover;">
                        </td>
                        <td><span class="badge badge-light border text-muted px-2 py-1 small"><?= htmlspecialchars($kat_nama) ?></span></td>
                        <td>
                          <a href="<?= base_url('home/produk/').clean_url($kat_url).'/'.$row->id_produk ?>" class="font-weight-bold text-dark text-decoration-none">
                            <?= htmlspecialchars($row->nama_produk) ?>
                          </a>
                        </td>
                        <td><span class="badge-status badge-status-danger"><i class="fa fa-check mr-1"></i> Terjual</span></td>
                        <td>
                          <?php
                            $status = $this->db->query("SELECT * FROM abe_lelang_bidder WHERE id_barang = '$prod_id' AND id_bidder = '$id_user' AND status = 'pemenang'")->num_rows();
                            if($status == '0'){
                          ?>
                            <button title="Hanya pemenang yang dapat memberikan ulasan" disabled class="btn btn-xs btn-light text-muted border">
                              <i class="fa fa-lock mr-1"></i> Khusus Pemenang
                            </button>
                          <?php
                            }else{
                          ?>
                            <button title="Beri Ulasan Produk" class="btn btn-xs btn-outline-warning font-weight-bold" onclick="review('<?= $prod_id ?>','<?= $id_kategori ?>')">
                              <i class="fa fa-star mr-1"></i> Beri Ulasan
                            </button>
                          <?php
                            }
                          ?>
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
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/pelelang_produk/').$id ?>"><i class="fa fa-cubes"></i> <span>Produk Aktif</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item active">
                    <a href="<?= base_url('profile/pelelang_produk_laku/').$id ?>"><i class="fa fa-check-circle"></i> <span>Produk Terjual</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">

  function review(produk, kategori)
  {
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#review-modal').modal('show'); // show bootstrap modal
      $('[name="id_produk"]').val(produk);
      $('[name="id_kategori"]').val(kategori);
  }

</script>

      <div id="review-modal" tabindex="-1" role="dialog" class="modal fade modal-lux">
        <div role="document" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-star text-warning mr-2"></i> Berikan Ulasan Pemenang Lot</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close text-white"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4">
              <form id="form" action="<?= base_url('profile/report') ?>" method="post">
                <input type="hidden" name="id_produk" id="id_produk">
                <input type="hidden" name="id_kategori" id="id_kategori">
                <input type="hidden" name="id_pelelang" id="id_pelelang" value="<?= $id ?>">

                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Tingkat Kepuasan Anda</label>
                  <select class="form-control" name="kepuasan" required>
                    <option value="">-- Pilih Penilaian --</option>
                    <option value="puas">⭐⭐⭐⭐⭐ Sangat Puas</option>
                    <option value="suka">⭐⭐⭐⭐ Suka &amp; Sesuai</option>
                    <option value="kecewa">⭐⭐ Kecewa</option>
                  </select>
                </div>
                <div class="form-group mb-4">
                  <label class="font-weight-bold small text-dark">Ulasan &amp; Testimoni</label>
                  <textarea name="review" rows="3" class="form-control" placeholder="Tuliskan pengalaman bertransaksi dengan pelelang ini..." required></textarea>
                </div>
                <button type="submit" class="btn btn-hero-primary btn-block py-2 font-weight-bold shadow-sm">
                  <i class="fa fa-paper-plane mr-1"></i> Kirim Ulasan
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
