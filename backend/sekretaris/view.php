<?php
$baris = 10;
        $hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
        $pageSql = "SELECT * FROM sekretaris";
        $pageQry = mysql_query($pageSql) or die ("error paging: ".mysql_error());
        $jumlah	 = mysql_num_rows($pageQry);
        $maksData= ceil($jumlah/$baris);
$kampret = mysql_query("SELECT * FROM sekretaris JOIN kelas ON sekretaris.kelas = kelas.ID_KELAS JOIN jurusan ON kelas.ID_JURUSAN = jurusan.ID_JURUSAN ORDER BY id ASC LIMIT $hal, $baris");
?>
<a href="home.php?page=./sekretaris/form" class="btn btn-primary">+ Sekretaris</a>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<tr>
		<td>Id</td>
		<td>Username</td>
		<td>Nama</td>
		<td>Kelas</td>
		<td>Status</td>
		<td>Aksi</td>
	</tr>
<?php
	while($begal = mysql_fetch_array($kampret)){
		if ($begal['status'] == "0") {
			$status = "<font color='red'><b>Tidak Aktif</b></font>";
		}else{
			$status = "<font color='green'><b>Aktif</b></font>";
		}
?>
	<tr>
		<td><?= $begal['id']; ?></td>
		<td><?= $begal['username']?></td>
		<td><?= $begal['nama'] ?></td>
		<td><?= $begal['NAMA_KELAS'];?> <?= $begal['SINGKATAN'] ?></td>
		<td><?= $status ?></td>
		<td><a href="home.php?page=./sekretaris/form&id=<?= $begal['id'] ?>" class="btn btn-primary">Ubah</a>
			<a href="home.php?page=./sekretaris/del&id=<?= $begal['id'] ?>" class="btn btn-danger">Hapus</a></td>
	</tr>
	<?php
		}
	 ?>
	<table width="100%"><tr><td>
        <strong>Jumlah Data : </strong> <?php echo $jumlah; ?></td>
        <td align="right">
        <strong>Halaman ke : </strong>
<?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?page=./piket/view&hal=$list[$h]'>$h</a> ";
	}
?>
</table>