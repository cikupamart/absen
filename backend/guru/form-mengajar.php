<?php

include('libs/conn.php');
unset($_SESSION['ID_GURU'])
?>
<form method="post" action="?page=./guru/save-mengajar">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
     <tr>
    <td>Pilih Guru</td>
    <td>:</td>
    <td><select name="guru" class="form-control">
    	
    	<?php
		
			$ambil=mysql_query("select * from guru_mp");
			while($r=mysql_fetch_array($ambil)){
			echo "<option value='$r[ID_GURU]''>$r[ID_GURU] -- $r[NAMA_GURU]</option>";
			}
		?>
    	</select></td>
  </tr>
   <tr>
    <td>Tahun Ajar</td>
    <td>:</td>
    <td><select name="thn1" class="form-control">
    	
    	<?php
		
			$x=date('Y');
			for($i=$x;$i>=2000;$i--){
                            echo "<option value='$i'>$i</option>";
                        }
		?>
    	</select>
    <select name="thn2" class="form-control">
    	
    	<?php
		
			$x=date('Y');
			for($i=$x+1;$i>=2000;$i--){
                            echo "<option value='$i'>$i</option>";
                        }
		?>
    	</select></td>
  </tr>
  <tr>
    <td>Semester</td>
    <td>:</td>
    <td>
      <select name="smt" class="form-control">
        <option value="1">Ganjil</option>
        <option value="2">Genap</option>
      </select>
    </td>
  </tr>
  <tr>
      <td colspan="3"><input type="submit" name="pilih" id="Save" value="Pilih" class="button"/>
          <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="button"/>
      </td>
  </tr>
</table>
</form>
