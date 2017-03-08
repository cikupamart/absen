
<?php
	include('libs/conn.php');
        

?>
<h2>LAPORAN ABSENSI PER TANGGAL</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" target="_self">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td>Mata Pelajaran</td>
    <td>:</td>
    <td> <?php if ($UserLevel == "Guru"){ ?><select name="mp">
    	
    	<?php
		
			$ambil=mysql_query("select mengajar.ID_MP,mata_pelajaran.NAMA_MP
                                from guru_mp,mata_pelajaran,mengajar
                                where mengajar.ID_GURU=guru_mp.ID_GURU
                                and mengajar.ID_MP=mata_pelajaran.ID_MP and mengajar.ID_GURU='$_SESSION[UserName]'
                                GROUP BY ID_MP");
                        
			while($r=mysql_fetch_array($ambil)){
			
			echo "<option value=$r[ID_MP]>$r[NAMA_MP]</option>";
			}
		?>
    </select><?php } else{?>
    <select name="mp">
    	
    	<?php
		
			$ambil=mysql_query("select mengajar.ID_MP,mata_pelajaran.NAMA_MP
                                from guru_mp,mata_pelajaran,mengajar
                                where mengajar.ID_GURU=guru_mp.ID_GURU
                                and mengajar.ID_MP=mata_pelajaran.ID_MP 
                                ");
                        
			while($r=mysql_fetch_array($ambil)){
			
			echo "<option value=$r[ID_MP]>$r[NAMA_MP]</option>";
			}
		?>
    </select>
    <?php } ?>
    </td>
        
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
    <td>  <select name="jurusan" >

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
    <td>  <select name="thn_ajar" style="width:110px;">

                <?php

                                $ambil=mysql_query("select THN_AJAR from kelas_siswa");
                                while($r=mysql_fetch_array($ambil)){

                                echo "<option value=$r[THN_AJAR]>$r[THN_AJAR]</option>";
                                }
                        ?>
        </select></td>
  </tr>
  <tr>
    <td>Semester</td>
    <td>:</td>
    <td>  <select name="semester" style="width:110px;">

            <OPTION value="1">1</OPTION>
            <OPTION value="2">2</OPTION>
        </select></td>
  </tr>
  <tr>
      <td width="133"><strong>Tanggal Absensi</strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="340"><input name="txtTglAwal" type="text" class="tcal"  size="20" required=""/> 
        s/d 
        <input name="txtTglAkhir" type="text" class="tcal"  size="20" required="" />
        <input name="btnTampil" type="submit" value=" Tampilkan " class="button"/></td>
    </tr>
</table>
</form>

<table class="table table-striped table-bordered table-hover">
  <tr>
    <th scope="col">No</th>
    <th scope="col">Tanggal Absen</th>
    <th scope="col">Nis</th>
    <th scope="col">Nama Siswa</th>
    <th scope="col">Keterangan</th>
  </tr>
  
 <?php
 if(isset($_POST['btnTampil'])) {
	// membaca form
	$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
	$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');
	
	// SQL Jika tombol Tampil diklik
	$SqlPeriode = " TANGGAL BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."'";

 	$tampil=  mysql_query("SELECT absensi.NIS,absensi.KETERANGAN,absensi.TANGGAL,siswa.NAMA_SISWA,
                    mata_pelajaran.NAMA_MP,kelas.NAMA_KELAS,jurusan.NAMA_JURUSAN
                    from absensi,siswa,mata_pelajaran,kelas,kelas_siswa,jurusan
                    where absensi.NIS=siswa.NIS
                    and absensi.ID_MP=mata_pelajaran.ID_MP
                    and siswa.NIS=kelas_siswa.NIS
                    and kelas_siswa.ID_KELAS=kelas.ID_KELAS
                    and kelas.ID_JURUSAN=jurusan.ID_JURUSAN 
                    AND absensi.ID_MP='$_POST[mp]'
                    AND kelas.ID_KELAS='$_POST[kelas]'
                    AND
                    $SqlPeriode ORDER BY siswa.NIS DESC");
        $nomor = 0;
        while($r=  mysql_fetch_array($tampil)){
            $nomor++;
            echo "<tr><td>$nomor</td><td>$r[TANGGAL]</td><td>$r[NIS]</td><td>$r[NAMA_SISWA]</td><td>$r[KETERANGAN]</td></tr>";
        }
 }else {
	// Tanggal standar
	$awalTgl 	= "01-".date('m-Y');
	$akhirTgl 	= date('d-m-Y'); 

	// SQL Jika tidak belum ada tombol diklik
	$SqlPeriode = " tgl_pemesanan BETWEEN '".InggrisTgl($awalTgl)."' AND '".InggrisTgl($akhirTgl)."'";
}
 ?>
</table>

