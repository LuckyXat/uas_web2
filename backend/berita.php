<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
    exit();
}
include("includes/config.php");

// Tambah berita
if (isset($_POST['Simpan'])) {
    $beritaID = $_POST['inputID'];
    $beritaJUDUL = $_POST['inputJUDUL'];
    $beritaISI = $_POST['inputISI'];
    $beritaSUMBER = $_POST['inputSUMBER'];
    $kategoriID = $_POST['inputKategori'];

    // Proses Upload File
    $fotoPath = '';
    if (!empty($_FILES['inputFOTO']['name'])) {
        $targetDir = "img/";
        $fotoPath = $targetDir . basename($_FILES['inputFOTO']['name']);
        $imageFileType = strtolower(pathinfo($fotoPath, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            if (move_uploaded_file($_FILES['inputFOTO']['tmp_name'], $fotoPath)) {
                // File uploaded successfully
            } else {
                echo "<script>alert('Gagal mengunggah file.');</script>";
                exit();
            }
        } else {
            echo "<script>alert('Jenis file tidak didukung. Hanya JPG, PNG, dan JPEG diperbolehkan.');</script>";
            exit();
        }
    }

    // Simpan data ke database
    $query = "INSERT INTO berita (berita_ID, berita_JUDUL, berita_ISI, berita_SUMBER, berita_FOTO, kategori_ID) 
              VALUES ('$beritaID', '$beritaJUDUL', '$beritaISI', '$beritaSUMBER', '$fotoPath', '$kategoriID')";
    if (mysqli_query($conn, $query)) {
        header("location: berita.php");
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
    }
}

// Pencarian
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchTerm) {
    $query = mysqli_query($conn, "SELECT * FROM berita WHERE berita_JUDUL LIKE '%$searchTerm%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM berita");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kelola Berita</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="sb-nav-fixed">
    <?php include("includes/head.php"); ?>
    <?php include("includes/menunav.php"); ?>

    <div id="layoutSidenav">
        <?php include("includes/menu.php"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Kelola Berita</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Berita</li>
                    </ol>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="inputID" class="form-label">Kode Berita</label>
                            <input type="text" class="form-control" id="inputID" name="inputID" placeholder="Kode Berita" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputJUDUL" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control" id="inputJUDUL" name="inputJUDUL" placeholder="Judul Berita" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputISI" class="form-label">Isi Berita</label>
                            <textarea class="form-control" id="inputISI" name="inputISI" placeholder="Isi Berita" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputSUMBER" class="form-label">Sumber Berita</label>
                            <input type="text" class="form-control" id="inputSUMBER" name="inputSUMBER" placeholder="Sumber Berita" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputFOTO" class="form-label">Foto Berita</label>
                            <input type="file" class="form-control" id="inputFOTO" name="inputFOTO" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputKategori" class="form-label">Kategori</label>
                            <select class="form-control" id="inputKategori" name="inputKategori" required>
                                <option value="">Pilih Kategori</option>
                                <?php
                                $kategoriQuery = mysqli_query($conn, "SELECT * FROM kategori");
                                while ($kategori = mysqli_fetch_array($kategoriQuery)) {
                                    echo "<option value='{$kategori['kategori_ID']}'>{$kategori['kategori_NAMA']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" name="Simpan">Simpan</button>
                        <button type="reset" class="btn btn-danger">Batal</button>
                    </form>

                    <form method="GET" class="my-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari Judul Berita" value="<?php echo $searchTerm; ?>">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>

                    <table class="table table-striped table-hover mt-4">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Sumber</th>
                                <th>Foto</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $row['berita_ID']; ?></td>
                                    <td><?php echo $row['berita_JUDUL']; ?></td>
                                    <td><?php echo $row['berita_ISI']; ?></td>
                                    <td><?php echo $row['berita_SUMBER']; ?></td>
                                    <td><img src="<?php echo $row['berita_FOTO']; ?>" alt="Foto" width="100"></td>
                                    <td><?php echo $row['kategori_ID']; ?></td>
                                    <td>
                                        <a href="berita_edit.php?id=<?php echo $row['berita_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="berita_delete.php?id=<?php echo $row['berita_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
