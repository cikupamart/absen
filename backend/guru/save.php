<?php
	include('libs/conn.php');
	$nama=ucwords($_POST['nama']);
	$tempat=ucwords($_POST['tempat']);
	$tgl=ucwords($_POST['tgl']);
	$thn_msk=ucwords($_POST['thn_msk']);
	$jk=ucwords($_POST['jk']);
	$status=ucwords($_POST['status']);
	$alamat=ucwords($_POST['alamat']);
	$telp=ucwords($_POST['telp']);
	$pas=MD5($_POST['pass']);
	
	$stat=$_POST['ket'];
	
	if($stat=="N"){
		$akhir=mysql_fetch_array(mysql_query("SELECT max(ID_GURU) AS akhir FROM guru_mp"));
		$i=$akhir['akhir'];
		$nextnis = substr($i, 2, 3) + 1;
	 	$id = 'G-'.sprintf('%03s', $nextnis);

		$masuk=mysql_query("INSERT INTO guru_mp(ID_GURU,NAMA_GURU,JK_GURU,ALAMAT_GURU,TELP_GURU,STATUS_GURU,USERNAME_GURU,PASSWORD_GURU,TEMPAT_LAHIR,TGL_LAHIR,THN_MSK)
												values('$id','$nama','$jk','$alamat','$telp','$status','$id','$pas','$tempat','$tgl','$thn_msk')")or die(mysql_error());
		
	
                                                                                                    if($masuk){
		?>
		<div class="jumbotron">
		<table class="table">
			<tr>
				<td colspan="3">Data Guru berhasil ditambahkan</td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><?= $id ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $nama ?></td>
			</tr>
		</table>
		</div>
		<?php
		}else{
			echo "<script type=''  language='javascript'>alert('DATA GURU GAGAL DITAMBAHKAN');
					history.go(-1)</script>";
		}
        }else{
           	$id=$_POST['idwali'];
            $masuk=mysql_query("UPDATE guru_mp SET NAMA_GURU='$nama',
						   				JK_GURU='$jk',
										ALAMAT_GURU='$alamat',
										TELP_GURU='$telp',
										USERNAME_GURU='$id',
										PASSWORD_GURU='$pas',
										TEMPAT_LAHIR='$tempat',
										TGL_LAHIR='$tgl',
										THN_MSK='$thn_msk'
										where ID_GURU='$id'");
		if($masuk){
                    if($UserLevel=="Guru"){
                        echo "<script type=''  language='javascript'>alert('DATA PROFILE BERHASIL DIUPDATE');
					window.location.href='home.php';</script>";
                    }else{
			echo "<script type=''  language='javascript'>alert('DATA GURU BERHASIL DIUPDATE');
					window.location.href='?page=./guru/view';</script>";
                    }
		}else{
			echo "<script type=''  language='javascript'>alert('DATA GURU GAGAL DIUPDATE');
					history.go(-1)</script>";
		}
	}
	
?>