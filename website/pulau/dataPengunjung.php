<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Data Masyarakat</title>
</head>
<body>

	<?php include "menu.php"; ?>

	<!--isi -->
	<div class="container-fluid">
		<h3>Data Pengunjung</h3>
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: grey; color: white;">
					<th style="width: 10px; text-align: center">No.</th>
					<th style="width: 200px; text-align: center">Nik</th>
					<th style="width: 200px; text-align: center">Nama</th>
					<th style="width: 200px; text-align: center">Asal</th>
					<th style="text-align: center">Mode</th>
					<th style="text-align: center">Status</th>
					<th style="width: 100px; text-align: center">Aksi</th>
				</tr>
			</thead>
			<tbody>

				<?php
					//koneksi ke database
					include "koneksi.php";

					//baca data karyawan
					$sql = mysqli_query($konek, "select * from tb_pengunjung");
					$no = 0;
					while($data = mysqli_fetch_array($sql))
					{
						$no++;
				?>

				<tr>
					<!-- echo $data['pengunjung_mode']; -->
					<td> <?php echo $no; ?> </td>
					<td> <?php echo $data['pengunjung_card']; ?> </td>
					<td> <?php echo $data['pengunjung_name']; ?> </td>
					<td> <?php echo $data['pengunjung_asal']; ?> </td>
					<td> 
						<?php 
							if($data['pengunjung_mode'] == 'M'){
								echo "Masuk";
							}else if($data['pengunjung_mode'] == 'K'){
								echo "Keluar";
							}else if($data['pengunjung_mode'] == 'E'){
								echo "Kosong";
							} 
						?> 
					</td>
					<td>
						<?php  
							if($data['pengunjung_status'] == 'A'){
								echo "Aktif";
							}else if($data['pengunjung_status'] == 'N'){
								echo "Nonaktif";
							}else if($data['pengunjung_status'] == 'B'){
								echo "Baru";
							}
						?>
					</td>
					<td>
						<a href="edit.php?id=<?php echo $data['pengunjung_id']; ?>"> Edit</a> | <a href="hapus.php?id=<?php echo $data['pengunjung_id']; ?>"> Hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<!-- tombol tambah data karyawan -->
		<a href="tambah.php"> <button class="btn btn-primary">Tambah Data Pengunjung</button> </a>
	</div>

	<?php include "footer.php"; ?>

</body>
</html>