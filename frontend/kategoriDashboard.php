<?php
$namakategori = $_GET['namaKategori'];
include("../admin/includes/config.php");

$query = mysqli_query($conn, "SELECT w.*, kt.kategori_NAMA, kb.kabupaten_NAMA 
    FROM destinasi w 
    JOIN kabupaten kb ON w.kabupaten_ID = kb.kabupaten_ID 
    JOIN kategori kt ON w.kategori_ID = kt.kategori_ID 
    WHERE kt.kategori_NAMA = '$namakategori'
");
?>

<?php include("head.php") ?>

<main class="main" id="top">
<section class="pt-5" style="margin-top: 100px;" id="destination">
    <div class="container">
        <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4">
            <img src="assets/img/dest/shape.svg" alt="destination" />
        </div>
        <div class="mb-7 text-center">
            <h5 class="text-secondary">Top Selling</h5>
            <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize"><?php echo $namakategori ?></h3>
        </div>
        <div class="row d-flex justify-content-center">
            <?php while ($row = mysqli_fetch_array($query)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card overflow-hidden shadow">
                        <img class="card-img-top" src="../admin/images/<?php echo $row['destinasi_FOTO']; ?>" alt="Tidak ada Foto">
                        <div class="card-body py-4 px-3">
                            <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                                <h4 class="text-secondary fw-medium">
                                    <a class="link-900 text-decoration-none stretched-link" href="#">
                                        <?php echo $row['destinasi_NAMA']; ?>
                                    </a>
                                </h4>
                                <span class="fs-1 fw-medium"><?php echo $row['kabupaten_NAMA']; ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="assets/img/dest/navigation.svg" style="margin-right: 14px" width="20" alt="navigation" />
                                <span class="fs-0 fw-medium"><?php echo $row['destinasi_ALAMAT']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

</main>