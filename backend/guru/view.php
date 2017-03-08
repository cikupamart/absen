<?php
	include('libs/conn.php');

?>

        <input type="button" name="tambah" class="btn btn-primary btn-lg" onClick="window.location.href='?page=./guru/form'" value="+ Data Guru" style="width: 150px; height:40px;"/>
        <input type="button" name="tambah_ajar" class="btn btn-primary btn-lg" onClick="window.location.href='?page=./guru/form-mengajar'" value="+ Data Mengajar" style="height:40px;width: 150px;"/>

<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">ID GURU</th>
    <th scope="col">Nama Guru</th>
    <th scope="col">Jenis Kel.</th>
    <th scope="col">Alamat</th>
    <th scope="col">Telp</th>
    <th scope="col">Status</th>
    <th scope="col">Aksi</th>
  </tr>
 </thead>
 <tbody>
 <?php
 	$ambil=mysql_query("SELECT * FROM guru_mp Order By ID_GURU Asc");
	$cek=mysql_num_rows($ambil);
	if($cek>0){
		while($r=mysql_fetch_array($ambil)){
			if ($r['JK_GURU']=='Laki-Laki')
		    {
			  $a = '<img src="images/man.png" width="20" height="20" align="center" title="Laki - Laki"/>'; 
		    }else{
		      		$a = '<img src="images/woman.png" width="20" height="20" align="center" title="Perempuan" />';
		    	}
			echo "<tr><td>$r[ID_GURU]</td>
					  <td><a href='?page=./guru/detail-mengajar&idguru=$r[ID_GURU]'>$r[NAMA_GURU]</a></td>
					  <td>$a</td>
					  <td>$r[ALAMAT_GURU]</td>
					  <td>$r[TELP_GURU]</td>
					  <td>$r[STATUS_GURU]</td>
					  <td><a href='?page=./guru/form&idguru=$r[ID_GURU]'><img src='libs/img/check.gif'></a> &nbsp;
					  	  <a href='?page=./guru/del&idguru=$r[ID_GURU]'><img src='libs/img/deleteb.png'></a>
					  </td>
				  </tr>";
		}
	}else{
		echo "<tr><td colspan=6>Data Masih Kosong</td></tr>";
	}
 ?>
 </tbody>
</table>