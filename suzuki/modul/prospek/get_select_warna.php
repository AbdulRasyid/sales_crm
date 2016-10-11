<?php
	include "../../library/inc.koneksi.php";
?>

<option value="">- Pilih Warna -</option>

<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<option value="<?php echo $row['id_warna']; ?>"><?php echo $row['warna']; ?></option>

<?php } } ?>
