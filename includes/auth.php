<?php
// ============================================================
// includes/auth.php - Cek sesi login & helper role
// ============================================================

function requireLogin(string $redirectTo = '../index.php'): void {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (empty($_SESSION['user_id'])) {
        header('Location: ' . $redirectTo);
        exit;
    }
}

function requireRole(string|array $roles, string $redirectTo = '../index.php'): void {
    requireLogin($redirectTo);
    $roles = (array)$roles;
    if (!in_array($_SESSION['role'] ?? '', $roles)) {
        header('Location: ' . $redirectTo);
        exit;
    }
}

function isAdmin(): bool {
    return ($_SESSION['role'] ?? '') === 'admin';
}

function isGuru(): bool {
    return ($_SESSION['role'] ?? '') === 'guru';
}

function isSiswa(): bool {
    return ($_SESSION['role'] ?? '') === 'siswa';
}

function currentUser(): array {
    return [
        'id'    => $_SESSION['user_id'] ?? 0,
        'nama'  => $_SESSION['nama']    ?? '—',
        'role'  => $_SESSION['role']    ?? '—',
        'user'  => $_SESSION['username'] ?? '—',
    ];
}

function flash(string $key): string {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $msg = $_SESSION['flash'][$key] ?? '';
    unset($_SESSION['flash'][$key]);
    return htmlspecialchars($msg);
}

function setFlash(string $key, string $msg): void {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['flash'][$key] = $msg;
}
