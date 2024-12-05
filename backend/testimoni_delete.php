<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}

include("includes/config.php");

if (isset($_GET['id'])) {
    $testimoniID = $_GET['id'];

    // Fetch the photo path for deletion
    $query = mysqli_query($conn, "SELECT testimoni_FOTO FROM testimoni WHERE testimoni_ID = '$testimoniID'");
    $row = mysqli_fetch_array($query);
    $fotoPath = $row['testimoni_FOTO'];

    // Delete the testimonial from the database
    $queryDelete = "DELETE FROM testimoni WHERE testimoni_ID = '$testimoniID'";

    if (mysqli_query($conn, $queryDelete)) {
        // Remove the photo from the server if it exists
        if (file_exists($fotoPath) && !empty($fotoPath)) {
            unlink($fotoPath);
        }
        echo "<div class='alert alert-success'>Testimoni berhasil dihapus!</div>";
        header("Location: testimoni.php");
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
    }
} else {
    header("Location: testimoni.php");
}
?>
