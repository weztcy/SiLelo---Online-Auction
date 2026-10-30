  <script>
      function validasiFile(){
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var file_size = $('#file')[0].files[0].size;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
        if(!ekstensiOk.exec(pathFile)){
            alert('Mohon maaf, file yang diperbolehkan untuk upload berformat .JPG / .JPEG / .PNG');
            inputFile.value = '';
            return false;
        }else if(file_size > 2000000){
            alert('Mohon maaf, file yang diperbolehkan untuk upload maksimal 2 Mb');
            inputFile.value = '';
            return false;
        }
      }
  </script>

<?php
  $id       = $this->session->userdata('id');
  $sql_user = "SELECT * FROM users WHERE id = " . $this->db->escape($id);
  $bidder   = $this->db->query($sql_user)->row_array();

  $sql_deposit = "SELECT * FROM abe_deposit WHERE id_user = " . $this->db->escape($id) . " AND status = 'oke'";
  $deposit_row = $this->db->query($sql_deposit)->row_array();
  $jumlah = !empty($deposit_row['jumlah']) ? (float)$deposit_row['jumlah'] : 0;

  // Resolve product ID for invoice
  $produk_id = $this->uri->segment(3);
  if(empty($produk_id)){
    // Check latest invoice of this user
    $user_inv = $this->db->query("SELECT id_produk FROM abe_invoice WHERE id_user = " . $this->db->escape($id) . " ORDER BY id_invoice DESC LIMIT 1")->row_array();
    if(!empty($user_inv['id_produk'])){
      $produk_id = $user_inv['id_produk'];
    } else {
      // Fallback to any latest invoice in system
      $any_inv = $this->db->query("SELECT id_produk FROM abe_invoice ORDER BY id_invoice DESC LIMIT 1")->row_array();
      $produk_id = !empty($any_inv['id_produk']) ? $any_inv['id_produk'] : null;
    }
  }

  $invoice = null;
  $produk  = null;
  if(!empty($produk_id)){
    $sql1 = "SELECT * FROM abe_invoice WHERE id_produk = " . $this->db->escape($produk_id) . " LIMIT 1";
    $sql2 = "SELECT ai.*, ap.*, afp.file_foto FROM abe_invoice as ai JOIN abe_produk as ap ON ai.id_produk = ap.id_produk LEFT JOIN abe_foto_produk as afp ON ap.id_produk = afp.id_produk WHERE ai.id_produk = " . $this->db->escape($produk_id) . " LIMIT 1";
    $invoice = $this->db->query($sql1)->row_array();
    $produk  = $this->db->query($sql2)->row_array();
  }

  $has_invoice = !empty($invoice);

  $sql_payment = "SELECT * FROM abe_invoice WHERE id_user = " . $this->db->escape($id) . " AND status = 'belum bayar'";
  $payment = $this->db->query($sql_payment)->num_rows();

  $nama       = !empty($produk['nama_produk']) ? $produk['nama_produk'] : 'Produk Lelang';
  $harga      = !empty($invoice['harga_produk']) ? (float)$invoice['harga_produk'] : 0;
  $kode       = !empty($invoice['kode_unik']) ? (int)$invoice['kode_unik'] : 0;
  $deposito   = !empty($invoice['deposit']) ? (float)$invoice['deposit'] : 0;
  $ppn        = ($harga * 10) / 100;
  $all_total  = max(0, $harga + $kode + $ppn - $deposito);
  $no_invoice = !empty($invoice['no_invoice']) ? $invoice['no_invoice'] : 'INV-PRO-001';
  $inv_status = !empty($invoice['status']) ? strtolower($invoice['status']) : 'belum bayar';
