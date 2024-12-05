<?php
include("includes/config.php");
$query = "SELECT * FROM richwan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Richwan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Data Richwan</h1>
        <a href="richwan_add.php" class="btn btn-success mb-3">Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Foto</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['Y825230123richwan']; ?></td>
                        <td><?php echo htmlspecialchars($row['Yrichwan']); ?></td>
                        <td><?php echo htmlspecialchars($row['Y825230123richwan']); ?></td>
                        <td><img src="<?php echo $row['foto']; ?>" width="100"></td>
                        <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                        <td>
                            <a href="richwan_edit.php?id=<?php echo $row['Y825230123richwan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="richwan_delete.php?id=<?php echo $row['Y825230123richwan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
