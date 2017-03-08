<?php
	include('libs/conn.php');
	$id=$_POST['idwali'];
	$nama=ucwords($_POST['nama']);
	$tgl=ucwords($_POST['tgl']);
	$alamat=ucwords($_POST['alamat']);
	$telp=ucwords($_POST['telp']);
	$jk=ucwords($_POST['jk']);
	$tempat=ucwords($_POST['tempat']);
	$wali=ucwords($_POST['wali']);
	$pas=MD5($_POST['idwali']);
	$stat=$_POST['ket'];
	$jurusan=$_POST['jurusan'];
        $thn_msk=$_POST['thn_msk'];
        $thn2=$thn_msk."/".$thn_msk+1;
	$agama=$_POST['agama'];
	$nama_photo    = $_FILES['photo']['name'];
	$type 	     = $_FILES['photo']['type'];
	$ukuran	     = $_FILES['photo']['size'];
	$today 		 = date("Y-m-d H:i:s");
	if($stat=="N"){
			if (isset($_FILES['photo']['name'])){
						if($type != "image/gif"  &&  $type != "image/jpg"  && $type != "image/jpeg") {
							?> <script type=""  language='javascript'>alert('Format Gambar Harus .jpg / .jpeg / .gif !');
							history.go(-1)</script>
							<?php
							$query = '';
						}else{
							if($ukuran>1000000){
								?> <script type=""  language='javascript'>alert('File Yang Di Izinkan Hanya Berukuran Kurang Dari 1MB!! Silahkan Ulangi !');
								history.go(-1)</script>
								<?php
							}else{
				
							  
							  $uploaddir='siswa/photo/';
							  $rnd=date("His");				
							  $nama_file_upload=$rnd.'-'.$nama_photo;
							  $alamatfile=$uploaddir.$nama_file_upload;
							  $nis=mysql_num_rows(mysql_query("select NIS from siswa where NIS='$id'"));
								if($nis > 0){
									echo "<script type=''  language='javascript'>alert('DATA NIS sudah ada');
														history.go(-1);</script>";
								}else{
									if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile)){ 
											$masuk=mysql_query("INSERT INTO siswa(`NIS`, `ID_WALI`, `NAMA_SISWA`,
											`JK_SISWA`, `AGAMA_SISWA`, `TGL_LAHIR`,
											`TELP_SISWA`, `ALAMAT_SISWA`, `FOTO`, `USERNAME_SISWA`, `PASSWORD_SISWA`,`TEMPAT_LAHIR`,`ID_JURUSAN`,`THN_MASUK`)
																VALUES('$id','$wali','$nama','$jk','$agama','$tgl','$telp',
																'$alamat','$nama_file_upload','$id',md5('$tgl'),'$tempat','$jurusan','$thn_msk')")or die(mysql_error());
                                                                                        
											
									if($masuk){
											echo "<script type=''  language='javascript'>alert('DATA SISWA BERHASIL DITAMBAHKAN');
                                                                                        window.location.href='?page=./siswa/view';</script>";
											}else{
												echo "<script type=''  language='javascript'>alert('DATA SISWA GAGAL DITAMBAHKAN');
														history.go(-1)</script>";
											}
									}
								}
								
							}
						}
			}
        }
	else{
		$photo_lama = $_POST['lama'];
								if(empty($_FILES['photo']['name'])){
									$nama_file_upload=$photo_lama;
                                                                        $query = mysql_query("UPDATE siswa SET NAMA_SISWA='$nama', 
														TGL_LAHIR='$tgl', 
														ALAMAT_SISWA='$alamat', 
														JK_SISWA='$jk',
														AGAMA_SISWA='$agama',
														TEMPAT_LAHIR='$tempat',
														TELP_SISWA='$telp',
														ID_WALI='$wali', 
														ID_JURUSAN='$jurusan', 
														FOTO='$nama_file_upload' WHERE nis='$id'");
										if($query){
                                                                                        echo "<script type=''  language='javascript'>alert('DATA SISWA BERHASIL DIRUBAH');
                                                                                                window.location.href='?page=./siswa/view';</script>";
												
											}else{
												echo "<script type=''  language='javascript'>alert('DATA SISWA GAGAL DIRUBAH');
														history.go(-1)</script>";
											}
									
								  }else{
										if($type != "image/gif"  &&  $type != "image/jpg"  && $type != "image/jpeg") {
										?> <script type=""  language='javascript'>alert('Format Gambar Harus .jpg / .jpeg / .gif !');
											history.go(-1)</script>
										<?php
										$query = '';
										}else{
										if($ukuran>1000000){
											?> <script type=""  language='javascript'>alert('File Yang Di Izinkan Hanya Berukuran Kurang Dari 1MB!! Silahkan Ulangi !');
											history.go(-1)</script>
											<?php
										}else{
											$uploaddir='siswa/photo/';
										$rnd=date("His");				
										$nama_file_upload=$rnd.'-'.$nama_photo;
										$alamatfile=$uploaddir.$nama_file_upload;
										unlink('siswa/photo/'.$photo_lama);
										$upload=move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile);
										$query = mysql_query("UPDATE siswa SET NAMA_SISWA='$nama', 
														TGL_LAHIR='$tgl', 
														ALAMAT_SISWA='$alamat', 
														JK_SISWA='$jk',
														AGAMA_SISWA='$agama',
														TEMPAT_LAHIR='$tempat',
														TELP_SISWA='$telp',
														ID_WALI='$wali', 
														ID_JURUSAN='$jurusan', 
                                                                                                                THN_MASUK='$thn_msk',
														FOTO='$nama_file_upload' WHERE nis='$id'");
										if($query){
                                                                                    $edit_kelas=mysql_query("UPDATE kelas_siswa SET ID_KELAS='$kelas' THN_AJAR='$thn2' WHERE nis='$nis'");
												if($edit_kelas){
                                                                                                echo "<script type=''  language='javascript'>alert('DATA SISWA BERHASIL DIRUBAH');
                                                                                                window.location.href='?page=./siswa/view';</script>";}
											}else{
												echo "<script type=''  language='javascript'>alert('DATA SISWA GAGAL DIRUBAH');
														history.go(-1)</script>";
											}
										
								  }
							}
	
	}
	}
?>