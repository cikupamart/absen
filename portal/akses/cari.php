<!DOCTYPE html>
<html>
<head>
	<title>Laporan Izin Keluar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="../../backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../../backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../../backend/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../../backend/assets/css/style.css" rel="stylesheet" />
    <link href="../../backend/assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../../backend/assets/plugins/dataTables/dataTables.bootstrap.css">
</head>
<body>
<?php
@include '../../backend/libs/conn.php';
if (@$_POST['berdasarkan'] == "nis") {
	$fld2 = "izin.NIS";
}else{
	$fld2 = "siswa.NAMA_SISWA";
}
@$carip = $_POST['cari'];
@$cariq = mysql_query("SELECT * FROM izin JOIN siswa ON siswa.NIS = izin.NIS WHERE $fld2 LIKE '%$carip%'");
?>

<div class="table-responsive">
	<table class="table">
	<tr align="center">
			<td colspan="7"><img src="../../backend/assets/img/logo.png" alt="SMK PASIM PLUS" width="150" height="150" /></td>
		</tr>
		<tr>
               	<th>Kode Izin</th>
               	<th>NIS</th>
               	<th>Tanggal</th>
               	<th>Nama Siswa</th>
               	<th>Jam Izin</th>
               	<th>Jam Kembali</th>
               	<th>Alasan</th>
		</tr>
		<?php while($r = mysql_fetch_array($cariq)){ ?>
		<tr>
			<td><?=$r['KD_IZIN']?></td>
			<td><?=$r['NIS'];?></td>
			<td><?=$r['TANGGAL'];?></td>
			<td><?=$r['NAMA_SISWA'];?></td>
			<td><?=$r['JAM_IZIN'];?></td>
			<td><?=$r['JAM_KEMBALI'];?></td>
			<td><?=$r['ALASAN'];?></td>
		</tr>
		<?php } ?>
	</table>
	<table class="table">
		<tr>
			<pre align="center">SMK Pasim Plus 2016</pre>
		</tr>
	</table>
</div>
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
</body>
</html>