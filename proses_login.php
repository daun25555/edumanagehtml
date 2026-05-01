<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role'];

    // Query untuk mencari user berdasarkan username dan role
    $query = "SELECT * FROM users WHERE username = '$username' AND role = '$role'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password (menggunakan bcrypt sesuai edumanage.sql)
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['id']       = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama']     = $user['nama'];
            $_SESSION['role']     = $user['role'];

            // Redirect sesuai role
            if ($role == 'admin') {
                header("Location: admin.php");
            } elseif ($role == 'guru') {
                header("Location: guru.php");
            } else {
                header("Location: siswa.php");
            }
            exit();
        } else {
            header("Location: index.php?error=password_salah");
            exit();
        }
    } else {
        header("Location: index.php?error=user_tidak_ditemukan");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
