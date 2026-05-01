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

    /* Workaround: use anchors for tabs */
    .tab-panels > div { display:none; }
    .tab-panels > div:target { display:block; }

    .cal-month-nav { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
    .cal-month-nav h3 { font-size:18px; font-weight:700; color:var(--text); }
    .schedule-time { font-weight:700; color:var(--primary); font-size:13px; }
  </style>
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
      <a href="jadwal.php" class="nav-item active"><span class="icon">📅</span> Jadwal & Kalender</a>
      <div class="nav-label">Akademik</div>
      <a href="nilai.php" class="nav-item"><span class="icon">📊</span> Nilai Siswa</a>
      <a href="absensi.php" class="nav-item"><span class="icon">✅</span> Absensi</a>
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
      <div class="topbar-title">Jadwal & <span>Kalender</span></div>
      <div class="topbar-right">
        <span class="badge">Admin</span>
        <a href="logout.php" class="btn-logout">🚪 Logout</a>
      </div>
    </header>

    <div class="page-content">
      <div class="page-header">
        <h2>Jadwal Pelajaran & Kalender Akademik</h2>
        <p>Atur jadwal pelajaran per kelas dan kelola kalender kegiatan sekolah.</p>
      </div>

      <div class="grid-2" style="margin-bottom:24px;">
        <!-- Form Tambah Jadwal -->
        <div class="card">
          <div class="card-title">➕ Tambah Jadwal Pelajaran</div>
          <form>
            <div class="form-grid">
              <div class="form-group">
                <label>Kelas</label>
                <select>
                  <option value="">-- Pilih Kelas --</option>
                  <optgroup label="DKV">
                    <option>X DKV 1</option><option>X DKV 2</option>
                    <option>XI DKV 1</option><option>XI DKV 2</option>
                    <option>XII DKV 1</option><option>XII DKV 2</option>
                  </optgroup>
                  <optgroup label="Animasi">
                    <option>X Animasi 1</option><option>XI Animasi 1</option><option>XII Animasi 1</option>
                  </optgroup>
                  <optgroup label="PPLG">
                    <option>X PPLG 1</option><option>X PPLG 2</option>
                    <option>XI PPLG 1</option><option>XI PPLG 2</option>
                    <option>XII PPLG 1</option><option>XII PPLG 2</option>
                  </optgroup>
                  <optgroup label="TJKT">
                    <option>X TJKT 1</option><option>XI TJKT 1</option><option>XII TJKT 1</option>
                  </optgroup>
                </select>
              </div>
              <div class="form-group">
                <label>Hari</label>
                <select>
                  <option value="">-- Pilih Hari --</option>
                  <option>Senin</option><option>Selasa</option><option>Rabu</option>
                  <option>Kamis</option><option>Jumat</option>
                </select>
              </div>
              <div class="form-group">
                <label>Mata Pelajaran</label>
                <input type="text" placeholder="Contoh: Matematika">
              </div>
              <div class="form-group">
                <label>Guru Pengajar</label>
                <input type="text" placeholder="Nama guru">
              </div>
              <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" value="07:00">
              </div>
              <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" value="07:45">
              </div>
              <div class="form-group">
                <label>Ruang</label>
                <input type="text" placeholder="Contoh: Lab Komputer 1">
              </div>
              <div class="form-group">
                <label>Semester</label>
                <select>
                  <option>Genap 2024/2025</option>
                  <option>Ganjil 2025/2026</option>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">💾 Simpan Jadwal</button>
              <button type="reset" class="btn btn-outline">🔄 Reset</button>
            </div>
          </form>
        </div>

        <!-- Kalender April 2025 -->
        <div class="card">
          <div class="cal-month-nav">
            <h3>📅 April 2025</h3>
            <div style="display:flex;gap:8px;">
              <a href="#" class="btn btn-outline btn-sm">◀ Prev</a>
              <a href="#" class="btn btn-outline btn-sm">Next ▶</a>
            </div>
          </div>
          <div class="calendar-grid">
            <div class="cal-day-header">Min</div>
            <div class="cal-day-header">Sen</div>
            <div class="cal-day-header">Sel</div>
            <div class="cal-day-header">Rab</div>
            <div class="cal-day-header">Kam</div>
            <div class="cal-day-header">Jum</div>
            <div class="cal-day-header">Sab</div>
            <!-- April 2025: starts Tuesday -->
            <div class="cal-day empty"></div>
            <div class="cal-day empty"></div>
            <div class="cal-day">1</div>
            <div class="cal-day">2</div>
            <div class="cal-day">3</div>
            <div class="cal-day">4</div>
            <div class="cal-day">5</div>
            <div class="cal-day">6</div>
            <div class="cal-day">7</div>
            <div class="cal-day">8</div>
            <div class="cal-day">9</div>
            <div class="cal-day">10</div>
            <div class="cal-day">11</div>
            <div class="cal-day">12</div>
            <div class="cal-day">13</div>
            <div class="cal-day">14</div>
            <div class="cal-day">15</div>
            <div class="cal-day">16</div>
            <div class="cal-day">17</div>
            <div class="cal-day">18</div>
            <div class="cal-day event">19</div>
            <div class="cal-day">20</div>
            <div class="cal-day">21</div>
            <div class="cal-day">22</div>
            <div class="cal-day">23</div>
            <div class="cal-day">24</div>
            <div class="cal-day">25</div>
            <div class="cal-day">26</div>
            <div class="cal-day today">27</div>
            <div class="cal-day">28</div>
            <div class="cal-day">29</div>
            <div class="cal-day">30</div>
            <div class="cal-day empty"></div>
            <div class="cal-day empty"></div>
            <div class="cal-day empty"></div>
          </div>
          <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;"><div style="width:14px;height:14px;border-radius:4px;background:var(--primary);"></div> Hari ini</div>
            <div style="display:flex;align-items:center;gap:6px;font-size:12px;"><div style="width:14px;height:14px;border-radius:4px;background:var(--accent-light);"></div> Ada kegiatan</div>
          </div>
        </div>
      </div>

      <!-- Jadwal Table -->
      <div class="card">
        <div class="card-title">📋 Jadwal Pelajaran – Semua Kelas</div>
        <div style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap;">
          <select style="width:auto;">
            <option>-- Filter Kelas --</option>
            <option>X DKV 1</option><option>XI PPLG 1</option><option>XII TJKT 1</option>
          </select>
          <select style="width:auto;">
            <option>-- Filter Hari --</option>
            <option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option>
          </select>
        </div>
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
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="empty-row">
                <td colspan="7">
                  <span class="empty-icon">📅</span>
                  Belum ada jadwal pelajaran.<br>
                  Tambahkan jadwal menggunakan form di atas.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Kalender Akademik -->
      <div class="section-divider" style="margin-top:28px;"><h3>Kalender Akademik 2024/2025</h3></div>
      <div class="card">
        <div class="card-title">📆 Agenda & Kegiatan Sekolah</div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr><th>Tanggal</th><th>Kegiatan</th><th>Keterangan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>19 April 2025</strong></td>
                <td>Isra Mi'raj Nabi Muhammad SAW</td>
                <td><span class="status status-izin">Libur Nasional</span></td>
                <td>
                  <button class="btn btn-danger btn-sm">🗑️ Hapus</button>
                </td>
              </tr>
              <tr>
                <td><strong>01 Mei 2025</strong></td>
                <td>Hari Buruh Internasional</td>
                <td><span class="status status-izin">Libur Nasional</span></td>
                <td>
                  <button class="btn btn-danger btn-sm">🗑️ Hapus</button>
                </td>
              </tr>
              <tr>
                <td><strong>29 Mei 2025</strong></td>
                <td>Kenaikan Yesus Kristus</td>
                <td><span class="status status-izin">Libur Nasional</span></td>
                <td>
                  <button class="btn btn-danger btn-sm">🗑️ Hapus</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="form-actions" style="margin-top:16px;">
          <button class="btn btn-primary">➕ Tambah Agenda</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
