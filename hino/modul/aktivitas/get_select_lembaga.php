<?php
	include "../../library/inc.koneksi.php";
?>

<label class="control-label">Pilih Lembaga Leasing</label>
<select class="form-control lembaga" name="id_cabang">
	<option value="">- Pilih Lembaga -</option>
		<?php
			$sql=mysql_query("SELECT * FROM ms_perusahaan");
				while($row=mysql_fetch_array($sql))
					{
			$id = $row['id_perusahaan'];	
			echo '<option value="'.$id.'">'.$row['perusahaan'].'</option>';
						}
		?>
</select>

