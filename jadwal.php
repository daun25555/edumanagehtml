<?php
session_start();
include 'koneksi.php';

// Proteksi halaman: harus sudah login
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$role      = $_SESSION['role'];
$user_nama = $_SESSION['nama'] ?? 'Pengguna';
$user_id   = $_SESSION['id']   ?? 0;
$avatar    = strtoupper(substr($user_nama, 0, 1));

// ----------------------------------------------------------------
// HAPUS JADWAL (admin & guru)
// ----------------------------------------------------------------
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $hid = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM jadwal WHERE id = $hid");
    header("Location: jadwal.php?pesan=hapus_ok");
    exit();
}

// ----------------------------------------------------------------
// PROSES FORM TAMBAH / EDIT JADWAL
// ----------------------------------------------------------------
$edit_data = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $eid = (int) $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM jadwal WHERE id = $eid");
    $edit_data = mysqli_fetch_assoc($res);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi'])) {
    $kelas       = mysqli_real_escape_string($conn, $_POST['kelas']);
    $hari        = mysqli_real_escape_string($conn, $_POST['hari']);
    $mapel       = mysqli_real_escape_string($conn, $_POST['mapel']);
    $nama_guru   = mysqli_real_escape_string($conn, $_POST['nama_guru']);
    $jam_mulai   = mysqli_real_escape_string($conn, $_POST['jam_mulai']);
    $jam_selesai = mysqli_real_escape_string($conn, $_POST['jam_selesai']);
    $ruang       = mysqli_real_escape_string($conn, $_POST['ruang']);
    $semester    = mysqli_real_escape_string($conn, $_POST['semester']);
    $id_post     = (int) ($_POST['id'] ?? 0);

    if ($_POST['aksi'] === 'tambah') {
        mysqli_query($conn,
            "INSERT INTO jadwal (kelas, hari, jam_mulai, jam_selesai, mapel, nama_guru, ruang, semester)
             VALUES ('$kelas','$hari','$jam_mulai','$jam_selesai','$mapel','$nama_guru','$ruang','$semester')"
        );
        header("Location: jadwal.php?pesan=tambah_ok");
    } elseif ($_POST['aksi'] === 'edit' && $id_post > 0) {
        mysqli_query($conn,
            "UPDATE jadwal SET kelas='$kelas', hari='$hari', jam_mulai='$jam_mulai',
             jam_selesai='$jam_selesai', mapel='$mapel', nama_guru='$nama_guru',
             ruang='$ruang', semester='$semester' WHERE id=$id_post"
        );
        header("Location: jadwal.php?pesan=edit_ok");
    }
    exit();
}

// ----------------------------------------------------------------
// AMBIL DATA JADWAL DARI DB
// ----------------------------------------------------------------
$filter_kelas = isset($_GET['kelas']) ? mysqli_real_escape_string($conn, $_GET['kelas']) : '';
$filter_hari  = isset($_GET['hari'])  ? mysqli_real_escape_string($conn, $_GET['hari'])  : '';

$where = [];
if ($filter_kelas) $where[] = "kelas = '$filter_kelas'";
if ($filter_hari)  $where[] = "hari  = '$filter_hari'";
$where_sql = $where ? "WHERE " . implode(" AND ", $where) : "";

$jadwal_result = mysqli_query($conn,
    "SELECT * FROM jadwal $where_sql ORDER BY FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat'), jam_mulai"
);

// Ambil data kalender
$kalender_result = mysqli_query($conn, "SELECT * FROM kalender ORDER BY tanggal ASC");

