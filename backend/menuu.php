<?php 
if (isset($_SESSION['idUser']))
  {
  	$UserLevel=$_SESSION['UserLevel'];
?>

 <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <img src="assets/img/user.jpg" alt="">
                            </div>
                            <div class="user-info">
                                <div><?php echo $user ?></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Aktif
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    
                    <li>
                        <a href="?page=welcomee"><i class="fa fa-dashboard fa-fw"></i>Beranda</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Data Utama<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if ($UserLevel == "Admin"){ ?>
							<li><a href="?page=./guru/view">Guru</a></li>
                            <li><a href="?page=./piket/view">Piket</a></li>
							<li><a href="?page=./siswa/view">Siswa</a></li>
							<li><a href="?page=./kelas/view">Kelas</a></li>
                            <li><a href="?page=./sekretaris/view">Sekretaris Kelas</a></li>
							<li><a href="?page=./jurusan/view">Jurusan</a></li>
							<li><a href="?page=./mata_pelajaran/view">Mata Pelajaran</a></li>
							<li><a href="?page=./kelas_siswa/view">Kelas Siswa</a></li>
							<?php } ?> 
                        </ul>
                        <!-- second-level-items -->
                    </li>
					<?php if ($UserLevel == "Guru"){ ?>
					<li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Absensi<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                           	<li><a href="?page=./absensi/form">Absensi Mata Pelajaran</a></li>
							<li><a href="?page=./absensi/view">Laporan Absensi Harian</a></li>
                        </ul>
                        <!-- second-level-items -->
                    </li>
					<li>
                        <a href="?page=./guru/detail-mengajar">History Mengajar</a>
                    </li>
					<?php } ?>
					<?php if ($UserLevel == "Admin"){ ?>
                     <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
							<li><a href="?page=./laporan/view-siswa">Laporan Data Siswa</a></li>
							<li><a href="?page=./laporan/view-kelas">Laporan Kelas Siswa</a></li>
							<li><a href="?page=./laporan/view-guru">Laporan Data Guru</a></li>
							<li><a href="?page=./laporan/view-mp">Laporan Data Mata Pelajaran</a></li>
							<li><a href="?page=./laporan/view-absen">Laporan Absensi Mapel</a></li>
							<li><a href="?page=./laporan/view-absen-siswa">Laporan Absensi Siswa</a></li>
							<?php } ?> 
                        </ul>
                        <!-- second-level-items -->
                    </li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        <?php
		}
		?>

