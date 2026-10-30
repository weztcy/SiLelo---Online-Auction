<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Portal Mitra Pelelang | SiLelo Premier Auction</title>
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
      background: radial-gradient(circle at top center, #151d30 0%, #090d16 70%, #05070c 100%);
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      color: #f8fafc;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 16px;
    }
    .portal-box {
      width: 100%;
      max-width: 440px;
      box-sizing: border-box;
    }
    .portal-brand {
      text-align: center;
      margin-bottom: 24px;
    }
    .brand-title {
      font-family: 'Cinzel', serif;
      font-size: 2.2rem;
      font-weight: 800;
      color: #ffffff;
      margin: 0;
      letter-spacing: 0.04em;
    }
    .brand-title span {
      color: #f59e0b;
    }
    .portal-badge {
      display: inline-block;
      background: rgba(245, 158, 11, 0.12);
      border: 1px solid rgba(245, 158, 11, 0.3);
      color: #f59e0b;
      font-size: 0.72rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      padding: 4px 12px;
      border-radius: 999px;
      margin-top: 8px;
    }
    .portal-card {
      background: rgba(21, 28, 44, 0.94);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 16px;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.55), 0 0 0 1px rgba(245, 158, 11, 0.12);
      padding: 32px 28px;
      box-sizing: border-box;
      width: 100%;
    }
    .portal-card h2 {
      font-size: 1.3rem;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 6px 0;
      text-align: center;
    }
    .portal-card p.subtitle {
      color: #94a3b8;
      font-size: 0.85rem;
      text-align: center;
      margin: 0 0 22px 0;
    }
    .form-group {
      margin-bottom: 16px;
      width: 100%;
      box-sizing: border-box;
    }
    .form-group label {
      font-size: 0.75rem;
      font-weight: 700;
      color: #cbd5e1;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      margin-bottom: 6px;
      display: block;
    }
    .inp-grp {
      position: relative;
      width: 100%;
      box-sizing: border-box;
    }
    .inp-grp i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 1rem;
      z-index: 3;
      pointer-events: none;
    }
    .form-inp {
      display: block;
      width: 100% !important;
      box-sizing: border-box !important;
      height: 44px;
      background: #090e17;
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: 8px;
      color: #ffffff;
      padding: 8px 14px 8px 40px;
      font-size: 0.9rem;
      transition: all 0.2s ease;
    }
    .form-inp:focus {
      outline: none;
      border-color: #f59e0b;
      box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.25);
      background: #0c121e;
      color: #ffffff;
    }
    .form-inp::placeholder {
      color: #64748b;
    }
    .btn-submit {
      width: 100% !important;
      box-sizing: border-box !important;
      height: 46px;
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      border: none;
      border-radius: 8px;
      color: #0f172a;
      font-size: 0.9rem;
      font-weight: 800;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
      transition: all 0.2s;
      margin-top: 20px;
    }
    .btn-submit:hover {
      background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
      color: #0f172a;
    }
    .demo-pill {
      background: rgba(15, 23, 42, 0.7);
      border: 1px dashed rgba(245, 158, 11, 0.35);
      border-radius: 8px;
      padding: 10px 12px;
      margin-top: 18px;
      font-size: 0.8rem;
      box-sizing: border-box;
    }
    .links-bar {
      margin-top: 20px;
      padding-top: 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      text-align: center;
      font-size: 0.825rem;
      color: #94a3b8;
    }
    .links-bar a {
      color: #f59e0b;
      text-decoration: none;
      font-weight: 700;
    }
    .links-bar a:hover {
      text-decoration: underline;
    }
    .back-home {
      display: block;
      text-align: center;
      margin-top: 18px;
      color: #94a3b8;
      font-size: 0.825rem;
      text-decoration: none !important;
    }
    .back-home:hover {
      color: #ffffff;
    }
    .alert-msg {
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 0.85rem;
      margin-bottom: 16px;
      text-align: center;
      box-sizing: border-box;
    }
    .alert-msg-danger {
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #fca5a5;
    }
    .alert-msg-success {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.35);
      color: #6ee7b7;
    }
  </style>
</head>
<body>
  <div class="portal-box">
    <div class="portal-brand">
      <h1 class="brand-title">Si<span>Lelo</span></h1>
      <span class="portal-badge"><i class="fa fa-gavel"></i> PORTAL MITRA PELELANG</span>
    </div>

    <div class="portal-card">
      <h2>Masuk ke Dashboard</h2>
      <p class="subtitle">Kelola lot lelang terkurasi &amp; pantau penawaran real-time.</p>

      <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert-msg alert-msg-success"><i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success'); ?></div>
      <?php } elseif ($this->session->flashdata('gagal')) { ?>
        <div class="alert-msg alert-msg-danger"><i class="fa fa-exclamation-triangle"></i> <?= $this->session->flashdata('gagal'); ?></div>
      <?php } ?>

      <form action="<?= base_url('dashboard/proses_login') ?>" method="post">
        <div class="form-group">
          <label>Email Pelelang</label>
          <div class="inp-grp">
            <input type="email" name="email" class="form-inp" placeholder="pelelang@gmail.com" required autofocus>
            <i class="fa fa-envelope"></i>
          </div>
        </div>

        <div class="form-group" style="margin-top: 14px;">
          <div style="display:flex; justify-content:space-between; align-items:center;">
            <label style="margin:0;">Password</label>
            <a href="<?= base_url('dashboard/forgot') ?>" style="font-size:0.75rem; color:#f59e0b; text-decoration:none;">Lupa Password?</a>
          </div>
          <div class="inp-grp" style="margin-top:6px;">
            <input type="password" name="password" class="form-inp" placeholder="Password akun Anda" required>
            <i class="fa fa-lock"></i>
          </div>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fa fa-sign-in"></i> Masuk Sekarang
        </button>
      </form>

      <div class="demo-pill">
        <div style="font-weight:700; color:#f59e0b; margin-bottom:2px;"><i class="fa fa-info-circle"></i> Akun Demo Mitra Pelelang:</div>
        <div style="color:#cbd5e1; font-family:monospace; font-size:0.8rem;">Email: <strong>pelelang@gmail.com</strong> | Pass: <strong>pelelang</strong></div>
      </div>

      <div class="links-bar">
        Belum jadi mitra resmi? <a href="<?= base_url('dashboard/daftar') ?>">Daftar Mitra Baru</a>
      </div>
    </div>

    <a href="<?= base_url() ?>" class="back-home"><i class="fa fa-arrow-left"></i> Kembali ke Beranda SiLelo</a>
  </div>
</body>
</html>
