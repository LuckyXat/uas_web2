<?php
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
    exit();
}

include("includes/config.php");

if (isset($_GET['id'])) {
    $beritaID = $_GET['id'];
    $query = "DELETE FROM berita WHERE berita_ID='$beritaID'";
    mysqli_query($conn, $query);
    header("location: berita.php");
    exit();
} else {
    echo "ID Berita tidak ditemukan.";
}
?>
