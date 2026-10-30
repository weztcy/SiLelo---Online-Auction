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
  $sql_user = "SELECT * FROM users WHERE id = '$id'";
  $bidder   = $this->db->query($sql_user)->row_array();
  $kelamin  = !empty($bidder['gender']) ? $bidder['gender'] : '';

  $sql_deposit = "SELECT * FROM abe_deposit WHERE id_user = '$id' AND status = 'oke'";
  $deposit_row = $this->db->query($sql_deposit)->row_array();
  $jumlah = !empty($deposit_row['jumlah']) ? $deposit_row['jumlah'] : 0;
?>

      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-user-circle mr-1"></i> DASHBOARD BIDDER</span>
              <h1 class="h2 page-title">Profil &amp; Informasi Akun</h1>
              <p class="text-muted mb-0">Kelola informasi pribadi, data pengiriman lot pemenang, dan saldo deposit jaminan lelang.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Akun Saya</li>
              </ul>
            </div>
          </div>
        </div>
      </div> 

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row">
            <div id="customer-account" class="col-lg-8">
              <div class="card border-0 shadow-sm rounded-lg p-4 bg-white mb-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-id-card-o text-warning mr-2"></i> Data Pribadi</h4>
                  <span class="badge badge-light border text-muted px-2 py-1 small">ID Bidder: #<?= str_pad($id, 4, '0', STR_PAD_LEFT) ?></span>
                </div>

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
                <form action="<?= base_url('profile/update') ?>" method="post">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="firstname" class="font-weight-bold small text-dark">Nama Depan</label>
                      <input id="firstname" name="firstname" value="<?= !empty($bidder['first_name']) ? $bidder['first_name'] : '' ?>" required type="text" class="form-control" placeholder="Nama Depan">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lastname" class="font-weight-bold small text-dark">Nama Belakang</label>
                      <input id="lastname" name="lastname" value="<?= !empty($bidder['last_name']) ? $bidder['last_name'] : '' ?>" required type="text" class="form-control" placeholder="Nama Belakang">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="email" class="font-weight-bold small text-dark">Alamat Email (Akun)</label>
                      <input id="email" type="text" name="email" value="<?= !empty($bidder['email']) ? $bidder['email'] : '' ?>" readonly class="form-control bg-light">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="gender" class="font-weight-bold small text-dark">Jenis Kelamin</label>
                      <select class="form-control" name="gender" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="laki-laki" <?= ($kelamin == 'laki-laki') ? 'selected' : '' ?>>Laki - Laki</option>
                        <option value="perempuan" <?= ($kelamin == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat" class="font-weight-bold small text-dark">Alamat Lengkap Pengiriman</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Nama jalan, gedung, no rumah, RT/RW, kota, kode pos"><?= !empty($bidder['alamat']) ? $bidder['alamat'] : '' ?></textarea>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="telephone" class="font-weight-bold small text-dark">Nomor Handphone / WhatsApp</label>
                      <input id="telephone" name="telephone" value="<?= !empty($bidder['telephone']) ? $bidder['telephone'] : '' ?>" required type="tel" class="form-control" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password" class="font-weight-bold small text-dark">Kata Sandi Baru <span class="text-muted font-weight-normal">(Opsional)</span></label>
                      <input id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah" type="password" class="form-control">
                    </div>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-hero-primary px-4 py-2 font-weight-bold shadow-sm">
                      <i class="fa fa-save mr-1"></i> Simpan Perubahan Profil
                    </button>
                  </div>
                </form>
              </div>
              <div class="card border-0 shadow-sm rounded-lg p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                  <h4 class="font-weight-bold text-dark mb-0"><i class="fa fa-history text-warning mr-2"></i> Riwayat Deposit Jaminan</h4>
                  <button type="button" class="btn btn-sm btn-outline-warning font-weight-bold" data-toggle="modal" data-target="#deposit-modal">
                    <i class="fa fa-plus mr-1"></i> Top Up Saldo
                  </button>
                </div>
                <div class="table-responsive">
                  <table class="table table-lux mb-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>Jumlah Deposit</th>
                        <th>Status Verifikasi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $id_user = $this->session->userdata['id'];
                        $sql_deposit = "SELECT * FROM abe_deposit WHERE id_user = '$id_user' ORDER BY id_deposit DESC";
                        $deposit = $this->db->query($sql_deposit)->result();
                        $deposit2 = $this->db->query($sql_deposit)->num_rows();
                        $sql_payment = "SELECT * FROM abe_invoice WHERE id_user = '$id_user' AND status = 'belum bayar'";
                        $payment = $this->db->query($sql_payment)->num_rows();
                        $no = 1;
                        if($deposit2 == 0){
                      ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada catatan transaksi deposit.</td></tr>
                      <?php
                        }else{
                        foreach ($deposit as $row) {
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= date('d M Y, H:i', strtotime($row->tgl_deposit)) ?> WIB</td>
                        <td class="font-weight-bold text-dark">Rp <?= number_format($row->jumlah,0,',','.') ?></td>
                        <td>
                          <?php if($row->status == 'oke'){ ?>
                            <span class="badge-status badge-status-success"><i class="fa fa-check-circle mr-1"></i> Terverifikasi</span>
                          <?php } else { ?>
                            <span class="badge-status badge-status-warning"><i class="fa fa-clock-o mr-1"></i> Menunggu Verifikasi</span>
                          <?php } ?>
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
                      <button type="button" class="btn btn-xs btn-warning font-weight-bold px-2 py-1" data-toggle="modal" data-target="#deposit-modal">
                        <i class="fa fa-plus"></i> Top Up
                      </button>
                    </div>
                  </div>
                </div>

                <ul class="customer-nav-list">
                  <li class="customer-nav-item active">
                    <a href="<?= base_url('profile') ?>"><i class="fa fa-user"></i> <span>Akun &amp; Profil</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item">
                    <a href="<?= base_url('profile/rekomendasi') ?>"><i class="fa fa-star"></i> <span>Minat Kategori</span> <i class="fa fa-angle-right ml-auto"></i></a>
                  </li>
                  <li class="customer-nav-item">
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

      <!-- DEPOSIT MODAL -->
      <div id="deposit-modal" tabindex="-1" role="dialog" class="modal fade modal-lux">
        <div role="document" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-shield text-warning mr-2"></i> Top Up Saldo Deposit Jaminan</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close text-white"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4">
              <div class="alert alert-warning small mb-4">
                <i class="fa fa-info-circle mr-1"></i> Saldo deposit adalah tiket jaminan untuk bidding. Saldo ini <strong>dapat di-refund 100%</strong> jika Anda tidak memenangkan lelang.
              </div>
              <form action="<?= base_url('profile/deposit') ?>" enctype="multipart/form-data" method="post">
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Pilih Rekening Tujuan SiLelo</label>
                  <select class="form-control" name="bank_penerima" required>
                    <option value="BCA - 8820912345 (PT SiLelo Lelang Indonesia)">BCA - 8820-912345 (PT SiLelo Lelang Indonesia)</option>
                    <option value="Mandiri - 137001889922 (PT SiLelo Lelang Indonesia)">Mandiri - 137-00-1889922 (PT SiLelo Lelang Indonesia)</option>
                    <option value="BNI - 0987654321 (PT SiLelo Lelang Indonesia)">BNI - 098-765-4321 (PT SiLelo Lelang Indonesia)</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Jumlah Transfer (Rp)</label>
                  <input type="number" name="jumlah" min="500000" step="50000" required placeholder="Contoh: 1000000" class="form-control">
                  <small class="text-muted">Minimal transfer Rp 500.000</small>
                </div>
                <div class="form-row mb-3">
                  <div class="col-6">
                    <label class="font-weight-bold small text-dark">Bank Anda</label>
                    <input type="text" name="bank_pengirim" required placeholder="Contoh: BCA" class="form-control">
                  </div>
                  <div class="col-6">
                    <label class="font-weight-bold small text-dark">Atas Nama Rekening</label>
                    <input type="text" name="nama_pengirim" required placeholder="Nama di Rekening" class="form-control">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Nomor Rekening Pengirim</label>
                  <input type="number" name="nomor_rekening" required placeholder="Nomor Rekening" class="form-control">
                </div>
                <div class="form-group mb-3">
                  <label class="font-weight-bold small text-dark">Bukti Transfer (JPG / PNG)</label>
                  <input type="file" id="file" name="file_foto" onchange="return validasiFile()" required class="form-control-file border p-2 rounded w-100">
                </div>
                <div class="form-group mb-4">
                  <label class="font-weight-bold small text-dark">Catatan Tambahan (Opsional)</label>
                  <textarea name="catatan" rows="2" class="form-control" placeholder="Catatan transaksi bila ada"></textarea>
                </div>
                <button type="submit" class="btn btn-hero-primary btn-block py-2 font-weight-bold shadow-sm">
                  <i class="fa fa-paper-plane mr-1"></i> Konfirmasi Transfer Deposit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>