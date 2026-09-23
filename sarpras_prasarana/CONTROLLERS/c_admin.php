<?php
session_start();
require_once '../MODELS/m_koneksi.php';
require_once '../MODELS/m_aspirasi.php';
require_once '../MODELS/m_siswa.php';

if (($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../VIEWS/v_login.php');
    exit();
}

$modelAspirasi = new M_Aspirasi($conn);
$modelSiswa = new M_Siswa($conn);

$aspirasiPage = max(1, (int)($_GET['aspirasi_page'] ?? 1));
$aspirasiLimit = 10;
$totalAspirasi = $modelAspirasi->countAllAspirasi();
$totalAspirasiPages = max(1, (int)ceil($totalAspirasi / $aspirasiLimit));

if ($aspirasiPage > $totalAspirasiPages) {
    $aspirasiPage = $totalAspirasiPages;
}

$aspirasiOffset = ($aspirasiPage - 1) * $aspirasiLimit;
$list_aspirasi = $modelAspirasi->getAllAspirasi($aspirasiLimit, $aspirasiOffset);

$siswaKeyword = trim($_GET['siswa_keyword'] ?? '');
$siswaPage = max(1, (int)($_GET['siswa_page'] ?? 1));
$siswaLimit = 10;
$totalSiswa = $modelSiswa->countSiswa($siswaKeyword);
$totalSiswaPages = max(1, (int)ceil($totalSiswa / $siswaLimit));

if ($siswaPage > $totalSiswaPages) {
    $siswaPage = $totalSiswaPages;
}

$siswaOffset = ($siswaPage - 1) * $siswaLimit;
$list_siswa = $modelSiswa->getSiswa($siswaLimit, $siswaOffset, $siswaKeyword);

$editNis = trim($_GET['edit_nis'] ?? '');
$editing_siswa = $editNis !== '' ? $modelSiswa->getSiswaByNis($editNis) : null;
$page = $_GET['page'] ?? 'dashboard';
$showAddForm = ($page === 'siswa' && (($_GET['show_add'] ?? '0') === '1'));

$nama_admin = $_SESSION['nama_admin'] ?? 'Admin';
$role_admin = $_SESSION['role_admin'] ?? 'Admin';

require_once '../VIEWS/v_admin.php';
