<!DOCTYPE html>
<html>

<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER']))
    header("location:login.php");
?>

<body class="sb-nav-fixed">
    <?php include("includes/head.php"); ?>
    <?php include("includes/menunav.php"); ?>

    <div id="layoutSidenav">
        <?php include("includes/menu.php"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Kelola Kabupaten</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Kabupaten</li>
                    </ol>

<?php
include("includes/config.php");

// Tambahkan data
if (isset($_POST['Simpan'])) {
    $kabupatenID = $_POST['inputID'];
    $kabupatenNAMA = $_POST['inputNAMA'];
    $provinsiID = $_POST['inputProvinsi'];

    mysqli_query($conn, "INSERT INTO kabupaten VALUES ('$kabupatenID', '$kabupatenNAMA', '$provinsiID')");
    header("location: kabupaten.php");
}

// Hapus data
if (isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM kabupaten WHERE kabupaten_ID='$deleteID'");
    header("location: kabupaten.php");
}

// Pencarian
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$query = mysqli_query($conn, "SELECT kabupaten.*, provinsi.provinsi_NAMA FROM kabupaten 
                               JOIN provinsi ON kabupaten.provinsi_ID = provinsi.provinsi_ID 
                               WHERE kabupaten.kabupaten_NAMA LIKE '%$search%'");
?>

<div class="container mt-5">
    <form method="POST" class="mb-3">
        <div class="row mb-3">
            <label for="kabupatenID" class="col-sm-2 col-form-label">Kode Kabupaten</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kabupatenID" name="inputID" placeholder="Kode Kabupaten" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kabupatenNAMA" class="col-sm-2 col-form-label">Nama Kabupaten</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kabupatenNAMA" name="inputNAMA" placeholder="Nama Kabupaten" required>
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
                        echo "<option value='{$provinsi['provinsi_ID']}'>{$provinsi['provinsi_NAMA']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
                <input type="reset" class="btn btn-danger" value="Batal">
            </div>
        </div>
    </form>

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-sm-10">
                <input type="text" class="form-control" name="search" placeholder="Cari Nama Kabupaten" value="<?php echo $search; ?>">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-success table-hover mt-3">
        <tr>
            <th>Kode</th>
            <th>Nama Kabupaten</th>
            <th>Provinsi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?php echo $row['kabupaten_ID']; ?></td>
            <td><?php echo $row['kabupaten_NAMA']; ?></td>
            <td><?php echo $row['provinsi_NAMA']; ?></td>
            <td>
                <a href="kabupaten_edit.php?id=<?php echo $row['kabupaten_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="kabupaten.php?delete_id=<?php echo $row['kabupaten_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kabupaten ini?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
