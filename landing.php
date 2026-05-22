<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduManage – Sistem Manajemen Sekolah Digital</title>
  <meta name="description" content="EduManage adalah sistem manajemen sekolah digital modern untuk Sekolah. Kelola data siswa, guru, nilai, absensi, dan jadwal dalam satu platform.">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #1565C0;
      --primary-dark: #0D47A1;
      --primary-light: #1976D2;
      --accent: #42A5F5;
      --accent-light: #90CAF9;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; background: #fff; color: #1A2340; overflow-x: hidden; }
    a { text-decoration: none; color: inherit; }

    /* ===== NAVBAR ===== */
    .navbar {
      position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 60px; height: 70px;
      background: rgba(13,71,161,0.92);
      backdrop-filter: blur(16px);
      box-shadow: 0 2px 20px rgba(0,0,0,0.18);
      transition: all 0.3s;
    }
    .navbar.scrolled { background: rgba(13,71,161,0.98); }
    .nav-brand { display: flex; align-items: center; gap: 12px; }
    .nav-brand .logo-icon {
      width: 40px; height: 40px; border-radius: 10px;
      background: linear-gradient(135deg, #fff, #90CAF9);
      display: flex; align-items: center; justify-content: center; font-size: 20px;
    }
    .nav-brand h1 { color: #fff; font-size: 20px; font-weight: 800; letter-spacing: -0.3px; }
    .nav-brand h1 span { color: #90CAF9; }
    .nav-links { display: flex; gap: 32px; }
    .nav-links a { color: rgba(255,255,255,0.8); font-size: 14px; font-weight: 500; transition: color 0.2s; }
    .nav-links a:hover { color: #fff; }
    .btn-login-nav {
      background: #fff; color: var(--primary); padding: 9px 24px;
      border-radius: 8px; font-size: 14px; font-weight: 700;
      transition: all 0.2s; box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .btn-login-nav:hover { background: #E3F0FF; transform: translateY(-1px); }

    /* ===== HERO ===== */
    .hero {
      min-height: 100vh;
      background: linear-gradient(135deg, #0D47A1 0%, #1565C0 50%, #0288D1 100%);
      display: flex; align-items: center; justify-content: center;
      position: relative; overflow: hidden; padding-top: 70px;
    }
    .hero-bg-circles { position: absolute; inset: 0; pointer-events: none; }
    .hero-bg-circles span {
      position: absolute; border-radius: 50%;
      background: rgba(255,255,255,0.05); animation: float 8s ease-in-out infinite;
    }
    .hero-bg-circles span:nth-child(1) { width: 500px; height: 500px; top: -150px; right: -100px; animation-delay: 0s; }
    .hero-bg-circles span:nth-child(2) { width: 300px; height: 300px; bottom: -80px; left: -60px; animation-delay: 2s; }
    .hero-bg-circles span:nth-child(3) { width: 200px; height: 200px; top: 40%; left: 30%; animation-delay: 4s; background: rgba(255,255,255,0.03); }
    @keyframes float {
      0%, 100% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-24px) scale(1.03); }
    }

    .hero-content { text-align: center; max-width: 820px; padding: 0 24px; position: relative; z-index: 5; }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.25); border-radius: 50px;
      padding: 8px 20px; margin-bottom: 28px; font-size: 13px; color: #fff; font-weight: 500;
      animation: fadeInDown 0.7s ease both;
    }
    .hero-badge .dot { width: 8px; height: 8px; border-radius: 50%; background: #4CAF50; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.6;transform:scale(1.4)} }

    .hero-content h1 {
      font-size: clamp(36px, 6vw, 72px); font-weight: 900; color: #fff;
      line-height: 1.1; letter-spacing: -1px; margin-bottom: 24px;
      animation: fadeInDown 0.8s ease 0.1s both;
    }
    .hero-content h1 span { color: #90CAF9; }
    .hero-content p {
      font-size: 18px; color: rgba(255,255,255,0.8); line-height: 1.7;
      margin-bottom: 40px; animation: fadeInDown 0.8s ease 0.2s both;
    }
    .hero-actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; animation: fadeInDown 0.8s ease 0.3s both; }
    .btn-hero-primary {
      background: #fff; color: var(--primary); padding: 15px 36px;
      border-radius: 12px; font-size: 16px; font-weight: 700;
      box-shadow: 0 8px 32px rgba(0,0,0,0.2); transition: all 0.25s;
    }
    .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,0.28); }
    .btn-hero-outline {
      background: transparent; color: #fff; padding: 15px 36px;
      border-radius: 12px; font-size: 16px; font-weight: 600;
      border: 2px solid rgba(255,255,255,0.4); transition: all 0.25s;
    }
    .btn-hero-outline:hover { background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.7); transform: translateY(-2px); }

    .hero-stats {
      display: flex; gap: 48px; justify-content: center; margin-top: 60px;
      animation: fadeInDown 0.8s ease 0.4s both;
    }
    .hero-stat { text-align: center; }
    .hero-stat .num { font-size: 36px; font-weight: 900; color: #fff; line-height: 1; }
    .hero-stat .lbl { font-size: 13px; color: rgba(255,255,255,0.65); margin-top: 4px; }

    .scroll-indicator {
      position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%);
      display: flex; flex-direction: column; align-items: center; gap: 8px; z-index: 5;
      animation: fadeIn 1s ease 1s both;
    }
    .scroll-indicator span { font-size: 12px; color: rgba(255,255,255,0.6); letter-spacing: 1px; }
    .scroll-arrow {
      width: 28px; height: 28px; border-right: 2px solid rgba(255,255,255,0.5);
      border-bottom: 2px solid rgba(255,255,255,0.5);
      transform: rotate(45deg); animation: bounce 1.5s infinite;
    }
    @keyframes bounce { 0%,100%{transform:rotate(45deg) translateY(0)} 50%{transform:rotate(45deg) translateY(8px)} }

    /* ===== SCROLL ANIMATIONS ===== */
    .reveal {
      opacity: 0; transform: translateY(48px); transition: opacity 0.7s ease, transform 0.7s ease;
    }
    .reveal.visible { opacity: 1; transform: translateY(0); }
    .reveal-left { opacity: 0; transform: translateX(-48px); transition: opacity 0.7s ease, transform 0.7s ease; }
    .reveal-left.visible { opacity: 1; transform: translateX(0); }
    .reveal-right { opacity: 0; transform: translateX(48px); transition: opacity 0.7s ease, transform 0.7s ease; }
    .reveal-right.visible { opacity: 1; transform: translateX(0); }

    /* ===== SECTION SHARED ===== */
    section { padding: 96px 60px; }
    .section-tag {
      display: inline-block; background: #E3F0FF; color: var(--primary);
      padding: 6px 16px; border-radius: 50px; font-size: 12px; font-weight: 700;
      letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px;
    }
    .section-title { font-size: clamp(28px, 4vw, 44px); font-weight: 900; color: #1A2340; line-height: 1.15; margin-bottom: 16px; }
    .section-sub { font-size: 16px; color: #6B7A99; line-height: 1.7; max-width: 560px; }
    .text-center { text-align: center; }
    .text-center .section-sub { margin: 0 auto; }

    /* ===== FEATURES ===== */
    .features { background: #F0F6FF; }
    .features-grid {
      display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 56px;
    }
    .feature-card {
      background: #fff; border-radius: 16px; padding: 32px 28px;
      border: 1.5px solid #D0E2FF; box-shadow: 0 4px 20px rgba(21,101,192,0.07);
      transition: all 0.3s;
    }
    .feature-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(21,101,192,0.15); border-color: var(--accent); }
    .feature-icon {
      width: 60px; height: 60px; border-radius: 16px; font-size: 28px;
      display: flex; align-items: center; justify-content: center; margin-bottom: 20px;
    }
    .fi-blue { background: linear-gradient(135deg, #E3F0FF, #BBDEFB); }
    .fi-green { background: linear-gradient(135deg, #E8F5E9, #C8E6C9); }
    .fi-orange { background: linear-gradient(135deg, #FFF3E0, #FFE0B2); }
    .fi-purple { background: linear-gradient(135deg, #F3E5F5, #E1BEE7); }
    .fi-teal { background: linear-gradient(135deg, #E0F7FA, #B2EBF2); }
    .fi-red { background: linear-gradient(135deg, #FFEBEE, #FFCDD2); }
    .feature-card h3 { font-size: 17px; font-weight: 700; margin-bottom: 10px; }
    .feature-card p { font-size: 14px; color: #6B7A99; line-height: 1.7; }

    /* ===== ROLES ===== */
    .roles { background: #fff; }
    .roles-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-top: 56px; }
    .role-card {
      border-radius: 20px; padding: 40px 32px; text-align: center;
      transition: all 0.3s; position: relative; overflow: hidden;
    }
    .role-card::before {
      content: ''; position: absolute; inset: 0; opacity: 0;
      transition: opacity 0.3s; background: rgba(255,255,255,0.1);
    }
    .role-card:hover::before { opacity: 1; }
    .role-card:hover { transform: translateY(-8px); }
    .rc-admin { background: linear-gradient(135deg, #0D47A1, #1976D2); color: #fff; box-shadow: 0 8px 32px rgba(13,71,161,0.3); }
    .rc-guru { background: linear-gradient(135deg, #01579B, #0288D1); color: #fff; box-shadow: 0 8px 32px rgba(2,136,209,0.3); }
    .rc-siswa { background: linear-gradient(135deg, #1B5E20, #43A047); color: #fff; box-shadow: 0 8px 32px rgba(67,160,71,0.3); }
    .role-card .role-emoji { font-size: 52px; margin-bottom: 20px; display: block; }
    .role-card h3 { font-size: 22px; font-weight: 800; margin-bottom: 12px; }
    .role-card p { font-size: 14px; opacity: 0.85; line-height: 1.7; margin-bottom: 24px; }
    .role-features { list-style: none; text-align: left; display: flex; flex-direction: column; gap: 8px; }
    .role-features li { display: flex; gap: 8px; font-size: 13px; opacity: 0.9; }
    .role-features li::before { content: '✓'; font-weight: 700; flex-shrink: 0; }

    /* ===== STATS SECTION ===== */
    .stats-section {
      background: linear-gradient(135deg, #0D47A1, #1565C0, #0288D1);
      padding: 80px 60px; text-align: center;
    }
    .stats-section h2 { color: #fff; font-size: 36px; font-weight: 900; margin-bottom: 12px; }
    .stats-section p { color: rgba(255,255,255,0.75); font-size: 16px; margin-bottom: 60px; }
    .stats-row { display: flex; justify-content: center; gap: 80px; flex-wrap: wrap; }
    .stat-item .number { font-size: 56px; font-weight: 900; color: #fff; line-height: 1; }
    .stat-item .unit { font-size: 28px; }
    .stat-item .desc { font-size: 14px; color: rgba(255,255,255,0.7); margin-top: 8px; }

    /* ===== CTA ===== */
    .cta-section { background: #F0F6FF; text-align: center; padding: 96px 60px; }
    .cta-box {
      background: linear-gradient(135deg, #0D47A1, #1565C0);
      border-radius: 24px; padding: 72px 60px; max-width: 820px; margin: 0 auto;
      position: relative; overflow: hidden; box-shadow: 0 20px 60px rgba(13,71,161,0.3);
    }
    .cta-box::before {
      content: ''; position: absolute; top: -80px; right: -80px;
      width: 300px; height: 300px; border-radius: 50%; background: rgba(255,255,255,0.06);
    }
    .cta-box h2 { font-size: 40px; font-weight: 900; color: #fff; margin-bottom: 16px; position: relative; }
    .cta-box p { color: rgba(255,255,255,0.8); font-size: 16px; margin-bottom: 36px; line-height: 1.7; position: relative; }
    .cta-btn {
      display: inline-flex; align-items: center; gap: 10px;
      background: #fff; color: var(--primary); padding: 16px 44px;
      border-radius: 12px; font-size: 17px; font-weight: 800;
      box-shadow: 0 8px 32px rgba(0,0,0,0.2); transition: all 0.25s; position: relative;
    }
    .cta-btn:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,0.28); }

    /* ===== FOOTER ===== */
    footer {
      background: #0D47A1; color: rgba(255,255,255,0.7);
      padding: 40px 60px; text-align: center; font-size: 14px;
    }
    footer strong { color: #fff; }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-24px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
      section { padding: 64px 24px; }
      .navbar { padding: 0 24px; }
      .nav-links { display: none; }
      .features-grid, .roles-grid { grid-template-columns: 1fr; }
      .hero-stats { gap: 28px; }
      .stats-row { gap: 40px; }
      .cta-box { padding: 48px 28px; }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar" id="navbar">
    <div class="nav-brand">
      <div class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
      <h1>Edu<span>Manage</span></h1>
    </div>
    <div class="nav-links">
      <a href="#fitur">Fitur</a>
      <a href="#pengguna">Pengguna</a>
      <a href="#statistik">Statistik</a>
    </div>
    <a href="index.php" class="btn-login-nav"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg> Masuk</a>
  </nav>

  <!-- HERO -->
  <section class="hero" id="beranda">
    <div class="hero-bg-circles">
      <span></span><span></span><span></span>
    </div>
    <div class="hero-content">
      <div class="hero-badge">
        <span class="dot"></span> Sistem Aktif – Tahun Ajaran 2024/2025
      </div>
      <h1>Kelola Sekolah<br><span>Lebih Cerdas</span> & Efisien</h1>
      <p>Platform manajemen sekolah digital all-in-one untuk sekolah. Kelola data siswa, guru, nilai, absensi, dan jadwal dalam satu sistem yang terintegrasi.</p>
      <div class="hero-actions">
        <a href="index.php" class="btn-hero-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg> Masuk ke Sistem</a>
        <a href="#fitur" class="btn-hero-outline">Lihat Fitur ↓</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><div class="num">500+</div><div class="lbl">Siswa Terdaftar</div></div>
        <div class="hero-stat"><div class="num">40+</div><div class="lbl">Guru Aktif</div></div>
        <div class="hero-stat"><div class="num">12</div><div class="lbl">Kelas</div></div>
        <div class="hero-stat"><div class="num">6</div><div class="lbl">Jurusan</div></div>
      </div>
    </div>
    <div class="scroll-indicator">
      <span>SCROLL</span>
      <div class="scroll-arrow"></div>
    </div>
  </section>

  <!-- FITUR -->
  <section class="features" id="fitur">
    <div class="text-center reveal">
      <div class="section-tag">✨ Fitur Unggulan</div>
      <h2 class="section-title">Semua yang Dibutuhkan<br>Sekolah Modern</h2>
      <p class="section-sub">EduManage menyediakan semua alat yang dibutuhkan untuk mengelola institusi pendidikan secara efisien dan terorganisir.</p>
    </div>
    <div class="features-grid">
      <div class="feature-card reveal" style="transition-delay:0.05s">
        <div class="feature-icon fi-blue"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg></div>
        <h3>Manajemen Nilai</h3>
        <p>Input, kelola, dan rekap nilai siswa per mata pelajaran dan semester dengan mudah dan akurat.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:0.1s">
        <div class="feature-icon fi-green"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg></div>
        <h3>Absensi Digital</h3>
        <p>Catat kehadiran siswa secara real-time dengan status Hadir, Sakit, Izin, dan Alfa otomatis.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:0.15s">
        <div class="feature-icon fi-orange"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg></div>
        <h3>Jadwal & Kalender</h3>
        <p>Atur jadwal pelajaran mingguan dan kelola kalender akademik dalam tampilan yang intuitif.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:0.2s">
        <div class="feature-icon fi-purple"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg></div>
        <h3>Data Siswa</h3>
        <p>Kelola biodata siswa lengkap, kelas, jurusan, dan riwayat akademik dalam satu database terpusat.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:0.25s">
        <div class="feature-icon fi-teal">👨‍<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
        <h3>Data Guru</h3>
        <p>Catat data guru, NIP, mata pelajaran yang diampu, dan kelas yang diajar secara lengkap.</p>
      </div>
      <div class="feature-card reveal" style="transition-delay:0.3s">
        <div class="feature-icon fi-red"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
        <h3>Profil Sekolah</h3>
        <p>Tampilkan visi misi, struktur organisasi, dan informasi lengkap tentang sekolah secara digital.</p>
      </div>
    </div>
  </section>

  <!-- PENGGUNA -->
  <section class="roles" id="pengguna">
    <div class="text-center reveal">
      <div class="section-tag"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Tipe Pengguna</div>
      <h2 class="section-title">Dirancang untuk<br>Semua Peran</h2>
      <p class="section-sub">Setiap pengguna memiliki akses dan tampilan yang disesuaikan dengan kebutuhan dan tanggung jawabnya.</p>
    </div>
    <div class="roles-grid">
      <div class="role-card rc-admin reveal-left" style="transition-delay:0.05s">
        <span class="role-emoji"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.518l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg></span>
        <h3>Admin</h3>
        <p>Kontrol penuh atas seluruh sistem dan data sekolah.</p>
        <ul class="role-features">
          <li>Kelola data siswa & guru</li>
          <li>Input & rekap nilai</li>
          <li>Manajemen absensi</li>
          <li>Atur jadwal pelajaran</li>
          <li>Lihat statistik lengkap</li>
        </ul>
      </div>
      <div class="role-card rc-guru reveal" style="transition-delay:0.1s">
        <span class="role-emoji"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg></span>
        <h3>Guru</h3>
        <p>Akses untuk mengelola kelas dan data akademik.</p>
        <ul class="role-features">
          <li>Lihat jadwal mengajar</li>
          <li>Input nilai siswa</li>
          <li>Rekap absensi kelas</li>
          <li>Lihat profil sekolah</li>
          <li>Informasi akademik</li>
        </ul>
      </div>
      <div class="role-card rc-siswa reveal-right" style="transition-delay:0.15s">
        <span class="role-emoji"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg></span>
        <h3>Siswa</h3>
        <p>Pantau perkembangan akademik secara mandiri.</p>
        <ul class="role-features">
          <li>Lihat nilai rapor</li>
          <li>Cek rekap absensi</li>
          <li>Jadwal pelajaran</li>
          <li>Profil sekolah</li>
          <li>Informasi kelas</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- STATISTIK -->
  <section class="stats-section" id="statistik">
    <h2 class="reveal">Dipercaya oleh SMK Telkom</h2>
    <p class="reveal" style="transition-delay:0.1s">Platform kami terus berkembang melayani komunitas pendidikan</p>
    <div class="stats-row">
      <div class="stat-item reveal" style="transition-delay:0.05s">
        <div class="number">500<span class="unit">+</span></div>
        <div class="desc">Siswa Terdaftar</div>
      </div>
      <div class="stat-item reveal" style="transition-delay:0.1s">
        <div class="number">40<span class="unit">+</span></div>
        <div class="desc">Guru Aktif</div>
      </div>
      <div class="stat-item reveal" style="transition-delay:0.15s">
        <div class="number">12</div>
        <div class="desc">Total Kelas</div>
      </div>
      <div class="stat-item reveal" style="transition-delay:0.2s">
        <div class="number">4</div>
        <div class="desc">Jurusan SMK</div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-section">
    <div class="cta-box reveal">
      <h2>Siap Mulai?</h2>
      <p>Login ke sistem EduManage sekarang dan rasakan kemudahan mengelola sekolah secara digital. Tersedia untuk Admin, Guru, dan Siswa.</p>
      <a href="index.php" class="cta-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 9.9-1"/></svg> Masuk ke EduManage →</a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <p>© 2025 <strong>EduManage</strong> – SMK Telkom | Sistem Manajemen Sekolah Digital</p>
  </footer>

  <script>
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    });

    // Scroll reveal animation
    const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

    revealEls.forEach(el => observer.observe(el));
  </script>
</body>
</html>
