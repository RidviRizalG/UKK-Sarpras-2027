<?php
class M_Siswa {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    public function countSiswa($keyword = '') {
        $keyword = mysqli_real_escape_string($this->db, $keyword);
        $query = "SELECT COUNT(*) AS total FROM siswa";

        if ($keyword !== '') {
            $query .= " WHERE nis LIKE '%$keyword%' OR nama_siswa LIKE '%$keyword%' OR kelas LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
        }

        $result = mysqli_query($this->db, $query);
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }

    public function getSiswa($limit = null, $offset = 0, $keyword = '') {
        $keyword = mysqli_real_escape_string($this->db, $keyword);
        $query = "SELECT * FROM siswa";

        if ($keyword !== '') {
            $query .= " WHERE nis LIKE '%$keyword%' OR nama_siswa LIKE '%$keyword%' OR kelas LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
        }

        $query .= " ORDER BY CAST(nis AS UNSIGNED) ASC, nis ASC";

        if ($limit !== null) {
            $query .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        }

        $result = mysqli_query($this->db, $query);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getSiswaByNis($nis) {
        $query = "SELECT * FROM siswa WHERE nis = '$nis' LIMIT 1";
        $result = mysqli_query($this->db, $query);
        return mysqli_fetch_assoc($result);
    }

    public function tambahSiswa($nis, $namaSiswa, $kelas, $jurusan, $jenisKelamin, $password) {
        $query = "INSERT INTO siswa (nis, nama_siswa, kelas, jurusan, jenis_kelamin, password)
                  VALUES ('$nis', '$namaSiswa', '$kelas', '$jurusan', '$jenisKelamin', '$password')";
        return mysqli_query($this->db, $query);
    }

    public function updateSiswa($nisLama, $nisBaru, $namaSiswa, $kelas, $jurusan, $jenisKelamin, $password) {
        $nisLama = mysqli_real_escape_string($this->db, $nisLama);
        $nisBaru = mysqli_real_escape_string($this->db, $nisBaru);
        $namaSiswa = mysqli_real_escape_string($this->db, $namaSiswa);
        $kelas = mysqli_real_escape_string($this->db, $kelas);
        $jurusan = mysqli_real_escape_string($this->db, $jurusan);
        $jenisKelamin = mysqli_real_escape_string($this->db, $jenisKelamin);
        $password = mysqli_real_escape_string($this->db, $password);

        $query = "UPDATE siswa SET
                    nis = '$nisBaru',
                    nama_siswa = '$namaSiswa',
                    kelas = '$kelas',
                    jurusan = '$jurusan',
                    jenis_kelamin = '$jenisKelamin',
                    password = '$password'
                  WHERE nis = '$nisLama'";
        return mysqli_query($this->db, $query);
    }

    public function hapusSiswa($nis) {
        $query = "DELETE FROM siswa WHERE nis = '$nis'";
        return mysqli_query($this->db, $query);
    }
}
?>
