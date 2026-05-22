<?php
session_start();
include 'koneksi.php';

// Proteksi: harus sudah login
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$role      = $_SESSION['role'];
$user_nama = $_SESSION['nama'] ?? 'Pengguna';
$avatar    = strtoupper(substr($user_nama, 0, 1));

// ----------------------------------------------------------------
// Pastikan tabel profil_sekolah ada & punya 1 baris
// ----------------------------------------------------------------
mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS `profil_sekolah` (
      `id`            INT AUTO_INCREMENT PRIMARY KEY,
      `nama_sekolah`  VARCHAR(200) NOT NULL DEFAULT 'SMK Telkom',
      `npsn`          VARCHAR(20)  DEFAULT '12345678',
      `jenis_sekolah` VARCHAR(50)  DEFAULT 'SMK',
      `akreditasi`    VARCHAR(30)  DEFAULT 'A (Unggul)',
      `tahun_berdiri` VARCHAR(10)  DEFAULT '1990',
      `kurikulum`     VARCHAR(100) DEFAULT 'Merdeka Belajar',
      `alamat`        TEXT,
      `telepon`       VARCHAR(30)  DEFAULT '',
      `fax`           VARCHAR(30)  DEFAULT '',
      `email`         VARCHAR(100) DEFAULT '',
      `website`       VARCHAR(150) DEFAULT '',
      `jam_operasional` VARCHAR(100) DEFAULT 'Senin–Jumat, 07.00–15.00',
      `visi`          TEXT,
      `misi`          TEXT,
      `updated_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB
");

// Cek apakah baris pertama ada
$cek = mysqli_query($conn, "SELECT id FROM profil_sekolah LIMIT 1");
if (mysqli_num_rows($cek) === 0) {
    mysqli_query($conn, "
        INSERT INTO profil_sekolah
          (nama_sekolah, npsn, jenis_sekolah, akreditasi, tahun_berdiri, kurikulum,
           alamat, telepon, fax, email, website, jam_operasional, visi, misi)
        VALUES
          ('SMK Telkom','12345678','SMK','A (Unggul)','1990','Merdeka Belajar',
           'Jl. Pendidikan No. 1, Kel. Maju, Kec. Jaya, Kota Contoh',
           '(021) 1234-5678','(021) 1234-5679','info@smkn-contoh.sch.id',
           'www.smkn-contoh.sch.id','Senin–Jumat, 07.00–15.00',
           'Menjadi sekolah kejuruan terdepan yang menghasilkan lulusan berkarakter, kompeten, berdaya saing global, dan berwawasan teknologi pada tahun 2030.',
           'Menyelenggarakan pendidikan berkualitas berbasis kompetensi kejuruan.\nMengembangkan karakter siswa yang beriman, berakhlak mulia, dan berdisiplin.\nMembangun kemitraan dengan dunia usaha dan industri.\nMendorong inovasi pembelajaran berbasis teknologi digital.\nMewujudkan lingkungan belajar yang aman, nyaman, dan kondusif.')
    ");
}

// ----------------------------------------------------------------
// PROSES SIMPAN (hanya admin)
// ----------------------------------------------------------------
$pesan = '';
if ($role === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi_profil'])) {
    $fields = ['nama_sekolah','npsn','jenis_sekolah','akreditasi','tahun_berdiri','kurikulum',
               'alamat','telepon','fax','email','website','jam_operasional','visi','misi'];
    $sets = [];
    foreach ($fields as $f) {
        $val = mysqli_real_escape_string($conn, $_POST[$f] ?? '');
        $sets[] = "`$f` = '$val'";
    }
    mysqli_query($conn, "UPDATE profil_sekolah SET " . implode(', ', $sets) . " WHERE id = 1");
    $pesan = 'ok';
}

// ----------------------------------------------------------------
// AMBIL DATA PROFIL
// ----------------------------------------------------------------
$profil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profil_sekolah LIMIT 1"));
$misi_lines = array_filter(array_map('trim', explode("\n", $profil['misi'] ?? '')));
?>
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

    /* Flash message */
    .flash { padding:12px 16px; border-radius:8px; margin-bottom:18px; font-size:14px; font-weight:500; }
    .flash-success { background:#e8f5e9; color:#2e7d32; border:1px solid #a5d6a7; }

    /* Edit Section */
    .section-edit { background:var(--bg); border:1px solid var(--border); border-radius:var(--radius); padding:20px; margin-bottom:24px; }
    .section-edit .section-edit-title { font-size:16px; font-weight:700; color:var(--primary); margin-bottom:16px; }
    .admin-only-badge { background:#fff3cd; color:#856404; font-size:11px; padding:2px 8px; border-radius:4px; border:1px solid #ffc107; margin-left:8px; }
  </style>
</head>
<body>
<div class="layout">
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
      <h1>EduManage</h1>
      <span>Manajemen Sekolah</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Utama</div>
      <?php if ($role === 'admin'): ?>
      <a href="admin.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <?php elseif ($role === 'guru'): ?>
      <a href="guru.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <?php elseif ($role === 'siswa'): ?>
      <a href="siswa.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <?php endif; ?>
      <a href="profil.php" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> Jadwal & Kalender</a>
      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Nilai Siswa</a>
      <a href="absensi.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Absensi</a>
      <div class="nav-label">Data</div>
      <a href="data-siswa.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg> Data Siswa</a>
      <a href="data-guru.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Data Guru</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar"><?= $avatar ?></div>
      <div class="user-info">
        <small><?= ucfirst($role) ?></small>
        <strong><?= htmlspecialchars($user_nama) ?></strong>
      </div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Profil <span>Sekolah</span></div>
      <div class="topbar-right">
        <span class="badge"><?= ucfirst($role) ?></span>
        <a href="logout.php" class="btn-logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg> Logout</a>
      </div>
    </header>

    <div class="page-content">

      <?php if ($pesan === 'ok'): ?>
        <div class="flash flash-success"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Profil sekolah berhasil diperbarui.</div>
      <?php endif; ?>

      <!-- Hero -->
      <div class="profile-hero">
        <div style="font-size:60px;margin-bottom:16px;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
        <h2><?= htmlspecialchars($profil['nama_sekolah']) ?></h2>
        <p><?= htmlspecialchars($profil['alamat']) ?></p>
        <p style="margin-top:8px;opacity:0.7;font-size:13px;">
          Akreditasi: <?= htmlspecialchars($profil['akreditasi']) ?> &nbsp;|&nbsp;
          NPSN: <?= htmlspecialchars($profil['npsn']) ?> &nbsp;|&nbsp;
          Berdiri: <?= htmlspecialchars($profil['tahun_berdiri']) ?>
        </p>
      </div>

      <!-- ===== FORM EDIT (hanya admin) ===== -->
      <?php if ($role === 'admin'): ?>
      <div class="section-edit">
        <div class="section-edit-title">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg> Edit Profil Sekolah
          <span class="admin-only-badge"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg> Admin Only</span>
        </div>
        <form method="POST" action="profil.php">
          <input type="hidden" name="aksi_profil" value="1">
          <div class="form-grid">
            <div class="form-group">
              <label>Nama Sekolah</label>
              <input type="text" name="nama_sekolah" value="<?= htmlspecialchars($profil['nama_sekolah']) ?>" required>
            </div>
            <div class="form-group">
              <label>NPSN</label>
              <input type="text" name="npsn" value="<?= htmlspecialchars($profil['npsn']) ?>">
            </div>
            <div class="form-group">
              <label>Jenis Sekolah</label>
              <input type="text" name="jenis_sekolah" value="<?= htmlspecialchars($profil['jenis_sekolah']) ?>">
            </div>
            <div class="form-group">
              <label>Akreditasi</label>
              <input type="text" name="akreditasi" value="<?= htmlspecialchars($profil['akreditasi']) ?>">
            </div>
            <div class="form-group">
              <label>Tahun Berdiri</label>
              <input type="text" name="tahun_berdiri" value="<?= htmlspecialchars($profil['tahun_berdiri']) ?>">
            </div>
            <div class="form-group">
              <label>Kurikulum</label>
              <input type="text" name="kurikulum" value="<?= htmlspecialchars($profil['kurikulum']) ?>">
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Alamat</label>
              <input type="text" name="alamat" value="<?= htmlspecialchars($profil['alamat']) ?>">
            </div>
            <div class="form-group">
              <label>Telepon</label>
              <input type="text" name="telepon" value="<?= htmlspecialchars($profil['telepon']) ?>">
            </div>
            <div class="form-group">
              <label>Fax</label>
              <input type="text" name="fax" value="<?= htmlspecialchars($profil['fax']) ?>">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" value="<?= htmlspecialchars($profil['email']) ?>">
            </div>
            <div class="form-group">
              <label>Website</label>
              <input type="text" name="website" value="<?= htmlspecialchars($profil['website']) ?>">
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Jam Operasional</label>
              <input type="text" name="jam_operasional" value="<?= htmlspecialchars($profil['jam_operasional']) ?>">
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Visi</label>
              <textarea name="visi" rows="3"><?= htmlspecialchars($profil['visi']) ?></textarea>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Misi <small style="color:var(--text-muted);font-weight:400;">(pisahkan tiap poin dengan Enter baru)</small></label>
              <textarea name="misi" rows="6"><?= htmlspecialchars($profil['misi']) ?></textarea>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Simpan Perubahan</button>
            <button type="reset" class="btn btn-outline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg> Reset</button>
          </div>
        </form>
      </div>
      <?php endif; ?>

      <div class="grid-2" style="margin-bottom:24px;">
        <!-- Info Sekolah -->
        <div class="card">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Informasi Sekolah</div>
          <div class="info-grid">
            <div class="info-item">
              <span class="info-label">Nama Sekolah</span>
              <span class="info-val"><?= htmlspecialchars($profil['nama_sekolah']) ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">NPSN</span>
              <span class="info-val"><?= htmlspecialchars($profil['npsn']) ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Jenis Sekolah</span>
              <span class="info-val"><?= htmlspecialchars($profil['jenis_sekolah']) ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Akreditasi</span>
              <span class="info-val"><?= htmlspecialchars($profil['akreditasi']) ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Tahun Berdiri</span>
              <span class="info-val"><?= htmlspecialchars($profil['tahun_berdiri']) ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Kurikulum</span>
              <span class="info-val"><?= htmlspecialchars($profil['kurikulum']) ?></span>
            </div>
            <div class="info-item" style="grid-column:1/-1;">
              <span class="info-label">Alamat</span>
              <span class="info-val"><?= htmlspecialchars($profil['alamat']) ?></span>
            </div>
          </div>
        </div>

        <!-- Kontak -->
        <div class="card">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Kontak Sekolah</div>
          <div class="contact-list">
            <div class="contact-item"><span class="contact-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span><div><div style="font-size:11px;color:var(--text-muted);">Telepon</div><div style="font-weight:600;"><?= htmlspecialchars($profil['telepon']) ?></div></div></div>
            <div class="contact-item"><span class="contact-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10h16v10H4z"/><path d="M8 10V4h8v6"/><path d="M8 14h8"/></svg></span><div><div style="font-size:11px;color:var(--text-muted);">Fax</div><div style="font-weight:600;"><?= htmlspecialchars($profil['fax']) ?></div></div></div>
            <div class="contact-item"><span class="contact-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></span><div><div style="font-size:11px;color:var(--text-muted);">Email</div><div style="font-weight:600;"><?= htmlspecialchars($profil['email']) ?></div></div></div>
            <div class="contact-item"><span class="contact-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg></span><div><div style="font-size:11px;color:var(--text-muted);">Website</div><div style="font-weight:600;"><?= htmlspecialchars($profil['website']) ?></div></div></div>
            <div class="contact-item"><span class="contact-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></span><div><div style="font-size:11px;color:var(--text-muted);">Jam Operasional</div><div style="font-weight:600;"><?= htmlspecialchars($profil['jam_operasional']) ?></div></div></div>
          </div>
        </div>
      </div>

      <!-- Visi Misi -->
      <div class="section-divider"><h3>Visi & Misi</h3></div>
      <div class="grid-2" style="margin-bottom:24px;">
        <div class="visi-card">
          <h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg> Visi</h3>
          <p><?= nl2br(htmlspecialchars($profil['visi'])) ?></p>
        </div>
        <div class="visi-card">
          <h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/></svg> Misi</h3>
          <ul class="misi-list">
            <?php foreach ($misi_lines as $line): ?>
              <li><?= htmlspecialchars($line) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <!-- Struktur Organisasi -->
      <div class="section-divider"><h3>Struktur Organisasi</h3></div>
      <div class="card">
        <div class="org-chart">
          <!-- Kepala Sekolah -->
          <div class="org-node">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg> Kepala Sekolah
            <small>—</small>
          </div>
          <div class="org-connector"></div>

          <!-- Level 2 -->
          <div class="org-level">
            <div class="org-branch">
              <div class="org-node secondary"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Wakasek Kurikulum<small>—</small></div>
            </div>
            <div style="width:40px;"></div>
            <div class="org-branch">
              <div class="org-node secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Wakasek Kesiswaan<small>—</small></div>
            </div>
            <div style="width:40px;"></div>
            <div class="org-branch">
              <div class="org-node secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg> Wakasek Sarpras<small>—</small></div>
            </div>
            <div style="width:40px;"></div>
            <div class="org-branch">
              <div class="org-node secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3-6 6"/><path d="m21 15-4.51 4.51a1.92 1.92 0 0 1-2.58.11L12 18l-3-3-5.26 3.5a1 1 0 0 0-.25 1.42l3.4 4.54a2 2 0 0 0 2.6.61l6-4.5"/></svg> Wakasek Humas<small>—</small></div>
            </div>
          </div>

          <div class="org-connector"></div>

          <!-- Level 3 -->
          <div class="org-level">
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg> Ketua Jurusan DKV<small>—</small></div>
            </div>
            <div style="width:16px;"></div>
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><circle cx="13.5" cy="5.5" r="2.5"/><circle cx="6.5" cy="11.5" r="2.5"/><circle cx="11.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="14.5" r="2.5"/><path d="M8 8.5C11 11.5 15.5 6 17.5 9s-2.5 7-2 9-5.5-4-7.5-6.5-1-6.5-1-6.5z"/></svg> Ketua Jurusan Animasi<small>—</small></div>
            </div>
            <div style="width:16px;"></div>
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="20" height="14" x="2" y="3" rx="2" ry="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg> Ketua Jurusan PPLG<small>—</small></div>
            </div>
            <div style="width:16px;"></div>
            <div class="org-branch">
              <div class="org-node secondary" style="min-width:130px;font-size:12px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg> Ketua Jurusan TJKT<small>—</small></div>
            </div>
          </div>
        </div>

        <div class="info-box" style="margin-top:20px;">
          <span class="info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="9" x2="15" y1="21" y2="21"/><line x1="10" x2="14" y1="18" y2="18"/><path d="M12 2a7 7 0 0 0-7 7c0 2 1 3.9 2 5 .5.5 1 1 1 1.5V17a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-1.5c0-.5.5-1 1-1.5 1-1.1 2-3 2-5a7 7 0 0 0-7-7z"/></svg></span>
          <div>Data nama pejabat masih kosong. Admin dapat memperbarui data personalia melalui fitur yang akan datang.</div>
        </div>
      </div>

      <!-- Program Keahlian -->
      <div class="section-divider"><h3>Program Keahlian</h3></div>
      <div class="grid-2">
        <div class="card" style="border-left:4px solid #1565C0;">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><circle cx="13.5" cy="5.5" r="2.5"/><circle cx="6.5" cy="11.5" r="2.5"/><circle cx="11.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="14.5" r="2.5"/><path d="M8 8.5C11 11.5 15.5 6 17.5 9s-2.5 7-2 9-5.5-4-7.5-6.5-1-6.5-1-6.5z"/></svg> DKV – Desain Komunikasi Visual</div>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.7;">Program keahlian yang mempelajari desain grafis, fotografi, video, dan komunikasi visual untuk keperluan industri kreatif.</p>
          <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
            <span class="status status-hadir">Kelas X</span>
            <span class="status status-hadir">Kelas XI</span>
            <span class="status status-hadir">Kelas XII</span>
          </div>
        </div>
        <div class="card" style="border-left:4px solid #0288D1;">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="20" height="20" x="2" y="2" rx="2.18" ry="2.18"/><line x1="7" x2="7" y1="2" y2="22"/><line x1="17" x2="17" y1="2" y2="22"/><line x1="2" x2="22" y1="12" y2="12"/><line x1="2" x2="7" y1="7" y2="7"/><line x1="2" x2="7" y1="17" y2="17"/><line x1="17" x2="22" y1="17" y2="17"/><line x1="17" x2="22" y1="7" y2="7"/></svg> Animasi</div>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.7;">Program keahlian yang mengajarkan produksi animasi 2D dan 3D, desain karakter, storyboard, dan produksi film animasi.</p>
          <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
            <span class="status status-hadir">Kelas X</span>
            <span class="status status-hadir">Kelas XI</span>
            <span class="status status-hadir">Kelas XII</span>
          </div>
        </div>
        <div class="card" style="border-left:4px solid #43A047;">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="20" height="14" x="2" y="3" rx="2" ry="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg> PPLG – Pengembangan Perangkat Lunak & GIM</div>
          <p style="font-size:14px;color:var(--text-muted);line-height:1.7;">Program keahlian pemrograman web, mobile, database, dan pengembangan game digital untuk industri teknologi.</p>
          <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
            <span class="status status-hadir">Kelas X</span>
            <span class="status status-hadir">Kelas XI</span>
            <span class="status status-hadir">Kelas XII</span>
          </div>
        </div>
        <div class="card" style="border-left:4px solid #7B1FA2;">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg> TJKT – Teknik Jaringan Komputer & Telekomunikasi</div>
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
