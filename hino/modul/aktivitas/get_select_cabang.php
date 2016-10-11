<?php
	include "../../library/inc.koneksi.php";
?>

<option value="">- Pilih Cabang -</option>

<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_leasing a JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan WHERE id_perusahaan=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<option value="<?php echo $row['id_cabang']; ?>"><?php echo $row['kota_perusahaan']; ?></option>

<?php } } ?>
