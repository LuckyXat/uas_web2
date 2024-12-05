<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
    exit();
}

// Include database connection
include("includes/config.php");

// Check if the travel ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the travel data to delete the associated image
    $query = mysqli_query($conn, "SELECT * FROM travel WHERE id_travel='$id'");
    $travel = mysqli_fetch_assoc($query);

    if ($travel) {
        // Delete the associated image file if it exists
        if (file_exists($travel['gambartravel'])) {
            unlink($travel['gambartravel']);
        }

        // Delete the travel record
        $deleteQuery = "DELETE FROM travel WHERE id_travel='$id'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "<script>alert('Travel berhasil dihapus!'); window.location='travel.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menghapus data.'); window.location='travel.php';</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location='travel.php';</script>";
    }
} else {
    header("location:travel.php");
}
?>
