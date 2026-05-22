<?php
// ============================================================
// Script untuk reset password semua akun demo
// Jalankan sekali di browser: localhost/Edumanagehtml/reset_password.php
// Setelah berhasil, HAPUS file ini demi keamanan
// ============================================================
include 'koneksi.php';

$accounts = [
    ['username' => 'admin',   'password' => 'admin123', 'role' => 'admin',  'nama' => 'Administrator'],
    ['username' => 'guru01',  'password' => 'admin123', 'role' => 'guru',   'nama' => 'Guru Demo'],
    ['username' => 'siswa01', 'password' => 'admin123', 'role' => 'siswa',  'nama' => 'Siswa Demo'],
];

echo "<h2>Reset Password - EduManage</h2>";
echo "<hr>";

foreach ($accounts as $acc) {
    $hash = password_hash($acc['password'], PASSWORD_DEFAULT);
    
    // Cek apakah user sudah ada
    $check = mysqli_query($conn, "SELECT id FROM users WHERE username = '{$acc['username']}'");
    
    if (mysqli_num_rows($check) > 0) {
        // Update password
        $sql = "UPDATE users SET password = '$hash' WHERE username = '{$acc['username']}'";
        if (mysqli_query($conn, $sql)) {
            echo "<p>✅ <strong>{$acc['username']}</strong> ({$acc['role']}) — password direset ke: <code>{$acc['password']}</code></p>";
        } else {
            echo "<p>❌ Gagal update {$acc['username']}: " . mysqli_error($conn) . "</p>";
        }
    } else {
        // Insert user baru
        $sql = "INSERT INTO users (username, password, role, nama) VALUES ('{$acc['username']}', '$hash', '{$acc['role']}', '{$acc['nama']}')";
        if (mysqli_query($conn, $sql)) {
            echo "<p>✅ <strong>{$acc['username']}</strong> ({$acc['role']}) — dibuat baru dengan password: <code>{$acc['password']}</code></p>";
        } else {
            echo "<p>❌ Gagal insert {$acc['username']}: " . mysqli_error($conn) . "</p>";
        }
    }
}

echo "<hr>";
echo "<p style='color:green;font-weight:bold;'>Selesai! Semua akun sekarang menggunakan password: admin123</p>";
echo "<p style='color:red;'>⚠️ Hapus file <code>reset_password.php</code> ini setelah selesai!</p>";
echo "<p><a href='index.php'>← Kembali ke Login</a></p>";
?>
