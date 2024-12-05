<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}

include("includes/config.php");

if (isset($_GET['id'])) {
    $testimoniID = $_GET['id'];

    // Fetch the testimonial data
    $query = mysqli_query($conn, "SELECT * FROM testimoni WHERE testimoni_ID = '$testimoniID'");
    $row = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {
        $judul = $_POST['testimoni_JUDUL'];
        $isi = $_POST['testimoni_ISI'];
        $nama = $_POST['testimoni_NAMA'];
        $kota = $_POST['testimoni_KOTA'];

        // Upload new photo if provided
        $fotoPath = $row['testimoni_FOTO'];
        if (!empty($_FILES['testimoni_FOTO']['name'])) {
            $targetDir = "img/";
            $fotoPath = $targetDir . basename($_FILES['testimoni_FOTO']['name']);
            $imageFileType = strtolower(pathinfo($fotoPath, PATHINFO_EXTENSION));

            if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                if (!move_uploaded_file($_FILES['testimoni_FOTO']['tmp_name'], $fotoPath)) {
                    echo "<script>alert('Gagal mengunggah foto.');</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Hanya file JPG, JPEG, dan PNG diperbolehkan.');</script>";
                exit();
            }
        }

        // Update the database with the new values
        $query = "UPDATE testimoni SET testimoni_JUDUL = '$judul', testimoni_FOTO = '$fotoPath', testimoni_ISI = '$isi', testimoni_NAMA = '$nama', testimoni_KOTA = '$kota' WHERE testimoni_ID = '$testimoniID'";

        if (mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success'>Testimoni berhasil diperbarui!</div>";
            header("Location: testimoni.php");
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
        }
    }
} else {
    header("Location: testimoni.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Testimoni</title>
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
                    <h1 class="mt-4">Edit Testimoni</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="testimoni_JUDUL" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="testimoni_JUDUL" name="testimoni_JUDUL" value="<?php echo $row['testimoni_JUDUL']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_FOTO" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="testimoni_FOTO" name="testimoni_FOTO">
                            <img src="<?php echo $row['testimoni_FOTO']; ?>" alt="Testimoni Foto" class="mt-3" width="100">
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_ISI" class="form-label">Isi Testimoni</label>
                            <textarea class="form-control" id="testimoni_ISI" name="testimoni_ISI" rows="3" required><?php echo $row['testimoni_ISI']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_NAMA" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="testimoni_NAMA" name="testimoni_NAMA" value="<?php echo $row['testimoni_NAMA']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_KOTA" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="testimoni_KOTA" name="testimoni_KOTA" value="<?php echo $row['testimoni_KOTA']; ?>" required>
                        </div>

                        <button type="submit" class="btn btn-success" name="update">Update</button>
                        <a href="testimoni.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
