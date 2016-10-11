<?php
	include "../../library/inc.koneksi.php";
?>

	<?php 
		if(isset($_POST['get_option']))
  		{

     	$id_p_analisa_lost = $_POST['get_option'];
  
 		$sql= mysql_query("SELECT * FROM ms_analisa_lost WHERE id_p_analisa_lost=$id_p_analisa_lost");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
<label>
<input type="radio" name="optionsRadios" value="<?php echo $id ; ?>"> <?php echo $row['analisa_lost'] ?></label>

<?php } } ?>
