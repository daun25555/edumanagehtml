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
      <a href="absensi.php" class="nav-item"><span class="icon">✅</span> Absensi</a>
      <div class="nav-label">Data</div>
      <a href="data-siswa.php" class="nav-item active"><span class="icon">🎒</span> Data Siswa</a>
      <a href="data-guru.php" class="nav-item"><span class="icon">👨‍🏫</span> Data Guru</a>
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
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Manajemen Data Siswa</h2>
        <p>Tambah, edit, dan kelola data lengkap seluruh siswa sekolah.</p>
      </div>

      <div class="info-box">
        <span class="info-icon">🔒</span>
        <div><strong>Akses Admin Only:</strong> Hanya Administrator yang dapat menambah, mengedit, dan menghapus data siswa.</div>
      </div>

      <!-- Form Tambah Siswa -->
      <div class="card" style="margin-bottom:24px;">
        <div class="card-title">➕ Tambah Data Siswa Baru</div>
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
            <button type="submit" class="btn btn-primary">💾 Simpan Data Siswa</button>
            <button type="reset" class="btn btn-outline">🔄 Reset Form</button>
          </div>
        </form>
      </div>

      <!-- Tabel Data Siswa -->
      <div class="card">
        <div class="card-title">📋 Daftar Seluruh Siswa</div>
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
                  <span class="empty-icon">🎒</span>
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
            <button class="btn btn-outline btn-sm">◀ Prev</button>
            <button class="btn btn-outline btn-sm">Next ▶</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
