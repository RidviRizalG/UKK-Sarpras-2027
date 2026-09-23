<?php
require_once __DIR__ . '/../MODELS/m_koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_GET['aksi'] ?? '') !== 'daftar') {
    header('Location: ../VIEWS/v_registrasi.php');
    exit();
}

$nis = trim($_POST['nis'] ?? '');
$namaSiswa = trim($_POST['nama_siswa'] ?? '');
$kelas = trim($_POST['kelas'] ?? '');
$jurusan = trim($_POST['jurusan'] ?? '');
$jenisKelamin = $_POST['jenis_kelamin'] ?? '';
$password = $_POST['password'] ?? '';

if ($nis === '' || $namaSiswa === '' || $kelas === '' || $jurusan === '' || $password === '' || !in_array($jenisKelamin, ['L', 'P'], true)) {
    header('Location: ../VIEWS/v_registrasi.php?status=data_tidak_lengkap');
    exit();
}

if (!ctype_digit($nis)) {
    header('Location: ../VIEWS/v_registrasi.php?status=nis_tidak_valid');
    exit();
}

$cekNis = mysqli_prepare($conn, 'SELECT nis FROM siswa WHERE nis = ?');
mysqli_stmt_bind_param($cekNis, 'i', $nis);
mysqli_stmt_execute($cekNis);
mysqli_stmt_store_result($cekNis);

if (mysqli_stmt_num_rows($cekNis) > 0) {
    mysqli_stmt_close($cekNis);
    header('Location: ../VIEWS/v_registrasi.php?status=nis_sudah_terdaftar');
    exit();
}
mysqli_stmt_close($cekNis);

$simpan = mysqli_prepare(
    $conn,
    'INSERT INTO siswa (nis, nama_siswa, kelas, jurusan, jenis_kelamin, password) VALUES (?, ?, ?, ?, ?, ?)'
);
mysqli_stmt_bind_param($simpan, 'isssss', $nis, $namaSiswa, $kelas, $jurusan, $jenisKelamin, $password);

if (mysqli_stmt_execute($simpan)) {
    mysqli_stmt_close($simpan);
    header('Location: ../VIEWS/v_login.php?status=registrasi_berhasil');
    exit();
}

mysqli_stmt_close($simpan);
header('Location: ../VIEWS/v_registrasi.php?status=gagal');
exit();
?>