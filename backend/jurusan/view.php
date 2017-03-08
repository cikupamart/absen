
<?php
	include('libs/conn.php');
?>
<input type="button" name="tambah" class="btn btn-primary btn-lg" onClick="window.location.href='?page=./jurusan/form'" value="Tambah Data"/>
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <th scope="col">Id Jurusan</th>
    <th scope="col">Nama Jurusan</th>
    <th scope="col">Alias</th>
    <th scope="col">Aksi</th>
  </tr>
  
 <?php
 	$ambil=mysql_query("select * from jurusan");
	$cek=mysql_num_rows($ambil);
	if($cek>0){
		while($r=mysql_fetch_array($ambil)){
			echo "<tr><td>$r[ID_JURUSAN]</td>
					  <td>$r[NAMA_JURUSAN]</td>
					  <td>$r[SINGKATAN]</td>
					  <td><a href='?page=./jurusan/form&idk=$r[ID_JURUSAN]'><img src='libs/img/check.gif'></a> &nbsp;
					  	  <a href='?page=./jurusan/del&idk=$r[ID_JURUSAN]'><img src='libs/img/deleteb.png'></a>
					  </td>
				  </tr>";
		}
	}else{
		echo "<tr><td colspan=4>Data Masih Kosong</td></tr>";
	}
 ?>
</table>

