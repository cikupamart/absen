<?php
	include('libs/conn.php');
        $nama_file="photo/".$_GET[foto];
        unlink($nama_file);
	$hapus=mysql_query("DELETE FROM siswa WHERE NIS='$_GET[idwali]'")or die(mysql_error());
	if($hapus){
			echo "<script type=''  language='javascript'>alert('DATA SISWA BERHASIL DIHAPUS');
					window.location.href='?page=./siswa/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA SISWA GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>