<?php
	include "../../library/inc.koneksi.php";
?>	


<?php if($_POST['id'] == '2' ) { ?>

<?php 
$spacebar = '&nbsp&nbsp&nbsp&nbsp&nbsp';
?>

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-settings"></i> Detail Metode Pembayaran Kredit
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tab-content">								
			<div class="skin skin-square">
				<div class="form-body">
	
					<div class="form-group input-xlarge">
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

					<div class="form-group input-xlarge">	
						<label class="control-label">Pilih Cabang Leasing</label>
						<select class="form-control" name="id_cabang" id="id_cabang" required>
							<option value="">- Pilih Cabang -</option>
										
						</select>
					</div>

					<div class="form-group">
						<label>Down Payment (%)</label>
						<div class="radio-list"> <?php echo $spacebar ; ?>				
							<label class="radio-inline"> 
							<input type="radio" name="id_dp" value="1"> 0 - 14.9 % </label>
							<label class="radio-inline">
							<input type="radio" name="id_dp" value="2"> 15 - 19,9 % </label>
							<label class="radio-inline">
							<input type="radio" name="id_dp" value="3"> 20 - 29,9 % </label>
							<label class="radio-inline">
							<input type="radio" name="id_dp" value="3"> >= 30 % </label>
						</div>
					</div>

					<div class="form-group">
						<label>Tenor (Masa Pinjaman)</label>
						<div class="radio-list"> <?php echo $spacebar ; ?>				
							<label class="radio-inline"> 
							<input type="radio" name="tenor" value="1"> 1 Tahun </label>
							<label class="radio-inline">
							<input type="radio" name="tenor" value="2"> 2 Tahun </label>
							<label class="radio-inline">
							<input type="radio" name="tenor" value="3"> 3 Tahun </label>
							<label class="radio-inline">
							<input type="radio" name="tenor" value="3"> 4 Tahun </label>
							<label class="radio-inline">
							<input type="radio" name="tenor" value="3"> 5 Tahun </label>
						</div>
					</div>
													
				</div>												
			</div>										
		</div>
	</div>
</div>
	
<?php }  ?>