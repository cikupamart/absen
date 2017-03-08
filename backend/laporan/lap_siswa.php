

<html>
<head>
	<title>Print Laporan Siswa</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   
     <style type="text/css">
  body{background:#efefef;font-family:arial;}
  #wrapshopcart{width:70%;margin:3em auto;padding:30px;background:#fff;box-shadow:0 0 15px #ddd;}
  h1{margin:0;padding:0;font-size:2.5em;font-weight:bold;}
  p{font-size:1em;margin:0;}
  table{margin:2em 0 0 0; border:1px solid #eee;width:100%; border-collapse: separate;border-spacing:0;}
  table th{background:#fafafa; border:none; padding:20px ; font-weight:normal;text-align:left;}
  table td{background:#fff; border:none; padding:12px  20px; font-weight:normal;text-align:left; border-top:1px solid #eee;}
  table tr.total td{font-size:1.5em;}
  .btnsubmit{display:inline-block;padding:10px;border:1px solid #ddd;background:#eee;color:#000;text-decoration:none;margin:2em 0;}
  form{margin:2em 0 0 0;}
  label{display:inline-block;width:auto;}
  input[type=text]{border:1px solid #bbb;padding:10px;width:30em;}
  textarea{border:1px solid #bbb;padding:10px;width:30em;height:5em;vertical-align:text-top;margin:0.3em 0 0 0;}
  .submitbtn{font-size:1.5em;display:inline-block;padding:10px;border:1px solid #ddd;background:#eee;color:#000;text-decoration:none;margin:0.5em 0 0 8em;};
  
  </style>

<link href='../assets/img/dok.png' rel='icon' type='image/gif'/>
   <?php 
	include('../libs/conn.php');
	?>
	<?php
        if(isset($_GET['id'])){
           		if($_GET['id']==""){
           			$filterSql = ""; 
           		}else{$filterSql = "AND THN_MASUK='$_GET[id]'"; }
            
        }else{
                $filterSql = ""; 
             }
       
?>
<body>
 <div id="wrapshopcart">
<center><p align='center'><h2>Laporan Data Siswa</h2></p>
<?php 
$query=mysql_query("SELECT siswa.*,jurusan.SINGKATAN FROM SISWA,JURUSAN where siswa.ID_JURUSAN=jurusan.ID_JURUSAN $filterSql");
		echo "<table border='1' class='pure-table'>
			<thead>
			<tr>
				<th>No</th>
				<th>Nis</th>
			    <th>Nama Siswa</th>
			    <th>Jenis Kelamin</th>
			    <th>Jurusan</th>
				<th>Photo</th>
			</tr>
			</thead>
			<tbody>
				";
			$i=0;
	while($r=mysql_fetch_array($query))
	{
		$i++;
		
			echo "<tr><td>$i</td><td>$r[NIS]</td>
					  <td>$r[NAMA_SISWA]</td>
					  <td>$r[JK_SISWA]</td>
					  <td>$r[SINGKATAN]</td>
					  <td><img src='../siswa/photo/$r[FOTO]' width='50px' height='50px'></td>
					  
				  </tr>";
	}
		echo "</tbody></table>";
?>
<h5>Jumlah Data:<?=mysql_num_rows($query)?></h5>
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
	</div>
</body>
</html>