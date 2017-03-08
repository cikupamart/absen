<script>
    function konfirmasicetak(indeks){
    
    idnya = indeks;
    tanya = confirm("Cetak Data SISWA Dengan NIS "+idnya+" ?");
    if(tanya == 1){
        window.open('pdf/siswa-det.php?&nis='+idnya, '_blank');
    }else{
		window.location.href="home.php?page=./laporan/view-siswa";
		}
}
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include('libs/conn.php');
if (isset($_GET['idwali'])){
		$qwerty = mysql_query("SELECT siswa.*,jurusan.* FROM siswa,jurusan WHERE siswa.ID_JURUSAN=jurusan.ID_JURUSAN AND siswa.NIS = '$_GET[idwali]'") or die(mysql_error());
		$row=mysql_fetch_array($qwerty);
}
?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
      <td width="145" colspan="3" align="center"><img src="siswa/photo/<?=$row['FOTO'];?>" width="150px" height="150px"></td>
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
     
      
      <?php echo "<input type='image' src='images/print.jpg' style='width:50px; height:50px;' align='middle' title='Cetak Data Siswa' value='$row[NIS]' name='cetak' id='cetak' onclick='konfirmasicetak($row[NIS])'>";?></td>
    </tr>
</table>

