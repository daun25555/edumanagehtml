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
if (!$data) $data = $_POST;

$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username dan password harus diisi.']);
    exit();
}

$stmt = $conn->prepare("SELECT id, username, nama, role, email, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Username tidak terdaftar.']);
    $stmt->close();
    exit();
}

$user = $result->fetch_assoc();
$stmt->close();

if (!password_verify($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Password salah.']);
    exit();
}

$token = bin2hex(random_bytes(32));

// Update token di database (simpan untuk validasi selanjutnya)
$stmt2 = $conn->prepare("UPDATE users SET token = ? WHERE id = ?");
$stmt2->bind_param("si", $token, $user['id']);
$stmt2->execute();
$stmt2->close();

// Ambil detail tambahan (guru/siswa)
$detail = null;
if ($user['role'] === 'guru') {
    $d = $conn->query("SELECT nip, mapel FROM guru WHERE user_id = " . (int)$user['id']);
    if ($d && $d->num_rows > 0) $detail = $d->fetch_assoc();
} elseif ($user['role'] === 'siswa') {
    $d = $conn->query("SELECT nisn, kelas FROM siswa WHERE user_id = " . (int)$user['id']);
    if ($d && $d->num_rows > 0) $detail = $d->fetch_assoc();
}

echo json_encode([
    'success' => true,
    'token'   => $token,
    'user' => [
        'id'          => $user['id'],
        'username'    => $user['username'],
        'nama_lengkap'=> $user['nama'],
        'role'        => $user['role'],
        'email'       => $user['email'],
        'is_active'   => 1,
    ],
    'detail' => $detail
]);
?>
