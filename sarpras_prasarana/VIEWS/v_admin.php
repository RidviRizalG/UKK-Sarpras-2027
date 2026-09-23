<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - Pengaduan Sarana Prasarana</title>
    <link rel="stylesheet" href="../CSS/01-warna-dan-font.css">
    <link rel="stylesheet" href="../CSS/02-navbar-atas.css">
    <link rel="stylesheet" href="../CSS/03-form-dan-tombol.css">
    <link rel="stylesheet" href="../CSS/04-tabel-dan-badge.css">
    <link rel="stylesheet" href="../CSS/05-admin-dan-dashboard.css">
</head>

<body class="dashboard-page">

    <?php
    $page = $_GET['page'] ?? 'dashboard';
    ?>

    <div class="navbar">

        <div class="brand">
            <img class="logo" src="../ASSETS/logo_sekolah_temagelap.png" alt="Logo Sekolah">
            <span>Aplikasi Pengaduan Sarana Prasarana SMK Hunter x Hunter</span>
        </div>

        <div class="user-info">

            <span class="role-name">
                Admin:
                <?= htmlspecialchars($nama_admin) ?>
            </span>

            <small>
                (<?= htmlspecialchars($role_admin) ?>)
            </small>

            <button type="button" class="theme-toggle" data-theme-toggle aria-label="Ganti tema"></button>
            <a
                class="btn-logout"
                href="../CONTROLLERS/c_logout.php"
                title="Logout"
            >
                <img src="../assets/logout.png" alt="Logout">
            </a>

        </div>

    </div>

    <!-- =========================
         CONTENT
    ========================= -->

    <div class="container">

        <?php if ($page !== 'edit_siswa' && $page !== 'dashboard'): ?>
            <!-- ADMIN NAVIGATION -->

            <div class="admin-nav">

                <div class="menu">

                    <a
                        class="<?= $page === 'dashboard' ? 'active' : '' ?>"
                        href="../CONTROLLERS/c_admin.php?page=dashboard"
                        title="Dashboard"
                        style="padding:8px 12px; font-weight:700; color:#4a0e17;"
                    >
                        <img src="../assets/logo_dashboard.png" alt="Dashboard" style="width:24px;height:24px;object-fit:contain;display:block;">
                    </a>

                    <a
                        class="<?= $page === 'histori' ? 'active' : '' ?>"
                        href="../CONTROLLERS/c_admin.php?page=histori"
                        title="Histori Aspirasi"
                    >
                        <img src="../assets/historiaspirasi.png" alt="Histori Aspirasi">
                    </a>

                    <a
                        class="<?= $page === 'siswa' ? 'active' : '' ?>"
                        href="../CONTROLLERS/c_admin.php?page=siswa"
                        title="List Siswa"
                    >
                        <img src="../assets/datasiswa.png" alt="List Siswa">
                    </a>

                </div>

                <small>Admin Panel</small>

            </div>
        <?php endif; ?>

        <?php if ($page === 'dashboard'): ?>

            <div class="dashboard-hero">
                <div class="dashboard-hero-content">
                    <img class="dashboard-hero-logo" src="../ASSETS/logo_sekolah.png" alt="Logo Sekolah">
                    <h2>Selamat datang di Pengaduan Sarana Prasarana</h2>
                    <h2>SMK Hunter x Hunter</h2>
                    <div class="dashboard-name">
                        <?= htmlspecialchars($_SESSION['nama_admin'] ?? 'Admin') ?>
                    </div>
                    <h3>Kelola data siswa dan pantau histori aspirasi secara mudah dan terorganisir</h3>
                </div>
            </div>

            <div class="dashboard-nav-grid">
                <a class="dashboard-link" href="../CONTROLLERS/c_admin.php?page=histori">
                    <img src="../assets/historiaspirasi.png" alt="Histori Aspirasi">
                    <span>Histori Aspirasi</span>
                </a>

                <a class="dashboard-link" href="../CONTROLLERS/c_admin.php?page=siswa">
                    <img src="../assets/datasiswa.png" alt="List Siswa">
                    <span>List Siswa</span>
                </a>
            </div>

        <?php elseif ($page === 'siswa' && $showAddForm): ?>

            <div class="card">
                <h3>Tambah Siswa</h3>

                <form action="../CONTROLLERS/c_siswa.php?aksi=tambah" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="number" name="nis" placeholder="NIS" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" placeholder="Nama Siswa" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" placeholder="Kelas" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" placeholder="Jurusan" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required autocomplete="off">
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                    </div>

                    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                        <button type="submit" class="btn-submit" style="width:auto;min-width:180px;">Tambah Siswa</button>
                        <a href="../CONTROLLERS/c_admin.php?page=siswa" class="btn-logout" style="display:inline-flex;align-items:center;justify-content:center;width:120px;height:40px;padding:0;">Batal</a>
                    </div>
                </form>
            </div>

        <?php elseif ($page === 'siswa'): ?>

            <div class="card">

                <h3>List Siswa</h3>

                <div style="margin-bottom:16px;">
                    <a href="../CONTROLLERS/c_admin.php?page=siswa&show_add=1" class="btn-logout" title="Tambah Siswa" style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;padding:0;">
                        <img src="../assets/tambah_datasiswa.png" alt="Tambah Siswa" style="width:24px;height:24px;object-fit:contain;display:block;filter:brightness(0) invert(1);">
                    </a>
                </div>

                <form method="GET" action="../CONTROLLERS/c_admin.php" style="margin-bottom:16px;">
                    <input type="hidden" name="page" value="siswa">
                    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                        <input
                            type="text"
                            name="siswa_keyword"
                            value="<?= htmlspecialchars($siswaKeyword ?? '') ?>"
                            placeholder="Cari NIS, nama, kelas, jurusan..."
                            style="max-width:420px;"
                            autocomplete="off"
                        >
                        <button type="submit" class="btn-submit" title="Cari" style="width:auto;padding:10px 16px;display:inline-flex;align-items:center;justify-content:center;">
                            <img src="../assets/search_aspirasi.png" alt="Cari" style="width:24px;height:24px;object-fit:contain;display:block;filter:brightness(0) invert(1);">
                        </button>
                        <?php if (($siswaKeyword ?? '') !== ''): ?>
                            <a href="../CONTROLLERS/c_admin.php?page=siswa" class="btn-logout" style="display:inline-block;">Reset</a>
                        <?php endif; ?>
                    </div>
                </form>

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
                                        style="text-align:center;color:#888;padding:20px;"
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
                                                title="Edit Siswa"
                                                style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:#fdf4f5;border:1px solid #f0d7dd;"
                                            >
                                                <img src="../assets/edit_datasiswa.png" alt="Edit Siswa" style="width:18px;height:18px;object-fit:contain;display:block;">
                                            </a>

                                            <a
                                                href="../CONTROLLERS/c_siswa.php?aksi=hapus&nis=<?= urlencode($s['nis']) ?>"
                                                onclick="return confirm('Hapus siswa ini?')"
                                                title="Hapus Siswa"
                                                style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:8px;background:#fdf4f5;border:1px solid #f0d7dd;"
                                            >
                                                <img src="../assets/hapus_datasiswa.png" alt="Hapus Siswa" style="width:18px;height:18px;object-fit:contain;display:block;">
                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <div class="pagination" style="margin-top:14px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                    <?php if ($siswaPage > 1): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_admin.php?page=siswa&siswa_page=<?= (int)($siswaPage - 1) ?>">Sebelumnya</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalSiswaPages; $i++): ?>
                        <a class="btn-logout" style="<?= $i === $siswaPage ? 'background:#6b1d2f;color:#fff;' : '' ?>" href="../CONTROLLERS/c_admin.php?page=siswa&siswa_page=<?= $i ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($siswaPage < $totalSiswaPages): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_admin.php?page=siswa&siswa_page=<?= (int)($siswaPage + 1) ?>">Berikutnya</a>
                    <?php endif; ?>
                </div>

            </div>

        <?php elseif ($page === 'edit_siswa'): ?>

            <div class="card">

                <h3>Edit Siswa</h3>

                <form
                    action="../CONTROLLERS/c_siswa.php?aksi=update"
                    method="POST"
                    autocomplete="off"
                >

                    <?php if ($page === 'edit_siswa' && !empty($editing_siswa)): ?>
                        <input type="hidden" name="nis_lama" value="<?= htmlspecialchars($editing_siswa['nis'] ?? '') ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>NIS</label>

                        <input
                            type="number"
                            name="nis"
                            placeholder="NIS"
                            value="<?= htmlspecialchars($editing_siswa['nis'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>

                        <input
                            type="text"
                            name="nama_siswa"
                            placeholder="Nama Siswa"
                            value="<?= htmlspecialchars($editing_siswa['nama_siswa'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>

                        <input
                            type="text"
                            name="kelas"
                            placeholder="Kelas"
                            value="<?= htmlspecialchars($editing_siswa['kelas'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>

                        <input
                            type="text"
                            name="jurusan"
                            placeholder="Jurusan"
                            value="<?= htmlspecialchars($editing_siswa['jurusan'] ?? '') ?>"
                            required
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>

                        <select
                            name="jenis_kelamin"
                            required
                            autocomplete="off"
                        >
                            <option value="L" <?= ($page === 'edit_siswa' && ($editing_siswa['jenis_kelamin'] ?? '') === 'L') ? 'selected' : '' ?>>L</option>
                            <option value="P" <?= ($page === 'edit_siswa' && ($editing_siswa['jenis_kelamin'] ?? '') === 'P') ? 'selected' : '' ?>>P</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            value="<?= htmlspecialchars($editing_siswa['password'] ?? '') ?>"
                            required
                            autocomplete="new-password"
                        >
                    </div>

                    <button type="submit" class="btn-submit">
                        Simpan Perubahan
                    </button>

                </form>

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
                                        style="text-align:center;color:#888;padding:20px;"
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

                                        <td>

                                            <span class="badge <?= $badgeClass ?>">
                                                <?= htmlspecialchars(
                                                    $row['status'] ?? 'Menunggu'
                                                ) ?>
                                            </span>

                                        </td>

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
                                                    title="Simpan"
                                                >
                                                    <img src="../assets/save_historiaspirasi.png" alt="Simpan">
                                                </button>

                                            </form>

                                        </td>

                                        <td></td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <div class="pagination" style="margin-top:14px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                    <?php if ($aspirasiPage > 1): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_admin.php?page=histori&aspirasi_page=<?= (int)($aspirasiPage - 1) ?>">Sebelumnya</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalAspirasiPages; $i++): ?>
                        <a class="btn-logout" style="<?= $i === $aspirasiPage ? 'background:#6b1d2f;color:#fff;' : '' ?>" href="../CONTROLLERS/c_admin.php?page=histori&aspirasi_page=<?= $i ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($aspirasiPage < $totalAspirasiPages): ?>
                        <a class="btn-logout" href="../CONTROLLERS/c_admin.php?page=histori&aspirasi_page=<?= (int)($aspirasiPage + 1) ?>">Berikutnya</a>
                    <?php endif; ?>
                </div>

            </div>

        <?php endif; ?>

    </div>

<script src="../JS/theme.js"></script>
</body>

</html>