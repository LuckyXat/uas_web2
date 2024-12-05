<!DOCTYPE html>
<html>

<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $wisataID = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM destinasiwisata WHERE wisata_ID = '$wisataID'");
    $data = mysqli_fetch_array($query);
}

if (isset($_POST['Update'])) {
    $wisataID = $_POST['inputID'];
    $wisataNAMA = $_POST['inputNAMA'];
    $wisataALAMAT = $_POST['inputALAMAT'];
    $wisataKET = $_POST['inputKETERANGAN'];
    $kecamatanID = $_POST['inputKECAMATAN'];

    mysqli_query($conn, "UPDATE destinasiwisata SET wisata_NAMA='$wisataNAMA', wisata_ALAMAT='$wisataALAMAT', wisata_KET='$wisataKET', kecamatan_ID='$kecamatanID' WHERE wisata_ID='$wisataID'");
    header("location: destinasiwisata.php");
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Destinasi Wisata</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h2>Edit Destinasi</h2>
    <form method="POST">
        <div class="row mb-3">
            <label for="wisataID" class="col-sm-2 col-form-label">Kode Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataID" name="inputID" value="<?php echo $data['wisata_ID']; ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="wisataNAMA" class="col-sm-2 col-form-label">Nama Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataNAMA" name="inputNAMA" value="<?php echo $data['wisata_NAMA']; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="wisataALAMAT" class="col-sm-2 col-form-label">Alamat Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataALAMAT" name="inputALAMAT" value="<?php echo $data['wisata_ALAMAT']; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="wisataKET" class="col-sm-2 col-form-label">Keterangan Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataKET" name="inputKETERANGAN" value="<?php echo $data['wisata_KET']; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kecamatanID" class="col-sm-2 col-form-label">Kode Kecamatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kecamatanID" name="inputKECAMATAN" value="<?php echo $data['kecamatan_ID']; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" class="btn btn-success" value="Update" name="Update">
                <a href="destinasiwisata.php" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
