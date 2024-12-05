<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $kecamatanID = $_GET['id'];

    mysqli_query($conn, "DELETE FROM kecamatan WHERE kecamatan_ID = '$kecamatanID'");

    header("location: kecamatan.php");
}
?>
