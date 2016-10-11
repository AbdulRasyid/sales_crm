	<?php
	include "../../library/inc.koneksi.php";
	?>
	<?php 
		if(isset($_POST['get_option']))
  		{

     	$id = $_POST['get_option'];
  
 		$sql= mysql_query("SELECT * FROM ms_users WHERE level IN ('sales','supervisor') AND divisi = 'hino' AND sublevel = '$id' AND blokir = 'N' ORDER BY username ASC");
 	?>

 	<?php
 		while($row=mysql_fetch_array($sql))
 			{
	?>
												
	<option value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>

	<?php } } ?>