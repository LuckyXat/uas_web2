<!DOCTYPE html>
<html>

<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
    exit();
}

// Include database connection
include("includes/config.php");

// Fetch travel details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM travel WHERE id_travel='$id'");
    $travel = mysqli_fetch_assoc($query);
    if (!$travel) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='travel.php';</script>";
        exit();
    }
}

// Update travel details
if (isset($_POST['Update'])) {
    $idTravel = $_POST['id_travel'];
    $judul = $_POST['judul'];
    $subjudul = $_POST['subjudul'];
    $keterangan = $_POST['keterangan'];
    $linkVideo = $_POST['linkvideo'];
    $gambarTravel = $travel['gambartravel']; // Default to existing image

    // Handle file upload if a new image is provided
    if (!empty($_FILES['gambartravel']['name'])) {
        $targetDir = "img/";
        $gambarTravel = $targetDir . basename($_FILES['gambartravel']['name']);
        $imageFileType = strtolower(pathinfo($gambarTravel, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            if (!move_uploaded_file($_FILES['gambartravel']['tmp_name'], $gambarTravel)) {
                echo "<div class='alert alert-danger'>Gagal mengunggah gambar baru.</div>";
                exit();
            }
        } else {
            echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, dan PNG diperbolehkan.</div>";
            exit();
        }
    }

    // Update travel data in the database
    $updateQuery = "UPDATE travel 
                    SET judul='$judul', subjudul='$subjudul', keterangan='$keterangan', linkvideo='$linkVideo', gambartravel='$gambarTravel'
                    WHERE id_travel='$idTravel'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Travel berhasil diupdate!'); window.location='travel.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Travel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Travel</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_travel" value="<?php echo $travel['id_travel']; ?>">

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $travel['judul']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="subjudul" class="form-label">Sub Judul</label>
                <input type="text" class="form-control" id="subjudul" name="subjudul" value="<?php echo $travel['subjudul']; ?>">
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required><?php echo $travel['keterangan']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="linkvideo" class="form-label">Link Video</label>
                <input type="url" class="form-control" id="linkvideo" name="linkvideo" value="<?php echo $travel['linkvideo']; ?>">
            </div>

            <div class="mb-3">
                <label for="gambartravel" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambartravel" name="gambartravel">
                <p class="mt-2">Gambar saat ini: <img src="<?php echo $travel['gambartravel']; ?>" width="100"></p>
            </div>

            <button type="submit" class="btn btn-success" name="Update">Update</button>
            <a href="travel.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
