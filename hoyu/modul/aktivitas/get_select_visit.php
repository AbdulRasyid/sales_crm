<?php
	include "../../library/inc.koneksi.php";
?>	


<?php if($_POST['id'] == 'Visit' ) { ?>


				<div class="form-group">
					<label class="control-label">Foto Visit</label>
					<div class="fileinput fileinput-new" data-provides="fileinput">
					<span class="input-group-addon">
						<input type="file" name="bukti_visit">
					</span>												
					</div>
					<span class="help-block">*Upload Foto Saat Bertemu Dengan Customer </span>							
				</div>
	

<?php } else { ?> <?php } ?>