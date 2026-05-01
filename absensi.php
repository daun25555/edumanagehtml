<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi – EduManage</title>
  <link rel="stylesheet" href="css/style.css">
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
      <a href="profil.php" class="nav-item"><span class="icon">🏫</span> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><span class="icon">📅</span> Jadwal & Kalender</a>
      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><span class="icon">📊</span> Nilai Siswa</a>
      <a href="absensi.php" class="nav-item active"><span class="icon">✅</span> Absensi</a>
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
      <div class="topbar-title">Manajemen <span>Absensi</span></div>
      <div class="topbar-right">
        <span class="badge">Admin</span>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Absensi Siswa</h2>
        <p>Input dan rekap data kehadiran siswa per kelas dan per hari.</p>
      </div>

      <div class="info-box">
        <span class="info-icon">🔒</span>
        <div><strong>Akses Terbatas:</strong> Hanya Admin dan Guru yang dapat mengisi absensi. Siswa hanya dapat melihat rekap kehadiran mereka sendiri.</div>
      </div>

      <div class="grid-2" style="margin-bottom:24px;">
        <!-- Form Input Absensi -->
        <div class="card">
          <div class="card-title">📝 Input Absensi Harian</div>
          <form>
            <div class="form-grid">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" value="2025-04-27">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select>
                  <option value="">-- Pilih Kelas --</option>
                  <optgroup label="DKV"><option>X DKV 1</option><option>X DKV 2</option><option>XI DKV 1</option><option>XII DKV 1</option></optgroup>
                  <optgroup label="Animasi"><option>X Animasi 1</option><option>XI Animasi 1</option><option>XII Animasi 1</option></optgroup>
                  <optgroup label="PPLG"><option>X PPLG 1</option><option>X PPLG 2</option><option>XI PPLG 1</option><option>XII PPLG 1</option></optgroup>
                  <optgroup label="TJKT"><option>X TJKT 1</option><option>XI TJKT 1</option><option>XII TJKT 1</option></optgroup>
                </select>
              </div>
              <div class="form-group">
                <label>NISN Siswa</label>
                <input type="text" placeholder="Masukkan NISN">
              </div>
              <div class="form-group">
                <label>Nama Siswa</label>
                <input type="text" placeholder="Nama lengkap siswa">
              </div>
              <div class="form-group">
                <label>Status Kehadiran</label>
                <select>
                  <option value="hadir">✅ Hadir</option>
                  <option value="sakit">🤒 Sakit</option>
                  <option value="izin">📋 Izin</option>
                  <option value="alfa">❌ Alfa (Tanpa Keterangan)</option>
                </select>
              </div>
              <div class="form-group">
                <label>Mata Pelajaran / Jam</label>
                <select>
                  <option>Jam 1 (07:00 – 07:45)</option>
                  <option>Jam 2 (07:45 – 08:30)</option>
                  <option>Jam 3 (08:30 – 09:15)</option>
                  <option>Jam 4 (09:30 – 10:15)</option>
                  <option>Jam 5 (10:15 – 11:00)</option>
                  <option>Jam 6 (11:00 – 11:45)</option>
                  <option>Jam 7 (12:30 – 13:15)</option>
                  <option>Jam 8 (13:15 – 14:00)</option>
                </select>
              </div>
              <div class="form-group full">
                <label>Keterangan</label>
                <textarea placeholder="Contoh: Surat dari orang tua / keterangan dokter..."></textarea>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">💾 Simpan Absensi</button>
              <button type="reset" class="btn btn-outline">🔄 Reset</button>
            </div>
          </form>
        </div>

        <!-- Ringkasan Hari Ini -->
        <div>
          <div class="card" style="margin-bottom:16px;">
            <div class="card-title">📊 Ringkasan Kehadiran Hari Ini</div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
              <div style="background:#E8F5E9;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:800;color:#2E7D32;">—</div>
                <div style="font-size:12px;color:#2E7D32;font-weight:600;">✅ Hadir</div>
              </div>
              <div style="background:#FFF3E0;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:800;color:#E65100;">—</div>
                <div style="font-size:12px;color:#E65100;font-weight:600;">🤒 Sakit</div>
              </div>
              <div style="background:#E3F2FD;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:800;color:#01579B;">—</div>
                <div style="font-size:12px;color:#01579B;font-weight:600;">📋 Izin</div>
              </div>
              <div style="background:#FFEBEE;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:800;color:#C62828;">—</div>
                <div style="font-size:12px;color:#C62828;font-weight:600;">❌ Alfa</div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-title">📅 Filter Rekap</div>
            <div style="display:flex;flex-direction:column;gap:12px;">
              <div class="form-group">
                <label>Bulan & Tahun</label>
                <input type="month" value="2025-04">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select>
                  <option value="">-- Semua Kelas --</option>
                  <option>X DKV 1</option><option>XI PPLG 1</option><option>XII TJKT 1</option>
                </select>
              </div>
              <button class="btn btn-primary">🔍 Tampilkan Rekap</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Rekap Absensi -->
      <div class="card">
        <div class="card-title">📋 Rekap Absensi Siswa</div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Mata Pelajaran</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="empty-row">
                <td colspan="9">
                  <span class="empty-icon">✅</span>
                  Belum ada data absensi.<br>
                  Gunakan form di atas untuk mengisi kehadiran siswa.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Rekap Bulanan Per Siswa -->
      <div class="section-divider" style="margin-top:28px;"><h3>Rekap Kehadiran Bulanan</h3></div>
      <div class="card">
        <div class="card-title">📊 Persentase Kehadiran per Siswa (Bulan April 2025)</div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alfa</th>
                <th>Total</th>
                <th>% Hadir</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="empty-row">
                <td colspan="11">
                  <span class="empty-icon">📊</span>
                  Belum ada rekap absensi untuk bulan ini.
                </td>
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
