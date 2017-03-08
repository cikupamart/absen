
<?php
	include('libs/conn.php');
?>
	<input type="button" name="tambah" class="btn btn-primary btn-lg" onClick="window.location.href='?page=./siswa/form'" value="Tambah Data"/>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">

	<thead>
  <tr>
    <th scope="col">Nis</th>
    <th scope="col">Nama Siswa</th>
    <th scope="col">Jenis Kelamin</th>
    <th scope="col">Jurusan</th>
	<th scope="col">Photo</th>
    <th scope="col">Aksi</th>
  </tr>
  </thead>
  <tbody>
 <?php
 	$ambil=mysql_query("SELECT siswa.*,jurusan.SINGKATAN FROM siswa,jurusan where siswa.ID_JURUSAN=jurusan.ID_JURUSAN") or die(mysql_error());
	$cek=mysql_num_rows($ambil);
	if($cek>0){
		while($r=mysql_fetch_array($ambil)){
		if ($r['JK_SISWA']=='L')
		    {
			  $a = '<img src="images/man.png" width="20" height="20" align="center" title="Laki - Laki"/>'; 
		    }else{
		      		$a = '<img src="images/woman.png" width="20" height="20" align="center" title="Perempuan" />';
		    	}
			echo "<tr><td><a href='?page=./siswa/detail&idwali=$r[NIS]&kt=view'>$r[NIS]</a></td>
					  <td>$r[NAMA_SISWA]</td>
					  <td>$a</td>
					  <td>$r[SINGKATAN]</td>
					  <td><img src='siswa/photo/$r[FOTO]' width='50px' height='50px'></td>
					  <td><a href='?page=./siswa/form&idwali=$r[NIS]'><img src='libs/img/check.gif'></a> &nbsp;
					  	  <a href='?page=./siswa/del&idwali=$r[NIS]&foto=$r[FOTO]'><img src='libs/img/deleteb.png'></a>
					  </td>
				  </tr>";
		}
	}else{
		echo "<tr><td colspan=6>Data Masih Kosong</td></tr>";
	}
 ?>
 </tbody>
</table>