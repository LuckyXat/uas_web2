<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<?php
if (!defined('aktif')) {
    die ('anda tidak bisa akses langsung file ini');
} else {

    include("../backend/includes/config.php");
    $query = mysqli_query($conn, "select * from kategori");
    $destinasi = mysqli_query($conn, "select * from destinasi");

?>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
                <div class="container"><a class="navbar-brand" href="index.html"><img src="assets/img/logo.svg" height="34" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">

                        <li class="nav-item dropdown px-3 px-lg-4">
                            <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 0.3rem;" aria-labelledby="navbarDropdown">
                            <?php if (mysqli_num_rows($query) > 0) { ?>
                                <?php while($row = mysqli_fetch_array($query)) { ?>
                                <li><a class="dropdown-item" href="kategori.php?kodekategori=<?php echo $row["kategori_ID"] ?>"><?php echo $row["kategori_NAMA"] ?></a></li>
                                <?php } ?>
                            <?php } ?>
                            </ul>
                        </li>
                        
                        
                        <li class="nav-item dropdown px-3 px-lg-0">
                            <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Destinasi</a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 0.3rem;" aria-labelledby="navbarDropdown">
                            <?php if (mysqli_num_rows($destinasi) > 0) { ?>
                                <?php while($row = mysqli_fetch_array($destinasi)) { ?>
                                <li><a class="dropdown-item" href="destinasi.php?kodedestinasi=<?php echo $row["destinasi_ID"] ?>"><?php echo $row["destinasi_NAMA"] ?></a></li>
                                <?php } ?>
                            <?php } ?>
                            </ul>
                        </li>

                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#booking">Booking</a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#testimonial">Testimonial</a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="#!">Login</a></li>
                        <li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark order-1 order-lg-0 fw-medium" href="#!">Sign Up</a></li>
                        <li class="nav-item dropdown px-3 px-lg-0"> <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">EN</a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">EN</a></li>
                            <li><a class="dropdown-item" href="#!">BN</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                </div>
        </nav>
<?php } ?>
</body>
</html>