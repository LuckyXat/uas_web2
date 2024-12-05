<!DOCTYPE html>
<html lang="en">
<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
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
                    <h1 class="mt-4">Form Booking dan Data Booking</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Booking</li>
                    </ol>

                    <?php
                    // Koneksi database
                    include("includes/config.php");

                    // Tambahkan data ke tabel booking
                    if (isset($_POST['Simpan'])) {
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

                    // Proses Upload File
                    $fotoPath = '';
                    if (!empty($_FILES['gambarbooking']['name'])) {
                        $targetDir = "img/"; // Ganti folder penyimpanan
                        $fotoPath = $targetDir . basename($_FILES['gambarbooking']['name']);
                        $imageFileType = strtolower(pathinfo($fotoPath, PATHINFO_EXTENSION));

                        // Validasi jenis file
                        if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                            if (move_uploaded_file($_FILES['gambarbooking']['tmp_name'], $fotoPath)) {
                                // File berhasil diunggah
                            } else {
                                echo "<script>alert('Gagal mengunggah file.');</script>";
                                exit();
                            }
                        } else {
                            echo "<script>alert('Jenis file tidak didukung. Hanya JPG, PNG, dan JPEG diperbolehkan.');</script>";
                            exit();
                        }
                    }
                        // Simpan data ke tabel booking
                        $query = "INSERT INTO booking (id_booking, judul, subjudul, tujuan, keterangan, lokasi, tanggal, oleh, trip, totalorang, gambarbooking) 
                                  VALUES ('$id_booking', '$judul', '$subjudul', '$tujuan', '$keterangan', '$lokasi', '$tanggal', '$oleh', '$trip', '$totalorang', '$gambarbooking')";

                        if (mysqli_query($conn, $query)) {
                            echo "<div class='alert alert-success'>Data berhasil disimpan!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
                        }
                    }

                    // Hapus data booking
                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $query = "DELETE FROM booking WHERE id_booking='$delete_id'";
                        if (mysqli_query($conn, $query)) {
                            echo "<div class='alert alert-success'>Data berhasil dihapus!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
                        }
                    }

                    // Ambil semua data booking
                    $result = mysqli_query($conn, "SELECT * FROM booking");
                    ?>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="id_booking" class="col-sm-2 col-form-label">ID Booking</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_booking" name="id_booking" placeholder="ID Booking" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subjudul" class="col-sm-2 col-form-label">Subjudul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subjudul" name="subjudul" placeholder="Subjudul">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tujuan" class="col-sm-2 col-form-label">Tujuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Tujuan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="oleh" class="col-sm-2 col-form-label">Dipesan Oleh</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="oleh" name="oleh" placeholder="Dipesan Oleh">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="trip" class="col-sm-2 col-form-label">Trip</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="trip" name="trip" placeholder="Trip">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="totalorang" class="col-sm-2 col-form-label">Total Orang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="totalorang" name="totalorang" placeholder="Total Orang">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gambarbooking" class="col-sm-2 col-form-label">Unggah Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="gambarbooking" name="gambarbooking" accept="image/*" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-success" name="Simpan">Simpan</button>
                                <button type="reset" class="btn btn-danger">Batal</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Data Booking -->
                    <h3 class="mt-5">Data Booking</h3>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Subjudul</th>
                                <th>Tujuan</th>
                                <th>Keterangan</th>
                                <th>Lokasi</th>
                                <th>Tanggal</th>
                                <th>Oleh</th>
                                <th>Trip</th>
                                <th>Total Orang</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id_booking']; ?></td>
                                    <td><?php echo $row['judul']; ?></td>
                                    <td><?php echo $row['subjudul']; ?></td>
                                    <td><?php echo $row['tujuan']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td><?php echo $row['lokasi']; ?></td>
                                    <td><?php echo $row['tanggal']; ?></td>
                                    <td><?php echo $row['oleh']; ?></td>
                                    <td><?php echo $row['trip']; ?></td>
                                    <td><?php echo $row['totalorang']; ?></td>
                                    <td>
                                        <?php if ($row['gambarbooking']) { ?>
                                            <img src="img/<?php echo $row['gambarbooking']; ?>" width="100" alt="Gambar">
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <a href="booking_edit.php?id_booking=<?php echo $row['id_booking']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="booking.php?delete_id=<?php echo $row['id_booking']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
