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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

<?php
// Memanggil koneksi ke MYSQL
include("includes/config.php");

// Tambahkan data
if (isset($_POST['Simpan'])) {
    $kecamatanID = $_POST['inputID'];
    $kecamatanNAMA = $_POST['inputNAMA'];
    $kabupatenID = $_POST['inputKABUPATEN'];

    mysqli_query($conn, "INSERT INTO kecamatan VALUES ('$kecamatanID', '$kecamatanNAMA', '$kabupatenID')");
    header("location: kecamatan.php");
}

// Hapus data
if (isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM kecamatan WHERE kecamatan_ID='$deleteID'");
    header("location: kecamatan.php");
}

// Search functionality (using GET method)
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = mysqli_query($conn, "SELECT * FROM kecamatan WHERE kecamatan_NAMA LIKE '%$search%'");
?>

<div class="container mt-5">
    <form method="POST">
        <div class="row mb-3">
            <label for="kecamatanID" class="col-sm-2 col-form-label">Kode Kecamatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kecamatanID" name="inputID" placeholder="Kode Kecamatan" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kecamatanNAMA" class="col-sm-2 col-form-label">Nama Kecamatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kecamatanNAMA" name="inputNAMA" placeholder="Nama Kecamatan" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kabupatenID" class="col-sm-2 col-form-label">Kode Kabupaten</label>
            <div class="col-sm-10">
                <select class="form-control" id="kabupatenID" name="inputKABUPATEN" required>
                    <option value="" disabled selected>Pilih Kabupaten</option>
                    <?php
                    // Query to get all kabupaten data
                    $kabupatenQuery = mysqli_query($conn, "SELECT kabupaten_ID, kabupaten_NAMA FROM kabupaten");
                    while ($kabupatenRow = mysqli_fetch_array($kabupatenQuery)) {
                        echo '<option value="' . $kabupatenRow['kabupaten_ID'] . '">' . $kabupatenRow['kabupaten_NAMA'] . '</option>';
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

    
    <!-- Search Form (GET Method) -->
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-sm-10">
                <input type="text" class="form-control" name="search" placeholder="Cari Nama Kecamatan" value="<?php echo $search; ?>">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-success table-hover mt-5">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kabupaten</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?php echo $row['kecamatan_ID']; ?></td>
            <td><?php echo $row['kecamatan_NAMA']; ?></td>
            <td><?php echo $row['kabupaten_ID']; ?></td>
            <td>
                <a href="kecamatan_edit.php?id=<?php echo $row['kecamatan_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="kecamatan.php?delete_id=<?php echo $row['kecamatan_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kecamatan ini?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
