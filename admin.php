<?php
session_start();
include 'koneksi.php';

// Proteksi halaman
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Ambil statistik
$count_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
$count_guru = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM guru"))['total'];
$count_kelas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT kelas) as total FROM siswa"))['total'];
$count_mapel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT mapel) as total FROM guru"))['total'];

// Ambil siswa terbaru
$siswa_terbaru = mysqli_query($conn, "SELECT nisn, nama, kelas FROM siswa ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin – EduManage</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="layout">
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
      <h1>EduManage</h1>
      <span>Manajemen Sekolah</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Utama</div>
      <a href="admin.php" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <a href="profil.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> Jadwal & Kalender</a>

      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Nilai Siswa</a>
      <a href="absensi.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Absensi</a>

      <div class="nav-label">Data</div>
      <a href="data-siswa.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg> Data Siswa</a>
      <a href="data-guru.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Data Guru</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar">A</div>
      <div class="user-info">
        <small><?php echo ucfirst($_SESSION['role']); ?></small>
        <strong><?php echo $_SESSION['nama']; ?></strong>
      </div>
    </div>
  </aside>

  <!-- Main -->
  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Dashboard <span>Admin</span></div>
      <div class="topbar-right">
        <span class="badge"><?php echo ucfirst($_SESSION['role']); ?></span>
        <a href="logout.php" class="btn-logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg> Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon" style="color:#F5A623;"><path d="M18 11V6a2 2 0 0 0-4 0v4"/><path d="M14 10V5a2 2 0 0 0-4 0v5"/><path d="M10 10.5V4a2 2 0 0 0-4 0v7"/><path d="M6 12v-1a2 2 0 0 0-4 0v5.5c0 3.5 2.5 6.5 6 6.5h3c3.5 0 6-3 6-6v-4.5"/><path d="M18 11a2 2 0 0 1 4 0v4.5c0 3.5-2.5 6.5-6 6.5"/></svg></h2>
        <p><?php echo date('l, d F Y'); ?> – Kelola seluruh data sekolah dari sini.</p>
      </div>

      <!-- Notice -->
      <div class="notice-card">
        <div class="notice-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg></div>
        <div>
          <h3>Tahun Ajaran 2024/2025 – Semester Genap</h3>
          <p>Saat ini aktif. Harap lengkapi data siswa dan guru sebelum ujian akhir semester.</p>
        </div>
      </div>

      <!-- Stats -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon blue"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg></div>
          <div class="stat-info">
            <div class="num"><?php echo $count_siswa; ?></div>
            <div class="label">Total Siswa</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
          <div class="stat-info">
            <div class="num"><?php echo $count_guru; ?></div>
            <div class="label">Total Guru</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg></div>
          <div class="stat-info">
            <div class="num"><?php echo $count_kelas; ?></div>
            <div class="label">Total Kelas</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon purple"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg></div>
          <div class="stat-info">
            <div class="num"><?php echo $count_mapel; ?></div>
            <div class="label">Mata Pelajaran</div>
          </div>
        </div>
      </div>

      <!-- Quick Access -->
      <div class="section-divider"><h3>Akses Cepat</h3></div>
      <div class="quick-grid" style="margin-bottom:28px;">
        <a href="data-siswa.php" class="quick-card">
          <span class="quick-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg></span>
          <div class="quick-label">Data Siswa</div>
          <div class="quick-desc">Tambah &amp; kelola data siswa</div>
        </a>
        <a href="data-guru.php" class="quick-card">
          <span class="quick-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
          <div class="quick-label">Data Guru</div>
          <div class="quick-desc">Tambah &amp; kelola data guru</div>
        </a>
        <a href="nilai.php" class="quick-card">
          <span class="quick-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg></span>
          <div class="quick-label">Input Nilai</div>
          <div class="quick-desc">Masukkan nilai siswa</div>
        </a>
        <a href="absensi.php" class="quick-card">
          <span class="quick-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg></span>
          <div class="quick-label">Absensi</div>
          <div class="quick-desc">Rekap kehadiran siswa</div>
        </a>
        <a href="jadwal.php" class="quick-card">
          <span class="quick-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg></span>
          <div class="quick-label">Jadwal</div>
          <div class="quick-desc">Atur jadwal pelajaran</div>
        </a>
        <a href="profil.php" class="quick-card">
          <span class="quick-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></span>
          <div class="quick-label">Profil Sekolah</div>
          <div class="quick-desc">Info &amp; struktur organisasi</div>
        </a>
      </div>

      <!-- Recent Activity -->
      <div class="grid-2">
        <div class="card">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Siswa Terdaftar Terbaru</div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                </tr>
              </thead>
              <tbody>
                <?php if (mysqli_num_rows($siswa_terbaru) > 0): ?>
                  <?php while($row = mysqli_fetch_assoc($siswa_terbaru)): ?>
                    <tr>
                      <td><?php echo $row['nisn']; ?></td>
                      <td><?php echo $row['nama']; ?></td>
                      <td><span class="tag"><?php echo $row['kelas']; ?></span></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr class="empty-row">
                    <td colspan="3">
                      <span class="empty-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg></span>
                      Belum ada data siswa.<br>
                      <a href="data-siswa.php" style="color:var(--primary);font-weight:600;">+ Tambah siswa</a>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> Agenda Hari Ini</div>
          <div class="info-box">
            <span class="info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="9" x2="15" y1="21" y2="21"/><line x1="10" x2="14" y1="18" y2="18"/><path d="M12 2a7 7 0 0 0-7 7c0 2 1 3.9 2 5 .5.5 1 1 1 1.5V17a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-1.5c0-.5.5-1 1-1.5 1-1.1 2-3 2-5a7 7 0 0 0-7-7z"/></svg></span>
            <div>Belum ada agenda. Tambahkan melalui halaman <a href="jadwal.php" style="color:var(--primary);font-weight:600;">Jadwal &amp; Kalender</a>.</div>
          </div>

          <div class="card-title" style="margin-top:16px;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Statistik Kehadiran Hari Ini</div>
          <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <div class="status status-hadir"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Hadir: —</div>
            <div class="status status-sakit"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z"/><path d="m8.5 8.5 7 7"/></svg> Sakit: —</div>
            <div class="status status-izin"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Izin: —</div>
            <div class="status status-alfa"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Alfa: —</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
