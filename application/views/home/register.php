
      <div id="heading-breadcrumbs" class="border-bottom">
        <div class="container">
          <div class="row d-flex align-items-center flex-wrap">
            <div class="col-md-7">
              <span class="badge-premium-pill mb-2"><i class="fa fa-user-circle mr-1"></i> AUTENTIKASI BIDDER</span>
              <h1 class="h2 page-title">Masuk Akun Bidder SiLelo</h1>
              <p class="text-muted mb-0">Masuk untuk mulai menawar lot impian dan kelola invoice lelang Anda.</p>
            </div>
            <div class="col-md-5">
              <ul class="breadcrumb d-flex justify-content-md-end mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active">Masuk / Daftar</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div id="content" class="py-5 bg-surface-alt">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
              <div class="card border-0 shadow-sm rounded-lg p-4 p-md-5 bg-white">
                <div class="text-center mb-4">
                  <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 56px; height: 56px; background: rgba(245, 158, 11, 0.12); color: #d97706; font-size: 1.5rem;">
                    <i class="fa fa-gavel"></i>
                  </div>
                  <h3 class="font-weight-bold text-dark mb-1">Selamat Datang</h3>
                  <p class="text-muted small">Silakan masuk dengan akun SiLelo atau Google Anda</p>
                </div>
                <?php if($this->session->flashdata('success')){ ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle mr-1"></i> <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                <?php }elseif($this->session->flashdata('gagal')){?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle mr-1"></i> <?= $this->session->flashdata('gagal'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                <?php } ?>

                <?php if(!empty($loginURL)){ ?>
                  <div class="mb-4">
                    <a href="<?= $loginURL ?>" class="btn btn-outline-dark btn-block d-flex align-items-center justify-content-center py-2 text-decoration-none shadow-xs font-weight-bold" style="border-color: #e2e8f0; font-size: 0.92rem; border-radius: 8px;">
                      <i class="fa fa-google text-danger mr-2"></i> Masuk dengan Google
                    </a>
                  </div>
                  <div class="d-flex align-items-center mb-4">
                    <hr class="flex-grow-1 border-light">
                    <span class="mx-3 text-muted small text-uppercase font-weight-bold" style="font-size: 0.75rem;">Atau dengan Email</span>
                    <hr class="flex-grow-1 border-light">
                  </div>
                <?php } ?>

                <form action="<?= base_url('home/login') ?>" method="post">
                  <div class="form-group mb-3">
                    <label for="email" class="font-weight-bold small text-dark">Alamat Email</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0 text-muted"><i class="fa fa-envelope-o"></i></span>
                      </div>
                      <input id="email" name="email" type="email" class="form-control border-left-0" placeholder="nama@email.com" required>
                    </div>
                  </div>

                  <div class="form-group mb-4">
                    <label for="password" class="font-weight-bold small text-dark mb-1">Kata Sandi</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0 text-muted"><i class="fa fa-lock"></i></span>
                      </div>
                      <input id="password" name="password" type="password" class="form-control border-left-0" placeholder="••••••••" required>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-hero-primary btn-block py-2 font-weight-bold shadow-sm">
                    <i class="fa fa-sign-in mr-2"></i> Masuk Sekarang
                  </button>
                </form>

                <div class="text-center mt-4 pt-3 border-top">
                  <p class="text-muted small mb-1">Ingin mendaftar sebagai pelelang resmi?</p>
                  <a href="<?= base_url('pelelang') ?>" class="text-warning font-weight-bold small"><i class="fa fa-external-link mr-1"></i> Buka Portal Pelelang SiLelo</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>