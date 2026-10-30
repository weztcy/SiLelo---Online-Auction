<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Portal Administrator | SiLelo Premier Auction</title>
  <link rel="shortcut icon" href="<?= base_url('assets/front_end/img/favicon.ico') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/back_end/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/front_end/vendor/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@700;800&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
    }
    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
    }
    body {
      background: radial-gradient(circle at top center, #1e1b2e 0%, #090a12 70%, #040508 100%);
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      color: #f8fafc;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 16px;
    }
    .admin-box { width: 100%; max-width: 440px; box-sizing: border-box; }
    .brand-title { font-family: 'Cinzel', serif; font-size: 2.2rem; font-weight: 800; color: #fff; text-align: center; margin: 0; }
    .brand-title span { color: #f59e0b; }
    .admin-badge {
      display: inline-block;
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #fca5a5;
      font-size: 0.72rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      padding: 4px 12px;
      border-radius: 999px;
      margin-top: 8px;
    }
    .admin-card {
      background: rgba(26, 21, 38, 0.94);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.55), 0 0 0 1px rgba(239, 68, 68, 0.2);
      padding: 32px 28px;
      box-sizing: border-box;
      width: 100%;
    }
    .admin-card h2 { font-size: 1.3rem; font-weight: 800; color: #fff; margin: 0 0 6px 0; text-align: center; }
    .admin-card p.sub { color: #94a3b8; font-size: 0.85rem; text-align: center; margin-bottom: 22px; }
    .form-group { margin-bottom: 16px; width: 100%; box-sizing: border-box; }
    .form-group label { font-size: 0.75rem; font-weight: 700; color: #cbd5e1; text-transform: uppercase; margin-bottom: 6px; display: block; }
    .inp-grp { position: relative; width: 100%; box-sizing: border-box; }
    .inp-grp i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1rem; z-index: 3; pointer-events: none; }
    .form-inp {
      display: block; width: 100% !important; box-sizing: border-box !important;
      height: 44px; background: #0c0a14;
      border: 1px solid rgba(255, 255, 255, 0.14); border-radius: 8px;
      color: #fff; padding: 8px 14px 8px 40px; font-size: 0.9rem;
      transition: all 0.2s ease;
    }
    .form-inp:focus { outline: none; border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25); background: #130f1e; }
    .btn-submit {
      width: 100% !important; box-sizing: border-box !important; height: 46px; background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
      border: none; border-radius: 8px; color: #fff; font-size: 0.9rem; font-weight: 800;
      text-transform: uppercase; cursor: pointer; display: flex; align-items: center; justify-content: center;
      gap: 8px; box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3); margin-top: 20px;
    }
    .btn-submit:hover { background: linear-gradient(135deg, #f87171 0%, #dc2626 100%); color: #fff; }
    .demo-pill {
      background: rgba(15, 23, 42, 0.7);
      border: 1px dashed rgba(239, 68, 68, 0.35);
      border-radius: 8px;
      padding: 10px 12px;
      margin-top: 18px;
      font-size: 0.8rem;
      box-sizing: border-box;
    }
  </style>
</head>
<body>
  <div class="admin-box">
    <div style="text-align: center; margin-bottom: 22px;">
      <h1 class="brand-title">Si<span>Lelo</span></h1>
      <span class="admin-badge"><i class="fa fa-shield"></i> PORTAL ADMINISTRATOR</span>
    </div>

    <div class="admin-card">
      <h2>Masuk Administrator</h2>
      <p class="sub">Autentikasi tingkat lanjut staf manajemen lelang SiLelo.</p>

      <?php if ($this->session->flashdata('success')) { ?>
        <div style="background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.35); color:#6ee7b7; border-radius:8px; padding:10px 14px; margin-bottom:14px; font-size:0.85rem; text-align:center;">
          <?= $this->session->flashdata('success'); ?>
        </div>
      <?php } elseif ($this->session->flashdata('gagal')) { ?>
        <div style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.35); color:#fca5a5; border-radius:8px; padding:10px 14px; margin-bottom:14px; font-size:0.85rem; text-align:center;">
          <?= $this->session->flashdata('gagal'); ?>
        </div>
      <?php } ?>

      <form action="<?= base_url('dashboard/proses_login_admin') ?>" method="post">
        <div class="form-group">
          <label>Email Staf Administrator</label>
          <div class="inp-grp">
            <input type="email" name="email" class="form-inp" placeholder="admin@gmail.com" required autofocus>
            <i class="fa fa-shield"></i>
          </div>
        </div>

        <div class="form-group" style="margin-top:14px;">
          <label>Password Akses</label>
          <div class="inp-grp">
            <input type="password" name="password" class="form-inp" placeholder="Password administrator" required>
            <i class="fa fa-lock"></i>
          </div>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fa fa-key"></i> Autentikasi Masuk
        </button>
      </form>

      <div class="demo-pill">
        <div style="font-weight:700; color:#ef4444; margin-bottom:2px;"><i class="fa fa-lock"></i> Kredensial Administrator:</div>
        <div style="color:#cbd5e1; font-family:monospace; font-size:0.8rem;">Email: <strong>admin@gmail.com</strong> | Pass: <strong>admin</strong></div>
      </div>
    </div>

    <a href="<?= base_url() ?>" style="display:block; text-align:center; margin-top:18px; color:#94a3b8; font-size:0.825rem; text-decoration:none;">
      <i class="fa fa-arrow-left"></i> Kembali ke Beranda SiLelo
    </a>
  </div>
</body>
</html>
