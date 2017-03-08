<?php
$id = $_SESSION['id'];
$row=mysql_fetch_array(mysql_query("SELECT SISWA.*,JURUSAN.* FROM SISWA,JURUSAN WHERE SISWA.ID_JURUSAN=JURUSAN.ID_JURUSAN AND SISWA.NIS = '$id'")) or die(mysql_error());
?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
      <td width="145" colspan="3" align="center"><img src="../../backend/siswa/photo/<?=$row['FOTO'];?>" width="150px" height="150px"></td>
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
    <td>Tempat Tanggal Lahir</td>
    <td>:</td>
    <td><?=$row['TEMPAT_LAHIR'].', '.$row['TGL_LAHIR'];?></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td><?=$row['JK_SISWA'];?></td>
</tr>
<tr>
    <td>Agama</td>
    <td>:</td>
    <td><?=$row['AGAMA_SISWA'];?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><?=$row['ALAMAT_SISWA'];?></td>
  </tr>
  <tr>
    <td>Telpon</td>
    <td>:</td>
    <td><?=$row['TELP_SISWA'];?></td>
  </tr>
  
 
  <tr>
    <td>Jurusan</td>
    <td>:</td>
    <td><?=$row['NAMA_JURUSAN'];?></td>
  </tr>
  <tr>
    <td colspan="3" align="center">
     <a href="cetak.php?id=<?= $id ?>"><img src='../../backend/images/print.jpg' style='width:50px; height:50px;'></a></td>
    </tr>
  </table>