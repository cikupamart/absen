<?php
date_default_timezone_set('Asia/Jakarta');
include '../backend/libs/conn.php';
$kd = $_GET['kd'];
$setq = mysql_query("SELECT * FROM izin JOIN siswa ON siswa.NIS = izin.NIS JOIN jurusan ON siswa.ID_JURUSAN = jurusan.ID_JURUSAN JOIN gpiket ON izin.GURU_PIKET = gpiket.id WHERE izin.KD_IZIN = '$kd'") or die(mysql_error());
$row = mysql_fetch_array($setq);
$jb = $row['JAM_KEMBALI'];
if ($jb >= "15:00:00") {
  $jb = "Pulang";
}

?>
	<link href="../backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../backend/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../backend/assets/css/style.css" rel="stylesheet" />
    <link href="../backend/assets/css/main-style.css" rel="stylesheet" />
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <tr align="center">
      <td rowspan="1"><img src="../backend/assets/img/logo.png" width="100" height="100"></td>
        <td colspan="3"><br/>YAYASAN PENGEMBANGAN SISTEM INFORMASI DAN MANAJEMEN<br/>
        SEKOLAH MENENGAH KEJURUSAN<br/>
        <b>SMK PASIM PLUS</b><br/></td>
      </tr>
  <tr>
      <td width="145" rowspan="9" align="center"><img src="../backend/siswa/photo/<?=$row['FOTO'];?>" width="150px" height="150px"></td>
  </tr>
  <tr>
      <td width="145"><b>NIS</b></td>
      <td width="12"><b>:</b></td>
      <td width="179"><b><?=$row['NIS'];?></b></td>
  </tr>
  <tr>
    <td>Nama Siswa</td>
    <td>:</td>
    <td><?=$row['NAMA_SISWA'];?></td>
  </tr>
  <tr>
    <td>Jam Keluar</td>
    <td>:</td>
    <td><?=$row['JAM_IZIN'];?></td>
  </tr>
  <tr>
    <td>Jam Kembali</td>
    <td>:</td>
    <td><?=$jb;?></td>
</tr>
<tr>
    <td>Tanggal</td>
    <td>:</td>
    <td><?=$row['TANGGAL'];?></td>
  </tr>
  <tr>
    <td>Alasan</td>
    <td>:</td>
    <td><?=$row['ALASAN'];?></td>
  </tr>
  <tr>
    <td>No Telpon</td>
    <td>:</td>
    <td><?=$row['TELP_SISWA'];?></td>
  </tr>
  
 
  <tr>
    <td>Guru Piket</td>
    <td>:</td>
    <td><?=$row['nama'];?></td>
  </tr>
</table>
<br/></br>
<table class="table">
  <tr>
    <td colspan="2" align="left">Mengetahui :</td>
    <td align="right">Sukabumi, <?= date('d-M-Y') ?></td>
  </tr>
  <tr align="center">
    <td>Guru Mata Pelajaran</td>
    <td>Bimbingan Konseling</td>
    <td>Guru Piket</td>
  </tr>
  <tr align="center">
    <td><br/><br/><br/><br/></td>
    <td><br/><br/><br/></td>
    <td><br/><br/><br/><br/></td>
  </tr>
  <tr align="center">
    <td>______________</td>
    <td>______________</td>
    <td>______________</td>
  </tr>
</table>

<script>
    window.load = print_d();
    function print_d(){
      window.print();
    }
</script>