<!DOCTYPE html>
<html>
<head>
  <title></title>
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
</head>
<body>
<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../libs/conn.php';
if (isset($_GET['nis'])){
    
    $row=mysql_fetch_array(mysql_query("SELECT SISWA.*,JURUSAN.* FROM SISWA,JURUSAN WHERE SISWA.ID_JURUSAN=JURUSAN.ID_JURUSAN"));
}

?>

<table width="50%" border="0" align="center">
  <tr>
      <td width="145" colspan="3"><center><img src="../siswa/photo/<?=$row['FOTO'];?>" width="150px" height="150px"></center></td>
  </tr>
  <tr>
      <td><b>NIS</b></td>
      <td><b>:</b></td>
      <td><b><?=$row['NIS'];?></b></td>
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
</table>

<script>
    window.load = print_d();
    function print_d(){
      window.print();
    }
  </script>
  </body>
  </html>