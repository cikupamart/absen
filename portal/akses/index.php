<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='login.php';</script>";
    exit();
}

include '../../backend/libs/conn.php';
$pengaturan = mysql_query("SELECT * FROM pengaturan WHERE id = '1'");
$set = mysql_fetch_array($pengaturan);
$smt = $set['Semester'];
$thajar = $set['THAjar'];
$query_all = mysql_query("SELECT * FROM izin");
$query_approved = mysql_query("SELECT * FROM izin WHERE STATUS = '1'");
$query_hariini = mysql_query("SELECT izin.*, siswa.NAMA_SISWA FROM izin JOIN siswa ON siswa.NIS = izin.NIS WHERE izin.TANGGAL = CURRENT_DATE()") or die(mysql_error());
$jumlah_approved = mysql_num_rows($query_approved);
$jumlah_all = mysql_num_rows($query_all);
$jumlah_pending = $jumlah_all - $jumlah_approved;
$jumlah_hariini = mysql_num_rows($query_hariini);
$row1 = mysql_fetch_array($query_all);
$row2 = mysql_fetch_array($query_approved);
$l = $_SESSION['level'];
$id = $_SESSION['id'];
if ($l == "GPiket") {
    $name = mysql_query("SELECT nama FROM gpiket WHERE id = '$id'") or die(mysql_error());
    $cari = mysql_fetch_array($name);
    $user = $cari['nama'];
}elseif ($l == "Sekretaris"){
    $name = mysql_query("SELECT * FROM sekretaris JOIN kelas ON sekretaris.kelas = kelas.ID_KELAS JOIN jurusan ON kelas.ID_JURUSAN = jurusan.ID_JURUSAN WHERE sekretaris.id = '$id'") or die(mysql_error());
    $cari = mysql_fetch_array($name);
    $user = $cari['nama'];
    $idkelas = $cari['ID_KELAS'];
    $kelas = $cari['NAMA_KELAS'];
    $jrsan = $cari['SINGKATAN'];
    $x = "required";
    $y = "";
}else{
    $name = mysql_query("SELECT NAMA_SISWA FROM siswa WHERE NIS = '$_SESSION[user]'") or die(mysql_error());
    $cari = mysql_fetch_array($name);
    $user = $cari['NAMA_SISWA'];
    $x = "readonly";
    $y = $_SESSION['user'];
}

include_once "../../backend/libs/inc.library.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $l ?> Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="../../backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../../backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../../backend/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../../backend/assets/css/style.css" rel="stylesheet" />
    <link href="../../backend/assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../../backend/libs/tigra_calendar/tcal.css" />
    <script type="text/javascript"> 
window.setTimeout("waktu()",1000); 
function waktu() {
    var tanggal = new Date(); 
    setTimeout("waktu()",1000);
    document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds(); 
 } 

 </script> 
    <script type="text/javascript" src="../../backend/libs/tigra_calendar/tcal.js"></script> 
</head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <font size="8px" color="white">Portal <?= $_SESSION['level']; ?></font>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="?page=./settings/pass"><i class="fa fa-gear fa-fw"></i>Pengaturan</a>
                        </li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Keluar</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-info">
                                <div><strong><?= $user ?></strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;<?= $_SESSION['level'] ?> <?= @$kelas ?> <?= @$jrsan ?>
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <?php
                        @include 'menu.php';
                    ?>
                     
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
<br/><br/>
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <?php 
				if(isset($_GET['page'])){
					$page=$_GET['page'];
					$halaman="$page.php";
					if(!file_exists($halaman) || empty($page)){
						@include "welcome.php";
					}else{
						include "$halaman";
						}			
				}else{
					@include "welcome.php";
					}
			?>
                </div>
                <!--End Page Header -->

            </div>

            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="../../backend/assets/plugins/jquery-1.10.2.js"></script>
    <script src="../../backend/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../../backend/assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../backend/assets/plugins/pace/pace.js"></script>
    <script src="../../backend/assets/scripts/siminta.js"></script>
    <script src="../../backend/assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../../backend/assets/plugins/dataTables/dataTables.bootstrap.js"></script>

<script>
    $("#myAbsen").on("change", function() {
    $("#myform").submit();
    });
</script>

<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
<!-- </body></html> FUCK TELKOM UZONE Ads  -->

</body>
</html>