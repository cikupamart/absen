<?php
	if (isset($_POST['ok'])) {
		$lvl 	= $_SESSION['UserLevel'];
		$pl		= md5($_POST['pl']);
		$upl	= md5($_POST['upl']);
		$pb		= $_POST['pb'];
		if ($lvl == "Admin") {
			$nxz = $_SESSION['UserName'];
			$whr = "USERNAME";
			$fld = "PASSWORD";
			$tbl = "admin";
			$CEK_PASS_LAMAQ = mysql_query("SELECT * FROM $tbl WHERE $whr = '$nxz'");
			$AMBIL_PASS_LAMA = mysql_fetch_array($CEK_PASS_LAMAQ);
			$pld = $AMBIL_PASS_LAMA['PASSWORD'];
		}else{
			$nxz = $_SESSION['idUser'];
			$whr = "ID_GURU";
			$tbl = "guru_mp";
			$fld = "PASSWORD_GURU";
			$CEK_PASS_LAMAQ = mysql_query("SELECT * FROM $tbl WHERE $whr = '$nxz'");
			$AMBIL_PASS_LAMA = mysql_fetch_array($CEK_PASS_LAMAQ);
			$pld = $AMBIL_PASS_LAMA['PASSWORD_GURU'];
		}
		if ($pl == $upl) {
			if ($pl == $pld) {
				$qupas = mysql_query("UPDATE $tbl SET $fld = MD5('$pb') WHERE $whr = '$nxz'") or die(mysql_error());
			if ($qupas) {
			?>
			<div class="alert alert-info">
                <i class="fa fa-folder-open"></i><b>&nbsp;Password Berhasil di ubah</b>
            </div>
			<?php
			}else{
			?>
			<div class="alert alert-danger">
                <i class="fa fa-folder-open"></i><b>&nbsp;Password lama anda salah</b>
            </div>
			<?php
			}	
			}else{
			?>
			<div class="alert alert-danger">
                <i class="fa fa-folder-open"></i><b>&nbsp;Password lama anda salah</b>
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