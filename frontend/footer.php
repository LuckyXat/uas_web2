<?php
// Include database connection
include("../backend/includes/config.php");

// Fetch categories from the database
$query = mysqli_query($conn, "SELECT * FROM kategori");
?>

<footer style="background-color: #14183E; color: #ffffff; padding: 20px 0;">
    <div class="container">
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-4">
                <h5 style="color: #FFD700;">pesonajawa.com</h5>
                <ul style="list-style: none; padding: 0; line-height: 1.8;">
                    <li>Wisata Jawa Mempesona</li>
                    <li>Pariwisata Solo</li>
                    <li>Download SDP2-App</li>
                </ul>
            </div>

            <!-- Column 2 -->
            <div class="col-md-4">
                <h5 style="color: #FFD700;">Informasi Kategori</h5>
                <ul style="list-style: none; padding: 0; line-height: 1.8;">
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <li><?php echo $row['kategori_NAMA']; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <!-- Column 3 -->
            <div class="col-md-4">
                <h5 style="color: #FFD700;">Contact Us</h5>
                <ul style="list-style: none; padding: 0; line-height: 1.8;">
                    <li>Email: admin@pesonajawa.com</li>
                </ul>
            </div>
        </div>
    </div>
</footer>


