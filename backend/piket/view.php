<?php
$baris = 10;
        $hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
        $pageSql = "SELECT * FROM gpiket";
        $pageQry = mysql_query($pageSql) or die ("error paging: ".mysql_error());
        $jumlah	 = mysql_num_rows($pageQry);
        $maksData= ceil($jumlah/$baris);
$kampret = mysql_query("SELECT * FROM gpiket ORDER BY id ASC LIMIT $hal, $baris");
?>
<a href="home.php?page=./piket/form" class="btn btn-primary">Tambah Petugas</a>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<tr>
		<td>Id</td>
		<td>Username</td>
		<td>Nama</td>
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
		<td><?= $status ?></td>
		<td><a href="home.php?page=./piket/form&id=<?= $begal['id'] ?>" class="btn btn-primary">Ubah</a>
			<a href="home.php?page=./piket/hapus&id=<?= $begal['id'] ?>" class="btn btn-danger">Hapus</a></td>
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