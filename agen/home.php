<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=home');
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
</head>
<body>
	<div class="container-fluid">

		<div class="row">
			<div style="text-align: center; margin-top: 20px;">
				<img alt="Brand" src="../images/bg_2.jpeg" width="100%">
			</div>
			<!-- <div class="col-md-12">
				<div class="alert alert-success alert-dimis">
					<center><h4>LOGIN BERHASIL <?php echo $_SESSION['nama_agen']; ?></h4></center>
					<h2>APLIKASI PEMBAYARAN LISTRIK PASCA BAYAR V.1.0</h2>
				</div>
			</div> -->
			
		</div>
	</div>
</body>
</html>