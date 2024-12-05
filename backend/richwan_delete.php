<?php
include("includes/config.php");

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Ambil data berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM richwan WHERE Y825230123richwan='$id'");
$row = mysqli_fetch_assoc($query);

if ($row) {
    // Hapus foto jika ada
    if (!empty($row['foto']) && file_exists($row['foto'])) {
        unlink($row['foto']);
    }

    // Hapus data dari database
    $deleteQuery = "DELETE FROM richwan WHERE Y825230123richwan='$id'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='richwan.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menghapus data: " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
}
?>
