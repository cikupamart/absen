<?php
	include('libs/conn.php');
	if (isset($_GET['idguru'])){
		$row=mysql_fetch_array(mysql_query("select * from guru_mp where ID_GURU='$_GET[idguru]'"));
		$stat="Y";
		$judul="EDIT DATA GURU MATA PELAJARAN";
		$id=$_GET['idguru'];
		$nama=$row['NAMA_GURU'];
     $tempat=$row['TEMPAT_LAHIR'];
     $x='';
		$alamat=$row['ALAMAT_GURU'];
		$telp=$row['TELP_GURU'];
    $thn_msk=$row['THN_MSK'];
		if($row['JK_GURU']=='Laki-Laki'){
			$l='checked';
			$p='';
		}else{
			$l='';
			$p='checked';
		}
		$tgl=$row['TGL_LAHIR'];
		if($row['STATUS_GURU']=='Aktif'){
			$a='checked';
			$t='';
		}else{
			$t='checked';
			$a='';
		}
		$but='Update';
	}else{
		$stat="N";
		$judul="TAMBAH DATA GURU MATA PELAJARAN";
		$akhir=mysql_fetch_array(mysql_query("SELECT max(ID_GURU) AS akhir FROM guru_mp"));
		$i=$akhir['akhir'];
		$nextnis = substr($i, 2, 3) + 1;
	 	$id = 'G-'.sprintf('%03s', $nextnis);
		$nama='';
		$l='';
		$p='';
		$a='';
    $tempat='';
		$t='';
		$alamat='';
    $tgl='';
    $thn_msk='';
		$telp='';
    $x='';
		$but='Save';
	}
?>

<H1><?=$judul;?></H1>
<form method="post" action="?page=./guru/save" target="_blank">
<input name="ket" value="<?php echo $stat ?>" type="hidden" size="30" />
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td width="145">Kode Guru</td>
    <td width="12">:</td>
    <td width="179"><input name="idwali" type="text" id="idwali"  value="<?=$id;?>" class="form-control" hidden/></td>
  </tr>
  <tr>
    <td>Nama Guru</td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama" placeholder="Isi Nama Guru" value="<?=$nama;?>" class="form-control" required/></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td><table width="200">
      <tr>
        <td><label>
          <input type="radio" name="jk" value="Laki-Laki" id="jk_0"  <?=$l;?>/>
          Laki-Laki</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="jk" value="Perempuan" id="jk_1"  <?=$p;?>/>
          Perempuan</label></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>Tempat Lahir</td>
    <td>:</td>
    <td><input type="text" name="tempat" id="tempat" placeholder="Isi Tempat Lahir"  maxlenght="20" value="<?=$tempat;?>" class="form-control" required/></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td><input class="form-control" type="date" name="tgl" id="tgl" placeholder="yyy/mm/dd" value="<?=$tgl;?>"  <?=$x?> required/></td>
  </tr>
  
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><textarea class="form-control" name="alamat" id="alamat" cols="45" rows="5" placeholder="Isi Alamat" required><?=$alamat;?></textarea></td>
  </tr>
  <tr>
    <td>Telpon</td>
    <td>:</td>
    <td><input class="form-control" type="text" name="telp" id="telp" placeholder="Isi Telpon"  maxlenght="12" value="<?=$telp;?>" required/></td>
  </tr>
 
        <tr>
    <td>Password</td>
    <td>:</td>
    <td><input class="form-control" name="pass" type="password" placeholder="isi Password Baru"></td>
  </tr>
 
  <tr>
      <td>Tahun Masuk</td>
    <td>:</td>
    <td><select name="thn_msk" class="form-control">
      
      <?php
                $thn_msk='';
    $x=date('Y');
      for($i=$x;$i>=2000;$i--){
                            echo "<option value='$i'>$i</option>";
                        }
    ?>
      </select>
        </td>
  </tr>
  <tr>
    <td>Status</td>
    <td>:</td>
    <td><table width="200">
      <tr>
        <td><label>
          <input type="radio" name="status" value="Aktif" id="status_0" <?=$a;?> checked/>
          Aktif</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="status" value="Tidak Aktif" id="status_1"  <?=$t;?>/>
          Tidak Aktif</label></td>
      </tr>
    </table></td>
  </tr>
   
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="<?=$but;?>" class='button'/>
      <input type="reset" name="Clear" id="Clear" value="Clear" class='button'/>
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class='button'/></td>
    </tr>
</table>
</form>
