<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $provinsiID = $_GET['id'];

    mysqli_query($conn, "DELETE FROM provinsi WHERE provinsi_ID = '$provinsiID'");

    header("location: provinsi.php");
}
?>
