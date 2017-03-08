
<?php
	include('libs/conn.php');
?>
<input type="button" value="Tambah"   align="middle" title="Tambah Data"  name="cetak"  onclick="window.location.href='?page=./mata_pelajaran/form'" class="btn btn-primary">

<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">Id Mata Pelajaran</th>
    <th scope="col">Nama Mata Pelajaran</th>
    <th scope="col">Aksi</th>
  </tr>
  </thead>
  <tbody>
 <?php
 	$ambil=mysql_query("select * from mata_pelajaran");
	$cek=mysql_num_rows($ambil);
	if($cek>0){
		while($r=mysql_fetch_array($ambil)){
			echo "<tr><td>$r[ID_MP]</td>
					  <td>$r[NAMA_MP]</td>
					  <td><a href='?page=./mata_pelajaran/form&idk=$r[ID_MP]'><img src='libs/img/check.gif'></a> &nbsp;
					  	  <a href='?page=./mata_pelajaran/del&idk=$r[ID_MP]'><img src='libs/img/deleteb.png'></a>
					  </td>
				  </tr>";
		}
	}else{
		echo "<tr><td colspan=4>Data Masih Kosong</td></tr>";
	}
 ?>
 </tbody>
</table>