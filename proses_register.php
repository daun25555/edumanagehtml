<?php
session_start();
include 'koneksi.php';

// Jika sudah login, tolak akses
if (isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

// Hanya terima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit();
}

// ----------------------------------------------------------------
// Ambil & bersihkan input
// ----------------------------------------------------------------
$role      = in_array($_POST['role'] ?? '', ['admin','guru','siswa']) ? $_POST['role'] : 'guru';
$nama      = trim($_POST['nama']      ?? '');
$username  = trim($_POST['username']  ?? '');
$password  = $_POST['password']       ?? '';
$password2 = $_POST['password2']      ?? '';
$email     = trim($_POST['email']     ?? '');
$nip       = trim($_POST['nip']       ?? '');   // hanya guru
$nisn      = trim($_POST['nisn']      ?? '');   // hanya siswa
$kelas     = trim($_POST['kelas']     ?? '');   // hanya siswa

// Helper: redirect balik dengan error + old value
function back(string $error, array $post): never {
    $params = array_merge(['error' => $error], $post);
    header("Location: register.php?" . http_build_query($params));
    exit();
}

$old = [
    'role'     => $role,
    'nama'     => $nama,
    'username' => $username,
    'email'    => $email,
    'nip'      => $nip,
    'nisn'     => $nisn,
    'kelas'    => $kelas,
];

// ----------------------------------------------------------------
// Validasi
// ----------------------------------------------------------------
if ($nama === '' || $username === '' || $password === '') {
    back('field_kosong', $old);
}

if (strlen($password) < 6) {
    back('password_lemah', $old);
}

if ($password !== $password2) {
    back('password_beda', $old);
}

// Sanitasi username (hanya huruf, angka, underscore, titik, strip)
$username = preg_replace('/[^a-zA-Z0-9_.\-]/', '', $username);
if ($username === '') {
    back('field_kosong', $old);
}

// ----------------------------------------------------------------
// Cek username sudah ada
// ----------------------------------------------------------------
$esc_user = mysqli_real_escape_string($conn, $username);
$cek = mysqli_query($conn, "SELECT id FROM users WHERE username = '$esc_user'");
if (mysqli_num_rows($cek) > 0) {
    back('username_ada', $old);
}

// ----------------------------------------------------------------
// Hash password & insert ke tabel users
// ----------------------------------------------------------------
$hash      = password_hash($password, PASSWORD_DEFAULT);
$esc_nama  = mysqli_real_escape_string($conn, $nama);
$esc_email = mysqli_real_escape_string($conn, $email);

$ok = mysqli_query($conn,
    "INSERT INTO users (username, password, role, nama)
     VALUES ('$esc_user', '$hash', '$role', '$esc_nama')"
);

if (!$ok) {
    back('db_gagal', $old);
}

$new_user_id = mysqli_insert_id($conn);

// ----------------------------------------------------------------
// Simpan data tambahan ke tabel guru / siswa
// ----------------------------------------------------------------
if ($role === 'guru') {
    $esc_nip   = mysqli_real_escape_string($conn, $nip);
    $nip_val   = $nip ? "'$esc_nip'" : 'NULL';
    mysqli_query($conn,
        "INSERT INTO guru (nip, nama, email)
         VALUES ($nip_val, '$esc_nama', '$esc_email')"
    );
}

if ($role === 'siswa') {
    $esc_nisn  = mysqli_real_escape_string($conn, $nisn);
    $esc_kelas = mysqli_real_escape_string($conn, $kelas);
    $nisn_val  = $nisn ? "'$esc_nisn'" : 'NULL';
    mysqli_query($conn,
        "INSERT INTO siswa (nisn, nama, kelas, email)
         VALUES ($nisn_val, '$esc_nama', '$esc_kelas', '$esc_email')"
    );
}

// ----------------------------------------------------------------
// Berhasil → redirect ke login dengan pesan sukses
// ----------------------------------------------------------------
header("Location: register.php?sukses=ok&role=$role");
exit();
