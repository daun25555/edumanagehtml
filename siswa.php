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
      <div class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
      <h1>EduManage</h1>
      <span>Portal Siswa</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Utama</div>
      <a href="siswa.php" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <a href="profil.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> Jadwal Pelajaran</a>

      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Nilai Saya</a>
      <a href="absensi.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Kehadiran Saya</a>
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
        <a href="logout.php" class="btn-logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg> Logout</a>
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
          <div class="stat-icon green"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg></div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Rata-rata Nilai</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg></div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">% Kehadiran</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon purple"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg></div>
          <div class="stat-info">
            <div class="num">—</div>
            <div class="label">Mata Pelajaran</div>
          </div>
        </div>
      </div>

      <div class="grid-2">
        <div class="card">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> Jadwal Hari Ini</div>
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
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Nilai Terbaru</div>
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
        <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Rekap Kehadiran Bulan Ini</div>
        <div style="display:flex;gap:16px;flex-wrap:wrap;">
          <div class="status status-hadir" style="padding:10px 20px;font-size:14px;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Hadir: — hari</div>
          <div class="status status-sakit" style="padding:10px 20px;font-size:14px;">🤒 Sakit: — hari</div>
          <div class="status status-izin" style="padding:10px 20px;font-size:14px;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Izin: — hari</div>
          <div class="status status-alfa" style="padding:10px 20px;font-size:14px;">❌ Alfa: — hari</div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
