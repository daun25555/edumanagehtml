<?php
session_start();
include 'koneksi.php';

// Proteksi halaman
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guru') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru – EduManage</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="layout">
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon">🏫</div>
      <h1>EduManage</h1>
      <span>Portal Guru</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Utama</div>
      <a href="guru.php" class="nav-item active"><span class="icon">🏠</span> Dashboard</a>
      <a href="profil.php" class="nav-item"><span class="icon">🏫</span> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><span class="icon">📅</span> Jadwal Mengajar</a>

      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><span class="icon">📊</span> Input Nilai</a>
      <a href="absensi.php" class="nav-item"><span class="icon">✅</span> Absensi Kelas</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar">G</div>
      <div class="user-info">
        <small><?php echo ucfirst($_SESSION['role']); ?></small>
        <strong><?php echo $_SESSION['nama']; ?></strong>
      </div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Dashboard <span>Guru</span></div>
      <div class="topbar-right">
        <span class="badge guru"><?php echo ucfirst($_SESSION['role']); ?></span>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?> 👋</h2>
        <p><?php echo date('l, d F Y'); ?> – Kelola nilai dan absensi kelas Anda.</p>
      </div>

      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon blue">🏛️</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Kelas Diampu</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green">📚</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Mata Pelajaran</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange">🎒</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Total Siswa</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon purple">📋</div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Jam Mengajar/Minggu</div>
          </div>
        </div>
      </div>

      <div class="grid-2">
        <div class="card">
          <div class="card-title">📅 Jadwal Mengajar Hari Ini</div>
          <div class="info-box">
            <span class="info-icon">ℹ️</span>
            <div>Jadwal mengajar belum diatur. Hubungi admin untuk pengaturan jadwal.</div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr><th>Jam</th><th>Mata Pelajaran</th><th>Kelas</th><th>Ruang</th></tr>
              </thead>
              <tbody>
                <tr class="empty-row">
                  <td colspan="4"><span class="empty-icon">📭</span>Belum ada jadwal mengajar.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-title">✅ Aksi Cepat</div>
          <div style="display:flex;flex-direction:column;gap:12px;">
            <a href="nilai.php" class="btn btn-primary">📊 Input Nilai Siswa</a>
            <a href="absensi.php" class="btn btn-outline">✅ Isi Absensi Kelas</a>
            <a href="jadwal.php" class="btn btn-outline">📅 Lihat Jadwal</a>
          </div>

          <div class="card-title" style="margin-top:20px;">📊 Kehadiran Kelas Hari Ini</div>
          <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <div class="status status-hadir">✅ Hadir: —</div>
            <div class="status status-sakit">🤒 Sakit: —</div>
            <div class="status status-izin">📋 Izin: —</div>
            <div class="status status-alfa">❌ Alfa: —</div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-title">📊 Nilai Terakhir Diinput</div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr><th>Tanggal</th><th>Nama Siswa</th><th>Kelas</th><th>Mata Pelajaran</th><th>Nilai</th></tr>
            </thead>
            <tbody>
              <tr class="empty-row">
                <td colspan="5"><span class="empty-icon">📭</span>Belum ada data nilai. <a href="nilai.php" style="color:var(--primary);font-weight:600;">+ Input nilai</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
