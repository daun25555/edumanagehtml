<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Sekolah – EduManage</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .info-item { display: flex; flex-direction: column; gap: 2px; }
    .info-item .info-label { font-size: 11px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .info-item .info-val { font-size: 14px; font-weight: 600; color: var(--text); }

    .contact-list { display: flex; flex-direction: column; gap: 10px; }
    .contact-item { display: flex; align-items: center; gap: 10px; font-size: 14px; }
    .contact-item .contact-icon { font-size: 18px; width: 28px; text-align: center; }
  </style>
</head>
<body>
<div class="layout">
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon">🏫</div>
      <h1>EduManage</h1>
      <span>Manajemen Sekolah</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Utama</div>
      <a href="admin.php" class="nav-item"><span class="icon">🏠</span> Dashboard</a>
      <a href="profil.php" class="nav-item active"><span class="icon">🏫</span> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><span class="icon">📅</span> Jadwal & Kalender</a>
      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><span class="icon">📊</span> Nilai Siswa</a>
      <a href="absensi.php" class="nav-item"><span class="icon">✅</span> Absensi</a>
      <div class="nav-label">Data</div>
      <a href="data-siswa.php" class="nav-item"><span class="icon">🎒</span> Data Siswa</a>
      <a href="data-guru.php" class="nav-item"><span class="icon">👨‍🏫</span> Data Guru</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar">A</div>
      <div class="user-info"><small>Role</small><strong>Administrator</strong></div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Profil <span>Sekolah</span></div>
      <div class="topbar-right">
        <span class="badge">Admin</span>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <!-- Hero -->
      <div class="profile-hero">
        <div style="font-size:60px;margin-bottom:16px;">🏫</div>
        <h2>SMK Telkom</h2>
        <p>Jl. Pendidikan No. 1, Kota Contoh, Provinsi Contoh</p>
        <p style="margin-top:8px;opacity:0.7;font-size:13px;">Akreditasi: A &nbsp;|&nbsp; NPSN: 12345678 &nbsp;|&nbsp; Berdiri: 1990</p>
      </div>

      <div class="grid-2" style="margin-bottom:24px;">
        <!-- Info Sekolah -->
        <div class="card">
          <div class="card-title">📋 Informasi Sekolah</div>
          <div class="info-grid">
            <div class="info-item">
              <span class="info-label">Nama Sekolah</span>
              <span class="info-val">SMK Telkom</span>
            </div>
            <div class="info-item">
              <span class="info-label">NPSN</span>
              <span class="info-val">12345678</span>
            </div>
            <div class="info-item">
              <span class="info-label">Jenis Sekolah</span>
              <span class="info-val">SMK</span>
            </div>
            <div class="info-item">
              <span class="info-label">Akreditasi</span>
              <span class="info-val">A (Unggul)</span>
            </div>
            <div class="info-item">
              <span class="info-label">Tahun Berdiri</span>
              <span class="info-val">1990</span>
            </div>
            <div class="info-item">
              <span class="info-label">Kurikulum</span>
              <span class="info-val">Merdeka Belajar</span>
            </div>
            <div class="info-item" style="grid-column:1/-1;">
              <span class="info-label">Alamat</span>
              <span class="info-val">Jl. Pendidikan No. 1, Kel. Maju, Kec. Jaya, Kota Contoh</span>
            </div>
          </div>
        </div>

        <!-- Kontak -->
        <div class="card">
          <div class="card-title">📞 Kontak Sekolah</div>
          <div class="contact-list">
            <div class="contact-item"><span class="contact-icon">📞</span><div><div style="font-size:11px;color:var(--text-muted);">Telepon</div><div style="font-weight:600;">(021) 1234-5678</div></div></div>
            <div class="contact-item"><span class="contact-icon">📠</span><div><div style="font-size:11px;color:var(--text-muted);">Fax</div><div style="font-weight:600;">(021) 1234-5679</div></div></div>
            <div class="contact-item"><span class="contact-icon">✉️</span><div><div style="font-size:11px;color:var(--text-muted);">Email</div><div style="font-weight:600;">info@smkn-contoh.sch.id</div></div></div>
            <div class="contact-item"><span class="contact-icon">🌐</span><div><div style="font-size:11px;color:var(--text-muted);">Website</div><div style="font-weight:600;">www.smkn-contoh.sch.id</div></div></div>
            <div class="contact-item"><span class="contact-icon">⏰</span><div><div style="font-size:11px;color:var(--text-muted);">Jam Operasional</div><div style="font-weight:600;">Senin–Jumat, 07.00–15.00</div></div></div>
          </div>
        </div>
      </div>

      <!-- Visi Misi -->
      <div class="section-divider"><h3>Visi & Misi</h3></div>
      <div class="grid-2" style="margin-bottom:24px;">
        <div class="visi-card">
          <h3>🎯 Visi</h3>
          <p>Menjadi sekolah kejuruan terdepan yang menghasilkan lulusan berkarakter, kompeten, berdaya saing global, dan berwawasan teknologi pada tahun 2030.</p>
        </div>
        <div class="visi-card">
          <h3>🚀 Misi</h3>
          <ul class="misi-list">
            <li>Menyelenggarakan pendidikan berkualitas berbasis kompetensi kejuruan.</li>
            <li>Mengembangkan karakter siswa yang beriman, berakhlak mulia, dan berdisiplin.</li>
            <li>Membangun kemitraan dengan dunia usaha dan industri.</li>
            <li>Mendorong inovasi pembelajaran berbasis teknologi digital.</li>
            <li>Mewujudkan lingkungan belajar yang aman, nyaman, dan kondusif.</li>
          </ul>
        </div>
      </div>

      <!-- Struktur Organisasi -->
      <div class="section-divider"><h3>Struktur Organisasi</h3></div>
      <div class="card">
        <div class="org-chart">
          <!-- Kepala Sekolah -->
          <div class="org-node">
            🎓 Kepala Sekolah
            <small>—</small>
          </div>
          <div class="org-connector"></div>

          <!-- Level 2 -->
          <div class="org-level">
            <div class="org-branch">
              <div class="org-node secondary">📋 Wakasek Kurikulum<small>—</small></div>
            </div>
            <div style="width:40px;"></div>
            <div class="org-branch">
              <div class="org-node secondary">👥 Wakasek Kesiswaan<small>—</small></div>
            </div>
            <div style="width:40px;"></div>
            <div class="org-branch">
              <div class="org-node secondary">🔧 Wakasek Sarpras<small>—</small></div>
            </div>
            <div style="width:40px;"></div>
            <div class="org-branch">
              <div class="org-node secondary">🤝 Wakasek Humas<small>—</small></div>
            </div>
          </div>

          <div class="org-connector"></div>

          <!-- Level 3 -->
          <div class="org-level">
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;">📚 Ketua Jurusan DKV<small>—</small></div>
            </div>
            <div style="width:16px;"></div>
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;">🎨 Ketua Jurusan Animasi<small>—</small></div>
            </div>
            <div style="width:16px;"></div>
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;">💻 Ketua Jurusan PPLG<small>—</small></div>
            </div>
            <div style="width:16px;"></div>
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;">🌐 Ketua Jurusan TJKT<small>—</small></div>
            </div>
          </div>
        </div>

        <div class="info-box" style="margin-top:20px;">
          <span class="info-icon">💡</span>
          <div>Data nama pejabat masih kosong. Admin dapat memperbarui data personalia melalui fitur yang akan datang.</div>
        </div>
      </div>

      <!-- Program Keahlian -->
      <div class="section-divider"><h3>Program Keahlian</h3></div>
      <div class="grid-2">
        <div class="card" style="border-left:4px solid #1565C0;">
          <div class="card-title">🎨 DKV – Desain Komunikasi Visual</div>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.7;">Program keahlian yang mempelajari desain grafis, fotografi, video, dan komunikasi visual untuk keperluan industri kreatif.</p>
          <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
            <span class="status status-hadir">Kelas X</span>
            <span class="status status-hadir">Kelas XI</span>
            <span class="status status-hadir">Kelas XII</span>
          </div>
        </div>
        <div class="card" style="border-left:4px solid #0288D1;">
          <div class="card-title">🎬 Animasi</div>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.7;">Program keahlian yang mengajarkan produksi animasi 2D dan 3D, desain karakter, storyboard, dan produksi film animasi.</p>
          <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
            <span class="status status-hadir">Kelas X</span>
            <span class="status status-hadir">Kelas XI</span>
            <span class="status status-hadir">Kelas XII</span>
          </div>
        </div>
        <div class="card" style="border-left:4px solid #43A047;">
          <div class="card-title">💻 PPLG – Pengembangan Perangkat Lunak & GIM</div>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.7;">Program keahlian pemrograman web, mobile, database, dan pengembangan game digital untuk industri teknologi.</p>
          <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
            <span class="status status-hadir">Kelas X</span>
            <span class="status status-hadir">Kelas XI</span>
            <span class="status status-hadir">Kelas XII</span>
          </div>
        </div>
        <div class="card" style="border-left:4px solid #7B1FA2;">
          <div class="card-title">🌐 TJKT – Teknik Jaringan Komputer & Telekomunikasi</div>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.7;">Program keahlian infrastruktur jaringan, keamanan siber, sistem telekomunikasi, dan administrasi server.</p>
          <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
            <span class="status status-hadir">Kelas X</span>
            <span class="status status-hadir">Kelas XI</span>
            <span class="status status-hadir">Kelas XII</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
