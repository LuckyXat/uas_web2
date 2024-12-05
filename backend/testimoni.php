<!DOCTYPE html>
<html lang="en">
<?php
ob_start();
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Testimoni</title>
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
                    <h1 class="mt-4">Tambah Testimoni</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Testimoni</li>
                    </ol>

                    <?php
                    include("includes/config.php");

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Simpan'])) {
                        $judul = trim($_POST['testimoni_JUDUL']);
                        $isi = trim($_POST['testimoni_ISI']);
                        $nama = trim($_POST['testimoni_NAMA']);
                        $kota = trim($_POST['testimoni_KOTA']);

                        // Handle file upload
                        $fotoPath = '';
                        if (!empty($_FILES['testimoni_FOTO']['name'])) {
                            $targetDir = "img/";
                            $fotoName = basename($_FILES['testimoni_FOTO']['name']);
                            $fotoPath = $targetDir . $fotoName;
                            $imageFileType = strtolower(pathinfo($fotoPath, PATHINFO_EXTENSION));

                            // Validate file type
                            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                                echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, dan PNG yang diperbolehkan.</div>";
                                exit();
                            }

                            // Move uploaded file
                            if (!move_uploaded_file($_FILES['testimoni_FOTO']['tmp_name'], $fotoPath)) {
                                echo "<div class='alert alert-danger'>Gagal mengunggah foto. Pastikan folder 'img/' memiliki izin yang sesuai.</div>";
                                exit();
                            }
                        }

                        // Save to database using prepared statements
                        $stmt = $conn->prepare("INSERT INTO testimoni (testimoni_JUDUL, testimoni_FOTO, testimoni_ISI, testimoni_NAMA, testimoni_KOTA) 
                                                VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssss", $judul, $fotoPath, $isi, $nama, $kota);

                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Testimoni berhasil ditambahkan!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $stmt->error . "</div>";
                        }

                        $stmt->close();
                    }
                    ?>

                    <!-- Add Testimonial Form -->
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="testimoni_JUDUL" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="testimoni_JUDUL" name="testimoni_JUDUL" required>
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_FOTO" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="testimoni_FOTO" name="testimoni_FOTO" accept=".jpg, .jpeg, .png">
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_ISI" class="form-label">Isi Testimoni</label>
                            <textarea class="form-control" id="testimoni_ISI" name="testimoni_ISI" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_NAMA" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="testimoni_NAMA" name="testimoni_NAMA" required>
                        </div>

                        <div class="mb-3">
                            <label for="testimoni_KOTA" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="testimoni_KOTA" name="testimoni_KOTA" required>
                        </div>

                        <button type="submit" class="btn btn-success" name="Simpan">Simpan</button>
                        <button type="reset" class="btn btn-danger">Batal</button>
                    </form>

                    <!-- Fetch and display all testimonials -->
                    <?php
                    $query = "SELECT * FROM testimoni";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-hover mt-4">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Foto</th>
                                        <th>Isi Testimoni</th>
                                        <th>Nama</th>
                                        <th>Kota</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                                    <td>' . $i . '</td>
                                    <td>' . htmlspecialchars($row['testimoni_JUDUL']) . '</td>
                                    <td><img src="' . htmlspecialchars($row['testimoni_FOTO']) . '" width="100"></td>
                                    <td>' . htmlspecialchars($row['testimoni_ISI']) . '</td>
                                    <td>' . htmlspecialchars($row['testimoni_NAMA']) . '</td>
                                    <td>' . htmlspecialchars($row['testimoni_KOTA']) . '</td>
                                    <td>
                                        <a href="testimoni_edit.php?id=' . $row['testimoni_ID'] . '" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="testimoni_delete.php?id=' . $row['testimoni_ID'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus testimoni ini?\')">Delete</a>
                                    </td>
                                  </tr>';
                            $i++;
                        }

                        echo '</tbody></table>';
                    } else {
                        echo "<div class='alert alert-info'>Belum ada testimoni.</div>";
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
