<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			 Data <small>Master</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Master Data</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->

			<?php 
				$id_tipe_kendaraan = $_GET['id_tipe_kendaraan']; 
				$result = mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_tipe_kendaraan=$id_tipe_kendaraan");
				$array = mysql_fetch_array($result);

				$id_warna = $_GET['id_warna'];
				$warna = mysql_query("SELECT id_warna, warna  FROM ms_warna WHERE id_warna=$id_warna");
				$a_warna = mysql_fetch_array($warna);

				$id_perusahaan = $_GET['id_perusahaan'];
				$perusahaan = mysql_query("SELECT id_perusahaan, perusahaan  FROM ms_leasing_nama WHERE id_perusahaan=$id_perusahaan");
				$a_perusahaan = mysql_fetch_array($perusahaan);

				$id_cabang = $_GET['id_cabang'];
				$cabang = mysql_query("SELECT a.id_perusahaan,a.id_kota_perusahaan,b.kota_perusahaan
                           						   FROM ms_leasing a
                           						   JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan
                           						   WHERE id_perusahaan = $id_perusahaan");
				$a_cabang = mysql_fetch_array($cabang);

				$id_surveyor = $_GET['id_surveyor'];
				$surveyor = mysql_query("SELECT id_surveyor,id_cabang,surveyor,no_hp  FROM ms_leasing_surveyor WHERE id_surveyor=$id_surveyor");
				$a_surveyor = mysql_fetch_array($surveyor);
			?>
			
			<?php 
            	switch($_GET[act]){
            	default:
          	?>

			<?php break; ?>

			<?php case "kendaraan" : ?>

			<?php
			$notif = $_GET['notif'];
			
			if ($_GET['notif'] == 1) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Kendaraan Berhasil ditambahkan !!
                </div>
            <?php
			} else if ($_GET['notif'] == 2) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Kendaraan Berhasil diperbarui !!
                </div>
            <?php
			} else if ($_GET['notif'] == 3) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Kendaraan Berhasil dihapus !!
                </div>
            <?php
			} ?>
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Data Kendaraan
							</div>
							<div class="actions">
								<a href="?module=master&act=tambah_kendaraan" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Kendaraan </a>
								<!-- a href="javascript:;" class="btn btn-default btn-sm">
								<i class="fa fa-print"></i> Print </a -->
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="m_kendaraan">
							<thead>
							<tr>
								<th width="15%">Model</th>	
								<th width="25%">Tipe</th>
								<th width="30%">Keterangan</th>
								<th width="10%">Transmisi</th>
								<th width="10%">Status</th>
								<th width="50%" align="center">Action</th>
							</tr>
							</thead>
							<tbody>

							<?php
                           	$result = mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan = 1 ORDER BY id_tipe_kendaraan DESC");
							while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td><?php echo $row['model'] ?></td>
								<td><?php echo $row['tipe']?></td>
								<td><?php echo $row['keterangan']?></td>
								<td><?php echo $row['transmisi']?> - <?php if($row['transmisi'] == 'AT' ) { echo "Automatic" ;} elseif ($row['transmisi'] == 'MT' ) { echo "Manual" ;} ?> </td>
								<td><?php if($row['discontinue_flag'] == '0' ) { ?>
									<a href="?module=master&act=delete_kendaraan&id_tipe_kendaraan=<?php echo $row[id_tipe_kendaraan] ; ?>" class="btn btn-xs purple tooltips" data-original-title="Ubah Status">
										Tersedia
									</a>
									<?php } elseif ($row['discontinue_flag'] == '1' ) { ?>
									<a href="?module=master&act=aktif_kendaraan&id_tipe_kendaraan=<?php echo $row[id_tipe_kendaraan] ; ?>" class="btn btn-xs red tooltips" data-original-title="Ubah Status">
										Discontinue
									</a>
									<?php } ?>
								</td>
								<td align="center">

									<a href="?module=master&act=edit_kendaraan&id_tipe_kendaraan=<?php echo $row['id_tipe_kendaraan'] ; ?>" 	class="btn btn-xs green tooltips" data-original-title="Edit Data">
										 <i class="fa fa-edit"></i>
									</a>

									<a href="?module=master&act=w_kendaraan&id_tipe_kendaraan=<?php echo $row['id_tipe_kendaraan'] ; ?>" 	class="btn btn-xs red tooltips" data-original-title="Lihat Warna">
										 <i class="fa fa-delicious"></i>
									</a>
								</td>
							</tr>
							<?php 
									}
                        	 ?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php break ; ?>


			<?php case "tambah_kendaraan" : ?>

			<?php
				error_reporting (E_ALL ^ E_NOTICE);

				$post = (!empty($_POST)) ? true : false;
				if($post){
					$error = '';

				if(empty($error)){

					$tipe = $_POST['tipe'];
					$model = $_POST['model'];
					$keterangan = addslashes( $_POST['keterangan'] );
					$transmisi = $_POST['transmisi'];

					$tambah=mysql_query("INSERT INTO ms_tipe_kendaraan (id_tipe_kendaraan,id_kendaraan,tipe,model,keterangan,
																		transmisi,discontinue_flag) 
										 VALUES('','2','$tipe','$model','$keterangan','$transmisi','0')") or die(mysql_error());
					
				if($tambah){
					header('location:?module=master&act=kendaraan&notif=1');

									}
										}
								}
			?>

			<div class="row">
				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Tambah Tipe Kendaraan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">

									<div class="form-group">
										<label class="control-label">Model Kendaraan</label>
										<input type="text" class="form-control" autocomplete="off" name="model" placeholder="Model Kendaraan" required>
									</div>

									<div class="form-group">
										<label class="control-label">Tipe Kendaraan</label>
										<input type="text" class="form-control" autocomplete="off" name="tipe" placeholder="Tipe Kendaraan" required>
									</div>

									<div class="form-group">
										<label class="control-label">Keterangan</label>
										<input type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan" required>
									</div>

									<div class="form-group input-large">
										<label class="control-label">Transmisi </label>		
										<select class="form-control" name="transmisi">
												<option value="" selected>- Pilih Transmisi -</option>
												<option value="AT">Automatic</option>
												<option value="MT">Manual</option>
											</select>
									</div>

														
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=master&act=kendaraan" type="button" class="btn default">Cancel</a>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
			</div>

			<?php break ; ?>

			<?php case "edit_kendaraan" : ?>

			<?php
				error_reporting (E_ALL ^ E_NOTICE);

				$post = (!empty($_POST)) ? true : false;
				if($post){
					$error = '';

				if(empty($error)){

					$model = $_POST['model'];
					$tipe = $_POST['tipe'];
					$keterangan = addslashes( $_POST['keterangan'] );
					$transmisi = $_POST['transmisi'];

					$edit=mysql_query("UPDATE ms_tipe_kendaraan SET model = '$model', tipe = '$tipe',
													keterangan = '$keterangan', transmisi = '$transmisi',
													discontinue_flag = 0 , discontinue_date = NOW()
										 WHERE id_tipe_kendaraan = $id_tipe_kendaraan") or die(mysql_error());
					
				if($edit){
					header('location:?module=master&notif=2');

									}
										}
								}
			?>

			<div class="row">
				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Edit Database
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">

									<div class="form-group">
										<label class="control-label">Model</label>
										<input type="text" class="form-control" autocomplete="off" name="model" value="<?php echo $array['model']; ?>">
									</div>

									<div class="form-group">
										<label class="control-label">Tipe</label>
										<input type="text" class="form-control" autocomplete="off" name="tipe" value="<?php echo $array['tipe']; ?>">
									</div>

									<div class="form-group">
										<label class="control-label">Keterangan</label>
										<input type="text" class="form-control" autocomplete="off" name="keterangan" value="<?php echo $array['keterangan']; ?>">
									</div>

									<div class="form-group input-large">
										<label class="control-label">Transmisi </label>		
										<select class="form-control" name="transmisi">
												<option value="AT" <?php if ($array['transmisi'] == 'AT') { echo 'selected' ; }  ?>>Automatic</option>
												<option value="MT" <?php if ($array['transmisi'] == 'MT') { echo 'selected' ; } ; ?>>Manual</option>
											</select>
									</div>
														
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=master&act=kendaraan" type="button" class="btn default">Cancel</a>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
			</div>

			<?php break ; ?>


			<?php case "delete_kendaraan" : ?>

			<?php 

				$delete = mysql_query("UPDATE ms_tipe_kendaraan SET discontinue_flag = 1 WHERE id_tipe_kendaraan = $id_tipe_kendaraan");

				if($delete){
					header('location:?module=master&act=kendaraan&notif=3');
					}
			?>

			<?php break ; ?>

			<?php case "aktif_kendaraan" : ?>

			<?php 

				$delete = mysql_query("UPDATE ms_tipe_kendaraan SET discontinue_flag = 0 WHERE id_tipe_kendaraan = $id_tipe_kendaraan");

				if($delete){
					header('location:?module=master&act=kendaraan&notif=3');
					}
			?>

			<?php break ; ?>

			<?php case "w_kendaraan" : ?>
	
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">

				<?php
					error_reporting (E_ALL ^ E_NOTICE);

					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';

					$sql_cek = mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan='" . $id_tipe_kendaraan . "' and warna='" . $_POST['warna'] . "' " );
										if(mysql_num_rows($sql_cek)){
	
					$error .= "Warna Tersebut sudah ada";
													}

					if(empty($error)){

						$warna = $_POST['warna'];

						$tambah=mysql_query("INSERT INTO ms_warna  VALUES('','$id_tipe_kendaraan','$warna')") or die(mysql_error());
					
					if($tambah){
						header('location:?module=master&act=w_kendaraan&id_tipe_kendaraan='.$id_tipe_kendaraan.'&notif=1');

										}
							}

					else {
							echo '	<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
										' . $error . '
									</div>';
											}
							}
				?>

				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Tambah Warna Kendaraan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label">Warna</label>
										<input type="text" class="form-control" autocomplete="off" name="warna" placeholder="Input Warna">
									</div>					
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>						
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>

				<div class="col-md-6">

				<?php
					$notif = $_GET['notif'];
			
					if ($_GET['notif'] == 1) {
				?>
					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Warna Kendaraan Berhasil ditambahkan !!
               	 	</div>
           	 	<?php
				} else if ($_GET['notif'] == 2) {
				?>
					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Warna Kendaraan Berhasil diperbarui !!
                	</div>
            	<?php
				} else if ($_GET['notif'] == 3) {
				?>
					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Database Berhasil dihapus !!
                	</div>
            	<?php
				} ?>

					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Warna Kendaraan <?php echo $array['tipe']; ?>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="m_kendaraan_w">
							<thead>
							<tr>
								<th width="80%">Warna</th>	
								<th width="20%" align="center">Action</th>

							</tr>
							</thead>
							<tbody>

							<?php
								$no=1;
                           		$warna = mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan=$id_tipe_kendaraan");
								while ($r_warna = mysql_fetch_array($warna)) {
							?>

							<tr>
								<td><?php echo $r_warna['warna'] ?></td>
								
								<td align="center">

									<a href="?module=master&act=edit_warna&id_tipe_kendaraan=<?php echo $id_tipe_kendaraan ; ?>&id_warna=<?php echo $r_warna['id_warna'] ; ?>" 	class="btn btn-xs green tooltips" data-original-title="Edit Data">
										 <i class="fa fa-edit"></i>
									</a>
									
								</td>
							</tr>

							<?php } ?>
							</tbody>
							</table>
						</div>
					</div>
				
				</div>
			</div>
			<!-- END PAGE CONTENT-->
			<?php break ; ?>

			<?php case "edit_warna" : ?>

				<div class="row">

				<?php
					error_reporting (E_ALL ^ E_NOTICE);

					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';


					if(empty($error)){

						$warna = $_POST['warna'];

						$edit=mysql_query("UPDATE ms_warna SET warna = '$warna' WHERE id_warna = $id_warna") or die(mysql_error());
					
					if($edit){
						header('location:?module=master&act=w_kendaraan&id_tipe_kendaraan='.$id_tipe_kendaraan.'&notif=2');

										}
							}

							}
				?>

				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Edit Warna Kendaraan
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label">Warna</label>
										<input type="text" class="form-control" autocomplete="off" name="warna" value="<?php echo $a_warna['warna'] ; ?>">
									</div>					
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=master&act=w_kendaraan&id_tipe_kendaraan=<?php echo $id_tipe_kendaraan ; ?>" type="button" class="btn default">Cancel</a>						
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
				</div>
			<?php case "break" ; ?>

			<?php case "lembaga" : ?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">

				<?php
					error_reporting (E_ALL ^ E_NOTICE);

					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';

					$sql_cek = mysql_query("SELECT * FROM ms_leasing_nama WHERE  perusahaan='" . $_POST['leasing'] . "' " );
										if(mysql_num_rows($sql_cek)){
	
					$error .= "Leasing Tersebut sudah ada";
													}

					if(empty($error)){

						$perusahaan = $_POST['leasing'];

						$tambah=mysql_query("INSERT INTO ms_leasing_nama  VALUES('','$perusahaan')") or die(mysql_error());
					
					if($tambah){
						header('location:?module=master&act=lembaga&notif=1');

										}
							}

					else {
							echo '	<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
										' . $error . '
									</div>';
											}
							}
				?>

				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Tambah Data Leasing
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label">Nama Leasing</label>
										<input type="text" class="form-control" autocomplete="off" name="leasing" placeholder="Input Nama Leasing">
									</div>					
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>						
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>

				<div class="col-md-6">

				<?php
					$notif = $_GET['notif'];
			
					if ($_GET['notif'] == 1) {
				?>
					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Leasing Berhasil ditambahkan !!
                	</div>

            	<?php } else if ($_GET['notif'] == 2) {	?>

					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Leasing Berhasil diperbarui !!
                	</div>
            
            	<?php } else if ($_GET['notif'] == 3) {	?>

					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data leasing Berhasil dihapus !!
                	</div>
            
            	<?php	} ?>

					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Data Lembaga Leasing
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="m_kendaraan">
							<thead>
							<tr>
								<th width="80%">Nama Leasing</th>	
								<th width="20%" align="center">Action</th>
							</tr>
							</thead>
							<tbody>

							<?php
                           	$result = mysql_query("SELECT id_perusahaan,perusahaan FROM ms_leasing_nama ORDER BY perusahaan ASC");
							while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td><?php echo $row['perusahaan'] ?></td>
								<td align="center">

									<a href="?module=master&act=edit_lembaga&id_perusahaan=<?php echo $row['id_perusahaan'] ; ?>" 	class="btn btn-xs green tooltips" data-original-title="Edit Data">
										 <i class="fa fa-edit"></i>
									</a>

									<a href="?module=master&act=c_lembaga&id_perusahaan=<?php echo $row['id_perusahaan'] ; ?>" 	class="btn btn-xs red tooltips" data-original-title="Lihat Cabang">
										 <i class="fa fa-delicious"></i>
									</a>
								</td>
							</tr>
							<?php 
									}
                        	 ?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php break ; ?>

			<?php case "edit_lembaga" : ?>

				<div class="row">

				<?php
					error_reporting (E_ALL ^ E_NOTICE);

					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';


					if(empty($error)){

						$perusahaan = $_POST['leasing'];

						$edit=mysql_query("UPDATE ms_leasing_nama SET perusahaan = '$perusahaan' WHERE id_perusahaan = $id_perusahaan") or die(mysql_error());
					
					if($edit){
						header('location:?module=master&act=lembaga&notif=2');

										}
							}

							}
				?>

				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Edit Nama Lembaga Leasing
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label">Nama Leasing</label>
										<input type="text" class="form-control" autocomplete="off" name="leasing" value="<?php echo $a_perusahaan['perusahaan'] ; ?>">
									</div>					
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=master&act=lembaga" type="button" class="btn default">Cancel</a>						
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
				</div>
			<?php case "break" ; ?>

			<?php case "c_lembaga" : ?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">

				<?php
					error_reporting (E_ALL ^ E_NOTICE);

					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';

					$sql_cek = mysql_query("SELECT * FROM ms_leasing WHERE  id_perusahaan='" . $id_perusahaan . "' and id_kota_perusahaan='" . $_POST['cabang'] . "' " );
										if(mysql_num_rows($sql_cek)){
	
					$error .= "Leasing Pada Kota Tersebut sudah ada";
													}

					if(empty($error)){

						$cabang = $_POST['cabang'];

						$tambah=mysql_query("INSERT INTO ms_leasing (id_cabang,id_perusahaan,id_kota_perusahaan)  
											 VALUES('','$id_perusahaan','$cabang')") or die(mysql_error());
					
					if($tambah){
						header('location:?module=master&act=c_lembaga&id_perusahaan='.$id_perusahaan.'&notif=1');

										}
							}

					else {
							echo '	<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
										' . $error . '
									</div>';
											}
							}
				?>

				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Tambah Cabang Leasing
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label">Nama Kota Cabang Leasing</label>
										<select required class="form-control form-control-inline select2me" name="cabang">
										<option selected="selected" value="">- Pilih Kota Cabang Leasing -</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_leasing_kota ORDER BY kota_perusahaan ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['id_kota_perusahaan'];	
  												
											echo '<option value="'.$id.'">'.$row['kota_perusahaan'].'</option>';
													}
											?>
								</select>
									</div>					
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=master&act=lembaga" type="button" class="btn default">Cancel</a>						
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>

				<div class="col-md-6">

				<?php
					$notif = $_GET['notif'];
			
					if ($_GET['notif'] == 1) {
				?>
					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Cabang Leasing Berhasil ditambahkan !!
                	</div>

            	<?php } else if ($_GET['notif'] == 2) {	?>

					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Cabang Leasing Berhasil diperbarui !!
                	</div>
            
            	<?php } else if ($_GET['notif'] == 3) {	?>

					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data leasing Berhasil dihapus !!
                	</div>
            
            	<?php	} ?>

					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Data Cabang Leasing <?php echo $a_perusahaan['perusahaan'] ; ?>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="m_kendaraan">
							<thead>
							<tr>
								<th width="80%">Cabang Kota</th>	
								<th width="20%" align="center">Action</th>
							</tr>
							</thead>
							<tbody>

							<?php
                           	$result = mysql_query("SELECT a.id_cabang,a.id_perusahaan,a.id_kota_perusahaan,b.kota_perusahaan
                           						   FROM ms_leasing a
                           						   JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan
                           						   WHERE id_perusahaan = $id_perusahaan");
							while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td><?php echo $row['kota_perusahaan'] ?></td>
								<td align="center">
									<a href="?module=master&act=s_lembaga&id_perusahaan=<?php echo $id_perusahaan ; ?>&id_cabang=<?php echo $row['id_cabang'] ; ?>" 	class="btn btn-xs red tooltips" data-original-title="Lihat Surveyor">
										 <i class="fa fa-delicious"></i>
									</a>
								</td>
							</tr>
							<?php 
									}
                        	 ?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php break ; ?>

			<?php case "s_lembaga" : ?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">

				<?php
					error_reporting (E_ALL ^ E_NOTICE);

					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';

					$sql_cek = mysql_query("SELECT * FROM ms_leasing WHERE  id_perusahaan='" . $id_perusahaan . "' and id_kota_perusahaan='" . $_POST['cabang'] . "' " );
										if(mysql_num_rows($sql_cek)){
	
					$error .= "Leasing Pada Kota Tersebut sudah ada";
													}

					if(empty($error)){

						$surveyor = $_POST['surveyor'];
						$no_hp = $_POST['no_hp'];

						$tambah=mysql_query("INSERT INTO ms_leasing_surveyor (id_surveyor,id_cabang,surveyor,no_hp)  
											 VALUES('','$id_cabang','$surveyor','$no_hp')") or die(mysql_error());
					
					if($tambah){
						header('location:?module=master&act=s_lembaga&id_perusahaan='.$id_perusahaan.'&id_cabang='.$id_cabang.'&notif=1');

										}
							}

					else {
							echo '	<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
										' . $error . '
									</div>';
											}
							}
				?>

				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Tambah Surveyor Leasing
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label">Nama Surveyor</label>
										<input type="text" class="form-control" autocomplete="off" name="surveyor" placeholder="Input Nama Surveyor" required>
									</div>		
									<div class="form-group">
										<label class="control-label">No. Handphone</label>
										<input type="text" class="form-control" autocomplete="off" name="no_hp" placeholder="Input No Handphone" required>
									</div>				
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=master&act=lembaga&id_perusahaan=<?php echo $id_perusahaan;?>" type="button" class="btn default">Cancel</a>						
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>

				<div class="col-md-6">

				<?php
					$notif = $_GET['notif'];
			
					if ($_GET['notif'] == 1) {
				?>
					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Surveyor Berhasil ditambahkan !!
                	</div>

            	<?php } else if ($_GET['notif'] == 2) {	?>

					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Surveyor Berhasil diperbarui !!
                	</div>
            
            	<?php } else if ($_GET['notif'] == 3) {	?>

					<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Surveyor Berhasil dihapus !!
                	</div>
            
            	<?php	} ?>

					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Data Surveyor <?php echo $a_perusahaan['perusahaan'] ; ?> Cabang <?php echo $a_cabang['kota_perusahaan'] ; ?> 
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="m_kendaraan">
							<thead>
							<tr>
								<th width="50%">Cabang Kota</th>	
								<th width="30%">No. Handphone</th>	
								<th width="20%" align="center">Action</th>
							</tr>
							</thead>
							<tbody>

							<?php
                           	$result = mysql_query("SELECT a.id_surveyor,a.surveyor,a.no_hp
                           						   FROM ms_leasing_surveyor a
                           						   WHERE id_cabang = $id_cabang");
							while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td><?php echo $row['surveyor'] ?></td>
								<td><?php echo $row['no_hp'] ?></td>
								<td align="center">

									<a href="?module=master&act=edit_surveyor&id_perusahaan=<?php echo $id_perusahaan ; ?>&id_cabang=<?php echo $id_cabang ; ?>&id_surveyor=<?php echo $row['id_surveyor'] ; ?>" 	class="btn btn-xs green tooltips" data-original-title="Edit Data">
										 <i class="fa fa-edit"></i>
									</a>
								</td>
							</tr>
							<?php 
									}
                        	 ?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php break ; ?>

			<?php case "edit_surveyor" : ?>

				<div class="row">

				<?php
					error_reporting (E_ALL ^ E_NOTICE);

					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';


					if(empty($error)){

						$surveyor = $_POST['surveyor'];
						$no_hp = $_POST['no_hp'];


						$edit=mysql_query("UPDATE ms_leasing_surveyor SET surveyor = '$surveyor', no_hp = '$no_hp' WHERE id_surveyor = $id_surveyor") or die(mysql_error());
					
					if($edit){
						header('location:?module=master&act=s_lembaga&id_perusahaan='.$id_perusahaan.'&id_cabang='.$id_cabang.'&notif=2');

										}
							}

							}
				?>

				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Edit Nama Surveyor Leasing
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label">Nama Surveyor</label>
										<input type="text" class="form-control" autocomplete="off" name="surveyor" value="<?php echo $a_surveyor['surveyor'] ; ?>">
									</div>	
									<div class="form-group">
										<label class="control-label">No Hp</label>
										<input type="text" class="form-control" autocomplete="off" name="no_hp" value="<?php echo $a_surveyor['no_hp'] ; ?>">
									</div>					
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=master&act=s_lembaga&id_perusahaan=<?php echo $id_perusahaan ;?>&id_cabang=<?php echo $id_cabang ;?>" type="button" class="btn default">Cancel</a>						
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
				</div>
			<?php case "break" ; ?>
			
			<?php } ?>
		</div>
</div>