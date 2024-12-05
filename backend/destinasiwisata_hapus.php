<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $wisataID = $_GET['id'];

    mysqli_query($conn, "DELETE FROM wisata WHERE wisata_ID = '$wisataID'");

    header("location: destinasiwisata.php");
}
?>
