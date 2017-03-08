
<div class="row">
                <!--quick info section -->
                <div class="col-lg-3">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-calendar fa-3x"></i>&nbsp;<b><?=$jumlah_pending?> </b>Permintaan izin tertunda

                    </div>
                </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
               	<th>Kode Izin</th>
               	<th>Tanggal</th>
               	<th>Nama Siswa</th>
               	<th>Jam Izin</th>
               	<th>Jam Kembali</th>
               	<th>Alasan</th>
               	<th>Status</th>
           	</tr>
       	</thead>
       	<tbody>
       	<?php
       		while($row3 = mysql_fetch_array($query_hariini)){
       	?>
            <tr>
            	<td><?=$row3['KD_IZIN']?></td>
             	<td><?=$row3['TANGGAL']?></td>
             	<td><?=$row3['NAMA_SISWA']?></td>
             	<td><?=$row3['JAM_IZIN']?></td>
             	<td><?=$row3['JAM_KEMBALI']?></td>
             	<td><?=$row3['ALASAN']?></td>
             	<td>
             		<?php
             			if ($row3['STATUS'] == "0") {
             		?>
             		<button onclick="window.location='ok.php?stat=1&kd=<?=$row3['KD_IZIN']?>';" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                    <button onclick="window.location='ok.php?stat=0&kd=<?=$row3['KD_IZIN']?>'" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>
             		<?php
             			}else{
             		?>
                  <a href="../cetak.php?kd=<?=$row3['KD_IZIN']?>" target="blank_"><img src="../../backend/images/print.jpg" width="50" height="50" ></a>
             		<?php
             			}
             		?>
             	</td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
</div>