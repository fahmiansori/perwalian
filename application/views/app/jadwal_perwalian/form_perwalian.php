<?php
	$nama_dosen = '';
	$nama_mahasiswa = '';
	if (isset($data_perwalian) && $data_perwalian) {
		$nama_dosen = $data_perwalian->nama_dosen;
		$nama_mahasiswa = $data_perwalian->nama_mahasiswa;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Surat Kendali Bimbingan Akademik Mahasiswa</title>
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
	</style>
</head>
<body style="font-family: calibri;">
	<header>
		<table style="width: 100%">
			<tr>
				<td>
					<center>
						<img src="<?php echo base_url('assets/images/logo_poliwangi.png'); ?>" width="100" height="90">
					</center>
				</td>
				<td>
					<center>
						<font style="font-size: 14pt;">PEMERINTAH KABUPATEN BANYUWANGI</font>
						<br>
						<b style="font-size: 14pt;">DINAS PENDIDIKAN</b>
						<font style="font-size: 12pt;">
							<br>
							Jalan Raya Jember No.KM13, Kawang, Labanasem, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461
							<br>
							Telp. (0333) 636780
						</font>
					</center>
				</td>
			</tr>
		</table>
	</header>
	<hr>
	<section style="margin: 20px;">
		<img src="http://192.168.1.111/sdk_sip/public/img/Kedaluwarsa.png" style="position: absolute;width: 90%;height: 80%; opacity: 0.0;">
		<img src="http://192.168.1.111/sdk_sip/public/img/salinan.png" style="position: absolute;width: 70%;height: 60%; opacity: 0.0;">
		<center>
			<p>
				<u>
					<b style="font-size: 14pt;">KARTU KENDALI BIMBINGAN MAHASISWA</b>
				</u>
				<br>
			</p>
		</center>

		<center>
			<p style="font-size: 12pt; text-align: justify;"> Mahasiswa :<b> <?php echo $nama_mahasiswa; ?> </b></p>
			<p style="font-size: 12pt; text-align: justify;"> Dosen Wali :<b> <?php echo $nama_dosen; ?> </b></p>
		</center>

		<center>		
			<table border="1" cellpadding="50">
			<tr>
				<th scope="col">NO</th>
				<th scope="col">Tanggal</th>
				<th scope="col">Jenis Bimbingan</th>
				<th scope="col">Uraian Konsultasi</th>
				<th scope="col">Tanda Tangan Dosen</th>
			</tr>
			<tr>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
			<tr>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
			<tr>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
			<tr>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
			<tr>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
		</table>
	</center>
</body>
</html>