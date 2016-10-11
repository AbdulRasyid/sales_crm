<?php
	include "../../library/inc.koneksi.php";
?>


<?php 
	switch($_GET[act]) {
  	default:
?>
	
	<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_users WHERE username IN ($inUsers) AND level IN ('supervisor','sales') AND blokir = 'N' ORDER BY username ASC");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
 												
<option value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
	
	<?php } } ?>

<?php break ; ?>


<?php case "sub_segmen" : ?>

	<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_segmen WHERE id_kategori_segmen=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
 												
<option value="<?php echo $row['id_segmen']; ?>"><?php echo $row['segmen']; ?></option>

<?php } } ?>

<?php break ; ?>

<?php case "kota" : ?>

	<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_kota WHERE id_prov=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<option value="<?php echo $row['id_kota']; ?>"><?php echo $row['nama_kota']; ?></option>

<?php } } ?>

<?php break ; ?>

<?php case "kecamatan" : ?>

	<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_kecamatan WHERE id_kota=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<option value="<?php echo $row['id_kecamatan']; ?>"><?php echo $row['nama_kecamatan']; ?></option>

<?php } } ?>

<?php break ; ?>

<?php case "kelurahan" : ?>

	<?php 
		if($_POST['id'])
		{
 		$id=$_POST['id'];
  
 		$sql= mysql_query("SELECT * FROM ms_kelurahan WHERE id_kecamatan=$id");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<option value="<?php echo $row['id_kelurahan']; ?>"><?php echo $row['nama_kelurahan']; ?></option>

<?php } } ?>

<?php break ; ?>

<?php } ?>