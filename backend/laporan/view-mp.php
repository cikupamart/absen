
<?php
	include('libs/conn.php');
        $baris = 10;
        $hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
        $pageSql = "SELECT * FROM mata_pelajaran";
        $pageQry = mysql_query($pageSql) or die ("error paging: ".mysql_error());
        $jumlah	 = mysql_num_rows($pageQry);
        $maksData= ceil($jumlah/$baris);
?>


	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <th scope="col">Id Mata Pelajaran</th>
    <th scope="col">Nama Mata Pelajaran</th>
    
  </tr>
  
 <?php
 	$ambil=mysql_query("select * from mata_pelajaran LIMIT $hal, $baris");
	$cek=mysql_num_rows($ambil);
	if($cek>0){
		while($r=mysql_fetch_array($ambil)){
			echo "<tr><td>$r[ID_MP]</td>
					  <td>$r[NAMA_MP]</td>
					  
				  </tr>";
		}
	}else{
		echo "<tr><td colspan=4>Data Masih Kosong</td></tr>";
	}
 ?>
</table>
<hr>
 <table width="100%"><tr><td>
        <strong>Jumlah Data : </strong> <?php echo $jumlah; ?></td>
        <td align="right">
        <strong>Halaman ke : </strong>
<?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?page=./mata_pelajaran/view&hal=$list[$h]'>$h</a> ";
	}
	?>
        </td></tr></table> 