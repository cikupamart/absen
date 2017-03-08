<?php
include '../backend/libs/conn.php';
$kd = $_GET['kd'];
$setq = mysql_query("SELECT * FROM izin JOIN siswa ON siswa.NIS = izin.NIS JOIN jurusan ON siswa.ID_JURUSAN = jurusan.ID_JURUSAN WHERE izin.KD_IZIN = '$kd'") or die(mysql_error());
$row = mysql_fetch_array($setq);

?>
	<link href="../backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../backend/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../backend/assets/css/style.css" rel="stylesheet" />
    <link href="../backend/assets/css/main-style.css" rel="stylesheet" />
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
      <td width="145" colspan="3" align="center"><img src="../backend/siswa/photo/<?=$row['FOTO'];?>" width="150px" height="150px"></td>
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
    <td><?=$row['JAM_KEMBALI'];?></td>
</tr>
<tr>
    <td>Tanggal</td>
    <td>:</td>
    <td><?= date('d-m-Y', strtotime($row['TANGGAL']));?></td>
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
    <td>Status</td>
    <td>:</td>
    <td>
      <?php
        if ($row['STATUS'] == 0) {
          echo "<font color='red'>BELUM DISETUJUI</font>";
        }else{
          echo "<font color='green'>TELAH DISETUJUI</font>";
        }
      ?>
    </td>
  </tr>
</table>