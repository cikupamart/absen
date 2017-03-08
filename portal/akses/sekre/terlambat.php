<?php
if (isset($_POST['nis'])) {
  if ($_POST['nis'] == "") {
    echo "<script>alert('NIS TIDAK BOLEH KOSONG !'); window.location='index.php';</script>";
  }
  else {
  include('backend/libs/conn.php');
  //jika tombol absen ditekan
$ceksiswa = mysql_query("SELECT * FROM siswa WHERE NIS = '$_POST[nis]'");
$ceksiswaa = mysql_num_rows($ceksiswa);
if ($ceksiswaa < 1) {
    echo "<script>alert('NIS TIDAK COCOK !'); window.location='index.php';</script>";
}else {
  $nm = mysql_fetch_array($ceksiswa) or die(mysql_error());
$nama = $nm['NAMA_SISWA'];
date_default_timezone_set('Asia/Jakarta');
$TglAbsen = date('Y-m-d');
$xq = mysql_fetch_array(mysql_query("select Date from gammu"));
$xd = $xq['Date'];
$nis = $_POST['nis'];
$jam = date('H:i:s');

$pengaturan = mysql_query("SELECT * FROM pengaturan WHERE id = '1'") or die(mysql_error());
$set = mysql_fetch_array($pengaturan) or die(mysql_error());
$semester = $set['Semester'];
$thajar = $set['THAjar'];
$kelasq = mysql_query("SELECT ID_KELAS, NIS FROM kelas_siswa WHERE NIS='$nis'") or die(mysql_error());
$IdKelasq = mysql_fetch_array($kelasq);
$IdKelas = $IdKelasq['ID_KELAS'];
$ceq = mysql_query("SELECT NIS,TglAbsen FROM tbabsen WHERE NIS='$nis' AND TglAbsen='$TglAbsen'") or die(mysql_error());
$cek = mysql_num_rows($ceq);

if ($cek == 0) {
    $queries = mysql_query("INSERT INTO `tbabsen` (`TglAbsen`, `NIS`, `JamMasuk`, `KETERANGAN`, `Ket`, `KdKelas`, `SEMESTER`,`THAjar`) VALUES ('$TglAbsen', '$nis', '$jam', 'H', 'Y', '$IdKelas','$semester','$thajar')") or die(mysql_error());
    if ($queries) {
      $nohp = $nm['ID_WALI'];
      mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', 'Yth. Orang Tua/wali Siswa, Ananda $nama Telah hadir terlambat di SMK Pasim Plus', 'Gammu 1.28.90')") or die(mysql_error());
      echo "<script>alert('Selamat Belajar Kawan'); window.location='index.php';</script>";
    }
}
else {
  $queries = mysql_query("UPDATE tbabsen SET KETERANGAN = 'H', Ket = 'Y' WHERE NIS = '$nis'") or die(mysql_error());
    if ($queries) {
      $nohp = $nm['ID_WALI'];
      mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', 'Yth. Orang Tua/wali Siswa, Ananda $nama Telah hadir terlambat di SMK Pasim Plus', 'Gammu 1.28.90')") or die(mysql_error());
      echo "<script>alert('Selamat Belajar Kawan'); window.location='index.php';</script>";
    }
}
  }
}    
}
?>


<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Sistem Informasi Absensi Online</h3>
  <img src="../../backend/assets/img/logo.png" class="img-responsive img-circle margin" style="display:inline" alt="Pasim" width="250" height="250">
  <form method="POST">
  <div class="col-md-4">
  </div>
  <div class="col-md-4">
    <input type="text" name="nis" class="form-control" placeholder="Nomor Induk Siswa"> <input type="submit" name="ok" class="btn btn-primary" value="Update">
  </form>
  </div>
  <div class="col-md-4">
  </div>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>Developed by <a href="http://www.facebook.com/junandia">R.Jun</a></p>
</footer>

    <!-- </body></html> FUCK TELKOM UZONE Ads  -->

    </body>
    </html>

