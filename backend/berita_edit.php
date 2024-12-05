<?php
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location: login.php");
    exit();
}

include("includes/config.php");

// Ambil ID berita yang akan diedit
if (isset($_GET['id'])) {
    $beritaID = $_GET['id'];
    
    // Query untuk mendapatkan data berita berdasarkan ID
    $result = mysqli_query($conn, "SELECT * FROM berita WHERE berita_ID = '$beritaID'");
    $berita = mysqli_fetch_assoc($result);

    if (!$berita) {
        echo "Data tidak ditemukan!";
        exit();
    }
}

// Proses update berita
if (isset($_POST['update'])) {
    $beritaJUDUL = $_POST['inputJUDUL'];
    $beritaISI = $_POST['inputISI'];
    $beritaSUMBER = $_POST['inputSUMBER'];
    $kategoriID = $_POST['inputKategori'];
    $beritaFOTO = $_POST['inputFOTO'];

    $updateQuery = "UPDATE berita SET 
                    berita_JUDUL = '$beritaJUDUL',
                    berita_ISI = '$beritaISI',
                    berita_SUMBER = '$beritaSUMBER',
                    kategori_ID = '$kategoriID',
                    berita_FOTO = '$beritaFOTO'
                    WHERE berita_ID = '$beritaID'";

    if (mysqli_query($conn, $updateQuery)) {
        header("location: berita.php");
    } else {
        echo "Error: " . $updateQuery . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php include("includes/head.php"); ?>
    <?php include("includes/menunav.php"); ?>

    <div id="layoutSidenav">
        <?php include("includes/menu.php"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Berita</h1>
                    <form method="POST">
                        <div class="row mb-3">
                            <label for="beritaJUDUL" class="col-sm-2 col-form-label">Judul Berita</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="beritaJUDUL" name="inputJUDUL" value="<?php echo $berita['berita_JUDUL']; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="beritaISI" class="col-sm-2 col-form-label">Isi Berita</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="beritaISI" name="inputISI" required><?php echo $berita['berita_ISI']; ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="beritaSUMBER" class="col-sm-2 col-form-label">Sumber Berita</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="beritaSUMBER" name="inputSUMBER" value="<?php echo $berita['berita_SUMBER']; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="beritaFOTO" class="col-sm-2 col-form-label">Foto Berita</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="beritaFOTO" name="inputFOTO" value="<?php echo $berita['berita_FOTO']; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kategoriID" class="col-sm-2 col-form-label">Kategori ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kategoriID" name="inputKategori" value="<?php echo $berita['kategori_ID']; ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-success" value="Update" name="update">
                                <a href="berita.php" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
