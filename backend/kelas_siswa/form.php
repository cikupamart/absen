<?php
	include('libs/conn.php');

?>

<h1>TAMBAH SISWA KE KELAS</h1>
<form method="post" action="?page=./kelas_siswa/save" enctype="multipart/form-data">
<input name="ket" value="<?php echo $stat ?>" type="hidden" size="30" />
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td width="145">NIS</td>
    <td width="12">:</td>
    <td width="179"><input name="NIS" type="text" id="NIS" placeholder="Isi NIS" value="" class="form-control" required/></td>
  </tr>
<tr>
    <td>Kelas</td>
    <td>:</td>
    <td><select name="KELAS" class="form-control">
    	
    	 <?php
 	$ambil=mysql_query("select kelas.*,jurusan.SINGKATAN,jurusan.NAMA_JURUSAN from kelas,jurusan where kelas.ID_JURUSAN=jurusan.ID_JURUSAN");
	$cek=mysql_num_rows($ambil);
	if($cek>0){
		while($r=mysql_fetch_array($ambil)){
			echo "<option value=$r[ID_KELAS]>$r[NAMA_KELAS] - $r[NAMA_JURUSAN]</option>";
		}
	}else{
		echo "<tr><td colspan=4>Data Masih Kosong</td></tr>";
	}
 ?>
    	</select></td>
  </tr>
  <td>Tahun Ajaran</td>
    <td>:</td>
    <td><select name="THN_AJAR" class="form-control">
    	
    	<?php
		$x=date('Y');
			for($i=$x;$i>=2000;$i--){
				$i2 = $i+1;
                            echo "<option value='$i/$i2'>$i/$i2</option>";
                        }
		?>
    	</select>
        </td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="Save" class="button" />
      <input type="reset" name="Clear" id="Clear" value="Clear" class="button" />
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="button"/></td>
    </tr>
</table>
</form>
