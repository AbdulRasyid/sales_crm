<?php
	include "../../library/inc.koneksi.php";
?>


<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<option value="<?php echo $row['id_tipe_kendaraan']; ?>"><?php echo $row['tipe']; ?></option>

<?php } } ?>
