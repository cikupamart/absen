<?php
	include('libs/conn.php');
        $baris = 10;
        $hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
        $pageSql = "SELECT * FROM guru_mp";
        $pageQry = mysql_query($pageSql) or die ("error paging: ".mysql_error());
        $jumlah	 = mysql_num_rows($pageQry);
        $maksData= ceil($jumlah/$baris);

?>

        
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <th scope="col">No</th>
    <th scope="col">ID GURU</th>
    <th scope="col">Nama Guru</th>
    <th scope="col">Jenis Kel.</th>
    <th scope="col">Alamat</th>
    <th scope="col">Telp</th>
    <th scope="col">Status</th>
    
  </tr>
  
 <?php
 	$ambil=mysql_query("SELECT * FROM guru_mp Order By ID_GURU Asc LIMIT $hal, $baris");
        $nomor = $hal; 
	$cek=mysql_num_rows($ambil);
	if($cek>0){
		while($r=mysql_fetch_array($ambil)){
                    $nomor++;
			if ($r['JK_GURU']=='Laki-Laki')
		    {
			  $a = '<img src="images/man.png" width="20" height="20" align="center" title="Laki - Laki"/>'; 
		    }else{
		      		$a = '<img src="images/woman.png" width="20" height="20" align="center" title="Perempuan" />';
		    	}
			echo "<tr><td>$nomor</td><td>$r[ID_GURU]</td>
					  <td><a href='?page=./guru/detail-mengajar&idguru=$r[ID_GURU]'>$r[NAMA_GURU]</a></td>
					  <td>$a</td>
					  <td>$r[ALAMAT_GURU]</td>
					  <td>$r[TELP_GURU]</td>
					  <td>$r[STATUS_GURU]</td>
					  
				  </tr>";
		}
	}else{
		echo "<tr><td colspan=6>Data Masih Kosong</td></tr>";
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
		echo " <a href='?page=./guru/view&hal=$list[$h]'>$h</a> ";
	}
	?>
        </td></tr></table> 


