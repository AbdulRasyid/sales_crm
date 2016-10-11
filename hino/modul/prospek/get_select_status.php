<link rel="stylesheet" type="text/css" href="../../../assets/global/plugins/zebradatepicker/css/bootstrap.css"/>
<script src="../../../assets/global/plugins/jquery-2.1.3.min.js" type="text/javascript"></script>
<!-- Prospek Tgl SPK -->
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

<!-- Detail M.A.N -->
<h4 class="form-section">MAN (Money | Authority | Need)</h4>
								
<div class="row">

	<div class="col-md-3">
		<div class="form-group">
			<label>Kecukupan Dana (Money)</label>
			<div class="input-group">
				<span class="input-group-addon">
				<input type="checkbox" name="cek_money" value="Y">
				</span>
				<input type="text" class="form-control" name="ket_money" autocomplete="off">
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label>Memiliki Wewenang (Authority)</label>
				<div class="input-group">
					<span class="input-group-addon">
					<input type="checkbox" name="cek_auth" value="Y">
					</span>
					<input type="text" class="form-control" name="ket_auth" autocomplete="off">
				</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label>Kebutuhan Unit (Need)</label>
			<div class="input-group">
				<span class="input-group-addon">
				<input type="checkbox" name="cek_need" value="Y">
				</span>
				<input type="text" class="form-control" name="ket_need" autocomplete="off">
			</div>
		</div>
	</div>

</div> <hr>
<!-- Detail M.A.N -->


<?php if($_POST['id'] == '4' ) { ?>

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

<?php } ?>