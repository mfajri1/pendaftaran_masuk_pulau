<?php
	include "koneksi.php";

	//baca nomor kartu dari NodeMCU
	$nokartu = $_GET['nokartu'];
	//kosongkan tabel tmprfid
	mysqli_query($konek, "delete from tmprfid");

	//simpan nomor kartu yang baru ke tabel tmprfid
	$simpan = mysqli_query($konek, "insert into tmprfid(nokartu)values('$nokartu')");

	$cariPengunjung = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_card = '$nokartu'");
	$jumlah_data = mysqli_num_rows($cariPengunjung);
	if($jumlah_data == 0){
		echo "kosong";
	}else{
		$queryPengunjung = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_status = 'A'");
		$jumlah_pengunjung = mysqli_num_rows($queryPengunjung);
		if($jumlah_pengunjung >= 1){
			$cariPengunjung3 = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_card = '$nokartu'");
			$data2 = mysqli_fetch_array($cariPengunjung3);
			if($data2['pengunjung_status'] == 'A' && $data2['pengunjung_mode'] == 'M'){
				$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_status = 'N', pengunjung_mode = 'K' WHERE pengunjung_card = '$nokartu'");

				echo "keluar";
			}else{
				echo "penuh";
			}
		}else{
			$cariPengunjung2 = mysqli_query($konek, "SELECT * FROM tb_pengunjung WHERE pengunjung_card = '$nokartu'");
			$data = mysqli_fetch_array($cariPengunjung2);

			if($data != NULL){
				if($data['pengunjung_status'] == 'B' && $data['pengunjung_mode'] == 'E'){
					$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_mode = 'M', pengunjung_status = 'A' WHERE pengunjung_card = '$nokartu'");
					echo 'masuk';
				}else if($data['pengunjung_status'] == 'A' && $data['pengunjung_mode'] == 'M'){
					$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_status = 'N', pengunjung_mode = 'K' WHERE pengunjung_card = '$nokartu'");
					echo 'keluar';
				}else if($data['pengunjung_status'] == 'N' && $data['pengunjung_mode'] == 'K'){
					$queryUpdate = mysqli_query($konek, "UPDATE tb_pengunjung SET pengunjung_status = 'A', pengunjung_mode = 'M' WHERE pengunjung_card = '$nokartu'");
					echo 'masuk';
				} 		
			}

		}
		//kosongkan tabel tmprfid
		mysqli_query($konek, "delete from tmprfid");
	}

	
	
?>