<?php
if (isset($_POST['go'])) {
  
    $jumlah = count($_POST['nis']);
    for($i=0;$i<$jumlah;$i++){
    $ket = $_POST['absen'][$i];
	  $nis = $_POST['nis'][$i];
    $seskelas = $_POST['kelas'][$i];
    $jam = date('H:i:s');
    $a = mysql_query("SELECT ID_WALI, NAMA_SISWA FROM siswa WHERE NIS = '$nis'");
    $b = mysql_fetch_array($a);
    $nohp = $b['ID_WALI'];
    $nama = $b['NAMA_SISWA'];
    
    if ($ket == "S") {
      mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', 'Yth. Orang Tua/wali Siswa, Ananda $nama tercatat tidak hadir di SMK Pasim Plus dikarenakan SAKIT', 'Gammu 1.28.90')") or die(mysql_error());
    }elseif ($ket == "I") {
      mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', 'Yth. Orang Tua/wali Siswa, Ananda $nama tercatat tidak hadir di SMK Pasim Plus dikarenakan IZIN', 'Gammu 1.28.90')") or die(mysql_error());
    }elseif ($ket == "A"){
      mysql_query("INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', 'Yth. Orang Tua/wali Siswa, Ananda $nama tercatat tidak hadir di SMK Pasim Plus dikarenakan ALPA', 'Gammu 1.28.90')") or die(mysql_error());
    }
    $queries = mysql_query("INSERT INTO `tbabsen` (`TglAbsen`, `NIS`, `JamMasuk`, `KETERANGAN`, `Ket`, `KdKelas`, `SEMESTER`,`THAjar`) VALUES (CURRENT_DATE(), '$nis', '$jam', '$ket', '$ket', '$seskelas','$smt','$thajar')") or die(mysql_error());
    if ($queries) {
      unset($_SESSION['kelas']);
      echo "<script>window.location='index.php?page=./sekre/absensi';</script>";
    }
  }
}
if (isset($_POST['kelas'])) {
$siswakelas = mysql_query("SELECT * FROM siswa JOIN kelas_siswa ON siswa.NIS = kelas_siswa.NIS WHERE kelas_siswa.ID_KELAS = '$_POST[kelas]'") or die(mysql_error());
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
          while ($u = mysql_fetch_array($siswakelas)) {
          $qabsentoday = mysql_query("SELECT * FROM tbabsen WHERE NIS = '$u[NIS]' AND TglAbsen = CURRENT_DATE() AND SEMESTER = '$smt'") or die(mysql_error());
          $cektoday = mysql_num_rows($qabsentoday);

       ?>
      <tr>
              <td><?= $u['NIS'] ?></td>
              <td><?= $u['NAMA_SISWA'] ?></td>
              <td>
              <?php
                if ($cektoday>0) {
                  $ca = mysql_fetch_array($qabsentoday);
                  $c = $ca['KETERANGAN'];
                  if ($c == "S") {
                    echo "Sakit";
                  }elseif ($c=="I") {
                    echo "Ijin";
                  }elseif ($c=="A") {
                    echo "Alpa";
                  }else{
                  echo "Sudah Hadir";
                }
                }else{
              ?>
              <form method="POST">
                <input type="hidden" name="nis[]" value="<?= $u['NIS'] ?>">
                <select name="absen[]" class="form-control">
                  <option value="H">Hadir</option>
                  <option value="S">Sakit</option>
                  <option value="I">Ijin</option>
                  <option value="A">Alpa</option>
                </select>
              <input type="hidden" name="kelas[]" value="<?= $_POST['kelas'] ?>"
              <?php
                }
              ?>
              </td>
            </tr>
       <?php
          }
        ?>
        </tbody>
    </table>
    <input type="submit" name="go" class="btn btn-primary">
    </form>
<?php
}else{
  $pilihkelas = mysql_query("SELECT kelas.ID_KELAS, kelas.NAMA_KELAS, jurusan.SINGKATAN FROM kelas JOIN jurusan ON kelas.ID_JURUSAN = jurusan.ID_JURUSAN");
?>
<div class="col-md-4">
</div>
<div class="col-md-4">
<form action="" method="post">
  <select class="form-control" name="kelas">
  <option>Pilih Kelas</option>
    <?php
      while ($selekelas = mysql_fetch_array($pilihkelas)) {
        echo "<option value='".$selekelas['ID_KELAS']."'>".$selekelas['NAMA_KELAS']."-".$selekelas['SINGKATAN']."</option>";
      }
    ?>
  </select>
  <input type="submit" value="Pilih" class="btn btn-primary">
</form>
</div>
<div class="col-md-4">
</div>
<?php } ?>