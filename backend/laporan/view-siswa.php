
<?php
	include('libs/conn.php');
        if(isset($_POST['cari'])){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if($_POST['thnn_msk']==''){
                    $filterSql = "";
                }else{
                    $filterSql = "AND THN_MASUK='$_POST[thnn_msk]'"; 
                }
               
            }
        }else{
                $filterSql = ""; 
             }
       
?>

<form action="" method="post" name="form1" target="_self" >
<a href="laporan/lap_siswa.php?&id=<?=$_POST['thnn_msk']?>" class='btn btn-primary' style="float:right;" target="_blank">Cetak Data</a>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <tr><td>Pilih Tahun Masuk</td><td> : </td><td><select name="thnn_msk" style="width:110px;" id="thnn_msk">
                <option value="">Semua</option>
    	<?php
                
		$x=date('Y');
			for($i=$x;$i>=2000;$i--){
                            echo "<option value='$i'>$i</option>";
                        }
		?>
            </select><input type="submit" name="cari" class='btn btn-primary'  value="Cari"/></td>
        <td align="right">
            
        </td>
    </tr>
    
</table>
</form>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">Nis</th>
    <th scope="col">Nama Siswa</th>
    <th scope="col">Jenis Kelamin</th>
    <th scope="col">Jurusan</th>
    <th scope="col">Photo</th>
  </tr>
  </thead>
  <tbody>
 <?php
 	$ambil=mysql_query("SELECT siswa.*,jurusan.SINGKATAN FROM siswa,jurusan where siswa.ID_JURUSAN=jurusan.ID_JURUSAN $filterSql");
	
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
					  
				  </tr>";
		}
	}else{
		echo "<tr><td colspan=6>Data Masih Kosong</td></tr>";
	}
 ?>
 </tbody>
</table>

<hr>
<table width="100%">
    <tr><td>
        <strong>Jumlah Data : </strong> <?php echo $cek; ?></br>
        </td>
        
    </tr>
</table>

