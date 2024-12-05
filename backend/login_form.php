<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Admin Form</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
</head>
<?php  
	//Memanggil koneksi ke mySQL
	include("includes/config.php");

	//Mengecek apakah tombol simpan sudah dipilih atau belum
	if (isset($_POST['Simpan'])) {
		$adminID = $_POST['inputID'];
		$adminUSER = $_POST['inputUSER'];
		$adminPASS = md5($_POST['inputPASS']);
		$adminPASShash = password_hash($_POST['inputPASS'], PASSWORD_BCRYPT);

		mysqli_query($conn, "insert into admin values('$adminID','$adminUSER','$adminPASS')");  //ganti $adminPASShash untuk jadi password hash
		header("location:login_form.php");
	}

	
	// $query = mysqli_query($conn, "select * from login");
?>

<body>
	<div class="row">
	<div class="col-1"></div>
	<div class="col-10">
	<div class="mb-5 mt-4">
    	<h1> Input ADMIN</h1>
    	<p> Daftar Admin Untuk Login </p>
	</div>
	<form method="POST">
		<div class="row">
		<div class="col-1"></div>
		<div class="col-10">
		<div class="row mb-3 mt-5">
			<label for="adminID" class="col-sm-2 col-form-label">Kode Admin</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="adminID" name="inputID" placeholder="Kode admin">
			</div>
		</div>
		<div class="row mb-3">
			<label for="adminUSER" class="col-sm-2 col-form-label">Username Admin</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="adminUSER" name="inputUSER" placeholder="Username admin">
			</div>
		</div>
		<div class="row mb-3">
			<label for="adminPASS" class="col-sm-2 col-form-label">Password Admin</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" id="adminPASS" name="inputPASS" placeholder="Password admin">
			</div>
		</div>
		<div class="form-group row">
        	<div class="col-sm-2"></div>
        	<div class="col-sm-10">
        		<input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
        		<input type="reset" class="btn btn-danger" value="Batal">
        	</div>
		</div>
	</form>

	<!-- form pencarian data -->
	<form method="POST">
		<div class="form-group row mt-5">
			<label for="search" class="col-sm-2"> Cari Username Admin</label>
			<div class="col-sm-6">
				<input type="text" name="search" class="form-control" id="search" placeholder="Cari username admin" value="<?php if (isset($_POST["search"])) {
					echo $_POST["search"];
				} ?>">
			</div>
			<input type="submit" name="kirim" value="cari" class="col-sm-1 btn btn-primary">
		</div>
	</form>
	<!-- end pencarian data -->

	<table class="table table-striped table-success table-hover mt-5">
		<!-- membuat judul -->
		<tr class="info">
			<th>Kode</th>
			<th>Username Admin</th>
			<th>Password Admin</th>
			<th colspan="2">Aksi</th>
		</tr>
		<?php { 
			// pencarian data
			if (isset($_POST["kirim"])) {
				$search = $_POST["search"];
				$query = mysqli_query($conn,"select * from admin where admin_USER like '%".$search."%'");
			} else {
				$query = mysqli_query($conn,"select * from admin");	
			}
			// end pencarian data
			?>

			<?php while ($row = mysqli_fetch_array($query)) {?>	
			<tr class="danger">
				<td><?php echo $row['admin_ID']; ?></td>
				<td><?php echo $row['admin_USER']; ?></td>
				<td><?php echo $row['admin_PASS']; ?></td>
				<td>
						<a href="<?php echo "login_form_edit.php?ubahadmin=" . $row['admin_ID']?>" class="btn btn-success btn-sm" title="EDIT">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  							<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
						</svg></a>
					</td>
					<td>
						<a href="login_form_hapus.php?hapusadmin=<?php echo $row['admin_ID'] ?>" class="btn btn-danger btn-sm" title="HAPUS">
						<i class="bi bi-trash"></i></a>
					</td>
			</tr>
			<?php } ?>
		<?php } ?>
	</table>

	</div>
		<div class="col-1"></div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</body>
</html>


