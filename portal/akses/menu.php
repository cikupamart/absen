<li class="">
    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Beranda</a>
</li>

<?php
if ($_SESSION['level'] == "GPiket") {
?>
<li class="">
    <a href="index.php?page=./pending"><i class="fa fa-dashboard fa-fw"></i>Pending Izin</a>
    <a href="index.php?page=./sekre/absensi"><i class="fa fa-dashboard fa-fw"></i>Absen</a>
    <a href="index.php?page=./sekre/terlambat"><i class="fa fa-dashboard fa-fw"></i>Terlambat</a>

</li>
<li>
    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Laporan<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="index.php?page=./laporan">Laporan Izin</a>
            <li><a href="?page=../../backend/laporan/view-absen-siswa">Laporan Absensi Harian</a></li>
        </li>
    </ul>
        <!-- second-level-items -->
</li>
<?php
}elseif ($_SESSION['level'] == "Sekretaris") {
?>
<li class="">
    <a href="index.php?page=./izin"><i class="fa fa-dashboard fa-fw"></i>Pengajuan Izin</a>
    <a href="index.php?page=./sekre/absensi"><i class="fa fa-dashboard fa-fw"></i>Absensi Kelas</a>
</li>
<?php
}elseif ($_SESSION['level'] == "Walas"){
    
}else{
?>
<li>
        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Data<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="?page=./siswa/bio">Biodata Saya</a></li>
            <li><a href="?page=./siswa/absen">Data Absen</a></li> 
        </ul>
                        <!-- second-level-items -->
    </li>
<li class="">
    <a href="index.php?page=./izin"><i class="fa fa-dashboard fa-fw"></i>Izin</a>
</li>
<?php	
}
?>