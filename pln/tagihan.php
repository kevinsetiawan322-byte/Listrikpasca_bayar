<?php  
	// Redirect ke halaman utama
	if (!isset($_GET['menu'])) {
		header("location:hal_utama.php?menu=tagihan");
	}
	// Nama tabel yang digunakan
	$table ="tagihan";
	$redirect="?menu=alamat";
	
	$cari ="";
	// Jika tombol cari berdasarkan teks diklik
	if (isset($_POST['bcari_text'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_pelanggan LIKE '%$text%' OR bulan LIKE '%$text%' OR tahun LIKE '%$text%' OR jumlah_meter LIKE '%$text%' OR tarif_perkwh LIKE '%$text%' OR jumlah_bayar LIKE '%$text%' OR nama_petugas LIKE '%$text%' OR nama_pelanggan LIKE '%$text%' OR status LIKE '%$text%'";
	}
	// Jika tombol cari berdasarkan filter diklik
	if (isset($_POST['bcari'])) {
		$bln_cari = $_POST['bulan'];
		$thn_cari = $_POST['tahun'];
		$status = $_POST['laporan'];
		$cari = "WHERE status = '$status' AND bulan = '$bln_cari'  AND tahun = '$thn_cari'";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>TAGIHAN</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						DAFTAR TAGIHAN
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="col-md-12">
								<!-- Form filter berdasarkan bulan dan status -->
								<div class="col-md-7 pull-left">
									<label>Filter Perbulan</label>
									<div class="input-group">
										<span class="input-group-addon">JENIS</span>
										<select name="laporan" class="form-control">
											<option value="Terbayar" <?php if(@$status=="Terbayar"){echo "selected";} ?>>Sudah Bayar</option>
											<option value="Belum Bayar" <?php if(@$status=="Belum Bayar"){echo "selected";} ?>>Belum Bayar</option>
										</select>
										<span class="input-group-addon">BULAN</span>
										<select name="bulan" class="form-control">
											<?php  
											// Loop untuk menampilkan opsi bulan (01-12)
												for ($a=1; $a <=12 ; $a++) { 
													if ($a<10) {
														$b = "0".$a;
													}else{
														$b = $a;
													} ?>
													<option value="<?php echo $b; ?>" <?php if($b==@$bln_cari){echo "selected";} ?>><?php $aksi->bulan($b); ?></option>
													
												<?php } ?>
										</select>
										<div class="input-group-addon" id="pri">TAHUN</div>
										<select name="tahun" class="form-control">
											<?php 
											// Loop untuk menampilkan opsi tahun dari sekarang hingga 2030
											for ($a=date("Y"); $a < 2031; $a++) {
											?>
											<option value="<?php echo $a; ?>" <?php if($a==@$thn_cari){echo "selected";} ?>><?php echo @$a; ?></option>
											<?php } ?>
										</select>
										<div class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
											<button type="submit"  name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
										</div>
									</div>
								</div>
								<!-- Form pencarian berdasarkan teks -->				
								<div class="col-md-5 pull-right">
									<label>Filter Dengan Pencarian</label>
									<div class="input-group">
										<input type="text" name="tcari" class="form-control" placeholder="Masukan Keyword [bulan 01 = januari, lainnya]" value="<?php echo @$text ?>">
										<div class="input-group-btn">
											<button type="submit" name="bcari_text" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
											<button type="submit"  name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
										</div>
									</div>
								</div>
							</div>
						</form>
						
						<br>
						<hr>
						<div class="col-md-12">
							<div class="table-responsive">
								<!-- Tabel daftar tagihan -->
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<th><center>No.</center></th>
										<th>ID Pelanggan</th>
										<th>Nama Pelanggan</th>
										<th>Bulan</th>
										<th>Jumlah Meter</th>
										<th>Jumlah Bayar</th>
										<th>Nama Petugas</th>
										<th>Status</th>
									</thead>
									<tbody>
										<?php  
											// Menampilkan data dari database berdasarkan filter
											$no=0;
											$a = $aksi->tampil("qw_tagihan",$cari,"ORDER BY status ASC");
											if (empty($a)) {
												$aksi->no_record(8);
											}else{
												foreach ($a as $r) {
													$no++; 
										?>	
											<tr>
												<td align="center"><?php echo $no; ?>.</td>
												<td><?php echo $r['id_pelanggan']; ?></td>
												<td><?php echo $r['nama_pelanggan']; ?></td>
												<td><?php $aksi->bulan($r['bulan']);echo " ".$r['tahun']; ?></td>
												<td><?php echo $r['jumlah_meter']; ?></td>
												<td><?php $aksi->rupiah($r['jumlah_bayar']); ?></td>
												<td><?php echo $r['nama_petugas']; ?></td>
												<td><?php echo $r['status']; ?></td>
											</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="panel-footer">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>