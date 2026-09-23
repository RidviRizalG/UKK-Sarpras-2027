<?php

class Koneksi
{
    private $host = "127.0.0.1";
    private $port = 3307;
    private $username = "root";
    private $pass = "";
    private $db = "sarana_prasaranarpl4";

    public $koneksi;

    public function __construct()
    {
        $this->koneksi = mysqli_connect(
            $this->host,
            $this->username,
            $this->pass,
            $this->db,
            $this->port
        );

        if (!$this->koneksi) {
            die("Koneksi ke database gagal: " . mysqli_connect_error());
        }

        mysqli_set_charset($this->koneksi, "utf8mb4");
    }
}

$koneksi = new Koneksi();

$conn = $koneksi->koneksi;
?>