<?php
	include('libs/conn.php');
       if(isset($_POST['btnHapus'])){
           if($_SERVER['REQUEST_METHOD'] == "POST"){
            $jumlah = count($_POST["item"]); 
            for($i=0; $i < $jumlah; $i++) { 
                $id=$_POST["item"][$i]; 
                mysql_query("DELETE FROM kelas_siswa where NIS='$id';"); 
               
           }
           }
       }
?>
<form method="POST" action="">
        <select name="kelas" class="form-control">

                <?php

                                $ambil=mysql_query("select kelas.*,jurusan.SINGKATAN from kelas,jurusan where kelas.ID_JURUSAN=jurusan.ID_JURUSAN");
                                while($r=mysql_fetch_array($ambil)){

                                echo "<option value=$r[ID_KELAS]>$r[NAMA_KELAS]-$r[SINGKATAN]</option>";
                                }
                        ?>
        </select>
        
        <select name="thn_ajar" class="form-control">

                <?php

                                $ambil=mysql_query("select Distinct(THN_AJAR) from kelas_siswa");
                                while($r=mysql_fetch_array($ambil)){

                                echo "<option value=$r[THN_AJAR]>$r[THN_AJAR]</option>";
                                }
                        ?>
        </select>
        <input type="submit" name="Cari" class="btn btn-primary btn-lg"  value="Tampil" style="width: 70px; height:40px;" /> <input type="button" name="Tambah" class="btn btn-primary btn-lg"  value="+ Data Ke Kelas" onClick="window.location.href='?page=./kelas_siswa/form'" style="width: 150px; height:40px;" />

</form>
<form method="post">
<table  class="table table-striped table-bordered table-hover" id="dataTables-example">
  <tr>
    <th scope="col" width="50%">NIS</th>
    <th scope="col" width="50%">Nama Siswa</th>
    <th scope="col" width="30%">Jenis Kel.</th>
    <th scope="col" width="50%">Gambar</th>
    <th scope="col">Aksi Hapus</th>
  </tr>
  
 <?php
         if(isset($_POST['Cari'])){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $kelas=$_POST['kelas'];
                    
                    $thn=$_POST['thn_ajar'];
                    $ambil=mysql_query("SELECT kelas_siswa.NIS,siswa.NAMA_SISWA,siswa.JK_SISWA,
                            siswa.FOTO from kelas_siswa,siswa,kelas where kelas_siswa.nis=siswa.nis 
                            and kelas_siswa.ID_KELAS='$kelas' and kelas_siswa.THN_AJAR='$thn' 
                            and kelas_siswa.ID_KELAS=kelas.ID_KELAS");
                    $cek=mysql_num_rows($ambil);
                    if($cek>0){
                            while($r=mysql_fetch_array($ambil)){
                                    if ($r['JK_SISWA']=='L')
                                {
                                      $a = '<img src="images/man.png" width="20" height="20" align="center" title="Laki - Laki"/>'; 
                                }else{
                                            $a = '<img src="images/woman.png" width="20" height="20" align="center" title="Perempuan" />';
                                    }
                                    echo "<tr><td>$r[NIS]</td>
                                                      <td>$r[NAMA_SISWA]</td>
                                                      <td>$a</td>
                                                      <td><img src='siswa/photo/$r[FOTO]' height='70px' width='70px'></td>
                                                      <td><input type='checkbox' name='item[]' nim='item[]' value='$r[NIS]'></td>
                                              </tr>";
		}
	}else{
		echo "<tr><td colspan=6>Data Masih Kosong</td></tr>";}
                }
        }
 	echo '</table><p align="center"><input name="btnHapus" type="submit" value="Delete" class="button"></p>'
 ?>
</form>


