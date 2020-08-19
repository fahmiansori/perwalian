<?php
	$nama_dosen = '';
	$nama_mahasiswa = '';
	$tanda_tangan = '';
	$status = '';
	if (isset($data_perwalian) && $data_perwalian) {
		$nama_dosen = $data_perwalian->nama_dosen;
		$nama_mahasiswa = $data_perwalian->nama_mahasiswa;
		$tanda_tangan = $data_perwalian->tanda_tangan;
		$status = $data_perwalian->status;
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
				<?php if ($data_perwalian_mahasiswa && $data_perwalian_mahasiswa->num_rows() > 0): ?>
					<?php
						function tanggal_indo($tanggal)
						{
							$hari = array ( 1 =>    'Senin',
								'Selasa',
								'Rabu',
								'Kamis',
								'Jumat',
								'Sabtu',
								'Minggu'
							);

							$bulan = array (1 =>   'Januari',
								'Februari',
								'Maret',
								'April',
								'Mei',
								'Juni',
								'Juli',
								'Agustus',
								'September',
								'Oktober',
								'November',
								'Desember'
							);
							$tanggal_ = date('Y-m-d', strtotime($tanggal));
							$split 	  = explode('-', $tanggal_);
							$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

							$num = date('N', strtotime($tanggal));
							$jam = date('H:i', strtotime($tanggal));
							return $hari[$num] . ', ' . $tgl_indo;
						}

						$no = 0;
					?>
					<?php foreach ($data_perwalian_mahasiswa->result() as $key): ?>
						<tr>
							<td scope="col"><?= ++$no; ?></td>
							<td scope="col"><?= tanggal_indo($key->tanggal) ?></td>
							<td scope="col"><?= $key->jenis ?></td>
							<td scope="col"><?= $key->uraian ?></td>
							<td scope="col">
								<?php if ($status == 'done' && !empty($tanda_tangan)): ?>
									<img src="<?= base_url('assets/images/tanda_tangan/'.$tanda_tangan); ?>" style="width:100px;display:block;margin:auto;" alt="">
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>

					<?php if ($no < 5): ?>
						<?php
							for ($i=0; $i <= $no; $i++) {
								?>
									<tr>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
									</tr>
								<?php
							}
						?>
					<?php endif; ?>
				<?php else: ?>
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
				<?php endif; ?>
			</table>
		</center>
</body>
</html>
