<?php
session_start();
include 'koneksi.php';

// Proteksi halaman
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'siswa') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Siswa – EduManage</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="layout">
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon">🏫</div>
      <h1>EduManage</h1>
      <span>Portal Siswa</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Utama</div>
      <a href="siswa.php" class="nav-item active"><span class="icon">🏠</span> Dashboard</a>
      <a href="profil.php" class="nav-item"><span class="icon">🏫</span> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><span class="icon">📅</span> Jadwal Pelajaran</a>

      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><span class="icon">📊</span> Nilai Saya</a>
      <a href="absensi.php" class="nav-item"><span class="icon">✅</span> Kehadiran Saya</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar" style="background:linear-gradient(135deg,#43A047,#66BB6A);">S</div>
      <div class="user-info">
        <small><?php echo ucfirst($_SESSION['role']); ?></small>
        <strong><?php echo $_SESSION['nama']; ?></strong>
      </div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Dashboard <span>Siswa</span></div>
      <div class="topbar-right">
        <span class="badge siswa"><?php echo ucfirst($_SESSION['role']); ?></span>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?> 👋</h2>
        <p><?php echo date('l, d F Y'); ?> – Pantau jadwal dan nilai akademikmu.</p>
      </div>

      <div class="info-box">
        <span class="info-icon">ℹ️</span>
        <div><strong>Mode Read-Only:</strong> Sebagai siswa, Anda hanya dapat melihat data. Untuk perubahan data, hubungi wali kelas atau admin sekolah.</div>
      </div>

      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon blue">🏛️</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Kelas Saya</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green">📊</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Rata-rata Nilai</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange">✅</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">% Kehadiran</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon purple">📚</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Mata Pelajaran</div>
          </div>
        </div>
      </div>

      <div class="grid-2">
        <div class="card">
          <div class="card-title">📅 Jadwal Hari Ini</div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr><th>Jam</th><th>Mata Pelajaran</th><th>Guru</th><th>Ruang</th></tr>
              </thead>
              <tbody>
                <tr class="empty-row">
                  <td colspan="4"><span class="empty-icon">📭</span>Jadwal belum tersedia.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-title">📊 Nilai Terbaru</div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr><th>Mata Pelajaran</th><th>Nilai</th><th>Ket.</th></tr>
              </thead>
              <tbody>
                <tr class="empty-row">
                  <td colspan="3"><span class="empty-icon">📭</span>Nilai belum diinput oleh guru.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-title">✅ Rekap Kehadiran Bulan Ini</div>
        <div style="display:flex;gap:16px;flex-wrap:wrap;">
          <div class="status status-hadir" style="padding:10px 20px;font-size:14px;">✅ Hadir: — hari</div>
          <div class="status status-sakit" style="padding:10px 20px;font-size:14px;">🤒 Sakit: — hari</div>
          <div class="status status-izin" style="padding:10px 20px;font-size:14px;">📋 Izin: — hari</div>
          <div class="status status-alfa" style="padding:10px 20px;font-size:14px;">❌ Alfa: — hari</div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
