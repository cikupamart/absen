
<?php
	include('libs/conn.php');
	if (isset($_GET['idk'])){
		$row=mysql_fetch_array(mysql_query("select kelas.*,jurusan.SINGKATAN,jurusan.NAMA_JURUSAN from kelas,jurusan where ID_KELAS='$_GET[idk]' 
										AND kelas.ID_JURUSAN=jurusan.ID_JURUSAN"));
		$stat="Y";
		$judul="EDIT DATA KELAS";
		$id=$_GET['idk'];
		$nama=$row['NAMA_KELAS'];
		$jurusan=$row['ID_JURUSAN'];
		$sing=$row['SINGKATAN'];
		$na_jur=$row['NAMA_JURUSAN'];
		$but='Update';
	}else{
		$stat="N";
		$judul="TAMBAH DATA KELAS";
		$akhir=mysql_fetch_array(mysql_query("SELECT max(ID_KELAS) AS akhir FROM kelas"));
		$id=$akhir['akhir']+1;
		$nama='';
		$jurusan='';
		$sing='';
		$na_jur='';
		$but='Save';
	}
?>
<H1><?=$judul;?></H1>
<form method="post" action="?page=./kelas/save">
<input name="ket" value="<?php echo $stat ?>" type="hidden" size="30" />
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td width="145">Id Kelas</td>
    <td width="12">:</td>
    <td width="179"><input name="idwali" type="text" id="idwali" readonly="readonly" value="<?=$id;?>"/></td>
  </tr>
  <tr>
    <td>Nama Kelas</td>
    <td>:</td>
    <td><select name=nama>
    	
    	<option value="<?=$nama?>" selected><?=$nama?></option>
    	<option value=Xa>X.a</option>
        <option value=XIa>XI.a</option>
        <option value=XIIa>XII.a</option>
        <option value=Xb>X.b</option>
        <option value=XIb>XI.b</option>
        <option value=XIIb>XII.b</option>
    </select></td>
  </tr>
  <tr>
    <td>Jurusan</td>
    <td>:</td>
    <td><select name="jurusan">
    	
    	<?php
		
			$ambil=mysql_query("select * from jurusan");
                        echo "<option value='$jurusan' selected>$sing -- $na_jur</option>";
			while($r=mysql_fetch_array($ambil)){
			
			echo "<option value=$r[ID_JURUSAN]>$r[SINGKATAN] -- $r[NAMA_JURUSAN]</option>";
			}
		?>
    	</select></td>
  </tr>
  
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="<?=$but;?>" class="button"/>
      <input type="reset" name="Clear" id="Clear" value="Clear" class="button"/>
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="button"/></td>
  </tr>
</table>
</form>
