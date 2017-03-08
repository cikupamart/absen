
<?php
	include('libs/conn.php');
	
	if (isset($_GET['idwali'])){
		$queryx = mysql_query("SELECT siswa.*,jurusan.* FROM siswa,jurusan WHERE siswa.ID_JURUSAN=jurusan.ID_JURUSAN");
		$row=mysql_fetch_array($queryx);
		if (isset($_GET['kt'])){
			$stat="Y";
			$judul="VIEW DATA SISWA";
			$button='View';
			$x='readonly';
			$d='disabled';
			$z='readonly';
		}else{
			$stat="Y";
			$judul="EDIT DATA SISWA";
			
			$button='Update';
			$x='';
			$d='';
			$z='readonly';
                        $thn_msk=$row['THN_MASUK'];
		}
		$id=$_GET['idwali'];
		
			$nama=$row['NAMA_SISWA'];
			
			$tgl=$row['TGL_LAHIR'];
			 $tempat=$row['TEMPAT_LAHIR'];
				if($row['JK_SISWA']=="L"){
				$l='checked';
				$p='';
				}else{
				$p='checked';
				$l='';
				}
			$agama = $row['AGAMA_SISWA'];	
			$alamat=$row['ALAMAT_SISWA'];
			$tempat=$row['TEMPAT_LAHIR'];
			$telp=$row['TELP_SISWA'];
			$jurusan=$row['ID_JURUSAN'];
			$sing=$row['SINGKATAN'];
			$na_jur=$row['NAMA_JURUSAN'];
                        $thn_msk=$row['THN_MASUK'];
			
		$fot="<img src='siswa/photo/$row[FOTO]' width='75px' height='75px'>";
		$hid="<input type='hidden' value='$row[FOTO]' name='lama'>";
		$idw=$row['ID_WALI'];
		
		
	}else{
		$stat="N";
		$judul="TAMBAH DATA SISWA";
		 $tempat='';
		$id='';
		$nama='';
		$jk='';
		$alamat='';
		$telp='';
		$tgl='';
		$wali='';
		$agama='';
		$foto='';
		$idw='';
		$ayah='';
		$ibu='';
		$tempat='';
		$l='';
		$p='';
		$jurusan='';
		$sing='';
		$na_jur='';
		$button='Save';
		$x='';
		$d='';
		$fot='';
		$hid='';
                $kelas='';
                $nama_kelas='';
		$z='';
                $thn_msk='';
	}
?>
<H1><?=$judul;?></H1>
<form role="form" method="post" action="?page=./siswa/save" enctype="multipart/form-data">
<?=$hid;?>
<div class="form-group">
<input name="ket" value="<?php echo $stat ?>" type="hidden" size="30" />
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td width="145">NIS</td>
    <td width="12">:</td>
    <td width="179"><input  name="idwali" type="text" id="idwali" placeholder="Isi NIS" value="<?=$id;?>" <?=$x?> <?=$z;?> class="form-control" required/></td>
  </tr>
  <tr>
    <td>Nama Siswa</td>
    <td>:</td>
    <td><input type="text" name="nama" id="ayah" placeholder="Isi Nama Siswa" value="<?=$nama;?>"  <?=$x?> class="form-control" required/></td>
  </tr>
   <tr>
    <td>Tempat Lahir</td>
    <td>:</td>
    <td><input type="text" name="tempat" id="tempat" placeholder="Isi Tempat Lahir"  maxlenght="20" value="<?=$tempat;?>" class="form-control" required/></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td><input class="form-control" type="date" name="tgl" id="ayah" placeholder="yyy/mm/dd" value="<?=$tgl;?>"  <?=$x?> required/></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td><table width="200">
      <tr>
        <td><label>
          <input type="radio" name="jk" value="L" id="jk_0" <?=$l;?>/>
          Laki-Laki</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="jk" value="P" id="jk_1" <?=$p;?>/>
          Perempuan</label></td>
      </tr>
	 </table></td>
</tr>
<tr>
    <td>Agama</td>
    <td>:</td>
    <td><select name="agama" <?=$d?> class="form-control">
		<?php 
		echo "<option value='$agama' selected>$agama</option>";
		?>
		<option value="Islam">Islam</option>
		<option value="Kristen">Kristen</option>
		<option value="Hindu">Hindu</option>
		<option value="Budha">Budha</option>
	</select></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><textarea name="alamat" class="form-control" id="alamat" cols="45" rows="5" placeholder="Isi Alamat"  <?=$x?> required><?=$alamat;?></textarea></td>
  </tr>
  <tr>
    <td>Telpon</td>
    <td>:</td>
    <td><input type="text" name="telp" id="telp" placeholder="Isi Telpon"  value="<?=$telp;?>"  <?=$x?> class="form-control" required/></td>
  </tr>
  
  <tr>
    <td>Foto</td>
    <td>:</td>
    <td><input type="file" name="photo" id="photo"   <?=$x?> />
		<br/><center> <?=$fot;?> </center>
	</td>
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
    <td>Jurusan</td>
    <td>:</td>
    <td><select name="jurusan" class="form-control">
    	
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
    <td>No Hp Ortu</td>
    <td>:</td>
    <td><input type="text" name="wali" id="wali" placeholder="Isi Telpon"  value="<?= $idw ?>"  <?=$x?> class="form-control" required/></td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="<?=$button;?>" class="button" <?=$d;?>/>
      <input type="reset" name="Clear" id="Clear" value="Clear" class="button" />
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="button"/></td>
    </tr>
</table>
</div>
</form>
