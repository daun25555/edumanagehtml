<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa – EduManage</title>
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
      <a href="nilai.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="18" x2="18" y1="20" y2="10"/><line x1="12" x2="12" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="14"/></svg> Nilai Siswa</a>
      <a href="absensi.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Absensi</a>
      <div class="nav-label">Data</div>
      <a href="data-siswa.php" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg> Data Siswa</a>
      <a href="data-guru.php" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Data Guru</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar">A</div>
      <div class="user-info"><small>Role</small><strong>Administrator</strong></div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Data <span>Siswa</span></div>
      <div class="topbar-right">
        <span class="badge">Admin</span>
        <a href="logout.php" class="btn-logout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg> Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Manajemen Data Siswa</h2>
        <p>Tambah, edit, dan kelola data lengkap seluruh siswa sekolah.</p>
      </div>

      <div class="info-box">
        <span class="info-icon"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
        <div><strong>Akses Admin Only:</strong> Hanya Administrator yang dapat menambah, mengedit, dan menghapus data siswa.</div>
      </div>

      <!-- Form Tambah Siswa -->
      <div class="card" style="margin-bottom:24px;">
        <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg> Tambah Data Siswa Baru</div>
        <form>
          <div class="form-grid">
            <div class="form-group">
              <label>NISN</label>
              <input type="text" placeholder="Contoh: 0012345678">
            </div>
            <div class="form-group">
              <label>NIS (Nomor Induk Sekolah)</label>
              <input type="text" placeholder="Nomor induk sekolah lokal">
            </div>
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" placeholder="Nama lengkap siswa">
            </div>
            <div class="form-group">
              <label>Nama Panggilan</label>
              <input type="text" placeholder="Nama panggilan">
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select>
                <option value="">-- Pilih --</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" placeholder="Kota tempat lahir">
            </div>
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date">
            </div>
            <div class="form-group">
              <label>Agama</label>
              <select>
                <option value="">-- Pilih Agama --</option>
                <option>Islam</option>
                <option>Kristen Protestan</option>
                <option>Kristen Katolik</option>
                <option>Hindu</option>
                <option>Buddha</option>
                <option>Konghucu</option>
              </select>
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <select>
                <option value="">-- Pilih Kelas --</option>
                <optgroup label="DKV"><option>X DKV 1</option><option>X DKV 2</option><option>XI DKV 1</option><option>XI DKV 2</option><option>XII DKV 1</option><option>XII DKV 2</option></optgroup>
                <optgroup label="Animasi"><option>X Animasi 1</option><option>XI Animasi 1</option><option>XII Animasi 1</option></optgroup>
                <optgroup label="PPLG"><option>X PPLG 1</option><option>X PPLG 2</option><option>XI PPLG 1</option><option>XI PPLG 2</option><option>XII PPLG 1</option></optgroup>
                <optgroup label="TJKT"><option>X TJKT 1</option><option>XI TJKT 1</option><option>XII TJKT 1</option></optgroup>
              </select>
            </div>
            <div class="form-group">
              <label>Tahun Masuk</label>
              <select>
                <option>2025/2026</option>
                <option>2024/2025</option>
                <option>2023/2024</option>
                <option>2022/2023</option>
              </select>
            </div>
            <div class="form-group">
              <label>No. HP / WA Siswa</label>
              <input type="tel" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
              <label>Email Siswa</label>
              <input type="email" placeholder="email@contoh.com">
            </div>
            <div class="form-group full">
              <label>Alamat Lengkap</label>
              <textarea placeholder="Jl. Nama Jalan No. X, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi"></textarea>
            </div>

            <!-- Data Orang Tua -->
            <div class="form-group full">
              <div style="background:var(--bg);border-radius:var(--radius-sm);padding:12px 16px;margin:4px 0;">
                <strong style="font-size:13px;color:var(--primary);">👨‍👩‍👧 Data Orang Tua / Wali</strong>
              </div>
            </div>
            <div class="form-group">
              <label>Nama Ayah</label>
              <input type="text" placeholder="Nama ayah kandung">
            </div>
            <div class="form-group">
              <label>Nama Ibu</label>
              <input type="text" placeholder="Nama ibu kandung">
            </div>
            <div class="form-group">
              <label>Pekerjaan Orang Tua</label>
              <input type="text" placeholder="Pekerjaan ayah/ibu">
            </div>
            <div class="form-group">
              <label>No. HP Orang Tua / Wali</label>
              <input type="tel" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select>
                <option>Aktif</option>
                <option>Tidak Aktif</option>
                <option>Alumni</option>
                <option>Pindah Sekolah</option>
              </select>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Simpan Data Siswa</button>
            <button type="reset" class="btn btn-outline"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg> Reset Form</button>
          </div>
        </form>
      </div>

      <!-- Tabel Data Siswa -->
      <div class="card">
        <div class="card-title"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg> Daftar Seluruh Siswa</div>
        <div style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap;align-items:center;">
          <input type="text" placeholder="🔍 Cari nama / NISN..." style="width:220px;">
          <select style="width:auto;">
            <option>-- Semua Kelas --</option>
            <option>X DKV 1</option><option>XI PPLG 1</option><option>XII TJKT 1</option>
          </select>
          <select style="width:auto;">
            <option>-- Semua Status --</option>
            <option>Aktif</option><option>Alumni</option><option>Pindah</option>
          </select>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>No. HP</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="empty-row">
                <td colspan="10">
                  <span class="empty-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg></span>
                  Belum ada data siswa terdaftar.<br>
                  Gunakan form di atas untuk menambahkan data siswa.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:16px;color:var(--text-muted);font-size:13px;">
          <span>Menampilkan 0 dari 0 siswa</span>
          <div style="display:flex;gap:8px;">
            <button class="btn btn-outline btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><polyline points="15 18 9 12 15 6"/></svg> Prev</button>
            <button class="btn btn-outline btn-sm">Next <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><polyline points="9 18 15 12 9 6"/></svg></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
