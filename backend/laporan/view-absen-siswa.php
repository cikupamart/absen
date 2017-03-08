
<?php
	if (isset($_SESSION['UserLevel'])) {
    if ($_SESSION['UserLevel'] == "Admin") {
      # code...
    include('libs/conn.php');
    $url = "./";
  }
  }else{
    include '../../backend/libs/conn.php';
    $url = "../../backend/";
     include_once "../../backend/libs/inc.library.php"; 
  }
        

?>
<h2>LAPORAN ABSENSI SISWA</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" target="_self">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td>Kelas</td>
    <td>:</td>
    <td> <select name="kelas" style="width: 70px;">

                <?php

                                $ambil=mysql_query("select * from kelas join jurusan on kelas.ID_JURUSAN = jurusan.ID_JURUSAN");
                                while($r=mysql_fetch_array($ambil)){

                                echo "<option value=$r[ID_KELAS]>$r[NAMA_KELAS] $r[SINGKATAN]</option>";
                                }
                        ?>
                </select></td>
  </tr>
  <tr>
    <td>Tahun Ajar</td>
    <td>:</td>
    <td>  <select name="thn_ajar" style="width:110px;">

                <?php

                                $ambil=mysql_query("SELECT * FROM `kelas_siswa` ORDER BY `THN_AJAR` DESC");
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

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
	$THN_AJAR = $set['THAjar'];
  $Semester = $set['Semester'];
	// SQL Jika tombol Tampil diklik
	$SqlPeriode = " TglAbsen BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."'";

 	$tampil=  mysql_query("SELECT tbabsen.nis,tbabsen.KETERANGAN,tbabsen.TglAbsen,siswa.NAMA_SISWA,
                    kelas.NAMA_KELAS,jurusan.NAMA_JURUSAN
                    from tbabsen,siswa,kelas,kelas_siswa,jurusan
                    where tbabsen.NIS=siswa.NIS
                    and siswa.NIS=kelas_siswa.NIS
                    and kelas_siswa.ID_KELAS=kelas.ID_KELAS
                    and kelas.ID_JURUSAN=jurusan.ID_JURUSAN 
                    AND kelas.ID_KELAS='$_POST[kelas]'
                    AND tbabsen.THAjar='$THN_AJAR'
                    AND tbabsen.Semester='$Semester'
                    AND
                    $SqlPeriode ORDER BY siswa.NIS DESC") or die(mysql_error());
        $nomor = 0;
        while($r=  mysql_fetch_array($tampil)){
            $nomor++;
            echo "<tr><td>$nomor</td><td>$r[TglAbsen]</td><td>$r[nis]</td><td>$r[NAMA_SISWA]</td><td>$r[KETERANGAN]</td></tr>";
        }
 }else {
	// Tanggal standar
	$awalTgl 	= "01-".date('m-Y');
	$akhirTgl 	= date('d-m-Y'); 

	// SQL Jika tidak belum ada tombol diklik
	$SqlPeriode = " TglAbsen BETWEEN '".InggrisTgl($awalTgl)."' AND '".InggrisTgl($akhirTgl)."'";
}
 ?>
 <tr>
     <td colspan="5"><a href="<?= $url ?>laporan/lap_absen.php?Kelas=<?php echo $_POST['kelas'];?>&Tawal=<?php echo $tglAwal;?>&Takhir=<?php echo $tglAkhir; ?>&print=Y"  class="btn btn-warning" >Cetak</a>
          <a href="<?= $url ?>laporan/lap_absen.php?Kelas=<?php echo $_POST['kelas'];?>&Tawal=<?php echo $tglAwal;?>&Takhir=<?php echo $tglAkhir; ?>&print=N"  class="btn btn-warning" >Excel</a>
</td>
 </tr>
</table>

