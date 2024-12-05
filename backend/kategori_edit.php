<!DOCTYPE html>
<html>

<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $kategoriID = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_ID = '$kategoriID'");
    $data = mysqli_fetch_array($query);
}

// Update data
if (isset($_POST['Update'])) {
    $kategoriID = $_POST['inputID'];
    $kategoriNAMA = $_POST['inputNAMA'];
    $kategoriKET = $_POST['inputKETERANGAN'];

    mysqli_query($conn, "UPDATE kategori SET kategori_NAMA='$kategoriNAMA', kategori_KET='$kategoriKET' WHERE kategori_ID='$kategoriID'");
    header("location: kategori.php");
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Kategori Wisata</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h2>Edit Kategori</h2>
    <form method="POST">
        <div class="row mb-3">
            <label for="kategoriID" class="col-sm-2 col-form-label">Kode Kategori Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kategoriID" name="inputID" value="<?php echo $data['kategori_ID']; ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kategoriNAMA" class="col-sm-2 col-form-label">Nama Kategori Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kategoriNAMA" name="inputNAMA" value="<?php echo $data['kategori_NAMA']; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kategoriKET" class="col-sm-2 col-form-label">Keterangan Kategori Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kategoriKET" name="inputKETERANGAN" value="<?php echo $data['kategori_KET']; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" class="btn btn-success" value="Update" name="Update">
                <a href="kategori.php" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>