// Pesan flash
$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal & Kalender – EduManage</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .tab-bar { display:flex; gap:4px; background:var(--bg); border-radius:var(--radius-sm); padding:4px; margin-bottom:24px; width:fit-content; }
    .tab-btn { padding:9px 20px; border-radius:6px; font-size:13px; font-weight:600; color:var(--text-muted); display:block; }
    .tab-btn:target, body:not(:has([id^="tab"]:target)) .tab-btn:first-child { background:var(--primary); color:#fff; }

    .tab-content { display:none; }
    #tab-jadwal:target ~ .tab-contents #content-jadwal,
    #tab-kalender:target ~ .tab-contents #content-kalender { display:block; }
    body:not(:has([id^="tab"]:target)) #content-jadwal { display:block; }

    .tab-panels > div { display:none; }
    .tab-panels > div:target { display:block; }

    .cal-month-nav { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
    .cal-month-nav h3 { font-size:18px; font-weight:700; color:var(--text); }
    .schedule-time { font-weight:700; color:var(--primary); font-size:13px; }

    /* Flash message */
    .flash { padding:12px 16px; border-radius:8px; margin-bottom:18px; font-size:14px; font-weight:500; }
    .flash-success { background:#e8f5e9; color:#2e7d32; border:1px solid #a5d6a7; }
    .flash-error   { background:#fce4ec; color:#c62828; border:1px solid #ef9a9a; }

    /* Edit form highlight */
    .edit-mode { border:2px solid var(--primary) !important; }
    .edit-badge { background:var(--primary); color:#fff; font-size:11px; padding:2px 8px; border-radius:4px; margin-left:8px; vertical-align:middle; }
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
      <a href="profil.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg> Profil Sekolah</a>
      <?php elseif ($role === 'guru'): ?>
      <a href="guru.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <?php elseif ($role === 'siswa'): ?>
      <a href="siswa.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <?php endif; ?>
      <a href="jadwal.php" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> Jadwal & Kalender</a>
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
      <div class="topbar-title">Jadwal & <span>Kalender</span></div>
      <div class="topbar-right">
        <span class="badge"><?= ucfirst($role) ?></span>
        <a href="logout.php" class="btn-logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg> Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Jadwal Pelajaran & Kalender Akademik</h2>
        <p>Atur jadwal pelajaran per kelas dan kelola kalender kegiatan sekolah.</p>
      </div>

      <?php if ($pesan === 'tambah_ok'): ?>
        <div class="flash flash-success"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Jadwal berhasil ditambahkan ke database.</div>
      <?php elseif ($pesan === 'edit_ok'): ?>
        <div class="flash flash-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg> Jadwal berhasil diperbarui.</div>
      <?php elseif ($pesan === 'hapus_ok'): ?>
        <div class="flash flash-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg> Jadwal berhasil dihapus.</div>
      <?php endif; ?>

      <?php if ($role === 'admin' || $role === 'guru'): ?>
      <div class="grid-2" style="margin-bottom:24px;">
        <!-- Form Tambah / Edit Jadwal -->
        <div class="card <?= $edit_data ? 'edit-mode' : '' ?>">
          <div class="card-title">
            <?= $edit_data ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg> Edit Jadwal Pelajaran <span class="edit-badge">Mode Edit</span>' : '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg> Tambah Jadwal Pelajaran' ?>
          </div>
          <form method="POST" action="jadwal.php">
            <input type="hidden" name="aksi"  value="<?= $edit_data ? 'edit' : 'tambah' ?>">
            <input type="hidden" name="id"    value="<?= $edit_data ? $edit_data['id'] : '' ?>">
            <div class="form-grid">
              <div class="form-group">
                <label>Kelas</label>
                <select name="kelas" required>
                  <option value="">-- Pilih Kelas --</option>
                  <?php
                  $kelas_list = [
                    'DKV'  => ['X DKV 1','X DKV 2','XI DKV 1','XI DKV 2','XII DKV 1','XII DKV 2'],
                    'Animasi' => ['X Animasi 1','XI Animasi 1','XII Animasi 1'],
                    'PPLG' => ['X PPLG 1','X PPLG 2','XI PPLG 1','XI PPLG 2','XII PPLG 1','XII PPLG 2'],
                    'TJKT' => ['X TJKT 1','XI TJKT 1','XII TJKT 1'],
                  ];
                  foreach ($kelas_list as $group => $items) {
                      echo "<optgroup label=\"$group\">";
                      foreach ($items as $k) {
                          $sel = ($edit_data && $edit_data['kelas'] === $k) ? 'selected' : '';
                          echo "<option $sel>$k</option>";
                      }
                      echo "</optgroup>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Hari</label>
                <select name="hari" required>
                  <option value="">-- Pilih Hari --</option>
                  <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat'] as $h): ?>
                    <option <?= ($edit_data && $edit_data['hari'] === $h) ? 'selected' : '' ?>><?= $h ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Mata Pelajaran</label>
                <input type="text" name="mapel" placeholder="Contoh: Matematika" required
                       value="<?= htmlspecialchars($edit_data['mapel'] ?? '') ?>">
              </div>
              <div class="form-group">
                <label>Guru Pengajar</label>
                <input type="text" name="nama_guru" placeholder="Nama guru"
                       value="<?= htmlspecialchars($edit_data['nama_guru'] ?? '') ?>">
              </div>
              <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" value="<?= $edit_data['jam_mulai'] ?? '07:00' ?>" required>
              </div>
              <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" value="<?= $edit_data['jam_selesai'] ?? '07:45' ?>" required>
              </div>
              <div class="form-group">
                <label>Ruang</label>
                <input type="text" name="ruang" placeholder="Contoh: Lab Komputer 1"
                       value="<?= htmlspecialchars($edit_data['ruang'] ?? '') ?>">
              </div>
              <div class="form-group">
                <label>Semester</label>
                <select name="semester">
                  <?php foreach (['Genap 2024/2025','Ganjil 2025/2026'] as $sem): ?>
                    <option <?= ($edit_data && $edit_data['semester'] === $sem) ? 'selected' : '' ?>><?= $sem ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> <?= $edit_data ? 'Simpan Perubahan' : 'Simpan Jadwal' ?></button>
              <?php if ($edit_data): ?>
                <a href="jadwal.php" class="btn btn-outline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Batal Edit</a>
              <?php else: ?>
                <button type="reset" class="btn btn-outline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg> Reset</button>
              <?php endif; ?>
            </div>
          </form>
        </div>

        <!-- Kalender bulan ini -->
        <div class="card">
          <div class="cal-month-nav">
            <h3><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> <?= date('F Y') ?></h3>
          </div>
          <?php
          $now        = new DateTime();
          $first_day  = new DateTime($now->format('Y-m-01'));
          $days_in_m  = (int) $now->format('t');
          $start_dow  = (int) $first_day->format('w'); // 0=Sun
          $today_d    = (int) $now->format('j');
          // Ambil tanggal event bulan ini
          $events_this_month = [];
          $ev_res = mysqli_query($conn,
              "SELECT DAY(tanggal) as d FROM kalender WHERE MONTH(tanggal)={$now->format('n')} AND YEAR(tanggal)={$now->format('Y')}"
          );
          while ($ev = mysqli_fetch_assoc($ev_res)) $events_this_month[] = (int)$ev['d'];
          ?>
          <div class="calendar-grid">
            <?php foreach (['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $dh): ?>
              <div class="cal-day-header"><?= $dh ?></div>
            <?php endforeach; ?>
            <?php for ($i = 0; $i < $start_dow; $i++): ?>
              <div class="cal-day empty"></div>
            <?php endfor; ?>
            <?php for ($d = 1; $d <= $days_in_m; $d++): ?>
              <?php
              $cls = 'cal-day';
              if ($d === $today_d) $cls .= ' today';
              if (in_array($d, $events_this_month)) $cls .= ' event';
              ?>
              <div class="<?= $cls ?>"><?= $d ?></div>
            <?php endfor; ?>
          </div>
          <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;"><div style="width:14px;height:14px;border-radius:4px;background:var(--primary);"></div> Hari ini</div>
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;"><div style="width:14px;height:14px;border-radius:4px;background:var(--accent-light);"></div> Ada kegiatan</div>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <!-- Jadwal Table -->
      <div class="card">
        <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Jadwal Pelajaran – Semua Kelas</div>
        <form method="GET" action="jadwal.php" style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap;">
          <select name="kelas" style="width:auto;" onchange="this.form.submit()">
            <option value="">-- Filter Kelas --</option>
            <?php
            $all_kelas = ['X DKV 1','X DKV 2','XI DKV 1','XI DKV 2','XII DKV 1','XII DKV 2',
                          'X Animasi 1','XI Animasi 1','XII Animasi 1',
                          'X PPLG 1','X PPLG 2','XI PPLG 1','XI PPLG 2','XII PPLG 1','XII PPLG 2',
                          'X TJKT 1','XI TJKT 1','XII TJKT 1'];
            foreach ($all_kelas as $k) {
                $sel = ($filter_kelas === $k) ? 'selected' : '';
                echo "<option $sel>$k</option>";
            }
            ?>
          </select>
          <select name="hari" style="width:auto;" onchange="this.form.submit()">
            <option value="">-- Filter Hari --</option>
            <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat'] as $h): ?>
              <option <?= ($filter_hari === $h) ? 'selected' : '' ?>><?= $h ?></option>
            <?php endforeach; ?>
          </select>
          <?php if ($filter_kelas || $filter_hari): ?>
            <a href="jadwal.php" class="btn btn-outline btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Reset Filter</a>
          <?php endif; ?>
        </form>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Ruang</th>
                <?php if ($role === 'admin' || $role === 'guru'): ?><th>Aksi</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($jadwal_result) === 0): ?>
                <tr class="empty-row">
                  <td colspan="<?= ($role === 'admin' || $role === 'guru') ? 7 : 6 ?>">
                    <span class="empty-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg></span>
                    Belum ada jadwal pelajaran.<br>
                    <?= ($role === 'admin' || $role === 'guru') ? 'Tambahkan jadwal menggunakan form di atas.' : 'Hubungi admin atau guru untuk informasi jadwal.' ?>
                  </td>
                </tr>
              <?php else: ?>
                <?php while ($row = mysqli_fetch_assoc($jadwal_result)): ?>
                <tr>
                  <td><strong><?= htmlspecialchars($row['hari']) ?></strong></td>
                  <td class="schedule-time"><?= substr($row['jam_mulai'],0,5) ?> – <?= substr($row['jam_selesai'],0,5) ?></td>
                  <td><?= htmlspecialchars($row['mapel']) ?></td>
                  <td><?= htmlspecialchars($row['nama_guru']) ?></td>
                  <td><?= htmlspecialchars($row['kelas']) ?></td>
                  <td><?= htmlspecialchars($row['ruang']) ?></td>
                  <?php if ($role === 'admin' || $role === 'guru'): ?>
                  <td>
                    <div style="display:flex;gap:6px;">
                      <a href="jadwal.php?edit=<?= $row['id'] ?>" class="btn btn-outline btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg> Edit</a>
                      <a href="jadwal.php?hapus=<?= $row['id'] ?>"
                         onclick="return confirm('Hapus jadwal ini?')"
                         class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg></a>
                    </div>
                  </td>
                  <?php endif; ?>
                </tr>
                <?php endwhile; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Kalender Akademik -->
      <div class="section-divider" style="margin-top:28px;"><h3>Kalender Akademik 2024/2025</h3></div>
      <div class="card">
        <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg> Agenda & Kegiatan Sekolah</div>
        <?php if ($role === 'admin'): ?>
        <!-- Form tambah agenda (hanya admin) -->
        <form method="POST" action="proses_kalender.php" style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px;align-items:flex-end;">
          <input type="hidden" name="aksi" value="tambah">
          <div class="form-group" style="margin:0;flex:1;min-width:140px;">
            <label>Tanggal</label>
            <input type="date" name="tanggal" required>
          </div>
          <div class="form-group" style="margin:0;flex:2;min-width:180px;">
            <label>Kegiatan</label>
            <input type="text" name="kegiatan" placeholder="Nama kegiatan" required>
          </div>
          <div class="form-group" style="margin:0;flex:1;min-width:140px;">
            <label>Keterangan</label>
            <input type="text" name="keterangan" placeholder="Contoh: Libur Nasional">
          </div>
          <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg> Tambah</button>
        </form>
        <?php endif; ?>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Keterangan</th>
                <?php if ($role === 'admin'): ?><th>Aksi</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($kalender_result) === 0): ?>
                <tr class="empty-row"><td colspan="<?= $role === 'admin' ? 4 : 3 ?>"><span class="empty-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg></span> Belum ada agenda.</td></tr>
              <?php else: ?>
                <?php while ($kal = mysqli_fetch_assoc($kalender_result)): ?>
                <tr>
                  <td><strong><?= date('d F Y', strtotime($kal['tanggal'])) ?></strong></td>
                  <td><?= htmlspecialchars($kal['kegiatan']) ?></td>
                  <td><span class="status status-izin"><?= htmlspecialchars($kal['keterangan']) ?></span></td>
                  <?php if ($role === 'admin'): ?>
                  <td>
                    <a href="proses_kalender.php?hapus=<?= $kal['id'] ?>"
                       onclick="return confirm('Hapus agenda ini?')"
                       class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg> Hapus</a>
                  </td>
                  <?php endif; ?>
                </tr>
                <?php endwhile; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
</body>
</html>
