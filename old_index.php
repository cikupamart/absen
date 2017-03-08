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
$nis = $_POST['nis'];
$jam = date('H:i:s');

if ($TglAbsen <= $xd) {
$pengaturan = mysql_query("SELECT * FROM pengaturan WHERE id = '1'") or die(mysql_error());
$set = mysql_fetch_array($pengaturan) or die(mysql_error());
$semester = $set['Semester'];
$thajar = $set['THAjar'];
$kelasq = mysql_query("SELECT ID_KELAS, NIS FROM kelas_siswa WHERE NIS='$nis'") or die(mysql_error());
$IdKelasq = mysql_fetch_array($kelasq);
$IdKelas = $IdKelasq['ID_KELAS'];
$ceq = mysql_query("SELECT NIS,TglAbsen FROM tbabsen WHERE NIS='$nis' AND TglAbsen='$TglAbsen'") or die(mysql_error());
$cek = mysql_num_rows($ceq);
}else{
  echo "You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''$nis''' at line 1";
}
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIAO SMK Pasim Plus</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Sistem Informasi Absensi Online</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="index.php">Absen</a></li>
                  <li><a href="backend/index.php?hal=index">Admin</a></li>
                  <li><a href="portal">Portal</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
              <center><img src="anim.gif"><br/><font size="1px">Anim By M Fauzan Isya Fadillah</font></center>
            <h1 class="cover-heading">MASUKAN Nomor Induk Siswa</h1>
            <p class="lead">
              <form method="POST">
                    <div class="form-group">
                      <input class="form-control" name="nis" placeholder="Nomor Induk Siswa" type="text">
                    </div>
              
            </p>
            <p class="lead">
            <?php
            //date_default_timezone_set('Asia/Jakarta');
            //$jam1 = date('H:i:s');
              //  if ($jam1 < "07:15:00" || $jam1 > "15:00:00") {
            ?>
             <input type="submit" class="btn btn-lg btn-default" value="Absen">
            
            <?php
              //}else{
            
             //<input type="button" class="btn btn-lg btn-default" value="ABSEN SUDAH DITUTUP">
            
             // }              
            ?>
              </form>
            </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>RPL@SMKPASIM | C 2016</p>
            </div>
          </div>

        </div>

      </div>

    </div>
    <!-- </body></html> FUCK TELKOM UZONE Ads  -->

    </body>
    </html>