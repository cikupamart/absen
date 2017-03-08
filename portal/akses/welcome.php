<?php
$level = $_SESSION['level'];
if ($level == "GPiket") {
?>
<div class="jumbotron">
<center>
  <img src="../../backend/assets/img/logo.png" class="img-responsive img-circle margin" style="display:inline" alt="Pasim" width="250" height="250">
<br/><br/>
	<a class="btn btn-primary" href="index.php?page=./sekre/absensi">Absen Siswa</a> <a class="btn btn-primary" href="index.php?page=./sekre/terlambat">Absen Siswa Terlambat</a> <a class="btn btn-primary" href="index.php?page=./pending">Lihat Ijin Siswa</a>
</center>
</div>
<?php
}elseif ($level == "Sekretaris") {
?>
<div class="jumbotron">
	Selamat datang di PORTAL SEKRETARIS KELAS SMK Pasim Plus Kota Sukabumi<br/>
	Gunakanlah semua fitur yang ada dengan bijak.
</div>
<?php
}else{
?>
<div class="jumbotron">
	Selamat datang di PORTAL SISWA SMK Pasim Plus Kota Sukabumi<br/>
	Gunakanlah semua fitur yang ada dengan bijak.
</div>
<?php
}
?>