?>
      
      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-file-text-o mr-1"></i> FAKTUR RESMI PEMENANG</span>
              <h1 class="h2 page-title">Detail Invoice Lot Lelang</h1>
              <p class="text-muted mb-0">Rincian pelunasan pemenang lelang, pemotongan deposit saldo, dan rekening pembayaran escrow.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('profile/payment') ?>">Tagihan</a></li>
                <li class="breadcrumb-item active">Invoice</li>
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

              <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
                <?php if(!$has_invoice){ ?>
                  <div class="text-center py-5">
                    <div class="mb-3 text-warning"><i class="fa fa-file-text-o fa-4x"></i></div>
                    <h4 class="font-weight-bold text-dark">Invoice Tidak Ditemukan</h4>
                    <p class="text-muted">Tidak ada data invoice lelang yang dipilih atau tagihan belum diterbitkan.</p>
                    <a href="<?= base_url('profile/payment') ?>" class="btn btn-hero-primary px-4 font-weight-bold">
                      <i class="fa fa-arrow-left mr-1"></i> Kembali ke Tagihan Saya
                    </a>
                  </div>
                <?php } else { ?>
                  <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <div>
                      <span class="badge badge-warning text-dark font-weight-bold px-2 py-1 mb-1 d-inline-block">INVOICE RESMI</span>
                      <h4 class="font-weight-bold text-dark mb-0">#<?= htmlspecialchars($no_invoice) ?></h4>
                    </div>
                    <div>
                      <a href="<?= base_url('profile/payment') ?>" class="btn btn-sm btn-outline-dark mr-2"><i class="fa fa-arrow-left mr-1"></i> Kembali</a>
                      <?php if($inv_status == 'lunas'){ ?>
                        <span class="badge-status badge-status-success"><i class="fa fa-check-circle mr-1"></i> LUNAS</span>
                      <?php } elseif($inv_status == 'transfer'){ ?>
                        <span class="badge-status badge-status-info"><i class="fa fa-hourglass-half mr-1"></i> MENUNGGU VERIFIKASI</span>
                      <?php } else { ?>
                        <span class="badge-status badge-status-warning"><i class="fa fa-clock-o mr-1"></i> BELUM BAYAR</span>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="table-responsive mb-4">
                    <table class="table table-lux mb-0">
                      <thead>
                        <tr>
                          <th>Lot Produk</th>
                          <th>Qty</th>
                          <th>Harga Hammer</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <img src="<?= get_foto_produk(!empty($produk['file_foto']) ? $produk['file_foto'] : null) ?>" alt="<?= htmlspecialchars($nama) ?>" class="rounded shadow-xs mr-3" style="width: 60px; height: 50px; object-fit: cover;">
                              <div>
                                <span class="font-weight-bold text-dark d-block"><?= htmlspecialchars($nama) ?></span>
                                <small class="text-muted">Status: Pemenang Lelang Terkonfirmasi</small>
                              </div>
                            </div>
                          </td>
                          <td>1</td>
                          <td class="font-weight-bold">Rp <?= number_format($harga, 0, ',', '.') ?></td>
                          <td class="font-weight-bold">Rp <?= number_format($harga, 0, ',', '.') ?></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3" class="text-right text-muted font-weight-normal border-top">Subtotal Hammer Price:</th>
                          <th class="font-weight-bold border-top">Rp <?= number_format($harga, 0, ',', '.') ?></th>
                        </tr>
                        <tr>
                          <th colspan="3" class="text-right text-muted font-weight-normal">Kode Unik Verifikasi:</th>
                          <th class="font-weight-bold">+ Rp <?= number_format($kode, 0, ',', '.') ?></th>
                        </tr>
                        <tr>
                          <th colspan="3" class="text-right text-muted font-weight-normal">PPN 10%:</th>
                          <th class="font-weight-bold">+ Rp <?= number_format($ppn, 0, ',', '.') ?></th>
                        </tr>
                        <?php if($deposito > 0){ ?>
                          <tr>
                            <th colspan="3" class="text-right text-success font-weight-normal">Potongan Deposit:</th>
                            <th class="text-success font-weight-bold">- Rp <?= number_format($deposito, 0, ',', '.') ?></th>
                          </tr>
                        <?php } ?>
                        <tr class="bg-light">
                          <th colspan="3" class="text-right font-weight-bold text-dark" style="font-size: 1.05rem;">Total Tagihan Transfer:</th>
                          <th class="font-weight-bold text-warning" style="font-size: 1.2rem;">Rp <?= number_format($all_total, 0, ',', '.') ?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                  <div class="d-flex justify-content-end align-items-center pt-3 border-top mb-4">
                    <?php if($inv_status == 'lunas'){ ?>
                      <span class="btn btn-success px-4 py-2 font-weight-bold disabled"><i class="fa fa-check-circle mr-1"></i> Pembayaran Selesai (Lunas)</span>
                    <?php } elseif($inv_status == 'transfer'){ ?>
                      <span class="btn btn-info px-4 py-2 font-weight-bold disabled"><i class="fa fa-clock-o mr-1"></i> Bukti Transfer Sedang Diverifikasi Admin</span>
                    <?php } else { ?>
                      <?php if($deposito == 0 && $jumlah > 0){ ?>
                        <button type="button" data-toggle="modal" data-target="#deposit-modal" class="btn btn-outline-warning mr-2 px-3 py-2 font-weight-bold">
                          <i class="fa fa-shield mr-1"></i> Gunakan Saldo Deposit
                        </button>
                      <?php } ?>
                      <button type="button" data-toggle="modal" data-target="#invoice-modal" class="btn btn-hero-primary px-4 py-2 font-weight-bold shadow-sm">
                        <i class="fa fa-money mr-1"></i> Konfirmasi Transfer Pelunasan
                      </button>
                    <?php } ?>
                  </div>

                  <div class="row pt-3 border-top">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <h6 class="font-weight-bold text-dark text-uppercase small mb-2"><i class="fa fa-map-marker text-warning mr-1"></i> Alamat Pengiriman</h6>
                      <p class="small text-muted mb-0">
                        <strong><?= !empty($bidder['first_name']) ? htmlspecialchars($bidder['first_name'].' '.$bidder['last_name']) : 'Pembeli' ?></strong><br>
                        <?= !empty($bidder['alamat']) ? nl2br(htmlspecialchars($bidder['alamat'])) : 'Alamat pengiriman belum diisi di profil' ?><br>
                        Telp: <?= !empty($bidder['telephone']) ? htmlspecialchars($bidder['telephone']) : '-' ?>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <h6 class="font-weight-bold text-dark text-uppercase small mb-2"><i class="fa fa-shield text-success mr-1"></i> Jaminan Escrow Terlindungi</h6>
                      <p class="small text-muted mb-0">
                        Dana transfer Anda ditahan aman di rekening bersama SiLelo. Penjual baru menerima pembayaran setelah barang sampai dan Anda verifikasi.
                      </p>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            <!-- RIGHT COLUMN: Customer Sidebar -->
            <div class="col-lg-4 mt-4 mt-lg-0">
              <div class="customer-sidebar-card">
                <div class="customer-sidebar-header">
                  <div class="customer-sidebar-avatar">
                    <i class="fa fa-user"></i>
                  </div>
                  <h4 class="customer-sidebar-name"><?= !empty($bidder['first_name']) ? htmlspecialchars($bidder['first_name'].' '.$bidder['last_name']) : 'Bidder SiLelo' ?></h4>
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

      <?php if($has_invoice){ ?>
      <!-- INVOICE PAYMENT MODAL -->
      <div id="invoice-modal" tabindex="-1" role="dialog" class="modal fade modal-lux">
        <div role="document" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-money text-warning mr-2"></i> Konfirmasi Pembayaran Tagihan</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close text-white"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4">
              <div class="alert alert-info small mb-3">
                Transfer <strong>tepat Rp <?= number_format($all_total, 0, ',', '.') ?></strong> (termasuk 3 digit kode unik) ke rekening resmi SiLelo Escrow agar diverifikasi otomatis.
              </div>
              <form action="<?= base_url('profile/bayar_invoice') ?>" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id_invoice" value="<?= !empty($invoice['id_invoice']) ? $invoice['id_invoice'] : '' ?>">
                <input type="hidden" name="produk" value="<?= !empty($invoice['id_produk']) ? $invoice['id_produk'] : '' ?>">
                <input type="hidden" name="total" value="<?= $all_total ?>">
                <input type="hidden" name="ppn" value="<?= $ppn ?>">

                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Pilih Rekening Tujuan Transfer</label>
                  <select class="form-control" name="bank_penerima" required>
                    <option value="BCA - 8820912345 (PT SiLelo Lelang Indonesia)">BCA - 8820-912345 (PT SiLelo Lelang Indonesia)</option>
                    <option value="Mandiri - 137001889922 (PT SiLelo Lelang Indonesia)">Mandiri - 137-00-1889922 (PT SiLelo Lelang Indonesia)</option>
                    <option value="BNI - 0987654321 (PT SiLelo Lelang Indonesia)">BNI - 098-765-4321 (PT SiLelo Lelang Indonesia)</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Nominal Ditransfer (Rp)</label>
                  <input type="number" name="jumlah" value="<?= $all_total ?>" required class="form-control font-weight-bold bg-light">
                </div>
                <div class="form-row mb-3">
                  <div class="col-6">
                    <label class="font-weight-bold small text-dark">Bank Anda</label>
                    <input type="text" name="bank_pengirim" required placeholder="Contoh: BCA" class="form-control">
                  </div>
                  <div class="col-6">
                    <label class="font-weight-bold small text-dark">Atas Nama Rekening</label>
                    <input type="text" name="nama_pengirim" required placeholder="Nama Pengirim" class="form-control">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Nomor Rekening Anda</label>
                  <input type="number" name="nomor_rekening" required placeholder="Nomor rekening pengirim" class="form-control">
                </div>
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Bukti Struk Transfer (JPG/PNG)</label>
                  <input type="file" id="file" name="file_foto" onchange="return validasiFile()" required class="form-control-file border p-2 rounded w-100">
                </div>
                <div class="form-group mb-4">
                  <label class="font-weight-bold small text-dark">Catatan Tambahan (Opsional)</label>
                  <textarea name="catatan" rows="2" class="form-control" placeholder="Catatan transaksi"></textarea>
                </div>
                <button type="submit" class="btn btn-hero-primary btn-block py-2 font-weight-bold shadow-sm">
                  <i class="fa fa-check-circle mr-1"></i> Kirim Bukti Pembayaran
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- DEPOSIT USAGE MODAL -->
      <div id="deposit-modal" tabindex="-1" role="dialog" class="modal fade modal-lux">
        <div role="document" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-shield text-warning mr-2"></i> Potong Saldo Deposit Jaminan</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close text-white"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4">
              <?php
                $deposit_info = $this->db->query("SELECT * FROM abe_deposit WHERE id_user = " . $this->db->escape($id) . " AND status = 'oke'")->row_array();
                $dep_val = !empty($deposit_info['jumlah']) ? (float)$deposit_info['jumlah'] : 0;
                $sisa_val = max(0, $all_total - $dep_val);
              ?>
              <div class="alert alert-warning small mb-3">
                Saldo deposit jaminan Anda akan dipotong untuk melunasi tagihan ini. Setelah digunakan, Anda perlu melakukan top up deposit lagi sebelum dapat menawar di lelang berikutnya.
              </div>
              <form action="<?= base_url('profile/bayar_invoice_deposit') ?>" method="post">
                <input type="hidden" name="id_invoice" value="<?= !empty($invoice['id_invoice']) ? $invoice['id_invoice'] : '' ?>">
                <input type="hidden" name="produk" value="<?= !empty($invoice['id_produk']) ? $invoice['id_produk'] : '' ?>">
                <input type="hidden" name="id_deposit" value="<?= !empty($deposit_info['id_deposit']) ? $deposit_info['id_deposit'] : 0 ?>">
                <input type="hidden" name="tagihan" value="<?= $all_total ?>">
                <input type="hidden" name="ppn" value="<?= $ppn ?>">
                <input type="hidden" name="nilai_deposit" value="<?= $dep_val ?>">

                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Total Tagihan Saat Ini</label>
                  <input type="text" readonly class="form-control bg-light font-weight-bold" value="Rp <?= number_format($all_total, 0, ',', '.') ?>">
                </div>
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Saldo Deposit Anda</label>
                  <input type="text" readonly class="form-control bg-light text-success font-weight-bold" value="Rp <?= number_format($dep_val, 0, ',', '.') ?>">
                </div>
                <div class="form-group mb-4">
                  <label class="font-weight-bold small text-dark">Sisa Tagihan yang Harus Ditransfer</label>
                  <input type="text" name="sisa_bayar" readonly class="form-control bg-light text-warning font-weight-bold" value="Rp <?= number_format($sisa_val, 0, ',', '.') ?>">
                </div>
                <button type="submit" class="btn btn-hero-primary btn-block py-2 font-weight-bold shadow-sm">
                  <i class="fa fa-shield mr-1"></i> Konfirmasi Gunakan Saldo Deposit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
