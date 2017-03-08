<?php
$siswa_nis = $_SESSION['id'];
$siswa_absen = mysql_query("SELECT * FROM tbabsen JOIN siswa ON tbabsen.NIS = siswa.NIS WHERE tbabsen.NIS = '$siswa_nis'");
$siswa_data = mysql_fetch_array($siswa_absen);
$siswa_hadir = mysql_query("SELECT COUNT(KETERANGAN) FROM tbabsen WHERE NIS = '$siswa_nis' AND KETERANGAN = 'H' AND THAjar = '$thajar'");
$h = mysql_fetch_array($siswa_hadir); 
$siswa_sakit = mysql_query("SELECT COUNT(KETERANGAN) FROM tbabsen WHERE NIS = '$siswa_nis' AND KETERANGAN = 'S' AND THAjar = '$thajar'");
$s = mysql_fetch_array($siswa_sakit); 
$siswa_alpa = mysql_query("SELECT COUNT(KETERANGAN) FROM tbabsen WHERE NIS = '$siswa_nis' AND KETERANGAN = 'A' AND THAjar = '$thajar'");
$a = mysql_fetch_array($siswa_alpa); 
$siswa_ijin = mysql_query("SELECT COUNT(KETERANGAN) FROM tbabsen WHERE NIS = '$siswa_nis' AND KETERANGAN = 'I' AND THAjar = '$thajar'"); 
$i = mysql_fetch_array($siswa_ijin);

$j = $h['COUNT(KETERANGAN)']+$s['COUNT(KETERANGAN)']+$a['COUNT(KETERANGAN)']+$i['COUNT(KETERANGAN)'];
?>

<div class="jumbotron">
	Data absen Saudara <?= $siswa_data['NAMA_SISWA'] ?> <br/>
	Semeser : <?= $smt ?>
	Tahun Ajaran : <?= $thajar ?> 

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<tr>
			<td>Jumlah Hadir</td>
			<td>:</td>
			<td><?= $h['COUNT(KETERANGAN)'] ?></td>
		</tr>
		<tr>
			<td>Jumlah Sakit</td>
			<td>:</td>
			<td><?= $s['COUNT(KETERANGAN)'] ?></td>
		</tr>
		<tr>
			<td>Jumlah Ijin</td>
			<td>:</td>
			<td><?= $i['COUNT(KETERANGAN)'] ?></td>
		</tr>
		<tr>
			<td>Jumlah Alpa</td>
			<td>:</td>
			<td><?= $a['COUNT(KETERANGAN)'] ?></td>
		</tr>
		<tr>
			<td colspan="2"><b>Jumlah</b></td>
			<td><b><?= $j ?></b></td>
		</tr>
	</table>
</div>
</div>