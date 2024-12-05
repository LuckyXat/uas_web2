<!DOCTYPE html>
<html>

<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $kecamatanID = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM kecamatan WHERE kecamatan_ID = '$kecamatanID'");
    $data = mysqli_fetch_array($query);
}

if (isset($_POST['Update'])) {
    $kecamatanID = $_POST['inputID'];
    $kecamatanNAMA = $_POST['inputNAMA'];
    $kabupatenID = $_POST['inputKABUPATEN'];

    mysqli_query($conn, "UPDATE kecamatan SET kecamatan_NAMA='$kecamatanNAMA', kabupaten_ID='$kabupatenID' WHERE kecamatan_ID='$kecamatanID'");
    header("location: kecamatan.php");
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Kecamatan</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h2>Edit Kecamatan</h2>
    <form method="POST">
        <div class="row mb-3">
            <label for="kecamatanID" class="col-sm-2 col-form-label">Kode Kecamatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kecamatanID" name="inputID" value="<?php echo $data['kecamatan_ID']; ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kecamatanNAMA" class="col-sm-2 col-form-label">Nama Kecamatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kecamatanNAMA" name="inputNAMA" value="<?php echo $data['kecamatan_NAMA']; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kabupatenID" class="col-sm-2 col-form-label">Kode Kabupaten</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kabupatenID" name="inputKABUPATEN" value="<?php echo $data['kabupaten_ID']; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" class="btn btn-success" value="Update" name="Update">
                <a href="kecamatan.php" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
