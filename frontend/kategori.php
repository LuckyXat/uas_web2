<?php
$query = mysqli_query($conn, "select * from kategori");
?>

<section class="pt-5 pt-md-9" id="service">

  <div class="container">
    <div class="position-absolute z-index--1 end-0 d-none d-lg-block"><img src="assets/img/category/shape.svg" style="max-width: 200px" alt="service" /></div>
    <div class="mb-7 text-center">
      <h5 class="text-secondary">CATEGORY </h5>
      <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">We Offer Best Place & Services</h3>
    </div>
    <div class="row">
      <?php if (mysqli_num_rows($query) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($query)) { ?>
          <div class="col-lg-3 col-sm-6 mb-6">
            <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
              <div class="card-body p-xxl-5 p-4"> <img src="assets/img/category/icon1.png" width="75" alt="Service" />
                <a href="kategori2.php?nama=<?php echo $row["kategori_NAMA"] ?>""><h4 class="mb-3"><?php echo $row["kategori_NAMA"] ?></h4></a>
                <p class="mb-0 fw-medium"><?php echo $row["kategori_KET"] ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div><!-- end of .container-->

</section>