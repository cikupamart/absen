<?php
$Judul		=$_POST['Judul'];
$Semester	=$_POST['Semester'];
$Footer		=$_POST['Footer'];
$THN_AJAR	=$_POST['THN_AJAR'];
	$q = mysql_query("UPDATE `absensi`.`pengaturan` SET `Judul` = '$Judul', `Semester` = '$Semester', `Footer` = '$Footer', `THAjar` = '$THN_AJAR' WHERE `pengaturan`.`id` = 1");

if ($q) {
			echo "<script type=''  language='javascript'>alert('DATA KELAS BERHASIL DI UBAH');
					window.location.href='?page=./settings/app';</script>";
}else{
			echo "<script type=''  language='javascript'>alert('DATA KELAS GAGAL DI UBAH');
					window.location.href='?page=./settings/app';</script>";
}
?>