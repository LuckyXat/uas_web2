<?php
// Include database connection
include("../backend/includes/config.php");

// Query to fetch data from the table
$query = mysqli_query($conn, "SELECT * FROM richwan");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .testimoni-section {
            text-align: center;
            padding: 50px 20px;
            background-color: #f8f9fa;
        }

        .testimoni-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #14183E;
        }

        .testimoni-text {
            font-size: 1rem;
            color: #333;
            margin-bottom: 10px;
        }

        .testimoni-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: #14183E;
        }

        .testimoni-role {
            font-size: 1rem;
            color: #6c757d;
        }

        .testimoni-container {
            max-width: 400px;
            margin: 0 auto 40px;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <section class="testimoni-section">
        <h2 class="mb-5">Testimoni Mahasiswa</h2>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <div class="testimoni-container">
                <!-- Display Photo -->
                
                    <img src="../backend/img/rc.jpg" alt="Foto Mahasiswa" class="testimoni-image">


                <!-- Display Description -->
                <p class="testimoni-text"><?php echo htmlspecialchars($row['keterangan']); ?></p>

                <!-- Display Name -->
                <p class="testimoni-name"><?php echo htmlspecialchars($row['Yrichwan']); ?></p>

                <!-- Display NIM -->
                <p class="testimoni-role">NIM: <?php echo htmlspecialchars($row['Y825230123richwan']); ?></p>
            </div>
        <?php } ?>
    </section>
</body>

</html>
