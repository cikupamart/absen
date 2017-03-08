<?php
include('libs/conn.php');

if(isset($_POST['pilih'])){
    if($_POST['thn1'] > $_POST['thn2']){
        echo "<script type=''  language='javascript'>alert('TAHUN 1 TIDAK BOLEH LEBIH BESAR');
					history.go(-1)</script>";
    }elseif (($_POST['thn2'] - $_POST['thn1'])> 1) {
        echo "<script type=''  language='javascript'>alert('SELISIH HARUS 1 TAHUN');
					history.go(-1)</script>";
    }elseif ($_POST['thn2'] == $_POST['thn1']) {
        echo "<script type=''  language='javascript'>alert('TAHUN TIDAK BOLEH SAMA');
					history.go(-1)</script>";
    }else{
        $_SESSION['ID_GURU'] = $_POST['guru'];
        $_SESSION['thn1']=$_POST['thn1'];
        $_SESSION['thn2']=$_POST['thn2'];
        $_SESSION['smt']=$_POST['smt'];
        $gur=  mysql_fetch_array(mysql_query("select NAMA_GURU from guru_mp where ID_GURU='$_SESSION[ID_GURU]'"));
        $_SESSION['nama_guru']=$gur['NAMA_GURU'];
        
    }
}

if(isset($_POST['mp'])){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $masuk=  mysql_query("INSERT INTO mengajar(ID_GURU,ID_MP,THN_AJAR1,THN_AJAR2,SEM)values"
                . "('$_SESSION[ID_GURU]','$_POST[mapel]','$_SESSION[thn1]','$_SESSION[thn2]','$_SESSION[smt]')")or die(mysql_error());
        
    if($masuk){
			echo "<script type=''  language='javascript'>alert('DATA MP BERHASIL DITAMBAHKAN');
                    </script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA MP GAGAL DITAMBAHKAN');
					</script>";
		}
        
    }
}

?>
<div class="jumbotron">
<fieldset>
    <table class="table">
        <tr>
            <td>Id Guru</td><td>:</td><td><?=$_SESSION['ID_GURU'];?></td>
        </tr>
        <tr>
            <td>Nama Guru</td><td>:</td><td><?=$_SESSION['nama_guru'];?></td>
        </tr>
        <tr>
            <td>Tahun Ajar</td><td>:</td><td><?=$_SESSION['thn1'];?>/<?=$_SESSION['thn2'];?></td>
        </tr>
        <tr>
            <td>Semester</td><td>:</td><td><?=$_SESSION['smt'];?></td>
        </tr>
    </table>
</fieldset>
</div>

<div class="jumbotron">
<fieldset>
    <legend style="padding: 10px 10px 10px 10px;">Pilih Mata Pelajaran</legend>
    <form method="POST">
    &nbsp;<div  class="col-md-6"><select name="mapel" class="form-control">
    	
    	<?php
		
			$ambil=mysql_query("select * from mata_pelajaran");
			while($r=mysql_fetch_array($ambil)){
			echo "<option value=$r[ID_MP]>$r[ID_MP] -- $r[NAMA_MP]</option>";
			}
		?>
    	</select></div>
        <div class="col-md-3">
        <input type="submit" name="mp" id="Save" value="Save Mapel" class="btn btn-primary"/>
        </div>
    </form>
</fieldset>
</div>
<table class="table">
    <tr><th>Id Mapel</th><th>Nama Mapel</th><th>Semester</th><th>Aksi</th></tr>
<?php
    $ambil=  mysql_query("Select mengajar.ID_MP,mengajar.SEM,mata_pelajaran.NAMA_MP from mengajar,mata_pelajaran where mengajar.ID_MP=mata_pelajaran.ID_MP And mengajar.ID_GURU='$_SESSION[ID_GURU]' and mengajar.THN_AJAR1='$_SESSION[thn1]' And mengajar.THN_AJAR2='$_SESSION[thn2]' and mengajar.SEM = '$_SESSION[smt]'")or die(mysql_error());
    $cek=  mysql_num_rows($ambil);
    if($cek > 0){
        while($r=  mysql_fetch_array($ambil)){
            if ($r['SEM'] == "1") {
                $sem = "Ganjil";
            }else{
                $sem = "Genap";
            }
          echo "<tr><td >$r[ID_MP]</td><td >$r[NAMA_MP]</td><td>$sem</td><td ><a href='?page=./guru/del-mengajar&idmp=$r[ID_MP]&idg=$_SESSION[ID_GURU]&thn1=$_SESSION[thn1]&thn2=$_SESSION[thn2]'><img src='libs/img/deleteb.png'></a></td></tr>";
        }
    }else{
        echo "<tr><td colspan='3'>Pelajaran Belum Diisi</td></tr>";
    }

?>

</table>
<input type="button" name="Save2" id="Save2" value="Back" onclick="history.go(-1);" class="btn btn-primary"/>