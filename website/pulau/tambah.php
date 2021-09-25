<!-- proses penyimpanan -->

<?php 
	include "koneksi.php";

	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		$nokartu 		    = $_POST['pengunjung_card'];
		$pengunjung_name    = $_POST['pengunjung_name'];
		$pengunjung_asal    = $_POST['pengunjung_asal'];
		$pengunjung_jml_hari= 0;

		//simpan ke tabel karyawan
		$simpan = mysqli_query($konek, "INSERT INTO tb_pengunjung(pengunjung_card, pengunjung_name, pengunjung_asal, pengunjung_jml_hari, pengunjung_mode, pengunjung_status)VALUES('$nokartu', '$pengunjung_name', '$pengunjung_asal', '$pengunjung_jml_hari', 'E', 'B')");

		//jika berhasil tersimpan, tampilkan pesan Tersimpan,
		//kembali ke data karyawan
		if($simpan)
		{
			echo "
				<script>
					alert('Tersimpan');
					location.replace('dataPengunjung.php');
				</script>
			";
		}
		else
		{
			echo "
				<script>
					alert('Gagal Tersimpan');
					location.replace('dataPengunjung.php');
				</script>
			";
		}

	}

	//kosongkan tabel tmprfid
	mysqli_query($konek, "delete from tmprfid");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Tambah Data Pengunjung</title>

	<!-- pembacaan no kartu otomatis -->
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$("#norfid").load('nokartu.php')
			}, 0);  //pembacaan file nokartu.php, tiap 1 detik = 1000
		});
	</script>

</head>
<body>

	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>Tambah Data Pengunjung</h3>

		<!-- form input -->
		<form method="POST">
			<div id="norfid"></div>

			<div class="form-group">
				<label>Nama Pengunjung</label>
				<input type="text" name="pengunjung_name" id="pengunjung_name" placeholder="Nama Pengunjung" class="form-control" style="width: 400px">
			</div>
			<div class="form-group">
				<label>Asal Pengunjung </label>
				<textarea name="pengunjung_asal" class="form-control" id="pengunjung_asal" cols="30" rows="3" style="width: 400px"></textarea>
			</div>

			<button class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
		</form>
	</div>

	<?php //include "footer.php"; ?>

</body>
</html>