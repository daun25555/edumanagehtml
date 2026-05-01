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
      <div class="logo-icon">🏫</div>
      <h1>EduManage</h1>
      <span>Manajemen Sekolah</span>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-label">Utama</div>
      <a href="admin.php" class="nav-item active"><span class="icon">🏠</span> Dashboard</a>
      <a href="profil.php" class="nav-item"><span class="icon">🏫</span> Profil Sekolah</a>
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
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?> 👋</h2>
        <p><?php echo date('l, d F Y'); ?> – Kelola seluruh data sekolah dari sini.</p>
      </div>

      <!-- Notice -->
      <div class="notice-card">
        <div class="notice-icon">📢</div>
        <div>
          <h3>Tahun Ajaran 2024/2025 – Semester Genap</h3>
          <p>Saat ini aktif. Harap lengkapi data siswa dan guru sebelum ujian akhir semester.</p>
        </div>
      </div>

      <!-- Stats -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon blue">🎒</div>
          <div class="stat-info">
            <div class="num"><?php echo $count_siswa; ?></div>
            <div class="label">Total Siswa</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green">👨‍🏫</div>
          <div class="stat-info">
            <div class="num"><?php echo $count_guru; ?></div>
            <div class="label">Total Guru</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange">🏛️</div>
          <div class="stat-info">
            <div class="num"><?php echo $count_kelas; ?></div>
            <div class="label">Total Kelas</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon purple">📚</div>
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
          <span class="quick-icon">🎒</span>
          <div class="quick-label">Data Siswa</div>
          <div class="quick-desc">Tambah &amp; kelola data siswa</div>
        </a>
        <a href="data-guru.php" class="quick-card">
          <span class="quick-icon">👨‍🏫</span>
          <div class="quick-label">Data Guru</div>
          <div class="quick-desc">Tambah &amp; kelola data guru</div>
        </a>
        <a href="nilai.php" class="quick-card">
          <span class="quick-icon">📊</span>
          <div class="quick-label">Input Nilai</div>
          <div class="quick-desc">Masukkan nilai siswa</div>
        </a>
        <a href="absensi.php" class="quick-card">
          <span class="quick-icon">✅</span>
          <div class="quick-label">Absensi</div>
          <div class="quick-desc">Rekap kehadiran siswa</div>
        </a>
        <a href="jadwal.php" class="quick-card">
          <span class="quick-icon">📅</span>
          <div class="quick-label">Jadwal</div>
          <div class="quick-desc">Atur jadwal pelajaran</div>
        </a>
        <a href="profil.php" class="quick-card">
          <span class="quick-icon">🏫</span>
          <div class="quick-label">Profil Sekolah</div>
          <div class="quick-desc">Info &amp; struktur organisasi</div>
        </a>
      </div>

      <!-- Recent Activity -->
      <div class="grid-2">
        <div class="card">
          <div class="card-title">📋 Siswa Terdaftar Terbaru</div>
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
                      <span class="empty-icon">📭</span>
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
          <div class="card-title">🗓️ Agenda Hari Ini</div>
          <div class="info-box">
            <span class="info-icon">💡</span>
            <div>Belum ada agenda. Tambahkan melalui halaman <a href="jadwal.php" style="color:var(--primary);font-weight:600;">Jadwal &amp; Kalender</a>.</div>
          </div>

          <div class="card-title" style="margin-top:16px;">📊 Statistik Kehadiran Hari Ini</div>
          <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <div class="status status-hadir">✅ Hadir: —</div>
            <div class="status status-sakit">🤒 Sakit: —</div>
            <div class="status status-izin">📋 Izin: —</div>
            <div class="status status-alfa">❌ Alfa: —</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
