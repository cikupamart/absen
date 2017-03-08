<?php
if (isset($_POST['ok'])) {
    include '../../backend/libs/conn.php';
    $user = strtoupper($_POST['user']);
    $pass = md5($_POST['password']);
    if ($_POST['jabatan'] == "GPiket") {
        # code...
        $query = mysql_query("SELECT * FROM gpiket WHERE username = '$user' AND password = '$pass' AND status = '1'") or die(mysql_error());
        $r = mysql_fetch_array($query);
        $nama = $r['id'];
    }elseif ($_POST['jabatan'] == "Sekretaris"){
        $query = mysql_query("SELECT * FROM sekretaris WHERE username = '$user' AND password = '$pass' AND status = '1'") or die(mysql_error());
        $r = mysql_fetch_array($query);
        $nama = $r['id'];
    }elseif ($_POST['jabatan'] == "Walas") {
        # code...
    }else{
        $query = mysql_query("SELECT * FROM siswa WHERE USERNAME_SISWA = '$user' AND PASSWORD_SISWA = '$pass'") or die(mysql_error());
        $r = mysql_fetch_array($query);
        $nama = $r['NIS'];
    }
    $cek = mysql_num_rows($query);
    
    if ($cek == 1) {
        session_start();
        $_SESSION['id'] = $nama;
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        $_SESSION['level'] = $_POST['jabatan'];

        echo "<script>alert('Selamat datang $user !'); window.location='index.php';</script>";
    }else{
        echo "<script>alert('Username / Password Salah, Silahkan coba lagi.'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal SMK Pasim Plus</title>
    <!-- Core CSS - Include with every page -->
    <link href="../../backend/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="../../backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../../backend/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="../../backend/assets/css/style.css" rel="stylesheet" />
    <link href="../../backend/assets/css/main-style.css" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <img src="../../backend/assets/img/logo.png" alt="SMK PASIM PLUS" width="150" height="150" />
                </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Masuk</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nama Pengguna" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Kata Sandi" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="jabatan">
                                        <option value="GPiket">Guru Piket</option>
                                        <option value="Sekretaris">Sekretaris</option>
                                        <option value="Siswa">Siswa</option>
                                    </select>
                                </div>
                                 <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="ok" class="btn btn-lg btn-success btn-block" value="Masuk">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="../../backend/assets/plugins/jquery-1.10.2.js"></script>
    <script src="../../backend/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../../backend/assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<!-- </body></html> FUCK TELKOM UZONE Ads  -->

</body>

</html>
