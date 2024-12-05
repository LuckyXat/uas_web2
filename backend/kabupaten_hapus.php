<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $kabupatenID = $_GET['id'];

    mysqli_query($conn, "DELETE FROM kabupaten WHERE kabupaten_ID = '$kabupatenID'");

    header("location: kabupaten.php");
}
?>
