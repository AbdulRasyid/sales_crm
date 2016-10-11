<link rel="stylesheet" type="text/css" href="../../../assets/global/plugins/zebradatepicker/css/bootstrap.css"/>
<script src="../../../assets/global/plugins/jquery-2.1.3.min.js" type="text/javascript"></script>
<!-- Aktivitas . Tgl Aktivitas Ass -->
<script>
    $(document).ready(function(){
        $('#tgl_prospek').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>
<script src="../../../assets/global/plugins/zebradatepicker/zebra_datepicker.js" type="text/javascript"></script>



<?php
	include "../../library/inc.koneksi.php";
?>	


<?php 
$spacebar = '&nbsp&nbsp&nbsp&nbsp&nbsp';
?>

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-settings"></i> MAN (Money | Authority | Need)
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tab-content">								
			<div class="skin skin-square">
				<div class="form-body">
					
					<div class="form-group">
						<label>Kecukupan Dana (Money)</label>
						<div class="row">
							<div class="col-md-11">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" name="cek_money" value="Y">
									</span>
									<input type="text" class="form-control" name="ket_money" autocomplete="off" required>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Memiliki Wewenang (Authority)</label>
						<div class="row">
							<div class="col-md-11">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" name="cek_auth" value="Y">
									</span>
									<input type="text" class="form-control" name="ket_auth" autocomplete="off" required>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Kebutuhan Unit (Need)</label>
						<div class="row">
							<div class="col-md-11">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" name="cek_need" value="Y">
									</span>
									<input type="text" class="form-control" name="ket_need" autocomplete="off" required>
								</div>
							</div>
						</div>
					</div>

													
				</div>												
			</div>										
		</div>
	</div>
</div>

<?php if($_POST['id'] == '4' ) { ?>

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-settings"></i> Detail Status SPK
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tab-content">								
			<div class="skin skin-square">
				<div class="form-body">
		
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal SPK</label>
								<input type="text" class="form-control" name="tgl_spk" autocomplete="off" id ="tgl_prospek" required>
							</div>
						</div>
												
						<div class="col-md-6">
							<div class="form-group">
								<label>No. SPK</label>
								<input type="text" class="form-control">
							</div>
						</div>
					</div>									
				</div>												
			</div>										
		</div>
	</div>
</div>
	
<?php } elseif ($_POST['id'] == '7') { ?>

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-settings"></i> Detail Status PO
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tab-content">								
			<div class="skin skin-square">
				<div class="form-body">
		
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Perkiraan Tanggal Pengiriman</label>
								<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
							</div>
						</div>
												
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<input type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggak Purchase Order</label>
								<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
							</div>
						</div>
												
						<div class="col-md-6">
							<div class="form-group">
								<label>No. Purchase Order</label>
								<input type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
					</div>

				</div>												
			</div>										
		</div>
	</div>
</div>

<?php } elseif ($_POST['id'] == '5') { ?>

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-settings"></i> Detail Status DO
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tab-content">								
			<div class="skin skin-square">
				<div class="form-body">
		
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal Delivery Order</label>
								<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
							</div>
						</div>
												
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. Rangka</label>
								<input type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. Mesin</label>
								<input type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
												
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. Nota</label>
								<input type="text" class="form-control" autocomplete="off" required>
							</div>
						</div>
					</div>

				</div>												
			</div>										
		</div>
	</div>
</div>

<?php } elseif ($_POST['id'] == '6') { ?>

<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-settings"></i> Analisa Lost Case
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tab-content">								
			<div class="skin skin-square">
				<div class="form-body">
		
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Alasan</label>
								<select class="form-control" name="id_lembaga" onchange="ambil_analisa(this.value);" required>
									<option value="">- Pilih Lembaga -</option>
									<option value="1">Beli Merk Lain</option>
									<option value="2">Beli Dealer Lain</option>
									<option value="3">Beli Bekas</option>
									<option value="4">Batal Beli</option>
								</select>								
							</div>
						</div>
												
						<div class="col-md-8">
							<div class="form-group" >
								<label class="control-label">Analisa Lost</label>
								<div class="radio-list" id="analisa_lost">
								
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Keterangan</label>
								<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan" required></textarea>
							</div>
						</div>

					</div>

				</div>												
			</div>										
		</div>
	</div>
</div>

<?php } ?>