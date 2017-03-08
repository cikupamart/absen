
<?php
date_default_timezone_set('Asia/Jakarta');
	include('libs/conn.php');
	if(isset($_POST['Absen'])){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $jumlah = count($_POST["item"]);
                        for($i=0; $i < $jumlah; $i++) 
                        {
                            $nis=$_POST['nis'][$i];
                            $ket=$_POST["item"][$i];
                            $mp=$_SESSION['mp'];
                            $tgl=$_POST['tanggal'];
                            $jam=$_POST['jam'];
                            $pengaturan = mysql_query("SELECT * FROM pengaturan WHERE id = '1'");
                            $set = mysql_fetch_array($pengaturan);
                            $sms= $set['Semester'];
                            $THN_AJAR = $set['THAjar'];
                            $cek=mysql_num_rows(mysql_query("select NIS from absensi where NIS='$nis' and ID_MP='$mp' and TANGGAL='$tgl'"));
                            if($cek>0){
                                $q=mysql_query("UPDATE absensi SET KETERANGAN='$ket',JAM='$jam', SEMESTER='$sms' where NIS='$nis' and ID_MP='$mp' and TANGGAL='$tgl' ");
                            }else{
                                    $q=mysql_query("insert into absensi(NIS,ID_MP,KETERANGAN,TANGGAL,JAM,SEMESTER,THAjar)
                                            values('$nis','$mp','$ket','$tgl','$jam','$sms','$THN_AJAR')")or die(mysql_error()); 
                            }
                        }

                        if ($q){
                           echo"<SCRIPT>alert('Data Berhasil Diinput');</SCRIPT>";
                          }
                          else
                          {
                           echo"<SCRIPT>alert('Data Gagal Diinput');</SCRIPT>";
                          }
                }
        }
?>
<H1>ABSENSI MATA PELAJARAN</H1>
<form method="post" action="">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td>Mata Pelajaran</td>
    <td>:</td>
    <td><select name="mp" class="form-control">
    	
    	<?php
		
			$ambil=mysql_query("select mengajar.ID_MP,mata_pelajaran.NAMA_MP
                                from guru_mp,mata_pelajaran,mengajar
                                where mengajar.ID_GURU=guru_mp.ID_GURU
                                and mengajar.ID_MP=mata_pelajaran.ID_MP and mengajar.ID_GURU='$_SESSION[UserName]'
                                 GROUP BY mengajar.ID_MP");
                        
			while($r=mysql_fetch_array($ambil)){
			
			echo "<option value=$r[ID_MP]>$r[NAMA_MP]</option>";
			}
		?>
    	</select></td>
        
  </tr>
  <tr>
    <td>Kelas</td>
    <td>:</td>
    <td> <select name="kelas" class="form-control">

                <?php

                                $ambil=mysql_query("select * from kelas join jurusan on kelas.ID_JURUSAN = jurusan.ID_JURUSAN");
                                while($r=mysql_fetch_array($ambil)){

                                echo "<option value=$r[ID_KELAS]>$r[NAMA_KELAS] $r[SINGKATAN]</option>";
                                }
                        ?>
                </select></td>
  </tr>
  <tr>
    <td>Jurusan</td>
    <td>:</td>
    <td>  <select name="jurusan" class="form-control">

                <?php

                                $ambil=mysql_query("select * from jurusan");
                                while($r=mysql_fetch_array($ambil)){

                                echo "<option value=$r[ID_JURUSAN]>$r[SINGKATAN] -- $r[NAMA_JURUSAN]</option>";
                                }
                        ?>
        </select></td>
  </tr>
  <tr>
    <td>Tahun Ajar</td>
    <td>:</td>
    <td>  <select name="thn_ajar" class="form-control">

                <?php

                                $ambil=mysql_query("select DISTINCT(THN_AJAR) from kelas_siswa");
                                while($r=mysql_fetch_array($ambil)){

                                echo "<option value=$r[THN_AJAR]>$r[THN_AJAR]</option>";
                                }
                        ?>
        </select></td>
  </tr>
  <tr>
    <td>Semester</td>
    <td>:</td>
    <td>  <select name="semester" class="form-control">

            <OPTION value="1">1</OPTION>
            <OPTION value="2">2</OPTION>
        </select></td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="Tampilkan" class="button"/>
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="button"/></td>
  </tr>
</table>
</form>


<form method="post">
<FIELDSET>
    <LEGEND>Tanggal</LEGEND>
    <table class="table table-striped table-bordered table-hover">
  <tr>
    <td>Tanggal Absensi</td>
    <td>:</td>
    <td><input name="tanggal" type="text" class="tcal"  value="<?=InggrisTgl(date('d-m-Y')) ?>" size="22" /></td>
  </tr>
  <tr>
    <td>Waktu Absensi</td>
    <td>:</td>
    <td><input type="text" name="jam" value="<?=date("h:i:s");?>" readonly=""></td>
  </tr>
    </TABLE>
</FIELDSET>
<FIELDSET>
    <LEGEND>Daftar Siswa</LEGEND>
    
<table  class="table table-striped table-bordered table-hover">
  <tr>
    <th scope="col" width="50%">NIS</th>
    <th scope="col" width="50%">Nama Siswa</th>
    <th scope="col">Aksi Absen</th>
  </tr>
  <?php
         if(isset($_POST['Save'])){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $_SESSION['mp']=$_POST['mp'];
                    $_SESSION['sms']=$_POST['semester'];
                    $kelas=$_POST['kelas'];
                    $jur=$_POST['jurusan'];
                    $thn=$_POST['thn_ajar'];
                    $ambil=mysql_query("SELECT kelas_siswa.NIS,siswa.NAMA_SISWA,siswa.JK_SISWA,
                            siswa.FOTO from kelas_siswa,siswa,kelas where kelas_siswa.nis=siswa.nis 
                            and kelas_siswa.ID_KELAS='$kelas' and kelas_siswa.THN_AJAR='$thn' 
                            and kelas.ID_JURUSAN='$jur' and kelas_siswa.ID_KELAS=kelas.ID_KELAS");
                    $cek=mysql_num_rows($ambil);
                    if($cek>0){
                            while($r=mysql_fetch_array($ambil)){
                                   
                                    echo "<tr><td>$r[NIS]</td>
                                                      <td>$r[NAMA_SISWA]</td>
                                                      <td>
                                                       <input type='hidden' name='nis[]' value='$r[NIS]'>
                                                        <select name='item[]' nim='item[]'>
                                                            <option value='H' selected>Hadir</option>
                                                            <option value='I'>Izin</option>
                                                            <option value='A'>Alfa</option>
                                                            <option value='S'>Sakit</option>
                                                        </select>
                                                        </td>
                                              </tr>";
		}
	}else{
		echo "<tr><td colspan=6>Data Masih Kosong</td></tr>";}
                }
        }
        ?>
</TABLE>
    <center><input type='submit' name='Absen' id='Save' value='Absen' class='button'/></center>
</FIELDSET>
</FORM>