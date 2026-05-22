<?php
session_start();
include 'koneksi.php';

// Hanya admin yang boleh
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Hapus agenda
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kalender WHERE id = $id");
    header("Location: jadwal.php?pesan=hapus_ok");
    exit();
}

// Tambah agenda
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'tambah') {
    $tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $kegiatan   = mysqli_real_escape_string($conn, $_POST['kegiatan']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    mysqli_query($conn,
        "INSERT INTO kalender (tanggal, kegiatan, keterangan)
         VALUES ('$tanggal','$kegiatan','$keterangan')"
    );
    header("Location: jadwal.php?pesan=tambah_ok");
    exit();
}

header("Location: jadwal.php");
exit();
