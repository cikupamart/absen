<?php
	include('libs/conn.php');
	$id=$_POST['idwali'];
	$nama=ucwords($_POST['nama']);
	$jur=ucwords($_POST['jurusan']);
	$pas=MD5($_POST['idwali']);
	$stat=$_POST['ket'];
	
	if($stat=="N"){
		$masuk=mysql_query("INSERT INTO kelas(ID_KELAS,NAMA_KELAS,ID_JURUSAN) values('$id','$nama','$jur')");
		if($masuk){
			echo "<script type=''  language='javascript'>alert('DATA KELAS BERHASIL DITAMBAHKAN');
					window.location.href='?page=./kelas/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA KELAS GAGAL DITAMBAHKAN');
					history.go(-1)</script>";
		}
	}else{
		$masuk=mysql_query("UPDATE kelas SET NAMA_KELAS='$nama',ID_JURUSAN='$jur' WHERE ID_KELAS='$id'");
		if($masuk){
			echo "<script type=''  language='javascript'>alert('DATA KELAS BERHASIL DIUPDATE');
					window.location.href='?page=./kelas/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA KELAS GAGAL DIUPDATE');
					history.go(-1)</script>";
		}
	}
	
?>