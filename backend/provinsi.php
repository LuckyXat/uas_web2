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
                    <h1 class="mt-4">Kelola Provinsi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Provinsi</li>
                    </ol>

<?php
// Memanggil koneksi ke MYSQL
include("includes/config.php");

// Tambahkan data
if (isset($_POST['Simpan'])) {
    $provinsiID = $_POST['inputID'];
    $provinsiNAMA = $_POST['inputNAMA'];

    mysqli_query($conn, "INSERT INTO provinsi VALUES ('$provinsiID', '$provinsiNAMA')");
    header("location: provinsi.php");
}

// Hapus data
if (isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM provinsi WHERE provinsi_ID='$deleteID'");
    header("location: provinsi.php");
}

// Pencarian
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$query = mysqli_query($conn, "SELECT * FROM provinsi WHERE provinsi_NAMA LIKE '%$search%'");
?>

<div class="container mt-5">
    <form method="POST" class="mb-3">
        <div class="row mb-3">
            <label for="provinsiID" class="col-sm-2 col-form-label">Kode Provinsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="provinsiID" name="inputID" placeholder="Kode Provinsi" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="provinsiNAMA" class="col-sm-2 col-form-label">Nama Provinsi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="provinsiNAMA" name="inputNAMA" placeholder="Nama Provinsi" required>
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
                <input type="text" class="form-control" name="search" placeholder="Cari Nama Provinsi" value="<?php echo $search; ?>">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-success table-hover mt-3">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?php echo $row['provinsi_ID']; ?></td>
            <td><?php echo $row['provinsi_NAMA']; ?></td>
            <td>
                <a href="provinsi_edit.php?id=<?php echo $row['provinsi_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="provinsi.php?delete_id=<?php echo $row['provinsi_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus provinsi ini?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
