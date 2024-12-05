<!DOCTYPE html>
<html>

<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $provinsiID = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM provinsi WHERE provinsi_ID = '$provinsiID'");
    $data = mysqli_fetch_array($query);
}

if (isset($_POST['Update'])) {
    $provinsiID = $_POST['inputID'];
    $provinsiNAMA = $_POST['inputNAMA'];

    mysqli_query($conn, "UPDATE provinsi SET provinsi_NAMA='$provinsiNAMA' WHERE provinsi_ID='$provinsiID'");
    header("location: provinsi.php");
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Provinsi</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h2>Edit Provinsi</h2>
    <form method="POST">
        <div class="row mb-3">
            <label for="provinsiID" class="col-sm-2 col-form-label">Kode Provinsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="provinsiID" name="inputID" value="<?php echo $data['provinsi_ID']; ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="provinsiNAMA" class="col-sm-2 col-form-label">Nama Provinsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="provinsiNAMA" name="inputNAMA" value="<?php echo $data['provinsi_NAMA']; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" class="btn btn-success" value="Update" name="Update">
                <a href="provinsi.php" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
