<?php
	include "../../library/inc.koneksi.php";
?>

	<label class="control-label">Pilih Surveyor</label>
	<select class="form-control" name="id_surveyor">

	<option value="">- Pilih Surveyor -</option>
	<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_leasing_surveyor WHERE id_cabang=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
	<option value="<?php echo $row['id_surveyor']; ?>"><?php echo $row['surveyor']; ?></option>

	<?php } } ?>

	</select>