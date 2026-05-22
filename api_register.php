<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'koneksi.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    $data = $_POST;
}

$role     = strtolower(trim($data['role'] ?? ''));
$nama     = trim($data['nama'] ?? '');
$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';
$email    = trim($data['email'] ?? '');
$nip      = trim($data['nip'] ?? '');
$nisn     = trim($data['nisn'] ?? '');
$kelas    = trim($data['kelas'] ?? '');

// Validasi field wajib
if (empty($role) || empty($nama) || empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Semua field wajib diisi.']);
    exit();
}

// Validasi role
if (!in_array($role, ['admin', 'guru', 'siswa'])) {
    echo json_encode(['success' => false, 'message' => 'Role tidak valid.']);
    exit();
}

// Validasi password
if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Password minimal 6 karakter.']);
    exit();
}

// Cek username sudah ada
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Username sudah digunakan.']);
    $stmt->close();
    exit();
}
$stmt->close();

$hashed = password_hash($password, PASSWORD_BCRYPT);

// Insert ke tabel users
$stmt = $conn->prepare("INSERT INTO users (username, password, nama, role, email, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssss", $username, $hashed, $nama, $role, $email);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Gagal membuat akun: ' . $conn->error]);
    $stmt->close();
    exit();
}

$user_id = $conn->insert_id;
$stmt->close();

// Insert ke tabel spesifik berdasarkan role
if ($role === 'guru') {
    $mapel = $data['mapel'] ?? '';
    $stmt2 = $conn->prepare("INSERT INTO guru (user_id, nama, nip, email, mapel, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt2->bind_param("issss", $user_id, $nama, $nip, $email, $mapel);
    $stmt2->execute();
    $stmt2->close();
} elseif ($role === 'siswa') {
    $stmt2 = $conn->prepare("INSERT INTO siswa (user_id, nama, nisn, kelas, email, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt2->bind_param("issss", $user_id, $nama, $nisn, $kelas, $email);
    $stmt2->execute();
    $stmt2->close();
}

echo json_encode([
    'success' => true,
    'message' => 'Akun berhasil dibuat! Silakan login.',
    'user_id' => $user_id
]);
?>
