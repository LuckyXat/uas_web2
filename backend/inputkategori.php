<?php
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("Location: login.php");
    exit;
}
include "include/config.php";

if (isset($_POST['Simpan'])) {
    $kategoriID = $_POST['inputID'];
    $kategoriNAMA = $_POST['inputNAMA'];
    $kategoriKET = $_POST['inputKETERANGAN'];

        mysqli_query($conn, "INSERT INTO kategori VALUES ('$kategoriID', '$kategoriNAMA', '$kategoriKET', '$namafoto')");
        header("Location: inputkategori.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
    <?php include "include/head.php"; ?>

    <body class="sb-nav-fixed">
        <?php include "include/menunav.php"; ?>

        <div id="layoutSidenav">
            <?php include "include/menu.php"; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Input Kategori</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Input Data Kategori Wisata</li>
                        </ol>

                        <!-- Form Input Kategori -->
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="kategoriID" class="col-sm-2 col-form-label">Kode Kategori Wisata</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategoriID" name="inputID" placeholder="Kode Kategori Wisata" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kategoriNAMA" class="col-sm-2 col-form-label">Nama Kategori Wisata</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategoriNAMA" name="inputNAMA" placeholder="Nama Kategori Wisata" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kategoriKET" class="col-sm-2 col-form-label">Keterangan Kategori Wisata</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategoriKET" name="inputKETERANGAN" placeholder="Keterangan Kategori Wisata" required>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success" name="Simpan">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Batal</button>
                                </div>
                            </div>
                        </form>

                        <!-- Form Pencarian Kategori -->
                        <form method="POST" class="mt-5">
                            <div class="row">
                                <label for="search" class="col-sm-2 col-form-label">Cari Kategori</label>
                                <div class="col-sm-8">
                                    <input type="text" name="search" class="form-control" id="search"
                                        value="<?php if (isset($_POST["search"])) echo $_POST["search"]; ?>" placeholder="Masukkan kata kunci">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="kirim" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>

                        <!-- Tabel Data Kategori -->
                        <table class="table table-striped table-hover mt-4">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = isset($_POST["kirim"]) 
                                    ? mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_NAMA LIKE '%" . $_POST["search"] . "%'") 
                                    : mysqli_query($conn, "SELECT * FROM kategori");

                                while ($row = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $row['kategori_ID']; ?></td>
                                        <td><?php echo $row['kategori_NAMA']; ?></td>
                                        <td><?php echo $row['kategori_KET']; ?></td>
                                        <td>
                                            <img src="images/<?php echo $row['kategori_FOTO'] ?: 'noimage.png'; ?>" alt="Foto" width="80">
                                        </td>
                                        <td>
                                            <a href="kategori_edit.php?ubahkategori=<?php echo $row['kategori_ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="kategori_hapus.php?hapuskategori=<?php echo $row['kategori_ID']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </main>
                <?php include "include/footer.php"; ?>
            </div>
        </div>
        <?php include "include/jsscript.php"; ?>
    </body>
</html>
<?php
mysqli_close($conn);
?>
