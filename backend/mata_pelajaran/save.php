<?php
	include('libs/conn.php');
	$id=$_POST['idwali'];
	$nama=ucwords($_POST['nama']);
	
	$stat=$_POST['ket'];
	
	if($stat=="N"){
		$masuk=mysql_query("INSERT INTO mata_pelajaran(ID_MP,NAMA_MP) values('$id','$nama')");
		if($masuk){
			echo "<script type=''  language='javascript'>alert('DATA MP BERHASIL DITAMBAHKAN');
					window.location.href='?page=./mata_pelajaran/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA MP GAGAL DITAMBAHKAN');
					history.go(-1)</script>";
		}
	}else{
		$masuk=mysql_query("UPDATE mata_pelajaran SET NAMA_MP='$nama' WHERE ID_MP='$id'");
		if($masuk){
			echo "<script type=''  language='javascript'>alert('DATA MP BERHASIL DIUPDATE');
					window.location.href='?page=./mata_pelajaran/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA MP GAGAL DIUPDATE');
					history.go(-1)</script>";
		}
	}
	
?>