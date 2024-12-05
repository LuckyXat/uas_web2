<?php 
  include("../backend/includes/config.php");
  $query = mysqli_query($conn, "SELECT * FROM travel");

  // Check if the query returns any rows
  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
?>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end" style="margin-top: 200px;">
            <img class="pt-7 pt-md-0 hero-img" src="../backend/img/<?php echo $row['gambartravel']; ?>" alt="hero-header" />
          </div>
          <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
            <h4 class="fw-bold text-danger mb-3"><?php echo $row['subjudul']; ?></h4>
            <h1 class="hero-title"><?php echo $row['judul']; ?></h1>
            <p class="mb-4 fw-medium"><?php echo $row['keterangan']; ?></p>
            <div class="text-center text-md-start">
              <a class="btn btn-primary btn-lg me-md-4 mb-3 mb-md-0 border-0 primary-btn-shadow" href="https://www.indonesia.travel/" role="button">Find out more</a>
              <div class="w-100 d-block d-md-none"></div>
              <a href="#!" role="button" data-bs-toggle="modal" data-bs-target="#popupVideo">
                <span class="btn btn-danger round-btn-lg rounded-circle me-3 danger-btn-shadow">
                  <img src="assets/img/hero/play.svg" width="15" alt="play"/>
                </span>
              </a>
              <span class="fw-medium">Play Demo</span>

              <div class="modal fade" id="popupVideo" tabindex="-1" aria-labelledby="popupVideo" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <!-- Dynamically load the video from the database -->
                    <iframe class="rounded" style="width:100%;max-height:500px;" height="500px" 
                            src="https://www.youtube.com/embed/<?php echo $row['linkvideo']; ?>" 
                            title="YouTube video player" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php 
    }
  } else {
    echo "No data found.";
  }
?>
