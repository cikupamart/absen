
<?php
	include('libs/conn.php');
	if (isset($_GET['idk'])){
		$row=mysql_fetch_array(mysql_query("select * from jurusan where ID_JURUSAN='$_GET[idk]'"));
		$stat="Y";
		$judul="EDIT DATA JURUSAN";
		$id=$_GET['idk'];
		$nama=$row['NAMA_JURUSAN'];
		$singkatan=$row['SINGKATAN'];
		$but='Update';
	}else{
		$stat="N";
		$judul="TAMBAH DATA JURUSAN";
		$akhir=mysql_fetch_array(mysql_query("SELECT max(ID_JURUSAN) AS akhir FROM jurusan"));
		$id=$akhir['akhir']+1;
		$nama='';
		$jurusan='';
		$singkatan='';
		$na_jur='';
		$but='Save';
	}
?>
<H1><?=$judul;?></H1>
<form method="post" action="?page=./jurusan/save">
<input name="ket" value="<?php echo $stat ?>" type="hidden" size="30" />
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td width="145">Id Jurusan</td>
    <td width="12">:</td>
    <td width="179"><input name="idwali" class="form-control" type="text" id="idwali" readonly="readonly" value="<?=$id;?>"/></td>
  </tr>
  <tr>
    <td>Nama Jurusan</td>
    <td>:</td>
    <td><input name="nama" type="text" class="form-control" id="name"  value="<?=$nama;?>" required/></td>
  </tr>
  <tr>
    <td>Singkatan</td>
    <td>:</td>
    <td><input name="singkatan" class="form-control" type="text" id="name"  value="<?=$singkatan;?>" required/></td>
  </tr>
  
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="<?=$but;?>" class="button"/>
      <input type="reset" name="Clear" id="Clear" value="Clear" class="button"/>
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="button"/></td>
  </tr>
</table>
</form>
