<?php
include '../../backend/libs/conn.php';
$kelas = $_GET['kelas'];
$pengaturan = mysql_query("SELECT * FROM pengaturan WHERE id = '1'");
$set = mysql_fetch_array($pengaturan);
$smt = $set['Semester'];
$thajar = $set['THAjar'];
$wer = mysql_query("SELECT * FROM kelas JOIN jurusan ON jurusan.ID_JURUSAN = kelas.ID_JURUSAN WHERE kelas.ID_KELAS = '$kelas'") or die(mysql_error());
$r = mysql_fetch_array($wer);
?>

<html>
<head>
	<title>Print Laporan Izin</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../../backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
     <style type="text/css">
  body{background:#efefef;font-family:arial;}
  #wrapshopcart{width:70%;margin:3em auto;padding:30px;background:#fff;box-shadow:0 0 15px #ddd;}
  h1{margin:0;padding:0;font-size:2.5em;font-weight:bold;}
  p{font-size:1em;margin:0;}
  table{margin:2em 0 0 0; border:1px solid #eee;width:100%; border-collapse: separate;border-spacing:0;}
  table th{background:#fafafa; border:none; padding:20px ; font-weight:normal;text-align:left;}
  table td{background:#fff; border:none; padding:12px  20px; font-weight:normal;text-align:left; border-top:1px solid #eee;}
  table tr.total td{font-size:1.5em;}
  .btnsubmit{display:inline-block;padding:10px;border:1px solid #ddd;background:#eee;color:#000;text-decoration:none;margin:2em 0;}
  form{margin:2em 0 0 0;}
  label{display:inline-block;width:auto;}
  input[type=text]{border:1px solid #bbb;padding:10px;width:30em;}
  textarea{border:1px solid #bbb;padding:10px;width:30em;height:5em;vertical-align:text-top;margin:0.3em 0 0 0;}
  .submitbtn{font-size:1.5em;display:inline-block;padding:10px;border:1px solid #ddd;background:#eee;color:#000;text-decoration:none;margin:0.5em 0 0 8em;};
  
  </style>

<link href='../../backend/assets/img/dok.png' rel='icon' type='image/gif'/>
<body>
 <div id="wrapshopcart">
<center><p align='center'><h2>Laporan Data Izin<br/> Kelas <?= $r['NAMA_KELAS'] .'-'. $r['NAMA_JURUSAN']?> <br/> Tahun Ajaran <?= $thajar ?></h2></p>
<?php 
	$query = mysql_query("SELECT * FROM izin
  JOIN siswa ON izin.NIS = siswa.NIS
  JOIN kelas_siswa ON kelas_siswa.NIS = siswa.NIS
  JOIN kelas ON kelas.ID_KELAS = kelas_siswa.ID_KELAS
  JOIN jurusan ON kelas.ID_JURUSAN = jurusan.ID_JURUSAN
  WHERE kelas.ID_KELAS = '$kelas' ORDER BY izin.TANGGAL DESC") or die(mysql_error());

?>

	<table border='1' class='pure-table'>
		<tr>
               	<th>Kode Izin</th>
               	<th>Tanggal</th>
               	<th>Nama Siswa</th>
               	<th>Jam Izin</th>
               	<th>Jam Kembali</th>
               	<th>Alasan</th>
               	<th>Status</th>
		</tr>
		<?php while($r = mysql_fetch_array($query)){ ?>
		<tr>
			<td><?=$r['NIS'];?></td>
			<td><?=$r['TANGGAL'];?></td>
			<td><?=$r['NAMA_SISWA'];?></td>
			<td><?=$r['JAM_IZIN'];?></td>
			<td><?=$r['JAM_KEMBALI'];?></td>
			<td><?=$r['ALASAN'];?></td>
			<td><?php if ($r['STATUS'] == 0) {
          echo "<font color='red'>BELUM DISETUJUI</font>";
        }else{
          echo "<font color='green'>TELAH DISETUJUI</font>";
        } ?></td>
		</tr>
		<?php } ?>
    <tr>
      <td colspan="7">  <a href="lapkel-cetak.php?kelas=<?= $kelas ?>" class="btn btn-primary">Print</a> <a href="lapkel-export.php?kelas=<?=$kelas?>" class="btn btn-primary">Export to Excel</a>
</td>
    </tr>
	</table>
	</div>
</body>
</html>