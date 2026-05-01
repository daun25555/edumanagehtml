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

    /* CSS-only tab trick menggunakan :target */
    #panel-admin:target,
    #panel-guru:target,
    #panel-siswa:target { display: block; }

    /* Default tampil admin jika tidak ada target */
    .role-panels:not(:has(:target)) #panel-admin { display: block; }

    /* Highlight tab aktif via :has + :target */
    body:has(#panel-admin:target) .tab-admin,
    body:not(:has([id^="panel"]:target)) .tab-admin { background: var(--primary); color: #fff; box-shadow: 0 2px 8px rgba(21,101,192,0.25); }

    body:has(#panel-guru:target) .tab-guru { background: #0288D1; color: #fff; box-shadow: 0 2px 8px rgba(2,136,209,0.25); }
    body:has(#panel-siswa:target) .tab-siswa { background: #43A047; color: #fff; box-shadow: 0 2px 8px rgba(67,160,71,0.25); }

    .demo-accounts {
      background: var(--bg);
      border-radius: var(--radius-sm);
      padding: 14px 16px;
      font-size: 12px;
      color: var(--text-muted);
      margin-top: 16px;
      border: 1px solid var(--border);
    }
    .demo-accounts strong { color: var(--text); }
    .demo-accounts p { margin-top: 4px; }

    .school-name {
      text-align: center;
      color: rgba(255,255,255,0.70);
      font-size: 12px;
      margin-top: 24px;
      position: relative;
      z-index: 10;
    }
  </style>
</head>
<body>
  <div class="login-page">
    <div>
      <div class="login-container">
        <div class="login-logo">
          <div class="logo-circle">🏫</div>
          <h1>Edu<span>Manage</span></h1>
          <p>Sistem Manajemen Sekolah Digital</p>
        </div>

        <!-- Role Tabs -->
        <div class="role-tabs">
          <a href="#panel-admin" class="role-tab tab-admin">👑 Admin</a>
          <a href="#panel-guru" class="role-tab tab-guru">📚 Guru</a>
          <a href="#panel-siswa" class="role-tab tab-siswa">🎒 Siswa</a>
        </div>

        <!-- Role Panels -->
        <div class="role-panels">
          <?php if(isset($_GET['error'])): ?>
            <div style="background: #FFEBEE; color: #C62828; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 13px; text-align: center;">
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
              <input type="password" name="password" id="admin-pass" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login" style="border:none; width:100%; cursor:pointer;">Masuk sebagai Admin</button>
            <div class="demo-accounts">
              <strong>ℹ️ Demo:</strong>
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
              <input type="password" name="password" id="guru-pass" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login" style="background: linear-gradient(135deg, #0288D1, #0277BD); border:none; width:100%; cursor:pointer;">Masuk sebagai Guru</button>
            <div class="demo-accounts">
              <strong>ℹ️ Demo:</strong>
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
              <input type="password" name="password" id="siswa-pass" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login" style="background: linear-gradient(135deg, #43A047, #388E3C); border:none; width:100%; cursor:pointer;">Masuk sebagai Siswa</button>
            <div class="demo-accounts">
              <strong>ℹ️ Demo:</strong>
              <p>NISN: <strong>siswa01</strong> | Password: <strong>admin123</strong></p>
            </div>
          </form>
        </div>
      </div>
      <p class="school-name">© 2025 EduManage – SMK Telkom</p>
    </div>
  </div>
</body>
</html>
