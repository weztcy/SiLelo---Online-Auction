      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-headphones mr-1"></i> PUSAT BANTUAN &amp; LAYANAN</span>
              <h1 class="h2 page-title">Hubungi Tim Layanan SiLelo</h1>
              <p class="text-muted mb-0">Tim customer service dan konsultan lelang kami siap membantu Anda 24 jam setiap hari.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Kontak Kami</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100 p-4 border-0 shadow-sm rounded-lg text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 56px; height: 56px; background: rgba(245, 158, 11, 0.12); color: #d97706; font-size: 1.4rem;">
                  <i class="fa fa-map-marker"></i>
                </div>
                <h5 class="font-weight-bold text-dark mb-2">Kantor Pusat SiLelo</h5>
                <p class="text-muted small mb-2">SiLelo Tower Level 18, Jl. Jend. Sudirman Kav. 28, Jakarta Selatan 12920</p>
                <span class="badge badge-light border text-muted px-2 py-1 small"><i class="fa fa-clock-o mr-1"></i> Senin &mdash; Jumat: 08:30 - 18:00 WIB</span>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100 p-4 border-0 shadow-sm rounded-lg text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 56px; height: 56px; background: rgba(16, 185, 129, 0.12); color: #10b981; font-size: 1.4rem;">
                  <i class="fa fa-phone"></i>
                </div>
                <h5 class="font-weight-bold text-dark mb-2">Hotline &amp; WhatsApp</h5>
                <p class="text-muted small mb-2">Konsultasi penawaran, proses deposit jaminan, dan bantuan teknis akun bidder.</p>
                <div class="mb-2">
                  <a href="tel:+622188997700" class="font-weight-bold text-dark text-decoration-none d-block">+62 (21) 8899-7700</a>
                  <a href="https://wa.me/6281234567890" target="_blank" class="text-success small font-weight-bold"><i class="fa fa-whatsapp mr-1"></i> +62 812-3456-7890</a>
                </div>
                <span class="badge badge-success-light text-success px-2 py-1 small"><i class="fa fa-circle text-success mr-1" style="font-size: 8px;"></i> Live Support 24/7</span>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100 p-4 border-0 shadow-sm rounded-lg text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 56px; height: 56px; background: rgba(59, 130, 246, 0.12); color: #3b82f6; font-size: 1.4rem;">
                  <i class="fa fa-envelope-o"></i>
                </div>
                <h5 class="font-weight-bold text-dark mb-2">Email &amp; Verifikasi</h5>
                <p class="text-muted small mb-2">Kemitraan pelelang, kurasi barang, pengaduan escrow, atau verifikasi invoice.</p>
                <div class="mb-2">
                  <a href="mailto:support@silelo.id" class="font-weight-bold text-primary text-decoration-none d-block">support@silelo.id</a>
                </div>
                <span class="badge badge-light border text-muted px-2 py-1 small"><i class="fa fa-reply mr-1"></i> Respon &lt; 1 Jam</span>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-9">
              <div class="card border-0 shadow-sm rounded-lg p-4 p-md-5 bg-white">
                <div class="text-center mb-4">
                  <span class="section-badge"><i class="fa fa-paper-plane mr-1"></i> KIRIM PESAN</span>
                  <h3 class="section-title mb-2">Formulir Pesan &amp; Konsultasi</h3>
                  <p class="text-muted small">Tuliskan pertanyaan seputar cara bidding, deposit jaminan, atau kemitraan lelang.</p>
                </div>

                <form onsubmit="alert('Terima kasih! Pesan Anda telah kami terima.'); return false;">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold small text-dark">Nama Lengkap</label>
                      <input type="text" class="form-control" placeholder="Nama Anda" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold small text-dark">Alamat Email</label>
                      <input type="email" class="form-control" placeholder="nama@email.com" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold small text-dark">Nomor WhatsApp</label>
                      <input type="tel" class="form-control" placeholder="08123456789" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="font-weight-bold small text-dark">Kategori Topik</label>
                      <select class="form-control">
                        <option value="bidding">Panduan Bidding &amp; Pemenang</option>
                        <option value="deposit">Deposit Jaminan &amp; Refund</option>
                        <option value="pelelang">Kemitraan Pelelang / Kurasi</option>
                        <option value="escrow">Rekening Escrow SiLelo</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="font-weight-bold small text-dark">Pesan Anda</label>
                    <textarea rows="4" class="form-control" placeholder="Tuliskan pertanyaan Anda..." required></textarea>
                  </div>
                  <div class="text-center mt-4">
                    <button type="submit" class="btn btn-hero-primary px-5 py-2 font-weight-bold shadow-sm">
                      <i class="fa fa-paper-plane mr-2"></i> Kirim Pesan
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>