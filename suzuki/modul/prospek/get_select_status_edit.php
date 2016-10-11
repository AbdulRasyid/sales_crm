<link rel="stylesheet" type="text/css" href="../../../assets/global/plugins/zebradatepicker/css/bootstrap.css"/>
<script src="../../../assets/global/plugins/jquery-2.1.3.min.js" type="text/javascript"></script>
<!-- Aktivitas . Tgl DO -->
<script>
    $(document).ready(function(){
        $('#tgl_do').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>

<!-- Aktivitas . Tgl PO -->
<script>
    $(document).ready(function(){
        $('#tgl_po').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>
<!-- Aktivitas . Tgl Estimasi -->
<script>
    $(document).ready(function(){
        $('#tgl_estimasi').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>

<!-- Prospek . Tgl SPK -->
<script>
    $(document).ready(function(){
        $('#tgl_spk').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>
<script src="../../../assets/global/plugins/zebradatepicker/zebra_datepicker.js" type="text/javascript"></script>

<?php include "../../library/inc.koneksi.php"; ?>	


<?php if($_POST['id'] == '3' ) { ?>

<!-- Detail SPK -->
<h4 class="form-section">Detail SPK</h4>
								
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">Tanggal SPK</label>
			<input type="text" class="form-control" name="tgl_spk" autocomplete="off" id ="tgl_spk" required>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label>No. SPK</label>
			<input type="text" class="form-control" name="no_spk" autocomplete="off">
		</div>
	</div>

</div> <hr>
<!-- Detail SPK -->

<?php }  elseif ($_POST['id'] == '4') { ?>

<!-- Detail DO -->
<h4 class="form-section">Detail Delivery Order</h4>
								
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">Tanggal Delivery Order</label>
			<input type="text" class="form-control" name="tgl_do" id ="tgl_do" required>
		</div>
	</div>
												
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">No. Rangka</label>
			<input type="text" class="form-control" name="no_rangka" autocomplete="off" required>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">No. Mesin</label>
			<input type="text" class="form-control" name="no_mesin" autocomplete="off" required>
		</div>
	</div>
												
	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">No. Nota</label>
			<input type="text" class="form-control" name="no_nota" autocomplete="off">
		</div>
	</div>

</div> <hr>
<!-- Detail DO -->

<?php } elseif ($_POST['id'] == '5') { ?>


<h4 class="form-section">Analisa Lost Case</h4>
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
			<label class="control-label">Alasan</label>
			<select class="form-control" name="id_p_analisa_lost" onchange="ambil_analisa(this.value);" required>
				<option value="">- Pilih Lembaga -</option>
				<option value="1">Beli Merk Lain</option>
				<option value="2">Beli Dealer Lain</option>
				<option value="3">Beli Bekas</option>
				<option value="4">Batal Beli</option>
				</select>								
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group" >
			<label class="control-label">Analisa Lost</label>
			<div class="radio-list" id="analisa_lost">
								
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label">Keterangan</label>
			<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan" required></textarea>
		</div>
	</div>

</div>

<?php } ?>