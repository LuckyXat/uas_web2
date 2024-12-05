    <!DOCTYPE html>
    <html>

    <?php
    ob_start();
    session_start();
    if (!isset($_SESSION['admin_USER'])) {
        header("location:login.php");
    }
    ?>

    <body class="sb-nav-fixed">
        <?php include("includes/head.php"); ?>
        <?php include("includes/menunav.php"); ?>

        <div id="layoutSidenav">
            <?php include("includes/menu.php"); ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola Kategori</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>

                        <?php
                        // Memanggil koneksi ke MYSQL
                        include("includes/config.php");

                        // Tambahkan data
                        if (isset($_POST['Simpan'])) {
                            $kategoriID = $_POST['inputID'];
                            $kategoriNAMA = $_POST['inputNAMA'];
                            $kategoriKET = $_POST['inputKETERANGAN'];

                            mysqli_query($conn, "INSERT INTO kategori VALUES ('$kategoriID', '$kategoriNAMA', '$kategoriKET')");
                            header("location: kategori.php");
                        }

                        // Update data
                        if (isset($_POST['Update'])) {
                            $kategoriID = $_POST['inputID'];
                            $kategoriNAMA = $_POST['inputNAMA'];
                            $kategoriKET = $_POST['inputKETERANGAN'];

                            mysqli_query($conn, "UPDATE kategori SET kategori_NAMA='$kategoriNAMA', kategori_KET='$kategoriKET' WHERE kategori_ID='$kategoriID'");
                            header("location: kategori.php");
                        }

                        // Hapus data
                        if (isset($_GET['delete_id'])) {
                            $deleteID = $_GET['delete_id'];
                            mysqli_query($conn, "DELETE FROM kategori WHERE kategori_ID='$deleteID'");
                            header("location: kategori.php");
                        }

                        // Pencarian data
                        $search = "";
                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            $query = mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_NAMA LIKE '%$search%'");
                        } else {
                            $query = mysqli_query($conn, "SELECT * FROM kategori");
                        }
                        ?>

                        <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <title>Form Kategori Wisata</title>

                            <link rel="stylesheet" href="css/bootstrap.min.css">
                        </head>

                        <div class="container mt-5">
        <form method="POST">
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

            <!-- Jarak antara form pencarian dan tombol submit -->
            <div class="row mb-4"> <!-- Tambahkan margin-bottom untuk memberikan jarak -->
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
                    <input type="reset" class="btn btn-danger" value="Batal">
                </div>
            </div>
        </form>

        <!-- Form Pencarian -->
        <form method="GET" class="mb-5">
            <div class="row">
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nama Kategori" value="<?php echo $search; ?>">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <!-- Tabel Data -->
        <table class="table table-striped table-success table-hover mt-5">
            <tr>
                <th>Kode</th>
                <th>Nama Kategori</th>
                <th>Keterangan Kategori</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?php echo $row['kategori_ID']; ?></td>
                    <td><?php echo $row['kategori_NAMA']; ?></td>
                    <td><?php echo $row['kategori_KET']; ?></td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="kategori_edit.php?id=<?php echo $row['kategori_ID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <!-- Tombol Delete -->
                        <a href="kategori.php?delete_id=<?php echo $row['kategori_ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    </body>
    </html>
