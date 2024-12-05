<?php
include("../admin/includes/config.php");

if (isset($_GET['id'])) {
    $kategoriID = $_GET['id'];

    // Hapus data berdasarkan kategori_ID
    $query = mysqli_query($conn, "DELETE FROM kategori WHERE kategori_ID = '$kategoriID'");

    // Redirect kembali ke kategori.php
    header("location: kategori.php");
}
?>