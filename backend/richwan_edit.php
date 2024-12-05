<?php
include("includes/config.php");

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Ambil data berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM richwan WHERE Y825230123richwan='$id'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='richwan.php';</script>";
    exit();
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Update'])) {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $keterangan = trim($_POST['keterangan']);

    // Proses upload foto baru jika ada
    $fotoPath = $row['foto']; // Gunakan foto lama jika tidak ada foto baru
    if (!empty($_FILES['foto']['name'])) {
        $targetDir = "img/";
        $fotoName = basename($_FILES['foto']['name']);
        $fotoPath = $targetDir . $fotoName;

        // Validasi dan unggah file
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath)) {
            // Hapus foto lama jika ada
            if (!empty($row['foto']) && file_exists($row['foto'])) {
                unlink($row['foto']);
            }
        } else {
            echo "<div class='alert alert-danger'>Gagal mengunggah foto baru.</div>";
            exit();
        }
    }

    // Update data ke database
    $query = "UPDATE richwan SET Yrichwan='$nama', Y825230123richwan='$nim', foto='$fotoPath', keterangan='$keterangan' WHERE Y825230123richwan='$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='richwan.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui data: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Richwan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data Richwan</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($row['Yrichwan']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($row['Y825230123richwan']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <img src="<?php echo htmlspecialchars($row['foto']); ?>" width="100" class="mt-3">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="Update">Update</button>
            <a href="richwan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
