
<?php
	include('libs/conn.php');
	$pengaturan = mysql_query("SELECT * FROM pengaturan WHERE id ='1'");
	$set = mysql_fetch_array($pengaturan);

?>
<H1>PENGATURAN WEBSITE</H1>
<form method="post" action="?page=./settings/save">
<input name="ket" value="<?php echo $stat ?>" type="hidden" size="30" />
<table class="table table-striped table-bordered table-hover">
  <tr>
    <td width="145">Judul Website</td>
    <td width="12">:</td>
    <td width="179"><input name="Judul" type="text" id="Judul" class="form-control" value="<?=$set['Judul'];?>"/></td>
  </tr>
  <tr>
    <td>Semester</td>
    <td>:</td>
    <td><select name="Semester" class="form-control">
    	<option value="<?=$set['Semester']?>"><?=$set['Semester']?></option>
    	<option value="1">1</option>
    	<option value="2">2</option>
    	</select></td>
  </tr>
  <tr>
    <td>Tahun Ajaran</td>
    <td>:</td>
    <td><select name="THN_AJAR" class="form-control">
      
      <?php
    $x=date('Y');
      for($i=$x;$i>=2000;$i--){
        $i2 = $i+1;
                            echo "<option value='$i/$i2'>$i/$i2</option>";
                        }
    ?>
      </select>
        </td>
  </tr>
  <tr>
    <td width="145">Footer</td>
    <td width="12">:</td>
    <td width="179"><input name="Footer" type="text" class="form-control" id="Footer" value="<?=$set['Footer']?>"/></td>
  </tr>  
  <tr>
    <td colspan="3"><input type="submit" name="Save" id="Save" value="UBAH" class="button"/>
      <input type="button" name="Save2" id="Save2" value="Cancel" onclick="history.go(-1);" class="button"/></td>
  </tr>
</table>
</form>
