<?php
	include "../../library/inc.koneksi.php";
?>	


<?php if($_POST['id'] == '2' ) { ?>

<h4 class="form-section">Detail Pembayaran Kredit</h4>	
<div class="row">
											
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">Pilih Lembaga Leasing</label>
			<select class="form-control" name="id_lembaga" onchange="ambil_cabang(this.value);" required>
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
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">Pilih Cabang Leasing</label>
			<select class="form-control" name="id_cabang" id="id_cabang" required>
				<option value="">- Pilih Cabang -</option>
										
			</select>				
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">Down Payment (%)</label>
			<select class="form-control" name="id_dp" required>
				<option value="">- Pilih DP -</option>
					<?php
						$sql=mysql_query("SELECT * FROM ms_dp");
							while($row=mysql_fetch_array($sql))
													{
						$id = $row['id_dp'];	
							echo '<option value="'.$id.'">'.$row['dp'].'</option>';
									}
					?>
			</select>				
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">Masa Pinjaman (Tenor)</label>
			<select class="form-control" name="tenor" required>
				<option value="">- Pilih Tenor -</option>
				<option value="1">1 Tahun</option>
				<option value="2">2 Tahun</option>
				<option value="3">3 Tahun</option>
				<option value="4">4 Tahun</option>
				<option value="5">5 Tahun</option>
			</select>				
		</div>
	</div>
													
</div>
	
<?php }  ?>