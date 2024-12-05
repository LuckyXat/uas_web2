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
            <div class="        -fluid px-4">
                    <h1 class="mt-4">Kelola Destinasi Wisata</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Destinasi Wisata</li>
                    </ol>

<?php
// Memanggil koneksi ke MYSQL
include("includes/config.php");

// Tambahkan data
if (isset($_POST['Simpan'])) {
    $wisataID = $_POST['inputID'];
    $wisataNAMA = $_POST['inputNAMA'];
    $wisataALAMAT = $_POST['inputALAMAT'];
    $wisataKET = $_POST['inputKETERANGAN'];
    $kecamatanID = $_POST['inputKECAMATAN'];

    mysqli_query($conn, "INSERT INTO destinasiwisata VALUES ('$wisataID', '$wisataNAMA', '$wisataALAMAT', '$wisataKET', '$kecamatanID')");
    header("location: destinasiwisata.php");
}

// Hapus data
if (isset($_GET['delete_id'])) {
    $deleteID = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM destinasiwisata WHERE wisata_ID='$deleteID'");
    header("location: destinasiwisata.php");
}

$query = mysqli_query($conn, "SELECT * FROM destinasiwisata");
?>

<div class="container mt-5">
    <form method="POST">
        <div class="row mb-3">
            <label for="wisataID" class="col-sm-2 col-form-label">Kode Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataID" name="inputID" placeholder="Kode Destinasi Wisata" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="wisataNAMA" class="col-sm-2 col-form-label">Nama Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataNAMA" name="inputNAMA" placeholder="Nama Destinasi Wisata" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="wisataALAMAT" class="col-sm-2 col-form-label">Alamat Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataALAMAT" name="inputALAMAT" placeholder="Alamat Destinasi Wisata" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="wisataKET" class="col-sm-2 col-form-label">Keterangan Destinasi Wisata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="wisataKET" name="inputKETERANGAN" placeholder="Keterangan Destinasi Wisata" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="kecamatanID" class="col-sm-2 col-form-label">Kode Kecamatan</label>
            <div class="col-sm-10">
                <select class="form-control" id="kecamatanID" name="inputKECAMATAN" required>
                    <option value="" disabled selected>Pilih Kecamatan</option>
                    <?php
                    // Query to get all kecamatan data
                    $kecamatanQuery = mysqli_query($conn, "SELECT kecamatan_ID, kecamatan_NAMA FROM kecamatan");
                    while ($kecamatanRow = mysqli_fetch_array($kecamatanQuery)) {
                        echo '<option value="' . $kecamatanRow['kecamatan_ID'] . '">' . $kecamatanRow['kecamatan_NAMA'] . '</option>';
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

    <table class="table table-striped table-success table-hover mt-5">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Keterangan</th>
            <th>Kecamatan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($query)) { ?>
        <tr>
            <td><?php echo $row['wisata_ID']; ?></td>
            <td><?php echo $row['wisata_NAMA']; ?></td>
            <td><?php echo $row['wisata_ALAMAT']; ?></td>
            <td><?php echo $row['wisata_KET']; ?></td>
            <td><?php echo $row['kecamatan_ID']; ?></td>
            <td>
                <a href="destinasiwisata_edit.php?id=<?php echo $row['wisata_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="destinasiwisata.php?delete_id=<?php echo $row['wisata_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
