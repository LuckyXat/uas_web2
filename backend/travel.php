<!DOCTYPE html>
<html>

<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_USER'])) {
    header("location:login.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Travel</title>
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
                    <h1 class="mt-4">Kelola Travel</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Travel</li>
                        
                    </ol>

                    <?php
                    // Include database connection
                    include("includes/config.php");

                    // Add new travel data
                    if (isset($_POST['Simpan'])) {
                        $idTravel = $_POST['id_travel'];
                        $judul = $_POST['judul'];
                        $subjudul = $_POST['subjudul'];
                        $keterangan = $_POST['keterangan'];
                        $linkVideo = $_POST['linkvideo'];

                        // Handle file upload
                        $gambarTravel = '';
                        if (!empty($_FILES['gambartravel']['name'])) {
                            $targetDir = "img/";
                            $gambarTravel = $targetDir . basename($_FILES['gambartravel']['name']);
                            $imageFileType = strtolower(pathinfo($gambarTravel, PATHINFO_EXTENSION));

                            if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                                if (!move_uploaded_file($_FILES['gambartravel']['tmp_name'], $gambarTravel)) {
                                    echo "<div class='alert alert-danger'>Gagal mengunggah gambar.</div>";
                                    exit();
                                }
                            } else {
                                echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, dan PNG diperbolehkan.</div>";
                                exit();
                            }
                        }

                        // Insert into database
                        $query = "INSERT INTO travel (id_travel, judul, subjudul, keterangan, linkvideo, gambartravel) 
                                  VALUES ('$idTravel', '$judul', '$subjudul', '$keterangan', '$linkVideo', '$gambarTravel')";
                        if (mysqli_query($conn, $query)) {
                            echo "<div class='alert alert-success'>Travel berhasil ditambahkan!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . mysqli_error($conn) . "</div>";
                        }
                    }

                    // Delete travel data
                    if (isset($_GET['delete_id'])) {
                        $deleteID = $_GET['delete_id'];
                        mysqli_query($conn, "DELETE FROM travel WHERE id_travel='$deleteID'");
                        header("location: travel.php");
                    }

                    // Search for travel data
                    $search = "";
                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                        $query = mysqli_query($conn, "SELECT * FROM travel WHERE judul LIKE '%$search%'");
                    } else {
                        $query = mysqli_query($conn, "SELECT * FROM travel");
                    }
                    ?>

                    <!-- Add Travel Form -->
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="id_travel" class="col-sm-2 col-form-label">ID Travel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_travel" name="id_travel" placeholder="ID Travel" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Travel" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subjudul" class="col-sm-2 col-form-label">Sub Judul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subjudul" name="subjudul" placeholder="Sub Judul">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Keterangan Travel" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="linkvideo" class="col-sm-2 col-form-label">Link Video</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="linkvideo" name="linkvideo" placeholder="Link Video Travel">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gambartravel" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="gambartravel" name="gambartravel" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-success" name="Simpan">Simpan</button>
                                <button type="reset" class="btn btn-danger">Batal</button>
                            </div>
                        </div>
                    </form>

                    <!-- Search Form -->
                    <form method="GET" class="mt-4">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="search" placeholder="Cari Judul Travel" value="<?php echo $search; ?>">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>

                    <!-- Display Travel Data -->
                    <table class="table table-striped table-hover mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Sub Judul</th>
                                <th>Keterangan</th>
                                <th>Link Video</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?php echo $row['id_travel']; ?></td>
                                    <td><?php echo $row['judul']; ?></td>
                                    <td><?php echo $row['subjudul']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td><a href="<?php echo $row['linkvideo']; ?>" target="_blank">Tonton Video</a></td>
                                    <td><img src="<?php echo $row['gambartravel']; ?>" width="100"></td>
                                    <td>
                                        <a href="travel_edit.php?id=<?php echo $row['id_travel']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="travel.php?delete_id=<?php echo $row['id_travel']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus travel ini?')">Delete</a>
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
