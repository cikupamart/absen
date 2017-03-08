<?php
$x = "required";
if (!isset($_GET['id'])) {
	$nama = "";
	$pass = "";
	$action = "?page=./piket/save";
	$btn = "Simpan";
	$status = "1";
	$z = "required";
	$status = "1";
	$status_nama = "Aktif";
}else{
	$z = "";
	$cari = mysql_query("SELECT * FROM gpiket WHERE id = '$_GET[id]'");
	$hancurkan = mysql_fetch_array($cari);
	$id	  = $hancurkan['id'];
	$user = $hancurkan['username'];
	$nama = $hancurkan['nama'];
	$pass = "Ubah Password";
	$action = "?page=./piket/update";
	$btn = "Ubah";
	$status = $hancurkan['status'];
	if ($status == "1") {
		$status_nama = "Aktif";
	}else{
		$status_nama = "Tidak Aktif";
	}
?>

<?php
}
?>

<form role="form" method="post" action="<?= $action ?>" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $id ?>">
<div class="form-group">
<table class="table">
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama" class="form-control" value="<?= $nama ?>" <?= $x ?>></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" name="pass" class="form-control" value="" placeholder="<?= $pass ?>" <?= $z ?>></td>
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td>
			<select class="form-control" name="status">
				<option value="<?= $status ?>"><?= $status_nama ?></option>
				<option value="1">Aktif</option>
				<option value="0">Tidak Aktif</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" name="ok" class="btn btn-primary" value="<?= $btn ?>"></td>
	</tr>
</table>
</div>
</form>