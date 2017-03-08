<?php
include "libs/conn.php";

session_start();

//untuk tanggal log
$waktu=date("Y-m-d H:i:s");

if(isset($_POST['username'])){

$username1=strtoupper($_POST['username']);
$password1=MD5($_POST['password']);
$username=addslashes($username1);
$password=addslashes($password1);
$level=$_POST['level'];
	
	if ($level=="Admin"){
               
		$login=mysql_query("select * from admin where USERNAME='$username' and PASSWORD='$password'");
	
                $cek_login=mysql_num_rows($login);
        }
        else if ($level=="Guru"){
         
		$login=mysql_query("select * from guru_mp where USERNAME_GURU='$username' and PASSWORD_GURU='$password'") or die(mysql_error());
	
                $cek_login=mysql_num_rows($login);
        }
        else if ($level=="Siswa"){
		$login=mysql_query("select * from siswa where USERNAME_SISWA='$username' and PASSWORD_SISWA='$password'");
	
                $cek_login=mysql_num_rows($login);
        }else{
            echo "level tidak terdaftar";
        }
	
	
	

	if (empty($cek_login))
	{
		?><script language="javascript">alert('Anda Gagal Login');
			document.location.href="index.php";</script><?php 
	}else{
		
	   
	    while ($rows=mysql_fetch_array($login))
		{
		     if($_POST['level']=="Admin"){
				 $idUser='Admin';
				$UserName=$rows['USERNAME'];
				$UserLevel='Admin';
				$UserPassword=$rows['PASSWORD'];
			}else if($_POST['level']=="Guru"){
				$idUser=$rows['ID_GURU'];
				$UserName=$rows['USERNAME_GURU'];
				$UserPassword=$rows['PASSWORD_GURU'];
				$UserLevel='Guru';
			}else if($_POST['level']=="Siswa"){
				$idUser=$rows['NIS'];
				$UserName=$rows['USERNAME_SISWA'];
				$UserPassword=$rows['PASSWORD_SISWA'];
				$UserLevel='Siswa';
			} 
			 
			$_SESSION['idUser']=$idUser;
			$_SESSION['UserName']=$UserName;
			$_SESSION['UserLevel']=$UserLevel;
			$_SESSION['UserPassword']=$UserPassword;
		}
		
	     

		?><script language="javascript">alert('Anda Login Sebagai <?php echo $UserLevel ?>, Selamat Bekerja');
			document.location.href="home.php";</script><?php 
	}

}else{
	unset($_POST['username']);
}
?>