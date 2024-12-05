<?php
include("includes/config.php");

if (isset($_GET['hapusdestinasi'])) {
    $idDestinasi = $_GET['hapusdestinasi'];

    // Get file path
    $result = mysqli_query($conn, "SELECT destinasi_FOTO FROM destinasi WHERE destinasi_ID='$idDestinasi'");
    $row = mysqli_fetch_assoc($result);
    $filePath = $row['destinasi_FOTO'];

    // Delete file
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete data from database
    $query = "DELETE FROM destinasi WHERE destinasi_ID='$idDestinasi'";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Destinasi berhasil dihapus!</div>";
        header("location: destinasi.php");
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
    }
}
?>
