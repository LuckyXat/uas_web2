<?php
// Konfigurasi database
$host = 'localhost'; // Server database (default: localhost)
$username = 'root';  // Username database (default: root untuk XAMPP)
$password = '';      // Password database (default: kosong untuk XAMPP)
$database = 'pariwisata'; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// // Cek koneksi
// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }

// echo "Koneksi berhasil!";
?>
