<?php
# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	// Baca variabel form
	$txtPassLama= $_POST['txtPassLama'];
	$txtPassBaru= $_POST['txtPassBaru'];
	
	// Validasi form
	$pesanError = array();
	if (trim($txtPassLama)=="") {
		$pesanError[] = "Data <b> Password Lama </b> belum diisi !";		
	}
	if (trim($txtPassBaru)=="") {
		$pesanError[] = "Data <b> Password Baru </b> belum diisi !";		
	}
	
	// Validasi Password lama (harus benar)
	$sqlCek = "SELECT * FROM SISWA WHERE USERNAME_SISWA='11111' AND PASSWORD_SISWA ='".md5($txtPassLama)."'";
	$qryCek = mysql_query($sqlCek)  or die ("Query Periksa Password Salah : ".mysql_error());
	if(mysql_num_rows($qryCek) <1){
		$pesanError[] = "Maaf, <b> Password Anda Salah</b>....silahkan ulangi";
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<script>alert('Password Lama Salah')</script>";
		
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$mySql	= "UPDATE siswa SET PASSWORD_SISWA='".md5($txtPassBaru)."'";
		$myQry	= mysql_query($mySql);
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
		}
	}	
}
 ?>
<h1>Ganti Password</h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th colspan="3" scope="col">GANTI PASSWORD ADMIN </th>
    </tr>
    <tr>
      <td width="29%"><strong>Username</strong></td>
      <td width="2%">:</td>
      <td width="69%"><strong> <?php echo $_SESSION['UserName']; ?> </strong></td>
    </tr>
    <tr>
      <td><strong>Password Lama </strong></td>
      <td>:</td>
      <td><input name="txtPassLama" type="password" value="" size="40" maxlength="30" required=""/></td>
    </tr>
    <tr>
      <td><strong>Password Baru </strong></td>
      <td>:</td>
      <td><input name="txtPassBaru" type="password"  value="" size="40" maxlength="30" required=""/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN " class="button"></td>
    </tr>
  </table>
</form>

