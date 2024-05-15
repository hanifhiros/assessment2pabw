<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "desa_tanggap");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

