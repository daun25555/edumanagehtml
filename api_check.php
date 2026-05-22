<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'koneksi.php';

// Ambil token dari header Authorization
$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
$token = '';
if (preg_match('/Bearer\s+(.+)/i', $authHeader, $matches)) {
    $token = trim($matches[1]);
}

if (empty($token)) {
    echo json_encode(['success' => false, 'message' => 'Token tidak ditemukan.']);
    exit();
}

$stmt = $conn->prepare("SELECT id, username, nama, role, email FROM users WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Token tidak valid.']);
    $stmt->close();
    exit();
}

$user = $result->fetch_assoc();
$stmt->close();

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
