<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Guru – EduManage</title>
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
      <a href="data-siswa.php" class="nav-item"><span class="icon">🎒</span> Data Siswa</a>
      <a href="data-guru.php" class="nav-item active"><span class="icon">👨‍🏫</span> Data Guru</a>
    </nav>
    <div class="sidebar-user">
      <div class="avatar">A</div>
      <div class="user-info"><small>Role</small><strong>Administrator</strong></div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-title">Data <span>Guru</span></div>
      <div class="topbar-right">
        <span class="badge">Admin</span>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Manajemen Data Guru</h2>
        <p>Tambah, edit, dan kelola data seluruh guru dan tenaga pendidik sekolah.</p>
      </div>

      <div class="info-box">
        <span class="info-icon">🔒</span>
        <div><strong>Akses Admin Only:</strong> Hanya Administrator yang dapat menambah, mengedit, dan menghapus data guru.</div>
      </div>

      <!-- Form Tambah Guru -->
      <div class="card" style="margin-bottom:24px;">
        <div class="card-title">➕ Tambah Data Guru / Tenaga Pendidik</div>
        <form>
          <div class="form-grid">
            <div class="form-group">
              <label>NIP (Nomor Induk Pegawai)</label>
              <input type="text" placeholder="Contoh: 198001012005011001">
            </div>
            <div class="form-group">
              <label>NUPTK</label>
              <input type="text" placeholder="Nomor Unik PTK (opsional)">
            </div>
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" placeholder="Nama lengkap beserta gelar">
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
                <option value="">-- Pilih --</option>
                <option>Islam</option>
                <option>Kristen Protestan</option>
                <option>Kristen Katolik</option>
                <option>Hindu</option>
                <option>Buddha</option>
                <option>Konghucu</option>
              </select>
            </div>
            <div class="form-group">
              <label>Pendidikan Terakhir</label>
              <select>
                <option value="">-- Pilih --</option>
                <option>S3 (Doktor)</option>
                <option>S2 (Magister)</option>
                <option>S1 (Sarjana)</option>
                <option>D4</option>
                <option>D3</option>
              </select>
            </div>
            <div class="form-group">
              <label>Mata Pelajaran Diampu</label>
              <input type="text" placeholder="Contoh: Matematika, Fisika">
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select>
                <option value="">-- Pilih --</option>
                <option>Guru Mata Pelajaran</option>
                <option>Guru BK</option>
                <option>Wali Kelas</option>
                <option>Ketua Jurusan</option>
                <option>Wakasek Kurikulum</option>
                <option>Wakasek Kesiswaan</option>
                <option>Wakasek Sarpras</option>
                <option>Wakasek Humas</option>
                <option>Kepala Sekolah</option>
              </select>
            </div>
            <div class="form-group">
              <label>Status Kepegawaian</label>
              <select>
                <option>PNS</option>
                <option>PPPK</option>
                <option>GTT (Guru Tidak Tetap)</option>
                <option>Honorer</option>
              </select>
            </div>
            <div class="form-group">
              <label>TMT (Mulai Bertugas)</label>
              <input type="date">
            </div>
            <div class="form-group">
              <label>No. HP / WA</label>
              <input type="tel" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" placeholder="email@contoh.com">
            </div>
            <div class="form-group full">
              <label>Alamat Lengkap</label>
              <textarea placeholder="Jl. Nama Jalan No. X, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi"></textarea>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Simpan Data Guru</button>
            <button type="reset" class="btn btn-outline">🔄 Reset Form</button>
          </div>
        </form>
      </div>

      <!-- Tabel Data Guru -->
      <div class="card">
        <div class="card-title">📋 Daftar Seluruh Guru & Tenaga Pendidik</div>
        <div style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap;align-items:center;">
          <input type="text" placeholder="🔍 Cari nama / NIP..." style="width:220px;">
          <select style="width:auto;">
            <option>-- Semua Jabatan --</option>
            <option>Guru Mata Pelajaran</option>
            <option>Wali Kelas</option>
            <option>Ketua Jurusan</option>
            <option>Kepala Sekolah</option>
          </select>
          <select style="width:auto;">
            <option>-- Status Kepegawaian --</option>
            <option>PNS</option>
            <option>PPPK</option>
            <option>GTT</option>
            <option>Honorer</option>
          </select>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>Mata Pelajaran</th>
                <th>Pendidikan</th>
                <th>Status</th>
                <th>No. HP</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="empty-row">
                <td colspan="9">
                  <span class="empty-icon">👨‍🏫</span>
                  Belum ada data guru terdaftar.<br>
                  Gunakan form di atas untuk menambahkan data guru.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:16px;color:var(--text-muted);font-size:13px;">
          <span>Menampilkan 0 dari 0 guru</span>
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
