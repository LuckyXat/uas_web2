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
                    <h1 class="mt-4">Kelola Destinasi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Destinasi</li>
                    </ol>

<?php
// Memanggil koneksi ke MYSQL
include("includes/config.php");

// Tambahkan data
if (isset($_POST['Simpan'])) {
    $destinasiID = $_POST['inputID'];
    $destinasiNAMA = $_POST['inputNAMA'];
    $destinasiALAMAT = $_POST['inputALAMAT'];
    $destinasiFOTO =''; // Inisialisasi
    $destinasiTRIP = $_POST['inputTRIP'];
    $kategoriID = $_POST['inputKATEGORI'];
    $kabupatenID = $_POST['inputKABUPATEN'];

    mysqli_query($conn, "INSERT INTO destinasi VALUES ('$destinasiID', '$destinasiNAMA', '$destinasiALAMAT', '$destinasiFOTO', '$destinasiTRIP', '$kategoriID', '$kabupatenID')");
    header("location: destinasi.php");
}

    // Proses Upload Foto
    if (isset($_FILES['inputFOTO']) && $_FILES['inputFOTO']['error'] == 0) {
        $fotoTemp = $_FILES['inputFOTO']['tmp_name'];
        $fotoName = $_FILES['inputFOTO']['name'];
        $fotoPath = 'img/' . $fotoName;

        // Pindahkan file ke folder img
        if (move_uploaded_file($fotoTemp, $fotoPath)) {
            $destinasiFOTO = $fotoPath; // Set foto yang berhasil diupload
        }
    }

    
        $search = '';
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    }
    $query = mysqli_query($conn, "SELECT kabupaten.*, provinsi.provinsi_NAMA FROM kabupaten 
                                JOIN provinsi ON kabupaten.provinsi_ID = provinsi.provinsi_ID 
                                WHERE kabupaten.kabupaten_NAMA LIKE '%$search%'");

    // Hapus data
    if (isset($_GET['delete_id'])) {
        $deleteID = $_GET['delete_id'];
        mysqli_query($conn, "DELETE FROM destinasi WHERE destinasi_ID='$deleteID'");
        header("location: destinasi.php");
    }

    $query = mysqli_query($conn, "SELECT * FROM destinasi");
    ?>

    <div class="container mt-5">
        <form method="POST">
            <div class="row mb-3">
                <label for="destinasiID" class="col-sm-2 col-form-label">Kode Destinasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="destinasiID" name="inputID" placeholder="Kode Destinasi" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="destinasiNAMA" class="col-sm-2 col-form-label">Nama Destinasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="destinasiNAMA" name="inputNAMA" placeholder="Nama Destinasi" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="destinasiALAMAT" class="col-sm-2 col-form-label">Alamat Destinasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="destinasiALAMAT" name="inputALAMAT" placeholder="Alamat Destinasi" required>
                </div>
            </div>

            <div class="row mb-3">
            <label for="destinasiFOTO" class="col-sm-2 col-form-label">Foto Destinasi</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="destinasiFOTO" name="inputFOTO" required>
            </div>
            </div>

            <div class="row mb-3">
                <label for="destinasiTRIP" class="col-sm-2 col-form-label">Trip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="destinasiTRIP" name="inputTRIP" placeholder="Trip Destinasi" required>
                </div>
            </div>

            <div class="row mb-3">
            <label for="kategoriID" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <select class="form-control" id="kategoriID" name="inputKATEGORI" required>
                    <option value="">Pilih Kategori</option>
                    <?php
                    $kategoriQuery = mysqli_query($conn, "SELECT * FROM kategori");
                    while ($kategori = mysqli_fetch_array($kategoriQuery)) {
                        echo "<option value='{$kategori['kategori_ID']}'>{$kategori['kategori_NAMA']}</option>";
                    }
                    ?>
                </select>
            </div>
            </div>

        <div class="row mb-3">
            <label for="kabupatenID" class="col-sm-2 col-form-label">Kabupaten</label>
            <div class="col-sm-10">
                <select class="form-control" id="kabupatenID" name="inputKABUPATEN" required>
                    <option value="">Pilih Kabupaten</option>
                    <?php
                    $kabupatenQuery = mysqli_query($conn, "SELECT * FROM kabupaten");
                    while ($kabupaten = mysqli_fetch_array($kabupatenQuery)) {
                        echo "<option value='{$kabupaten['kabupaten_ID']}'>{$kabupaten['kabupaten_NAMA']}</option>";
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
        <th>Foto</th>
        <th>Trip</th>
        <th>Kategori</th>
        <th>Kabupaten</th>
        <th>Aksi</th>   
    </tr>
    <?php while ($row = mysqli_fetch_array($query)) { ?>
    <tr>
        <td><?php echo $row['destinasi_ID']; ?></td>
        <td><?php echo $row['destinasi_NAMA']; ?></td>
        <td><?php echo $row['destinasi_ALAMAT']; ?></td>
        <td><img src="<?php echo $row['destinasi_FOTO']; ?>" width="100" alt="Destinasi Foto"></td>
        <td><?php echo $row['destinasi_TRIP']; ?></td>
        <td><?php echo $row['kategori_ID']; ?></td>
        <td><?php echo $row['kabupaten_ID']; ?></td>
        <td>
            <a href="destinasi_edit.php?id=<?php echo $row['destinasi_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
            <a href="destinasi.php?delete_id=<?php echo $row['destinasi_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

    </div>
    </body>
    </html>