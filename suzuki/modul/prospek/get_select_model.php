<?php
	include "../../library/inc.koneksi.php";
?>

<option value="">- Pilih Tipe/Model -</option>

<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan=$id AND discontinue_flag = 0");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<option value="<?php echo $row['id_tipe_kendaraan']; ?>"><?php echo $row['tipe']; ?></option>

<?php } } ?>
