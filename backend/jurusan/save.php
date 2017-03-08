<?php
	include('libs/conn.php');
	$id=$_POST['idwali'];
	$nama=ucwords($_POST['nama']);
	$sin=ucwords($_POST['singkatan']);
	
	$stat=$_POST['ket'];
	
	if($stat=="N"){
		$masuk=mysql_query("INSERT INTO jurusan(ID_JURUSAN,NAMA_JURUSAN,SINGKATAN) values('$id','$nama','$sin')");
		if($masuk){
			echo "<script type=''  language='javascript'>alert('DATA JURUSAN BERHASIL DITAMBAHKAN');
					window.location.href='?page=./jurusan/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA JURUSAN GAGAL DITAMBAHKAN');
					history.go(-1)</script>";
		}
	}else{
		$masuk=mysql_query("UPDATE jurusan SET NAMA_JURUSAN='$nama',SINGKATAN='$sin' WHERE ID_JURUSAN='$id'");
		if($masuk){
			echo "<script type=''  language='javascript'>alert('DATA JURUSAN BERHASIL DIUPDATE');
					window.location.href='?page=./jurusan/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA JURUSAN GAGAL DIUPDATE');
					history.go(-1)</script>";
		}
	}
	
?>