<?php
session_start();
// Jika sudah login, redirect ke dashboard yang sesuai
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') header("Location: admin.php");
    elseif ($_SESSION['role'] === 'guru') header("Location: guru.php");
    else header("Location: siswa.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login – EduManage</title>
  <meta name="description" content="Login ke sistem manajemen sekolah EduManage">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .role-panels { margin-bottom: 24px; }
    .role-panel { display: none; }
    #panel-admin:target, #panel-guru:target, #panel-siswa:target { display: block; }
    .role-panels:not(:has(:target)) #panel-admin { display: block; }

    body:has(#panel-admin:target) .tab-admin,
    body:not(:has([id^="panel"]:target)) .tab-admin { background: var(--primary); color: #fff; box-shadow: 0 2px 8px rgba(21,101,192,0.25); }
    body:has(#panel-guru:target) .tab-guru { background: #0288D1; color: #fff; box-shadow: 0 2px 8px rgba(2,136,209,0.25); }
    body:has(#panel-siswa:target) .tab-siswa { background: #43A047; color: #fff; box-shadow: 0 2px 8px rgba(67,160,71,0.25); }

    .demo-accounts {
      background: var(--bg); border-radius: var(--radius-sm); padding: 14px 16px;
      font-size: 12px; color: var(--text-muted); margin-top: 16px; border: 1px solid var(--border);
    }
    .demo-accounts strong { color: var(--text); }
    .demo-accounts p { margin-top: 4px; }

    .school-name {
      text-align: center; color: rgba(255,255,255,0.70); font-size: 12px;
      margin-top: 24px; position: relative; z-index: 10;
    }

    .back-to-home {
      display: inline-flex; align-items: center; gap: 6px;
      color: rgba(255,255,255,0.75); font-size: 13px; font-weight: 500;
      margin-bottom: 20px; transition: color 0.2s;
      position: relative; z-index: 10;
    }
    .back-to-home:hover { color: #fff; }
    .back-to-home .arrow { font-size: 16px; }

    /* Password toggle eye */
    .password-wrapper {
      position: relative;
    }
    .password-wrapper input {
      padding-right: 44px;
    }
    .toggle-password {
      position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
      background: none; border: none; cursor: pointer; padding: 4px;
      color: var(--text-muted); display: flex; align-items: center; justify-content: center;
      transition: color 0.2s;
    }
    .toggle-password:hover { color: var(--primary); }
    .toggle-password svg { width: 18px; height: 18px; }
  </style>
</head>
<body>
  <div class="login-page">
    <div>
      <a href="landing.php" class="back-to-home"><span class="arrow">←</span> Kembali ke Beranda</a>
      <div class="login-container">
        <div class="login-logo">
          <div class="logo-circle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m4 6 8-4 8 4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg></div>
          <h1>Edu<span>Manage</span></h1>
          <p>Sistem Manajemen Sekolah Digital</p>
        </div>

        <!-- Role Tabs -->
        <div class="role-tabs">
          <a href="#panel-admin" class="role-tab tab-admin"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.518l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg> Admin</a>
          <a href="#panel-guru" class="role-tab tab-guru"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg> Guru</a>
          <a href="#panel-siswa" class="role-tab tab-siswa"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;margin-right:4px;"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/><path d="M8 21v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5"/><path d="M8 10h8"/><path d="M8 18h8"/></svg> Siswa</a>
        </div>

        <!-- Role Panels -->
        <div class="role-panels">
          <?php if(isset($_GET['error'])): ?>
            <div style="background:#FFEBEE;color:#C62828;padding:10px;border-radius:4px;margin-bottom:15px;font-size:13px;text-align:center;">
              <?php
                if($_GET['error'] == 'password_salah') echo "Password yang Anda masukkan salah.";
                elseif($_GET['error'] == 'user_tidak_ditemukan') echo "Username tidak terdaftar.";
              ?>
            </div>
          <?php endif; ?>

          <!-- Admin Panel -->
          <form id="panel-admin" class="role-panel login-form" action="proses_login.php" method="POST">
            <input type="hidden" name="role" value="admin">
            <div class="form-group">
              <label for="admin-user">Username Admin</label>
              <input type="text" name="username" id="admin-user" placeholder="Masukkan username admin" required>
            </div>
            <div class="form-group">
              <label for="admin-pass">Password</label>
              <div class="password-wrapper">
                <input type="password" name="password" id="admin-pass" placeholder="Masukkan password" required>
                <button type="button" class="toggle-password" onclick="togglePass('admin-pass', this)" title="Tampilkan password">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-open"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-off" style="display:none"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
                </button>
              </div>
            </div>
            <button type="submit" class="btn-login" style="border:none;width:100%;cursor:pointer;">Masuk sebagai Admin</button>
            <div class="demo-accounts">
              <strong><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg> Demo:</strong>
              <p>Username: <strong>admin</strong> | Password: <strong>admin123</strong></p>
            </div>
          </form>

          <!-- Guru Panel -->
          <form id="panel-guru" class="role-panel login-form" action="proses_login.php" method="POST">
            <input type="hidden" name="role" value="guru">
            <div class="form-group">
              <label for="guru-user">NIP / Username Guru</label>
              <input type="text" name="username" id="guru-user" placeholder="Masukkan NIP atau username" required>
            </div>
            <div class="form-group">
              <label for="guru-pass">Password</label>
              <div class="password-wrapper">
                <input type="password" name="password" id="guru-pass" placeholder="Masukkan password" required>
                <button type="button" class="toggle-password" onclick="togglePass('guru-pass', this)" title="Tampilkan password">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-open"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-off" style="display:none"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
                </button>
              </div>
            </div>
            <button type="submit" class="btn-login" style="background:linear-gradient(135deg,#0288D1,#0277BD);border:none;width:100%;cursor:pointer;">Masuk sebagai Guru</button>
            <div class="demo-accounts">
              <strong><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg> Demo:</strong>
              <p>NIP: <strong>guru01</strong> | Password: <strong>admin123</strong></p>
            </div>
          </form>

          <!-- Siswa Panel -->
          <form id="panel-siswa" class="role-panel login-form" action="proses_login.php" method="POST">
            <input type="hidden" name="role" value="siswa">
            <div class="form-group">
              <label for="siswa-user">NISN / Username Siswa</label>
              <input type="text" name="username" id="siswa-user" placeholder="Masukkan NISN atau username" required>
            </div>
            <div class="form-group">
              <label for="siswa-pass">Password</label>
              <div class="password-wrapper">
                <input type="password" name="password" id="siswa-pass" placeholder="Masukkan password" required>
                <button type="button" class="toggle-password" onclick="togglePass('siswa-pass', this)" title="Tampilkan password">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-open"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-off" style="display:none"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
                </button>
              </div>
            </div>
            <button type="submit" class="btn-login" style="background:linear-gradient(135deg,#43A047,#388E3C);border:none;width:100%;cursor:pointer;">Masuk sebagai Siswa</button>
            <div class="demo-accounts">
              <strong><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:-2px;"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg> Demo:</strong>
              <p>NISN: <strong>siswa01</strong> | Password: <strong>admin123</strong></p>
            </div>
          </form>
        </div>

        <!-- Link Daftar -->
        <div style="text-align:center;margin-top:18px;font-size:13px;color:var(--text-muted);">
          Belum punya akun?
          <a href="register.php" style="color:var(--primary);font-weight:600;text-decoration:none;">Daftar di sini</a>
        </div>
      </div>
      <p class="school-name">© 2025 EduManage – Sistem Manajemen Sekolah</p>
    </div>
  </div>
  <script>
    function togglePass(inputId, btn) {
      const input = document.getElementById(inputId);
      const eyeOpen = btn.querySelector('.eye-open');
      const eyeOff = btn.querySelector('.eye-off');
      if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.style.display = 'none';
        eyeOff.style.display = 'block';
        btn.title = 'Sembunyikan password';
      } else {
        input.type = 'password';
        eyeOpen.style.display = 'block';
        eyeOff.style.display = 'none';
        btn.title = 'Tampilkan password';
      }
    }
  </script>
</body>
</html>
