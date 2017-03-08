<?php
if (!isset($_POST['ok'])) {
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" target="_self" role="form" method="POST">
<div class="form-group">
	Dari Tanggal
	<input type="date" name="tawal" class="form-control"><br/>
	Sampai Dengan 
	<input type="date" name="takhir" class="form-control"><br/>
	<input type="submit" name="ok" value="Tampilkan" class="btn btn-primary">
</div>
</form>

<hr>
Pilihan lain<br/>
Cari berdasarkan :<br/>
<form action="cari.php" method="post">
<select name="berdasarkan">
	<option>== Cari Berdasarkan ==</option>
	<option value="nis">NIS</option>
	<option value="nama">Nama Siswa</option>
</select>
<input type="text" name="cari"> <input type="submit" value="Cari" name="submit" class="btn btn-primary">
</form>

<br/><br/>
Laporan Per Kelas :
<?php
$wer = mysql_query("SELECT * FROM kelas JOIN jurusan ON jurusan.ID_JURUSAN = kelas.ID_JURUSAN") or die(mysql_error());
?>
<form action="lapkelas.php" method="get"> 
<select name="kelas" class="form-control">
	<?php
		while ($kzl = mysql_fetch_array($wer)) {
			echo "<option value='$kzl[ID_KELAS]'>$kzl[NAMA_KELAS] - $kzl[NAMA_JURUSAN]</option>";
		}
	?>
</select>
<input type="submit" value="Tampilkan" class="btn btn-primary">
</form>
<?php
}else{
	$tawal = date('Y-m-d', strtotime($_POST['tawal']));
	$takhir = date('Y-m-d', strtotime($_POST['takhir']));
	$query = mysql_query("SELECT izin.*, siswa.NAMA_SISWA FROM izin JOIN siswa ON siswa.NIS = izin.NIS WHERE izin.TANGGAL BETWEEN '$tawal' AND '$takhir'") or die(mysql_error());

?>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<tr>
               	<th>Kode Izin</th>
               	<th>Tanggal</th>
               	<th>Nama Siswa</th>
               	<th>Jam Izin</th>
               	<th>Jam Kembali</th>
               	<th>Alasan</th>
               	<th>Status</th>
		</tr>
		<?php while($r = mysql_fetch_array($query)){ ?>
		<tr>
			<td><?=$r['NIS'];?></td>
			<td><?=$r['TANGGAL'];?></td>
			<td><?=$r['NAMA_SISWA'];?></td>
			<td><?=$r['JAM_IZIN'];?></td>
			<td><?=$r['JAM_KEMBALI'];?></td>
			<td><?=$r['ALASAN'];?></td>
			<td><?php if ($r['STATUS'] == 0) {
          echo "<font color='red'>BELUM DISETUJUI</font>";
        }else{
          echo "<font color='green'>TELAH DISETUJUI</font>";
        } ?></td>
		</tr>
		<?php } ?>
	</table>
</div>
<a class="btn btn-primary" href="laporan-cetak.php?tawal=<?=$tawal?>&takhir=<?=$takhir?>">Cetak</a> <a class="btn btn-primary" href="laporan-export.php?tawal=<?=$tawal?>&takhir=<?=$takhir?>">Export to Excel</a>
<?php
}
?>