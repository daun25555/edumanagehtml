<?php
// ============================================================
// config/db.php - Koneksi Database PDO
// ============================================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'edumanage');
define('DB_USER', 'root');
define('DB_PASS', '');       // Kosong = default XAMPP, isi jika berbeda
define('DB_CHARSET', 'utf8mb4');

define('APP_NAME', 'EduManage');
define('APP_SCHOOL', 'SMK Telkom');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('<div style="font-family:sans-serif;padding:40px;background:#fff3cd;border:1px solid #ffc107;border-radius:8px;margin:40px auto;max-width:600px;">
                <h2 style="color:#856404;">⚠️ Gagal Koneksi Database</h2>
                <p>Pastikan XAMPP/MySQL sudah berjalan dan database <strong>edumanage</strong> sudah diimport.</p>
                <p style="color:#666;font-size:13px;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>
            </div>');
        }
    }
    return $pdo;
}
