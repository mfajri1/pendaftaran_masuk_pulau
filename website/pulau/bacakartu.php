<?php 
	include "koneksi.php";
	// //baca tabel tmprfid
	// if(!empty($_GET['nokartu'])){
	// 	$nokartus = $_GET['nokartu'];
	// 	mysqli_query($konek, "delete from tmprfid");

	// 	$simpan = mysqli_query($konek, "insert into tmprfid(nokartu)values('$nokartus')");		
	// }

	$baca_kartu = mysqli_query($konek, "SELECT * FROM tmprfid");
	$data_kartu = mysqli_fetch_array($baca_kartu);
	$nokartu    = $data_kartu['nokartu'];
?>


<div class="container-fluid" style="text-align: center;">

	<?php if($nokartu == "") { ?>

	<h3>Silahkan Tempelkan Kartu RFID Anda</h3>
	<img src="images/rfid.png" style="width: 200px"> <br>
	<img src="images/animasi2.gif">

	<?php } else {
		//cek nomor kartu RFID tersebut apakah terdaftar di tabel karyawan
		$cariPengunjung = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_card = '$nokartu'");
		$jumlah_data = mysqli_num_rows($cariPengunjung);
		// echo $nokartu;
		// exit;

		if($jumlah_data == 0){ ?>
			<h4 class="text-danger font-weight-bold">Data Anda Tidak terdeteksi!! Silahkan Daftar Dulu</h4>
		<?php }else{
			$queryPengunjung = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_status = 'A'");
			$jumlah_pengunjung = mysqli_num_rows($queryPengunjung);
			
			if($jumlah_pengunjung >= 1){
				$cariPengunjung3 = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_card = '$nokartu'");
				$data2 = mysqli_fetch_array($cariPengunjung3);
				if($data2['pengunjung_status'] == 'A' && $data2['pengunjung_mode'] == 'M'){
					$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_status = 'N', pengunjung_mode = 'K' WHERE pengunjung_card = '$nokartu'");?>
					<h4 class="text-danger font-weight-bold">Trimakasih Silahkan Keluar!!</h4>
				<?php }else{?>
					<h4 class="text-danger font-weight-bold">Maaf , Untuk Hari ini Anda Tidak Bisa Masuk Pulau!!!</h4>
					<h6>Karena Pulau Sudah Memenuhi Kapasitas Sesuai dengan Protokol Kesehatan</h6><?php 
				}
			}else{
				$cariPengunjung2 = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_card = '$nokartu'");
				$data5 = mysqli_fetch_array($cariPengunjung2);
				
				if($data5 != ""){
					if($data5['pengunjung_status'] == 'B' && $data5['pengunjung_mode'] == 'E'){
						$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_mode = 'M', pengunjung_status = 'A' WHERE pengunjung_card = '$nokartu'"); 
						?><h4 class="text-success font-weight-bold">Trimakasih, Silahkan Masuk!!!</h4>
					<?php }else if($data5['pengunjung_status'] == 'A' && $data5['pengunjung_mode'] == 'M'){
						$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_status = 'N', pengunjung_mode = 'K' WHERE pengunjung_card = '$nokartu'");?>
						<h4 class="text-danger font-weight-bold">Trimakasih Kunjungan nya!!</h4>
					<?php }else if($data5['pengunjung_status'] == 'N' && $data5['pengunjung_mode'] == 'K'){
						$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_status = 'A', pengunjung_mode = 'M' WHERE pengunjung_card = '$nokartu'");?>
						<h4 class="text-danger font-weight-bold">Trimakasih, Silahkan Masuk!!</h4>
					<?php
					}
				}
			}
		
		}
			//kosongkan tabel tmprfid
			mysqli_query($konek, "delete from tmprfid");
	} ?>

</div>