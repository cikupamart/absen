<?php
date_default_timezone_set('Asia/Jakarta');
$ct = date('H:i');

if (!isset($_SESSION['user'])) {
    echo "ANDA MEMASUKI HALAMAN TERLARANG";
}else{
        $akhir=mysql_fetch_array(mysql_query("SELECT max(KD_IZIN) AS akhir FROM izin"));
        $i=$akhir['akhir'];
        $nextnis = substr($i, 2, 3) + 1;
        $KD_IZIN = 'IZN-'.sprintf('%03s', $nextnis);
if (isset($_POST['ok'])) {
    $KD_IZIN        = $_POST['KD_IZIN'];
    $NIS            = $_POST['NIS'];
    $JAM_IZIN       = $_POST['JAM_IZIN'];
    $JAM_KEMBALI    = $_POST['JAM_KEMBALI'];
    $ALASAN         = $_POST['ALASAN'];
    $senjata        = mysql_query("INSERT INTO izin VALUES('$KD_IZIN',
                      $NIS, CURRENT_DATE(), '$JAM_IZIN', '$JAM_KEMBALI'
                      ,'$ALASAN','0','0')") or die(mysql_error());
    if ($senjata) {
        echo "<script>alert('Form Izin berhasil dikirim, silahkan temui guru piket'); window.location='../detail.php?kd=$KD_IZIN';</script>";
    }
}    
?>

<!-- Contact Form - START -->
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="well well-sm">
                <form class="form-horizontal" method="post" action="index.php?page=./izin">
                    <fieldset>
                        <legend class="text-center header">Form Izin</legend>

                        <div class="form-group">
                            <div class="col-md-8">
                                <input id="fname" name="KD_IZIN" type="hidden" class="form-control" readonly="" value="<?= $KD_IZIN ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="lname" name="NIS" value="<?=$y?>" type="number" placeholder="Nomor Induk Siswa" class="form-control" <?= $x ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="JAM_IZIN" type="time" placeholder="Jam Izin" class="form-control" value="<?= $ct ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="phone" name="JAM_KEMBALI" type="time" placeholder="Phone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="message" name="ALASAN" placeholder="Alasan Izin." rows="7"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <input type="submit" name="ok" class="btn btn-primary btn-lg" value="KIRIM">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>