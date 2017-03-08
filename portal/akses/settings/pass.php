<?php
	if (isset($_POST['ok'])) {
		$nxz	= $_SESSION['id'];
		$lvl 	= $_SESSION['level'];
		$pl		= $_POST['pl'];
		$upl	= $_POST['upl'];
		$pb		= $_POST['pb'];
		if ($lvl == "Sekretaris") {
			$whr = "id";
			$fld = "password";
			$tbl = "sekretaris";
		}elseif ($lvl == "GPiket") {
			$whr = "id";
			$fld = "password";
			$tbl = "gpiket";
		}else{
			$whr = "NIS";
			$tbl = "siswa";
			$fld = "PASSWORD_SISWA";
		}
		if ($pl == $upl) {
			$qupas = mysql_query("UPDATE $tbl SET $fld = MD5('$pb') WHERE $whr = '$nxz'") or die(mysql_error());
			if ($qupas) {
			?>
			<div class="alert alert-info">
                        <i class="fa fa-folder-open"></i><b>&nbsp;Password Berhasil di ubah</b>
                    </div>
			<?php
			}
		}

	}
?>
<div class="jumbotron">
	Ubah Password
<form method="POST" action="?page=./settings/pass">	
	<table class="table table-striped table-bordered table-hover">
	<tr>
		<td>Password Lama</td>
		<td>:</td>
		<td><input type="password" name="pl" class="form-control" required></td>
	</tr>
	<tr>
		<td>Ulangi Password Lama</td>
		<td>:</td>
		<td><input type="password" name="upl" class="form-control" required></td>
	</tr>
	<tr>
		<td>Password Baru</td>
		<td>:</td>
		<td><input type="password" name="pb" class="form-control" required></td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" class="btn btn-primary" name="ok" value="Ubah"></td>
	</tr>
</table>
</form>
</div>