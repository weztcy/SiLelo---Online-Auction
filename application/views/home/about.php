      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <h1 class="h2 page-title">Cara Kerja &amp; Panduan Lelang</h1>
              <p class="text-muted mb-0">Pelajari mekanisme bidding transparan, sistem deposit jaminan, dan perlindungan escrow SiLelo.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Cara Lelang</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="content" class="py-5">
        <div class="container">
          <!-- Intro Banner -->
          <div class="guide-hero-card mb-5 p-4 p-md-5">
            <div class="row align-items-center">
              <div class="col-lg-8">
                <span class="badge-premium-pill mb-2"><i class="fa fa-gavel"></i> PANDUAN RESMI SILELO</span>
                <h2 class="font-weight-bold text-white mb-3">Lelang Online Adil, Terbuka &amp; 100% Bebas Bot</h2>
                <p class="text-light mb-0">SiLelo dirancang untuk memberikan pengalaman lelang terbaik bagi kolektor dan pencari penawaran menarik di seluruh Indonesia. Semua peserta terverifikasi dengan saldo jaminan untuk mencegah bid palsu.</p>
              </div>
              <div class="col-lg-4 text-center mt-4 mt-lg-0">
                <a href="<?= base_url('home/register') ?>" class="btn btn-hero-primary"><i class="fa fa-user-plus mr-1"></i> Daftar Bidder Sekarang</a>
              </div>
            </div>
          </div>

          <!-- Step by Step -->
          <div class="row mb-5">
            <div class="col-lg-12">
              <div class="section-heading-wrap text-center mb-5">
                <span class="section-badge"><i class="fa fa-list-ol mr-1"></i> 4 TAHAP MUDAH</span>
                <h3 class="section-title">Langkah-Langkah Mengikuti Lelang</h3>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
              <div class="guide-step-box h-100">
                <div class="guide-num">1</div>
                <div class="guide-icon"><i class="fa fa-id-card"></i></div>
                <h5 class="guide-title">Registrasi Akun</h5>
                <p class="guide-desc">Daftarkan akun bidder Anda dengan melengkapi nama, email aktif, dan nomor WhatsApp. Akun Anda langsung aktif seketika.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
              <div class="guide-step-box h-100">
                <div class="guide-num">2</div>
                <div class="guide-icon"><i class="fa fa-money"></i></div>
                <h5 class="guide-title">Deposit Jaminan</h5>
                <p class="guide-desc">Setor dana deposit jaminan (mulai Rp 500.000) melalui rekening resmi SiLelo. Deposit ini menjadi tiket Anda untuk menawar seluruh lot lelang.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
              <div class="guide-step-box h-100">
                <div class="guide-num">3</div>
                <div class="guide-icon"><i class="fa fa-gavel"></i></div>
                <h5 class="guide-title">Bidding Real-Time</h5>
                <p class="guide-desc">Tawar lot impian Anda dengan kenaikan harga fleksibel. Pantau status penawaran Anda hingga waktu lelang ditutup.</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
              <div class="guide-step-box h-100">
                <div class="guide-num">4</div>
                <div class="guide-icon"><i class="fa fa-gift"></i></div>
                <h5 class="guide-title">Penyelesaian &amp; Kirim</h5>
                <p class="guide-desc">Jika Anda menang, lunasi sisa pembayaran via invoice. Deposit Anda otomatis memotong total tagihan. Lot dikirim aman sampai ke rumah Anda!</p>
              </div>
            </div>
          </div>

          <!-- FAQ Accordion -->
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="section-heading-wrap text-center mb-4">
                <span class="section-badge"><i class="fa fa-question-circle mr-1"></i> PERTANYAAN POPULER</span>
                <h3 class="section-title">Frequently Asked Questions (FAQ)</h3>
              </div>

              <div id="accordionGuide" class="custom-accordion">
                <div class="card mb-3 border">
                  <div class="card-header bg-white" id="faqOne">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapseOne" class="d-flex justify-content-between align-items-center text-dark font-weight-bold">
                        <span>Apakah saldo deposit bisa ditarik kembali jika saya kalah lelang?</span>
                        <i class="fa fa-chevron-down text-warning"></i>
                      </a>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse show" data-parent="#accordionGuide">
                    <div class="card-body text-muted">
                      Ya, 100% bisa! Saldo deposit jaminan adalah hak Anda. Jika Anda tidak memenangkan lelang atau memilih untuk tidak menawar lagi, Anda dapat mengajukan pencairan (withdraw) dana deposit kapan saja ke rekening bank pribadi Anda tanpa potongan.
                    </div>
                  </div>
                </div>

                <div class="card mb-3 border">
                  <div class="card-header bg-white" id="faqTwo">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapseTwo" class="collapsed d-flex justify-content-between align-items-center text-dark font-weight-bold">
                        <span>Bagaimana jika barang yang saya terima tidak sesuai deskripsi?</span>
                        <i class="fa fa-chevron-down text-warning"></i>
                      </a>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" data-parent="#accordionGuide">
                    <div class="card-body text-muted">
                      SiLelo menerapkan sistem Rekening Bersama (Escrow). Dana pelunasan Anda ditahan oleh tim SiLelo dan baru diteruskan ke pelelang setelah Anda menerima barang dan mengonfirmasi kesesuaian fisik dalam waktu 2x24 jam. Jika barang tidak sesuai, garansi uang kembali 100% berlaku.
                    </div>
                  </div>
                </div>

                <div class="card mb-3 border">
                  <div class="card-header bg-white" id="faqThree">
                    <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapseThree" class="collapsed d-flex justify-content-between align-items-center text-dark font-weight-bold">
                        <span>Bagaimana cara mendaftar sebagai Pelelang (Seller)?</span>
                        <i class="fa fa-chevron-down text-warning"></i>
                      </a>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" data-parent="#accordionGuide">
                    <div class="card-body text-muted">
                      Untuk mendaftar sebagai pelelang, buka menu <strong>Portal Pelelang</strong> di bagian atas situs atau kunjungi tautan <code>/pelelang</code>. Anda dapat mendaftarkan diri dengan verifikasi NIK KTP dan nomor telepon. Setelah diverifikasi oleh admin, Anda langsung bisa mendaftarkan produk lelang.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
