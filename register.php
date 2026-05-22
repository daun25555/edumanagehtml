<?php
session_start();
// Jika sudah login, langsung redirect
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin')      header("Location: admin.php");
    elseif ($_SESSION['role'] === 'guru')   header("Location: guru.php");
    else                                     header("Location: siswa.php");
    exit();
}

// Ambil pesan error/sukses dari proses_register
$error  = $_GET['error']  ?? '';
$sukses = $_GET['sukses'] ?? '';
$old    = [
    'role'     => $_GET['role']     ?? 'guru',
    'nama'     => htmlspecialchars($_GET['nama']     ?? ''),
    'username' => htmlspecialchars($_GET['username'] ?? ''),
    'nip'      => htmlspecialchars($_GET['nip']      ?? ''),
    'nisn'     => htmlspecialchars($_GET['nisn']     ?? ''),
    'kelas'    => htmlspecialchars($_GET['kelas']    ?? ''),
    'email'    => htmlspecialchars($_GET['email']    ?? ''),
];

$error_msg = match($error) {
    'username_ada'   => '❌ Username sudah digunakan, coba yang lain.',
    'password_lemah' => '❌ Password minimal 6 karakter.',
    'password_beda'  => '❌ Konfirmasi password tidak cocok.',
    'field_kosong'   => '❌ Semua field wajib diisi.',
    'db_gagal'       => '❌ Gagal menyimpan data. Coba lagi.',
    default          => '',
};
$sukses_msg = $sukses === 'ok' ? '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg-icon"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg> Akun berhasil dibuat! Silakan login.' : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun – EduManage</title>
  <meta name="description" content="Daftar akun baru di sistem manajemen sekolah EduManage">
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* ── Tab Role ── */
    .role-panels { margin-bottom: 20px; }
    .role-panel  { display: none; }
    #rp-guru:target, #rp-siswa:target, #rp-admin:target { display: block; }
    .role-panels:not(:has(:target)) #rp-<?= $old['role'] === 'siswa' ? 'siswa' : ($old['role'] === 'admin' ? 'admin' : 'guru') ?> { display: block; }

    /* Warna tab aktif via :has() */
    body:has(#rp-admin:target) .tab-admin,
    <?php if ($old['role'] === 'admin' && !in_array($error.$sukses, ['','ok'])): ?>body:not(:has([id^="rp"]:target)) .tab-admin,<?php endif; ?>
    body:not(:has([id^="rp"]:target)) .tab-<?= $old['role'] ?> { background: var(--primary); color: #fff; box-shadow: 0 2px 8px rgba(21,101,192,.25); }
    body:has(#rp-guru:target)   .tab-guru   { background: #0288D1; color: #fff; box-shadow: 0 2px 8px rgba(2,136,209,.25); }
    body:has(#rp-siswa:target)  .tab-siswa  { background: #43A047; color: #fff; box-shadow: 0 2px 8px rgba(67,160,71,.25); }

    /* Layout login-page sudah ada di style.css, kita reuse */
    .back-to-home {
      display: inline-flex; align-items: center; gap: 6px;
      color: rgba(255,255,255,.75); font-size: 13px; font-weight: 500;
      margin-bottom: 20px; transition: color .2s; position: relative; z-index: 10;
    }
    .back-to-home:hover { color: #fff; }

    .school-name {
      text-align: center; color: rgba(255,255,255,.70); font-size: 12px;
      margin-top: 24px; position: relative; z-index: 10;
    }

    /* Alert box */
    .alert { padding: 11px 14px; border-radius: 8px; font-size: 13px; margin-bottom: 16px; font-weight: 500; }
    .alert-error   { background: #FFEBEE; color: #C62828; border: 1px solid #EF9A9A; }
    .alert-success { background: #E8F5E9; color: #2E7D32; border: 1px solid #A5D6A7; }

    /* Divider */
    .or-divider { display: flex; align-items: center; gap: 10px; color: var(--text-muted); font-size: 12px; margin: 18px 0 16px; }
    .or-divider::before, .or-divider::after { content:''; flex:1; height:1px; background:var(--border); }

    /* Sudah punya akun link */
    .login-link { text-align: center; font-size: 13px; color: var(--text-muted); }
    .login-link a { color: var(--primary); font-weight: 600; }

    /* Password strength indicator */
    .pw-strength { height: 4px; border-radius: 4px; margin-top: 6px; transition: width .3s, background .3s; width: 0; background: #e53935; }

    /* Hint text */
    .field-hint { font-size: 11px; color: var(--text-muted); margin-top: 4px; }
  </style>
</head>
<body>
<div class="login-page">
  <div>
    <a href="landing.php" class="back-to-home">← Kembali ke Beranda</a>

    <div class="login-container">
      <div class="login-logo">
        <div class="logo-circle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
        <h1>Edu<span>Manage</span></h1>
        <p>Daftar Akun Baru</p>
      </div>

      <!-- Role Tabs -->
      <div class="role-tabs">
        <a href="#rp-admin" class="role-tab tab-admin"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.518l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg> Admin</a>
        <a href="#rp-guru"  class="role-tab tab-guru" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg> Guru</a>
        <a href="#rp-siswa" class="role-tab tab-siswa"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg> Siswa</a>
      </div>

      <!-- Alert -->
      <?php if ($error_msg): ?>
        <div class="alert alert-error"><?= $error_msg ?></div>
      <?php elseif ($sukses_msg): ?>
        <div class="alert alert-success"><?= $sukses_msg ?></div>
      <?php endif; ?>

      <!-- ═══════════════ PANEL ADMIN ═══════════════ -->
      <div class="role-panels">
        <form id="rp-admin" class="role-panel login-form" action="proses_register.php" method="POST" novalidate>
          <input type="hidden" name="role" value="admin">

          <div class="form-group">
            <label for="a-nama">Nama Lengkap</label>
            <input type="text" id="a-nama" name="nama" placeholder="Nama lengkap admin"
                   value="<?= $old['role']==='admin' ? $old['nama'] : '' ?>" required>
          </div>
          <div class="form-group">
            <label for="a-user">Username</label>
            <input type="text" id="a-user" name="username" placeholder="Buat username unik"
                   value="<?= $old['role']==='admin' ? $old['username'] : '' ?>" required>
            <div class="field-hint">Huruf kecil, angka, tanpa spasi</div>
          </div>
          <div class="form-group">
            <label for="a-email">Email (opsional)</label>
            <input type="email" id="a-email" name="email" placeholder="email@sekolah.sch.id"
                   value="<?= $old['role']==='admin' ? $old['email'] : '' ?>">
          </div>
          <div class="form-group">
            <label for="a-pass">Password</label>
            <input type="password" id="a-pass" name="password" placeholder="Min. 6 karakter"
                   oninput="checkStrength(this,'a-strength')" required>
            <div class="pw-strength" id="a-strength"></div>
          </div>
          <div class="form-group">
            <label for="a-pass2">Konfirmasi Password</label>
            <input type="password" id="a-pass2" name="password2" placeholder="Ulangi password" required>
          </div>

          <button type="submit" class="btn-login" style="border:none;width:100%;cursor:pointer;margin-top:4px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.518l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg> Daftar sebagai Admin
          </button>
        </form>

        <!-- ═══════════════ PANEL GURU ═══════════════ -->
        <form id="rp-guru" class="role-panel login-form" action="proses_register.php" method="POST" novalidate>
          <input type="hidden" name="role" value="guru">

          <div class="form-group">
            <label for="g-nama">Nama Lengkap</label>
            <input type="text" id="g-nama" name="nama" placeholder="Nama lengkap guru"
                   value="<?= $old['role']==='guru' ? $old['nama'] : '' ?>" required>
          </div>
          <div class="form-group">
            <label for="g-nip">NIP</label>
            <input type="text" id="g-nip" name="nip" placeholder="Nomor Induk Pegawai"
                   value="<?= $old['role']==='guru' ? $old['nip'] : '' ?>">
            <div class="field-hint">Digunakan sebagai username jika tidak diisi username</div>
          </div>
          <div class="form-group">
            <label for="g-user">Username</label>
            <input type="text" id="g-user" name="username" placeholder="Buat username unik"
                   value="<?= $old['role']==='guru' ? $old['username'] : '' ?>" required>
          </div>
          <div class="form-group">
            <label for="g-email">Email (opsional)</label>
            <input type="email" id="g-email" name="email" placeholder="email@sekolah.sch.id"
                   value="<?= $old['role']==='guru' ? $old['email'] : '' ?>">
          </div>
          <div class="form-group">
            <label for="g-pass">Password</label>
            <input type="password" id="g-pass" name="password" placeholder="Min. 6 karakter"
                   oninput="checkStrength(this,'g-strength')" required>
            <div class="pw-strength" id="g-strength"></div>
          </div>
          <div class="form-group">
            <label for="g-pass2">Konfirmasi Password</label>
            <input type="password" id="g-pass2" name="password2" placeholder="Ulangi password" required>
          </div>

          <button type="submit" class="btn-login" style="background:linear-gradient(135deg,#0288D1,#0277BD);border:none;width:100%;cursor:pointer;margin-top:4px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg> Daftar sebagai Guru
          </button>
        </form>

        <!-- ═══════════════ PANEL SISWA ═══════════════ -->
        <form id="rp-siswa" class="role-panel login-form" action="proses_register.php" method="POST" novalidate>
          <input type="hidden" name="role" value="siswa">

          <div class="form-group">
            <label for="s-nama">Nama Lengkap</label>
            <input type="text" id="s-nama" name="nama" placeholder="Nama lengkap siswa"
                   value="<?= $old['role']==='siswa' ? $old['nama'] : '' ?>" required>
          </div>
          <div class="form-group">
            <label for="s-nisn">NISN</label>
            <input type="text" id="s-nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional"
                   value="<?= $old['role']==='siswa' ? $old['nisn'] : '' ?>">
          </div>
          <div class="form-group">
            <label for="s-kelas">Kelas</label>
            <select id="s-kelas" name="kelas">
              <option value="">-- Pilih Kelas --</option>
              <?php
              $kls = ['X DKV 1','X DKV 2','XI DKV 1','XI DKV 2','XII DKV 1','XII DKV 2',
                      'X Animasi 1','XI Animasi 1','XII Animasi 1',
                      'X PPLG 1','X PPLG 2','XI PPLG 1','XI PPLG 2','XII PPLG 1','XII PPLG 2',
                      'X TJKT 1','XI TJKT 1','XII TJKT 1'];
              foreach ($kls as $k) {
                  $sel = ($old['kelas'] === $k) ? 'selected' : '';
                  echo "<option $sel>$k</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="s-user">Username</label>
            <input type="text" id="s-user" name="username" placeholder="Buat username unik"
                   value="<?= $old['role']==='siswa' ? $old['username'] : '' ?>" required>
          </div>
          <div class="form-group">
            <label for="s-email">Email (opsional)</label>
            <input type="email" id="s-email" name="email" placeholder="email@gmail.com"
                   value="<?= $old['role']==='siswa' ? $old['email'] : '' ?>">
          </div>
          <div class="form-group">
            <label for="s-pass">Password</label>
            <input type="password" id="s-pass" name="password" placeholder="Min. 6 karakter"
                   oninput="checkStrength(this,'s-strength')" required>
            <div class="pw-strength" id="s-strength"></div>
          </div>
          <div class="form-group">
            <label for="s-pass2">Konfirmasi Password</label>
            <input type="password" id="s-pass2" name="password2" placeholder="Ulangi password" required>
          </div>

          <button type="submit" class="btn-login" style="background:linear-gradient(135deg,#43A047,#388E3C);border:none;width:100%;cursor:pointer;margin-top:4px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg> Daftar sebagai Siswa
          </button>
        </form>
      </div>

      <div class="or-divider">atau</div>
      <div class="login-link">Sudah punya akun? <a href="index.php">Masuk di sini</a></div>
    </div>

    <p class="school-name">© 2025 EduManage – Sistem Manajemen Sekolah</p>
  </div>
</div>

<script>
function checkStrength(input, barId) {
  const val = input.value;
  const bar = document.getElementById(barId);
  let score = 0;
  if (val.length >= 6)  score++;
  if (val.length >= 10) score++;
  if (/[A-Z]/.test(val)) score++;
  if (/[0-9]/.test(val)) score++;
  if (/[^A-Za-z0-9]/.test(val)) score++;

  const colors = ['#e53935','#FB8C00','#FDD835','#43A047','#1565C0'];
  const widths = ['20%','40%','60%','80%','100%'];
  bar.style.width  = val.length ? widths[score - 1] || '10%' : '0';
  bar.style.background = val.length ? colors[score - 1] || '#e53935' : 'transparent';
}
</script>
</body>
</html>
