<?php
session_start();
require_once '../MODELS/m_koneksi.php';
require_once '../MODELS/m_aspirasi.php';

if (!isset($_SESSION['nis']) || ($_SESSION['role'] ?? '') !== 'siswa') {
    header("Location: ../VIEWS/v_login.php");
    exit();
}

$modelAspirasi = new M_Aspirasi($conn);
$list_kategori = $modelAspirasi->getKategori();

$nis = $_SESSION['nis'];
$nama_siswa = $_SESSION['nama_siswa'] ?? 'Siswa';
$kelas = $_SESSION['kelas'] ?? '-';
$list_aspirasi = $modelAspirasi->getAspirasiByNis($nis);
$page = $_GET['page'] ?? 'dashboard';

if ($page === 'form') {
    require_once '../VIEWS/v_aspirasi.php';
} elseif ($page === 'histori') {
    require_once '../VIEWS/v_histori_aspirasi.php';
} else {
    require_once '../VIEWS/v_beranda.php';
}
?>
