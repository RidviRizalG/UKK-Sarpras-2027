<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beranda - Pengaduan Sarana Prasarana</title>
    <link rel="stylesheet" href="../CSS/01-warna-dan-font.css">
    <link rel="stylesheet" href="../CSS/02-navbar-atas.css">
    <link rel="stylesheet" href="../CSS/03-form-dan-tombol.css">
    <link rel="stylesheet" href="../CSS/04-tabel-dan-badge.css">
    <link rel="stylesheet" href="../CSS/05-admin-dan-dashboard.css">
</head>

<body class="dashboard-page">

    <?php
    $isAdmin = (($_SESSION['role'] ?? 'siswa') === 'admin');
    $page = $_GET['page'] ?? ($isAdmin ? 'histori' : 'dashboard');
    ?>

    <div class="navbar">

        <div class="brand">
            <img class="logo" src="../ASSETS/logo_sekolah_temagelap.png" alt="Logo Sekolah">
            <span>Aplikasi Pengaduan Sarpras</span>
        </div>

        <div class="user-info">

            <?php if ($isAdmin): ?>

                <span class="role-name">
                    Admin:
                    <?= htmlspecialchars($nama_siswa) ?>
                </span>

                <small>
                    (<?= htmlspecialchars($kelas) ?>)
                </small>

            <?php else: ?>

                <span class="role-name">
                    Siswa:
                    <?= htmlspecialchars($nama_siswa) ?>
                </span>

                <small>
                    (<?= htmlspecialchars($kelas) ?>)
                </small>

            <?php endif; ?>

            <button type="button" class="theme-toggle" data-theme-toggle aria-label="Ganti tema"></button>

            <a
                class="btn-logout"
                href="../CONTROLLERS/c_logout.php"
                title="Logout"
            >
                <img src="../ASSETS/logout.png" alt="Logout">
            </a>

        </div>

    </div>

    <div class="container">

        <?php if ($isAdmin): ?>

            <div class="admin-nav">

                <div class="menu">

                    <a
                        class="logo-link"
                        href="../CONTROLLERS/c_beranda.php?page=histori"
                    >
                        <img
                            class="logo"
                            src="../ASSETS/logo_sekolah_temagelap.png"
                            alt="Logo Sekolah"
                            style="width:34px;height:34px;object-fit:contain;display:block;"
                        >
                    </a>

                    <a
                        class="<?= $page === 'histori' ? 'active' : '' ?>"
                        href="../CONTROLLERS/c_beranda.php?page=histori"
                    >
                        Histori Aspirasi
                    </a>

                    <a
                        class="<?= $page === 'siswa' ? 'active' : '' ?>"
                        href="../CONTROLLERS/c_beranda.php?page=siswa"
                    >
                        CRUD Siswa
                    </a>

                </div>

                <small>Admin Panel</small>

            </div>

            <?php if ($page === 'siswa'): ?>

                <div class="card">

                    <h3>CRUD Siswa</h3>

                    <div class="grid-layout">

                        <div
                            class="card"
                            style="border-top:0; box-shadow:none;"
                        >

                            <h3>
                                Tambah Siswa
                            </h3>

                            <form
                                action="../CONTROLLERS/c_siswa.php?aksi=tambah"
                                method="POST"
                                autocomplete="off"
                            >

                                <div class="form-group">

                                    <label>NIS</label>

                                    <input
                                        type="number"
                                        name="nis"
                                        placeholder="NIS"
                                        required
                                    >

                                </div>


                                <div class="form-group">

                                    <label>Nama Siswa</label>

                                    <input
                                        type="text"
                                        name="nama_siswa"
                                        placeholder="Nama Siswa"
                                        required
                                    >

                                </div>


                                <div class="form-group">

                                    <label>Kelas</label>

                                    <input
                                        type="text"
                                        name="kelas"
                                        placeholder="Kelas"
                                        required
                                    >

                                </div>


                                <div class="form-group">

                                    <label>Jurusan</label>

                                    <input
                                        type="text"
                                        name="jurusan"
                                        placeholder="Jurusan"
                                        required
                                    >

                                </div>


                                <div class="form-group">

                                    <label>Jenis Kelamin</label>

                                    <select
                                        name="jenis_kelamin"
                                        required
                                    >

                                        <option value="L">L</option>
                                        <option value="P">P</option>

                                    </select>

                                </div>


                                <div class="form-group">

                                    <label>Password</label>

                                    <input
                                        type="password"
                                        name="password"
                                        placeholder="Password"
                                        required
                                    >

                                </div>


                                <button
                                    type="submit"
                                    class="btn-submit"
                                >
                                    Tambah Siswa
                                </button>

                            </form>

                        </div>

                        <div class="card">

                            <h3>Daftar Siswa</h3>

                            <div class="table-responsive">

                                <table class="table">

                                    <thead>

                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>JK</th>
                                            <th>Password</th>
                                            <th>Aksi</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php if (empty($list_siswa)): ?>

                                            <tr>

                                                <td
                                                    colspan="7"
                                                    style="text-align:center;color:var(--teks-medium);padding:20px;"
                                                >
                                                    Belum ada data siswa.
                                                </td>

                                            </tr>

                                        <?php else: ?>

                                            <?php foreach ($list_siswa as $s): ?>

                                                <tr>

                                                    <td>
                                                        <?= htmlspecialchars($s['nis']) ?>
                                                    </td>

                                                    <td>
                                                        <?= htmlspecialchars($s['nama_siswa']) ?>
                                                    </td>

                                                    <td>
                                                        <?= htmlspecialchars($s['kelas']) ?>
                                                    </td>

                                                    <td>
                                                        <?= htmlspecialchars($s['jurusan']) ?>
                                                    </td>

                                                    <td>
                                                        <?= htmlspecialchars($s['jenis_kelamin']) ?>
                                                    </td>

                                                    <td>
                                                        <?= htmlspecialchars($s['password']) ?>
                                                    </td>

                                                    <td>

                                                        <a
                                                            href="../CONTROLLERS/c_siswa.php?aksi=edit&nis=<?= urlencode($s['nis']) ?>"
                                                        >
                                                            Edit
                                                        </a>

                                                        |

                                                        <a
                                                            href="../CONTROLLERS/c_siswa.php?aksi=hapus&nis=<?= urlencode($s['nis']) ?>"
                                                            onclick="return confirm('Hapus siswa ini?')"
                                                        >
                                                            Hapus
                                                        </a>

                                                    </td>

                                                </tr>

                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            <?php else: ?>

                <div class="card">

                    <h3>Histori Aspirasi Siswa</h3>

                    <div class="table-responsive">

                        <table class="table">

                            <thead>

                                <tr>
                                    <th>Tanggal</th>
                                    <th>Siswa</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Feedback</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php if (empty($list_aspirasi)): ?>

                                    <tr>

                                        <td
                                            colspan="8"
                                            style="text-align:center;color:var(--teks-medium);padding:20px;"
                                        >
                                            Belum ada pengaduan.
                                        </td>

                                    </tr>

                                <?php else: ?>

                                    <?php foreach ($list_aspirasi as $row): ?>

                                        <?php
                                        $badgeClass = 'badge-menunggu';

                                        if (($row['status'] ?? '') === 'Proses') {
                                            $badgeClass = 'badge-proses';
                                        }

                                        if (($row['status'] ?? '') === 'Selesai') {
                                            $badgeClass = 'badge-selesai';
                                        }
                                        ?>

                                        <tr>

                                            <td>

                                                <small>
                                                    <?= date(
                                                        'd/m/Y H:i',
                                                        strtotime($row['tgl_pelaporan'])
                                                    ) ?>
                                                </small>

                                            </td>

                                            <td>

                                                <strong>
                                                    <?= htmlspecialchars(
                                                        $row['nama_siswa'] ?? '-'
                                                    ) ?>
                                                </strong>

                                                <br>

                                                <small>
                                                    <?= htmlspecialchars(
                                                        $row['kelas'] ?? '-'
                                                    ) ?>
                                                </small>

                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $row['ket_kategori'] ?? '-'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $row['lokasi'] ?? '-'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $row['ket'] ?? '-'
                                                ) ?>
                                            </td>


                                            <!-- STATUS -->

                                            <td>

                                                <span class="badge <?= $badgeClass ?>">
                                                    <?= htmlspecialchars(
                                                        $row['status'] ?? 'Menunggu'
                                                    ) ?>
                                                </span>

                                            </td>


                                            <!-- FEEDBACK -->

                                            <td>

                                                <form
                                                    action="../CONTROLLERS/c_aspirasi.php?aksi=update_status_feedback"
                                                    method="POST"
                                                >

                                                    <input
                                                        type="hidden"
                                                        name="id_input"
                                                        value="<?= htmlspecialchars($row['id_input']) ?>"
                                                    >


                                                    <select
                                                        class="status-select"
                                                        name="status"
                                                        required
                                                    >

                                                        <option
                                                            value="Menunggu"
                                                            <?= (($row['status'] ?? 'Menunggu') === 'Menunggu')
                                                                ? 'selected'
                                                                : '' ?>
                                                        >
                                                            Menunggu
                                                        </option>

                                                        <option
                                                            value="Proses"
                                                            <?= (($row['status'] ?? '') === 'Proses')
                                                                ? 'selected'
                                                                : '' ?>
                                                        >
                                                            Proses
                                                        </option>

                                                        <option
                                                            value="Selesai"
                                                            <?= (($row['status'] ?? '') === 'Selesai')
                                                                ? 'selected'
                                                                : '' ?>
                                                        >
                                                            Selesai
                                                        </option>

                                                    </select>


                                                    <textarea
                                                        class="feedback-text"
                                                        name="feedback"
                                                        placeholder="Feedback admin"
                                                    ><?= htmlspecialchars($row['feedback'] ?? '') ?></textarea>


                                                    <button
                                                        class="save-btn"
                                                        type="submit"
                                                    >
                                                        Save
                                                    </button>

                                                </form>

                                            </td>


                                            <!-- AKSI -->

                                            <td></td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            <?php endif; ?>


        <?php else: ?>

            <section class="dashboard-hero student-dashboard-hero">
                <div class="dashboard-hero-content">
                    <img class="dashboard-hero-logo" src="../ASSETS/logo_sekolah.png" alt="Logo Sekolah">
                    <h2>Selamat datang di Aplikasi Pengaduan Sarana Prasarana</h2>
                    <h2>SMK Hunter x Hunter</h2>
                    <div class="dashboard-name">
                        <?= htmlspecialchars($nama_siswa ?? 'Siswa') ?>
                    </div>
                    <p class="student-welcome-text">
                        Sampaikan aspirasi dan pengaduanmu untuk membantu menciptakan lingkungan sekolah yang lebih nyaman dan baik.
                    </p>
                </div>
            </section>

            <section class="dashboard-nav-grid student-dashboard-nav" aria-label="Navigasi siswa">
                <a class="dashboard-link student-dashboard-link" href="../CONTROLLERS/c_beranda.php?page=form">
                    <img src="../ASSETS/lakukan_pengaduan.png" alt="">
                    <div class="student-link-text">
                        <span class="student-link-title">Lakukan Pengaduan</span>
                        <small>Sampaikan laporan mengenai kerusakan atau kebutuhan sarana dan prasarana sekolah.</small>
                    </div>
                </a>

                <a class="dashboard-link student-dashboard-link" href="../CONTROLLERS/c_beranda.php?page=histori">
                    <img src="../ASSETS/histori_pengaduan.png" alt="">
                    <div class="student-link-text">
                        <span class="student-link-title">Histori Pengaduan</span>
                        <small>Lihat kembali pengaduan yang telah kamu kirim, status, dan tanggapan dari petugas.</small>
                    </div>
                </a>
            </section>

        <?php endif; ?>

    </div>

<script src="../JS/theme.js"></script>\n</body>

</html>