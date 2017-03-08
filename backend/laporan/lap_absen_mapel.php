<?php
if ($_GET['print'] == "Y") {
  echo "
    <script>
    window.load = print_d();
    function print_d(){
      window.print();
    }
  </script>
  ";
}else{
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=laporan-absen.xls");
}
	include('../libs/conn.php');
 
?>

<html>
<head>
	<title>Print Laporan Absen</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   
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
  <body>
 <div id="wrapshopcart">
<center><p align='center'><h2>Laporan Absensi Siswa</h2></p>
<table width="100%" border="0">
  <tr>
    <th scope="col">No</th>
    <th scope="col">Tanggal Absen</th>
    <th scope="col">Nis</th>
    <th scope="col">Nama Siswa</th>
    <th scope="col">Keterangan</th>
  </tr>
  
 <?php
	
        $tawal = date('Y-m-d', strtotime($_GET['Tawal']));
        $takhir = date('Y-m-d', strtotime($_GET['Takhir']));
	
	// SQL Jika tombol Tampil diklik
	$SqlPeriode = " absensi.TANGGAL BETWEEN '".($tawal)."' AND '".($takhir)."'";

 	$tampil=  mysql_query("SELECT absensi.NIS,absensi.KETERANGAN,absensi.TANGGAL,siswa.NAMA_SISWA,
                    mata_pelajaran.NAMA_MP,kelas.NAMA_KELAS,jurusan.NAMA_JURUSAN
                    from absensi,siswa,mata_pelajaran,kelas,kelas_siswa,jurusan
                    where absensi.NIS=siswa.NIS
                    and absensi.ID_MP=mata_pelajaran.ID_MP
                    and siswa.NIS=kelas_siswa.NIS
                    and kelas_siswa.ID_KELAS=kelas.ID_KELAS
                    and kelas.ID_JURUSAN=jurusan.ID_JURUSAN 
                    AND absensi.ID_MP='$_GET[mp]'
                    AND kelas.ID_KELAS='$_GET[Kelas]'
                    AND
                    $SqlPeriode ORDER BY siswa.NIS DESC") or die(mysql_error());
        $nomor = 0;
        while($r=  mysql_fetch_array($tampil)){
            $nomor++;
        ?>
  <tr>
   	<td><?php echo $nomor; ?></td>
   	<td><?php echo$r['TANGGAL']; ?></td>
   	<td><?php echo$r['NIS']; ?></td>
   	<td><?php echo$r['NAMA_SISWA']; ?></td>
   	<td><?php echo$r['KETERANGAN']; ?></td>
   </tr>
            <?php
        }
 ?>
</table>
</body>
</html>
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>