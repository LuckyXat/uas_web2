<!DOCTYPE html>
<html>

<?php
include("includes/config.php");

if (isset($_GET['id'])) {
    $kabupatenID = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM kabupaten WHERE kabupaten_ID = '$kabupatenID'");
    $data = mysqli_fetch_array($query);
}

if (isset($_POST['Update'])) {
    $kabupatenID = $_POST['inputID'];
    $kabupatenNAMA = $_POST['inputNAMA'];
    $provinsiID = $_POST['inputProvinsi'];

    mysqli_query($conn, "UPDATE kabupaten SET kabupaten_NAMA='$kabupatenNAMA', provinsi_ID='$provinsiID' WHERE kabupaten_ID='$kabupatenID'");
    header("location: kabupaten.php");
}
?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Kabupaten</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h2>Edit Kabupaten</h2>
    <form method="POST">
        <div class="row mb-3">
            <label for="kabupatenID" class="col-sm-2 col-form-label">Kode Kabupaten</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kabupatenID" name="inputID" value="<?php echo $data['kabupaten_ID']; ?>" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kabupatenNAMA" class="col-sm-2 col-form-label">Nama Kabupaten</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kabupatenNAMA" name="inputNAMA" value="<?php echo $data['kabupaten_NAMA']; ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="provinsiID" class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-10">
                <select class="form-control" id="provinsiID" name="inputProvinsi" required>
                    <option value="">Pilih Provinsi</option>
                    <?php
                    $provinsiQuery = mysqli_query($conn, "SELECT * FROM provinsi");
                    while ($provinsi = mysqli_fetch_array($provinsiQuery)) {
                        $selected = $provinsi['provinsi_ID'] == $data['provinsi_ID'] ? "selected" : "";
                        echo "<option value='{$provinsi['provinsi_ID']}' $selected>{$provinsi['provinsi_NAMA']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" class="btn btn-success" value="Update" name="Update">
                <a href="kabupaten.php" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
