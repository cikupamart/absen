<?php
session_start();
if (isset($_GET['stat'])) {
  include '../../backend/libs/conn.php';
  $PIKET = $_SESSION['id'];
  $kd = $_GET['kd'];
  $query = mysql_query("UPDATE izin SET STATUS = '1', GURU_PIKET='$PIKET' where KD_IZIN = '$kd'");
  if ($query) {
    echo "<script>alert('Izin dengan kode $_GET[kd] , berhasil disetujui !'); window.location='index.php?page=./pending';</script>";
  }
}
?>