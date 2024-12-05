<?php
if (!defined('aktif')) {
    die('Anda Tidak Bisa Mengakses Langsung File Ini');
} else {
    include('../backend/includes/config.php');
    $query = mysqli_query($conn, "SELECT * FROM testimoni");
    $queryTesti1 = mysqli_query($conn, "SELECT * FROM testimoni WHERE testimoni_JUDUL = '1'");
    $queryTesti2 = mysqli_query($conn, "SELECT * FROM testimoni WHERE testimoni_JUDUL = '2'");
    $queryTesti3 = mysqli_query($conn, "SELECT * FROM testimoni WHERE testimoni_JUDUL = '3'");
?>

    <section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-8 text-start">
                        <h5 class="text-secondary">Testimonials</h5>
                        <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">What people say about Us.</h3>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                    <div class="pe-7 ps-5 ps-lg-0">
                        <div class="carousel slide carousel-fade position-static" id="testimonialIndicator" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button class="active" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="0" aria-current="true" aria-label="Testimonial 0"></button>
                                <button class="false" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="1" aria-current="true" aria-label="Testimonial 1"></button>
                                <button class="false" type="button" data-bs-target="#testimonialIndicator" data-bs-slide-to="2" aria-current="true" aria-label="Testimonial 2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item position-relative active">
                                    <div class="card shadow" style="border-radius:10px;">
                                        <?php //mysqli_data_seek($query); 
                                        while ($row = mysqli_fetch_array($queryTesti1)) { ?>
                                            <div class="position-absolute start-0 top-0 translate-middle">
                                                <img src="../backend/img/<?php echo $row['testimoni_FOTO']; ?>" width="65" height="65" class="img-responsive rounded-circle fit-cover" />
                                            </div>
                                            <div class="card-body p-4">
                                                <p class="fw-medium mb-4">&quot; <?= $row['testimoni_ISI']; ?> &quot;</p>
                                                <h5 class="text-secondary">
                                                    <?= $row['testimoni_NAMA']; ?>
                                                </h5>
                                                <p class="fw-medium fs--1 mb-0">
                                                    <?= $row['testimoni_KOTA']; ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100" style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                                </div>
                                <div class="carousel-item position-relative ">
                                    <div class="card shadow" style="border-radius:10px;">
                                    <?php while ($row = mysqli_fetch_array($queryTesti2)) { ?>
                                            <div class="position-absolute start-0 top-0 translate-middle">
                                                    <img src="../backend/images/<?php echo $row['testimoni_FOTO']; ?>" width="65" height="65" class="img-responsive rounded-circle fit-cover" />
                                            </div>
                                            <div class="card-body p-4">
                                                <p class="fw-medium mb-4">&quot; <?= $row['testimoni_ISI']; ?> &quot;</p>
                                                <h5 class="text-secondary">
                                                    <?= $row['testimoni_NAMA']; ?>
                                                </h5>
                                                <p class="fw-medium fs--1 mb-0">
                                                    <?= $row['testimoni_KOTA']; ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100" style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                                </div>
                                <div class="carousel-item position-relative ">
                                    <div class="card shadow" style="border-radius:10px;">
                                    <?php while ($row = mysqli_fetch_array($queryTesti3)) { ?>
                                            <div class="position-absolute start-0 top-0 translate-middle">
                                                    <img src="../backend/images/<?php echo $row['testimoni_FOTO']; ?>" width="65" height="65" class="img-responsive rounded-circle fit-cover" />
                                            </div>
                                            <div class="card-body p-4">
                                                <p class="fw-medium mb-4">&quot; <?= $row['testimoni_ISI']; ?> &quot;</p>
                                                <h5 class="text-secondary">
                                                    <?= $row['testimoni_NAMA']; ?>
                                                </h5>
                                                <p class="fw-medium fs--1 mb-0">
                                                    <?= $row['testimoni_KOTA']; ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card shadow-sm position-absolute top-0 z-index--1 mb-3 w-100 h-100" style="border-radius:10px;transform:translate(25px, 25px)"> </div>
                                </div>
                            </div>
                            <div class="carousel-navigation d-flex flex-column flex-between-center position-absolute end-0 top-lg-50 bottom-0 translate-middle-y z-index-1 me-3 me-lg-0" style="height:60px;width:20px;">
                                <button class="carousel-control-prev position-static" type="button" data-bs-target="#testimonialIndicator" data-bs-slide="prev"><img src="assets/img/icons/up.svg" width="16" alt="icon" /></button>
                                <button class="carousel-control-next position-static" type="button" data-bs-target="#testimonialIndicator" data-bs-slide="next"><img src="assets/img/icons/down.svg" width="16" alt="icon" /></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->

    </section>
<?php } ?>