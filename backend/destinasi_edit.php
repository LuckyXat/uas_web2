<?php
include("includes/config.php");

if (isset($_POST['Update'])) {
    $idDestinasi = $_POST['destinasi_ID'];
    $namaDestinasi = $_POST['destinasi_NAMA'];
    $alamatDestinasi = $_POST['destinasi_ALAMAT'];
    $tripDestinasi = $_POST['destinasi_TRIP'];
    $kategoriID = $_POST['kategori_ID'];
    $kabupatenID = $_POST['kabupaten_ID'];

    $fotoDestinasi = $_POST['existing_foto'];
    if (!empty($_FILES['destinasi_FOTO']['name'])) {
        $targetDir = "images/";
        $fotoDestinasi = $targetDir . basename($_FILES['destinasi_FOTO']['name']);
        $fileType = strtolower(pathinfo($fotoDestinasi, PATHINFO_EXTENSION));

        if (in_array($fileType, ['jpg', 'jpeg', 'png'])) {
            if (!move_uploaded_file($_FILES['destinasi_FOTO']['tmp_name'], $fotoDestinasi)) {
                echo "<div class='alert alert-danger'>Gagal mengunggah gambar.</div>";
                exit();
            }
        } else {
            echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, dan PNG diperbolehkan.</div>";
            exit();
        }
    }

    $query = "UPDATE destinasi SET destinasi_NAMA='$namaDestinasi', destinasi_ALAMAT='$alamatDestinasi', destinasi_FOTO='$fotoDestinasi', 
              destinasi_TRIP='$tripDestinasi', kategori_ID='$kategoriID', kabupaten_ID='$kabupatenID' WHERE destinasi_ID='$idDestinasi'";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Destinasi berhasil diupdate!</div>";
        header("location: destinasi.php");
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
    }
}
?>
