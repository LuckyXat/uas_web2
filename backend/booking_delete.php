<?php
include("includes/config.php");

if (isset($_GET['id_booking'])) {
    $id_booking = $_GET['id_booking'];

    // Ambil nama gambar untuk dihapus
    $query = "SELECT gambarbooking FROM booking WHERE id_booking='$id_booking'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['gambarbooking']) && file_exists("uploads/" . $row['gambarbooking'])) {
        unlink("uploads/" . $row['gambarbooking']); // Hapus gambar
    }

    // Hapus data booking dari database
    $query = "DELETE FROM booking WHERE id_booking='$id_booking'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data booking berhasil dihapus!'); window.location='booking.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
    }
}
?>
