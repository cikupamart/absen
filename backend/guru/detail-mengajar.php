<?php

include('libs/conn.php');
if ($UserLevel == "Guru"){
    $row=mysql_fetch_array(mysql_query("select * from guru_mp where ID_GURU='$_SESSION[UserName]'"));
		$stat="Y";
		$judul="VIEW GURU MATA PELAJARAN";
		$g=$_SESSION['UserName'];
		$id=$_SESSION['UserName'];
		$nama=$row['NAMA_GURU'];
		$alamat=$row['ALAMAT_GURU'];
		$telp=$row['TELP_GURU'];
		if($row['JK_GURU']=='Laki-Laki'){
			$l='Laki-Laki';
			
		}else{
			$l='Perempuan';
			
		}
		
		if($row['STATUS_GURU']=='Aktif'){
			$a='Aktif';
			
		}else{
			$a='Tidak Aktif';
			
		}
}else{
	if (isset($_GET['idguru'])){
		$row=mysql_fetch_array(mysql_query("select * from guru_mp where ID_GURU='$_GET[idguru]'"));
		$g=$_GET['idguru'];
		$stat="Y";
		$judul="EDIT DATA GURU MATA PELAJARAN";
		$id=$_GET['idguru'];
		$nama=$row['NAMA_GURU'];
		$alamat=$row['ALAMAT_GURU'];
		$telp=$row['TELP_GURU'];
		if($row['JK_GURU']=='Laki-Laki'){
			$l='Laki-Laki';
			
		}else{
			$l='Perempuan';
			
		}
		
		if($row['STATUS_GURU']=='Aktif'){
			$a='Aktif';
			
		}else{
			$a='Tidak Aktif';
			
		}
		
	}
    }
 ?>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td width="145">Kode Guru</td>
    <td width="12">:</td>
    <td width="179"><?=$id;?></td>
  </tr>
  <tr>
    <td>Nama Guru</td>
    <td>:</td>
    <td><?=$nama;?></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td> <?=$l;?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><?=$alamat;?></td>
  </tr>
  <tr>
    <td>Telpon</td>
    <td>:</td>
    <td><?=$telp;?></td>
  </tr>
  
  <tr>
    <td>Status</td>
    <td>:</td>
    <td><?=$a;?></td>
  </tr>
</table>
<h2>Data Mengajar:</h2>
<table class="table table-striped table-bordered table-hover"><tr><th>Tahun Ajar</th><th>Kode Mata Pelajaran</th><th>Nama Mata Pelajaran</th></tr>
<?php
$tam=  mysql_query("select mengajar.*,mata_pelajaran.NAMA_MP from mengajar,mata_pelajaran where ID_GURU='$g' and mengajar.ID_MP=mata_pelajaran.ID_MP order by THN_AJAR1");
while($r=  mysql_fetch_array($tam)){
    echo"<tr><td>$r[THN_AJAR1]/$r[THN_AJAR2]</td><td>$r[ID_MP]</td><td>$r[NAMA_MP]</td></TR>";
}
?>
</table>