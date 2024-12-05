<?php 

	include 'includes/config.php';

	if (isset($_GET["hapusadmin"])) {
		$kodeadmin = $_GET["hapusadmin"];
		mysqli_query($conn,"DELETE FROM admin
			WHERE admin_ID = '$kodeadmin'");
		echo "<script>alert('DATA BERHASIL DIHAPUS');
		document.location='login_form.php';</script>";
	}
 ?>