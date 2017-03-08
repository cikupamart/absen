
<?php
	include('libs/conn.php');
        

?>
<h2>LAPORAN ABSENSI PER TANGGAL DAN MATA PELAJARAN</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" target="_self">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <td>Mata Pelajaran</td>
    <td>:</td>
    <td> 
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
    
    </td>
        
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

<table width="100%" border="0">
  <tr>
    <th scope="col">No</th>
    <th scope="col">Tanggal Absen</th>
    <th scope="col">Keterangan</th>
  </tr>
  
 <?php
 if(isset($_POST['btnTampil'])) {
	// membaca form
	$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
	$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');
	
	// SQL Jika tombol Tampil diklik
	$SqlPeriode = " TANGGAL BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."'";

 	$tampil=  mysql_query("SELECT absensi.KETERANGAN,absensi.TANGGAL
                    from absensi,siswa,mata_pelajaran
                    where absensi.NIS=siswa.NIS
                    and absensi.ID_MP=mata_pelajaran.ID_MP
                    and absensi.NIS='$_SESSION[UserName]'
                    and $SqlPeriode");
        $nomor = 0;
        while($r=  mysql_fetch_array($tampil)){
            $nomor++;
            echo "<tr><td>$nomor</td><td>$r[TANGGAL]</td><td>$r[KETERANGAN]</td></tr>";
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

