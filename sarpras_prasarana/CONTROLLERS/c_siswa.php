<?php
session_start();
require_once '../MODELS/m_koneksi.php';
require_once '../MODELS/m_siswa.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../VIEWS/v_login.php');
    exit();
}

$modelSiswa = new M_Siswa($conn);
$aksi = $_GET['aksi'] ?? 'list';

if ($aksi === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = trim($_POST['nis'] ?? '');
    $namaSiswa = trim($_POST['nama_siswa'] ?? '');
    $kelas = trim($_POST['kelas'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');
    $jenisKelamin = trim($_POST['jenis_kelamin'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($nis !== '' && $namaSiswa !== '' && $kelas !== '' && $jurusan !== '' && in_array($jenisKelamin, ['L', 'P'], true) && $password !== '') {
        $modelSiswa->tambahSiswa($nis, $namaSiswa, $kelas, $jurusan, $jenisKelamin, $password);
    }

    header('Location: c_admin.php?page=siswa');
    exit();
}

if ($aksi === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisLama = trim($_POST['nis_lama'] ?? '');
    $nis = trim($_POST['nis'] ?? '');
    $namaSiswa = trim($_POST['nama_siswa'] ?? '');
    $kelas = trim($_POST['kelas'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? '');
    $jenisKelamin = trim($_POST['jenis_kelamin'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($nisLama !== '' && $nis !== '' && $namaSiswa !== '' && $kelas !== '' && $jurusan !== '' && in_array($jenisKelamin, ['L', 'P'], true) && $password !== '') {
        $modelSiswa->updateSiswa($nisLama, $nis, $namaSiswa, $kelas, $jurusan, $jenisKelamin, $password);
    }

    header('Location: c_admin.php?page=siswa');
    exit();
}

if ($aksi === 'hapus') {
    $nis = trim($_GET['nis'] ?? '');
    if ($nis !== '') {
        $modelSiswa->hapusSiswa($nis);
    }
    header('Location: c_admin.php?page=siswa');
    exit();
}

if ($aksi === 'edit') {
    $nis = trim($_GET['nis'] ?? '');
    if ($nis !== '') {
        header('Location: c_admin.php?page=edit_siswa&edit_nis=' . urlencode($nis));
        exit();
    }
    header('Location: c_admin.php?page=siswa');
    exit();
}

header('Location: c_admin.php?page=siswa');
exit();
?>
