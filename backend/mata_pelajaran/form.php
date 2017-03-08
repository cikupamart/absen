
<?php
	include('libs/conn.php');
	if (isset($_GET['idk'])){
		$row=mysql_fetch_array(mysql_query("select * from mata_pelajaran where ID_MP='$_GET[idk]'"));
		$stat="Y";
		$judul="EDIT DATA MATA PELAJARAN";
		$id=$_GET['idk'];
		$nama=$row['NAMA_MP'];
		$but='Update';
	}else{
		$stat="N";
		$judul="TAMBAH DATA MATA PELAJARAN";
		$akhir=mysql_fetch_array(mysql_query("SELECT max(ID_MP) AS akhir FROM mata_pelajaran"));
		
		$i=$akhir['akhir'];
		$nextnis = substr($i, 3, 3) + 1;
	 	$id = 'MP-'.sprintf('%03s', $nextnis);
		$nama='';
		$but='Save';
	}
?>
<br/><br/>
<div class="jumbotron">
<H3><?=$judul;?></H1>
<form method="post" action="?page=./mata_pelajaran/save">
<input name="ket" value="<?php echo $stat ?>" type="hidden" size="30" />
<table width="100%" border="0">
  <tr>
    <td width="145">Id Mata Pelajaran</td>
    <td width="12">:</td>
    <td width="179"><input name="idwali" type="text" id="idwali" class="form-control" readonly="readonly" value="<?=$id;?>"/></td>
  </tr>
  <tr>
    <td>Nama Mata Pelajaran</td>
    <td>:</td>
    <td><input name="nama" type="text" id="name"  value="<?=$nama;?>" class="form-control" required/></td>
  </tr>
  
  
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="<?=$but;?>" class="btn btn-primary"/>
      <input type="reset" name="Clear" id="Clear" value="Clear" class="btn btn-warning"/>
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="btn btn-danger"/></td>
  </tr>
</table>
</form>
</div>