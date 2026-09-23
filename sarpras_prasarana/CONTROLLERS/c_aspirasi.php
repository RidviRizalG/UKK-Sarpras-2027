<?php
session_start();
require_once '../MODELS/m_koneksi.php';
require_once '../MODELS/m_aspirasi.php';

$modelAspirasi = new M_Aspirasi($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['aksi'] ?? '') === 'tambah') {
    $nis = $_SESSION['nis'] ?? '';
    $id_kategori = trim($_POST['id_kategori'] ?? '');
    $lokasi = trim($_POST['lokasi'] ?? '');
    $ket = trim($_POST['ket'] ?? '');

    if ($nis === '' || $id_kategori === '' || $lokasi === '' || $ket === '') {
        header('Location: c_beranda.php?page=form&status=data_tidak_lengkap');
        exit();
    }

    $insert = mysqli_prepare(
        $conn,
        'INSERT INTO input_aspirasi (nis, id_kategori, lokasi, ket, tgl_pelaporan) VALUES (?, ?, ?, ?, NOW())'
    );
    mysqli_stmt_bind_param($insert, 'iiss', $nis, $id_kategori, $lokasi, $ket);

    if (mysqli_stmt_execute($insert)) {
        mysqli_stmt_close($insert);
        header('Location: c_beranda.php?page=dashboard&status=berhasil');
        exit();
    }

    mysqli_stmt_close($insert);
    header('Location: c_beranda.php?page=form&status=gagal');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['aksi'] ?? '') === 'update_status_feedback') {
    if (($_SESSION['role'] ?? '') !== 'admin') {
        header('Location: ../VIEWS/v_login.php');
        exit();
    }

    $id_input = (int)($_POST['id_input'] ?? 0);
    $status = trim($_POST['status'] ?? 'Menunggu');
    $feedback = trim($_POST['feedback'] ?? '');
    $id_admin = (int)($_SESSION['id_admin'] ?? 0);

    if ($id_input > 0 && in_array($status, ['Menunggu', 'Proses', 'Selesai'], true)) {
        $modelAspirasi->updateAspirasi($id_input, $status, $feedback, $id_admin);
    }

    header('Location: c_admin.php?page=histori');
    exit();
}

header('Location: c_beranda.php?page=form');
exit();
?>
