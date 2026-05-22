<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nilai Siswa – EduManage</title>
  <link rel="stylesheet" href="css/style.css">
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
      <a href="admin.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg> Dashboard</a>
      <a href="profil.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg> Profil Sekolah</a>
      <a href="jadwal.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg> Jadwal & Kalender</a>
      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Nilai Siswa</a>
      <a href="absensi.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Absensi</a>
      <div class="nav-label">Data</div>
      <a href="data-siswa.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg> Data Siswa</a>
      <a href="data-guru.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Data Guru</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar">A</div>
      <div class="user-info"><small>Role</small><strong>Administrator</strong></div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Manajemen <span>Nilai</span></div>
      <div class="topbar-right">
        <span class="badge">Admin</span>
        <a href="logout.php" class="btn-logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg> Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Input & Rekap Nilai Siswa</h2>
        <p>Input nilai harian, ulangan, UTS, dan UAS siswa per mata pelajaran.</p>
      </div>

      <div class="info-box">
        <span class="info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
        <div><strong>Akses Terbatas:</strong> Hanya Admin dan Guru yang dapat mengisi nilai. Siswa hanya dapat melihat (read-only).</div>
      </div>

      <div class="grid-2" style="margin-bottom:24px;">
        <!-- Form Input Nilai -->
        <div class="card">
          <div class="card-title">📝 Input Nilai Siswa</div>
          <form>
            <div class="form-grid">
              <div class="form-group">
                <label>Kelas</label>
                <select>
                  <option value="">-- Pilih Kelas --</option>
                  <optgroup label="DKV"><option>X DKV 1</option><option>X DKV 2</option><option>XI DKV 1</option><option>XI DKV 2</option><option>XII DKV 1</option></optgroup>
                  <optgroup label="Animasi"><option>X Animasi 1</option><option>XI Animasi 1</option><option>XII Animasi 1</option></optgroup>
                  <optgroup label="PPLG"><option>X PPLG 1</option><option>X PPLG 2</option><option>XI PPLG 1</option><option>XII PPLG 1</option></optgroup>
                  <optgroup label="TJKT"><option>X TJKT 1</option><option>XI TJKT 1</option><option>XII TJKT 1</option></optgroup>
                </select>
              </div>
              <div class="form-group">
                <label>Mata Pelajaran</label>
                <select>
                  <option value="">-- Pilih Mapel --</option>
                  <option>Matematika</option>
                  <option>Bahasa Indonesia</option>
                  <option>Bahasa Inggris</option>
                  <option>Fisika</option>
                  <option>Kimia</option>
                  <option>Sejarah Indonesia</option>
                  <option>PPKN</option>
                  <option>Seni Budaya</option>
                  <option>PJOK</option>
                  <option>Produktif Kejuruan</option>
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
                <label>Jenis Penilaian</label>
                <select>
                  <option>Tugas Harian</option>
                  <option>Ulangan Harian</option>
                  <option>UTS (Ujian Tengah Semester)</option>
                  <option>UAS (Ujian Akhir Semester)</option>
                  <option>Praktik</option>
                  <option>Proyek</option>
                </select>
              </div>
              <div class="form-group">
                <label>Semester</label>
                <select>
                  <option>Ganjil 2024/2025</option>
                  <option>Genap 2024/2025</option>
                  <option>Ganjil 2025/2026</option>
                </select>
              </div>
              <div class="form-group">
                <label>Nilai (0 – 100)</label>
                <input type="number" min="0" max="100" placeholder="Masukkan nilai">
              </div>
              <div class="form-group">
                <label>Tanggal Penilaian</label>
                <input type="date">
              </div>
              <div class="form-group full">
                <label>Catatan (Opsional)</label>
                <textarea placeholder="Catatan tambahan untuk siswa ini..."></textarea>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Simpan Nilai</button>
              <button type="reset" class="btn btn-outline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg> Reset Form</button>
            </div>
          </form>
        </div>

        <!-- Keterangan Nilai -->
        <div>
          <div class="card" style="margin-bottom:16px;">
            <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Kategori Nilai</div>
            <table>
              <thead>
                <tr><th>Rentang</th><th>Huruf</th><th>Predikat</th></tr>
              </thead>
              <tbody>
                <tr><td>90 – 100</td><td><strong style="color:#2E7D32;">A</strong></td><td><span class="status status-hadir">Sangat Baik</span></td></tr>
                <tr><td>80 – 89</td><td><strong style="color:#1565C0;">B</strong></td><td><span class="status status-izin">Baik</span></td></tr>
                <tr><td>70 – 79</td><td><strong style="color:#F57F17;">C</strong></td><td><span class="status status-sakit">Cukup</span></td></tr>
                <tr><td>60 – 69</td><td><strong style="color:#C62828;">D</strong></td><td><span class="status status-alfa">Kurang</span></td></tr>
                <tr><td>&lt; 60</td><td><strong style="color:#C62828;">E</strong></td><td><span class="status status-alfa">Tidak Lulus</span></td></tr>
              </tbody>
            </table>
          </div>

          <div class="card">
            <div class="card-title">📈 Bobot Penilaian</div>
            <div style="display:flex;flex-direction:column;gap:10px;">
              <div style="display:flex;justify-content:space-between;align-items:center;padding:10px;background:var(--bg);border-radius:8px;">
                <span style="font-size:14px;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Tugas Harian</span>
                <strong style="color:var(--primary);">20%</strong>
              </div>
              <div style="display:flex;justify-content:space-between;align-items:center;padding:10px;background:var(--bg);border-radius:8px;">
                <span style="font-size:14px;">📝 Ulangan Harian</span>
                <strong style="color:var(--primary);">20%</strong>
              </div>
              <div style="display:flex;justify-content:space-between;align-items:center;padding:10px;background:var(--bg);border-radius:8px;">
                <span style="font-size:14px;">📄 UTS</span>
                <strong style="color:var(--primary);">30%</strong>
              </div>
              <div style="display:flex;justify-content:space-between;align-items:center;padding:10px;background:var(--bg);border-radius:8px;">
                <span style="font-size:14px;">📜 UAS</span>
                <strong style="color:var(--primary);">30%</strong>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Rekap Nilai -->
      <div class="card">
        <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Rekap Nilai Siswa</div>
        <div style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap;">
          <select style="width:auto;">
            <option>-- Pilih Kelas --</option>
            <option>X DKV 1</option><option>XI PPLG 1</option><option>XII TJKT 1</option>
          </select>
          <select style="width:auto;">
            <option>-- Pilih Mapel --</option>
            <option>Matematika</option><option>Bahasa Indonesia</option>
          </select>
          <select style="width:auto;">
            <option>-- Pilih Semester --</option>
            <option>Genap 2024/2025</option><option>Ganjil 2024/2025</option>
          </select>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Tugas</th>
                <th>UH</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Rata-rata</th>
                <th>Predikat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="empty-row">
                <td colspan="12">
                  <span class="empty-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg></span>
                  Belum ada data nilai.<br>
                  Gunakan form di atas untuk mengisi nilai siswa.
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
