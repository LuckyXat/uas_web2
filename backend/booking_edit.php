<?php
include("includes/config.php");

if (isset($_POST['Update'])) {
    $id_booking = $_POST['id_booking'];
    $judul = $_POST['judul'];
    $subjudul = $_POST['subjudul'];
    $tujuan = $_POST['tujuan'];
    $keterangan = $_POST['keterangan'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $oleh = $_POST['oleh'];
    $trip = $_POST['trip'];
    $totalorang = $_POST['totalorang'];

    // Proses Upload Gambar
    $gambarbooking = $_FILES['gambarbooking']['name'];
    $tmp_name = $_FILES['gambarbooking']['tmp_name'];
    $upload_dir = "uploads/";

    if ($gambarbooking) {
        move_uploaded_file($tmp_name, $upload_dir . $gambarbooking);
    } else {
        $gambarbooking = $_POST['current_gambarbooking'];
    }

    // Update data ke database
    $query = "UPDATE booking SET 
              judul='$judul', 
              subjudul='$subjudul', 
              tujuan='$tujuan', 
              keterangan='$keterangan', 
              lokasi='$lokasi', 
              tanggal='$tanggal', 
              oleh='$oleh', 
              trip='$trip', 
              totalorang='$totalorang', 
              gambarbooking='$gambarbooking' 
              WHERE id_booking='$id_booking'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='booking.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
    }
}

// Ambil data untuk ditampilkan
$id_booking = $_GET['id_booking'];
$query = "SELECT * FROM booking WHERE id_booking='$id_booking'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Booking</h2>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_booking" value="<?php echo $row['id_booking']; ?>">
            <input type="hidden" name="current_gambarbooking" value="<?php echo $row['gambarbooking']; ?>">

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row['judul']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="subjudul" class="form-label">Subjudul</label>
                <input type="text" class="form-control" id="subjudul" name="subjudul" value="<?php echo $row['subjudul']; ?>">
            </div>

            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?php echo $row['tujuan']; ?>">
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $row['keterangan']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $row['lokasi']; ?>">
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="oleh" class="form-label">Dipesan Oleh</label>
                <input type="text" class="form-control" id="oleh" name="oleh" value="<?php echo $row['oleh']; ?>">
            </div>

            <div class="mb-3">
                <label for="trip" class="form-label">Trip</label>
                <input type="text" class="form-control" id="trip" name="trip" value="<?php echo $row['trip']; ?>">
            </div>

            <div class="mb-3">
                <label for="totalorang" class="form-label">Total Orang</label>
                <input type="text" class="form-control" id="totalorang" name="totalorang" value="<?php echo $row['totalorang']; ?>">
            </div>

            <div class="mb-3">
                <label for="gambarbooking" class="form-label">Unggah Gambar</label>
                <input type="file" class="form-control" id="gambarbooking" name="gambarbooking">
                <?php if ($row['gambarbooking']) { ?>
                    <img src="uploads/<?php echo $row['gambarbooking']; ?>" width="100" alt="Gambar Booking">
                <?php } ?>
            </div>

            <button type="submit" class="btn btn-primary" name="Update">Update</button>
            <a href="booking.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
