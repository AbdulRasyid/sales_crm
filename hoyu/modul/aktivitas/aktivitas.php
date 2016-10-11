<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Aktivitas Harian <small>Manage</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.php">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Aktivitas Harian</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<?php 
				$divisi = $_GET['divisi'];
				$id_pelanggan = $_GET['id_pelanggan']; 
				$id_aktivitas_harian = $_GET['id_aktivitas_harian']
			?>

			<?php 
			switch($_GET[act]) {
  			default:
 			?>

 			<?php break ; ?>

 			<?php case "add": ?> 

			<!-- BEGIN PAGE CONTENT-->

			<?php if($divisi == 'unit') { ?>
			<div class="row">
				<div class="col-md-6">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Form Tambah Aktivitas Service
							</div>
							<ul class="nav nav-tabs">
								<li  <?php if($_GET['aktivitas'] == "add_telp" OR $_GET['aktivitas'] =="default") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_telp&id_pelanggan=<?php echo $id_pelanggan ; ?>"> Telepon </a>
								</li>
								
								<li  <?php if($_GET['aktivitas'] == "add_visit") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_visit&id_pelanggan=<?php echo $id_pelanggan ; ?>"> 
								Visit </a>
								</li>
								
								<li  <?php if($_GET['aktivitas'] == "add_suevey") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_survey&id_pelanggan=<?php echo $id_pelanggan ; ?>"> Survey </a>
								</li>

							</ul>
						</div>
						<div class="portlet-body form">
							<div class="tab-content">

								<?php 
            						switch($_GET[aktivitas]){
            						default:
          							break ; 
          						?>

          						<?php case"add_telp": ?>

          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_unit (id_aktivitas_harian,id_pelanggan,tgl_aktivitas,aktivitas,keterangan,tgl_kunjungan_berikut,created_by,created_date,deleted_flag)  VALUES('','$id_pelanggan','$tgl_aktivitas','telp','$keterangan','$tgl_kunjungan_berikut','$_SESSION[username]',NOW(),0)") or die(mysql_error());
										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" end-date ="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>								

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan" required></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d'>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>

								<?php break ; ?>

								<?php case"add_visit": ?>
										
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										$sql_cek = mysql_query("SELECT * FROM tb_aktivitas_harian_serv WHERE bukti_visit='" . $gambar . "'" );
										if(mysql_num_rows($sql_cek)){
	
										$error .= "Gambar sudah pernah diupload";
													}

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$sumber = $_FILES['bukti_visit']['tmp_name'];
                    					$target = 'picture/bukti/service/';
                    					$gambar = $_FILES['bukti_visit']['name'];

                    					move_uploaded_file($sumber, $target.$gambar);

                    					if(empty($gambar)) {
                    					$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_unit (
                    												id_aktivitas_harian,id_pelanggan,tgl_aktivitas,
                    												tgl_kunjungan_berikut,aktivitas,merk_kendaraan,type_kendaraan,
                    												body_kendaraan,no_polisi,no_mesin,no_chasis,keterangan,
                    												created_by,created_date,deleted_flag)  
                    										 VALUES('','$id_pelanggan','$tgl_aktivitas','$tgl_kunjungan_berikut','visit','$merk_kendaraan','$type_kendaraan','$body_kendaraan','$no_polisi','$no_mesin','$no_chasis','$keterangan','$_SESSION[username]',NOW(),0)") or die(mysql_error());
                    					}else{
										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_unit (
																	id_aktivitas_harian,id_pelanggan,tgl_aktivitas,
																	tgl_kunjungan_berikut,aktivitas,merk_kendaraan,type_kendaraan,
																	body_kendaraan,no_polisi,no_mesin,no_chasis,keterangan,
																	bukti_visit,created_by,created_date,deleted_flag)  
															 VALUES('','$id_pelanggan','$tgl_aktivitas','$tgl_kunjungan_berikut','visit','$merk_kendaraan','$type_kendaraan','$body_kendaraan','$no_polisi','$no_mesin','$no_chasis','$keterangan','$gambar','$_SESSION[username]',NOW(),0)") or die(mysql_error());
										}
										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

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

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Foto Visit</label>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="input-group-addon">
															<input type="file" name="bukti_visit">
														</span>												
													</div>
													<span class="help-block">*Upload Foto Saat Bertemu Dengan Customer </span>							
											</div>

											<div class="form-group">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan"></textarea>
											</div>

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>

								<?php case"add_survey": ?>
									
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$id_lembaga = $_POST['id_lembaga'];
										$id_cabang = $_POST['id_cabang'];
										$id_surveyor = $_POST['id_cabang'];

										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_unit (id_aktivitas_harian,id_pelanggan,tgl_aktivitas,aktivitas,keterangan,tgl_kunjungan_berikut,created_by,created_date,deleted_flag)  VALUES('','$id_pelanggan','$tgl_aktivitas','survey','$keterangan','$tgl_kunjungan_berikut','$_SESSION[username]',NOW(),0)") or die(mysql_error());

											$q = mysql_query("SELECT MAX(id_aktivitas_harian) AS getID FROM tb_aktivitas_harian_unit WHERE id_pelanggan = $id_pelanggan");   
          								    $r = mysql_fetch_array($q);

											mysql_query("INSERT INTO tb_survey(id_survey,id_aktivitas_harian,id_cabang,id_surveyor,id_perusahaan,created_by,created_date,deleted_flag)  VALUES('','$r[getID]','$id_cabang','$id_surveyor','$id_lembaga','$_SESSION[username]',NOW(),0)") or die(mysql_error());

										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" id ="aktivitas_unit" required>
													<span class="input-group-btn">
													<button class="btn default" type="button" disabled><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
	
											<div class="form-group input-xlarge">
												<label class="control-label">Pilih Lembaga Leasing</label>
												<select class="form-control lembaga" name="id_lembaga" required>
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
												<select class="form-control cabang" name="id_cabang" required>
													<option value="">- Pilih Cabang -</option>
										
												</select>
											</div>

											<div class="form-group input-xlarge">	
												<label class="control-label">Pilih Surveyor</label>
												<select class="form-control surveyor" name="id_surveyor">
													<option value="">- Pilih Cabang -</option>
										
												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan" required></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group">
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" id ="knjgn_berikut" required>
													<span class="input-group-btn">
													<button class="btn default" type="button" disabled><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>														
										</div>		
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>
								
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php } elseif($divisi == 'part') { ?>
			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Form Tambah Aktivitas Sparepart
							</div>
							<ul class="nav nav-tabs">
								<li  <?php if($_GET['aktivitas'] == "add_telp" OR $_GET['aktivitas'] =="default") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_telp&id_pelanggan=<?php echo $id_pelanggan ; ?>"> Telepon </a>
								</li>
								
								<li  <?php if($_GET['aktivitas'] == "add_visit") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_visit&id_pelanggan=<?php echo $id_pelanggan ; ?>"> 
								Visit </a>
								</li>

							</ul>
						</div>
						<div class="portlet-body form">
							<div class="tab-content">

								<?php 
            						switch($_GET[aktivitas]){
            						default:
          							break ; 
          						?>

          						<?php case"add_telp": ?>

          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$jenis_aktivitas = $_POST['jenis_aktivitas'] ;
										$keterangan = addslashes( $_POST['keterangan'] );

										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_part (id_aktivitas_harian,id_pelanggan,tgl_aktivitas,aktivitas,jenis_aktivitas,keterangan,tgl_kunjungan_berikut,created_by,created_date,deleted_flag)  VALUES('','$id_pelanggan','$tgl_aktivitas','Telepon','$jenis_aktivitas','$keterangan','$tgl_kunjungan_berikut','$_SESSION[username]',NOW(),0)") or die(mysql_error());
										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>

											<div class="form-group input-large">
												<label class="control-label">Jenis Aktivitas</label>
												<select class="form-control select2me" name="jenis_aktivitas">
													<option value="">- Pilih Jenis Aktivitas -</option>
                                    			
                                    				<?php
														$sql=mysql_query("SELECT * FROM ms_aktivitas_part");
															while($row=mysql_fetch_array($sql))
															{
														$id = $row['id_aktivitas'];	
															echo '<option value="'.$id.'">'.$row['aktivitas'].'</option>';
															}
													?>

												</select>
											</div>							

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan" required></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group">
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" id ="knjgn_berikut" required>
													<span class="input-group-btn">
													<button class="btn default" type="button" disabled><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>

								<?php break ; ?>

								<?php case"add_visit": ?>
										
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$jenis_aktivitas = $_POST['jenis_aktivitas'] ;
										$keterangan = addslashes( $_POST['keterangan'] );

										$sumber = $_FILES['bukti_visit']['tmp_name'];
                    					$target = 'picture/bukti/part/';
                    					$gambar = $_FILES['bukti_visit']['name'];

                    					move_uploaded_file($sumber, $target.$gambar);

										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_part (id_aktivitas_harian,id_pelanggan,tgl_aktivitas,aktivitas,jenis_aktivitas,keterangan,bukti_visit,tgl_kunjungan_berikut,created_by,created_date,deleted_flag)  VALUES('','$id_pelanggan','$tgl_aktivitas','Visit','$jenis_aktivitas','$keterangan','$gambar','$tgl_kunjungan_berikut','$_SESSION[username]',NOW(),0)") or die(mysql_error());
										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Jenis Aktivitas</label>
												<select class="form-control select2me" name="jenis_aktivitas">
													<option value="">- Pilih Jenis Aktivitas -</option>
                                    			
                                    				<?php
														$sql=mysql_query("SELECT * FROM ms_aktivitas_part");
															while($row=mysql_fetch_array($sql))
															{
														$id = $row['id_aktivitas'];	
															echo '<option value="'.$id.'">'.$row['aktivitas'].'</option>';
															}
													?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Foto Visit</label>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="input-group-addon">
															<input type="file" name="bukti_visit">
														</span>												
													</div>
													<span class="help-block">*Upload Foto Saat Bertemu Dengan Customer </span>							
											</div>
								
											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan" required></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group">
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" id ="knjgn_berikut" required>
													<span class="input-group-btn">
													<button class="btn default" type="button" disabled><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>
								
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php } elseif($divisi == 'serv') { ?>
			<div class="row">
				<div class="col-md-6">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Form Tambah Aktivitas Service
							</div>
							<ul class="nav nav-tabs">
								<li  <?php if($_GET['aktivitas'] == "add_telp" OR $_GET['aktivitas'] =="default") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_telp&id_pelanggan=<?php echo $id_pelanggan ; ?>"> Telepon </a>
								</li>
								
								<li  <?php if($_GET['aktivitas'] == "add_visit") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_visit&id_pelanggan=<?php echo $id_pelanggan ; ?>"> 
								Visit </a>
								</li>
								
								<li  <?php if($_GET['aktivitas'] == "add_handcomp") { echo 'class="active"' ; } ?>>
								<a href="?module=aktivitas&act=add&aktivitas=add_handcomp&id_pelanggan=<?php echo $id_pelanggan ; ?>"> Handling Complain </a>
								</li>

							</ul>
						</div>
						<div class="portlet-body form">
							<div class="tab-content">

								<?php 
            						switch($_GET[aktivitas]){
            						default:
          							break ; 
          						?>

          						<?php case"add_telp": ?>

          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_serv (id_aktivitas_harian,id_pelanggan,tgl_aktivitas,aktivitas,keterangan,tgl_kunjungan_berikut,created_by,created_date,deleted_flag)  VALUES('','$id_pelanggan','$tgl_aktivitas','Telepon','$keterangan','$tgl_kunjungan_berikut','$_SESSION[username]',NOW(),0)") or die(mysql_error());
										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" end-date ="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>								

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan" required></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d'>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>

								<?php break ; ?>

								<?php case"add_visit": ?>
										
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										$sql_cek = mysql_query("SELECT * FROM tb_aktivitas_harian_serv WHERE bukti_visit='" . $gambar . "'" );
										if(mysql_num_rows($sql_cek)){
	
										$error .= "Gambar sudah pernah diupload";
													}

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$merk_kendaraan = $_POST['merk_kendaraan'];
										$type_kendaraan = $_POST['type_kendaraan'];
										$body_kendaraan = $_POST['body_kendaraan'];
										$no_polisi = $_POST['no_polisi'];
										$no_mesin = $_POST['no_mesin'];
										$no_chasis = $_POST['no_chasis'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$sumber = $_FILES['bukti_visit']['tmp_name'];
                    					$target = 'picture/bukti/service/';
                    					$gambar = $_FILES['bukti_visit']['name'];

                    					move_uploaded_file($sumber, $target.$gambar);

                    					if(empty($gambar)) {
                    					$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_serv (
                    												id_aktivitas_harian,id_pelanggan,tgl_aktivitas,
                    												tgl_kunjungan_berikut,aktivitas,merk_kendaraan,type_kendaraan,
                    												body_kendaraan,no_polisi,no_mesin,no_chasis,keterangan,
                    												created_by,created_date,deleted_flag)  
                    										 VALUES('','$id_pelanggan','$tgl_aktivitas','$tgl_kunjungan_berikut','Visit','$merk_kendaraan','$type_kendaraan','$body_kendaraan','$no_polisi','$no_mesin','$no_chasis','$keterangan','$_SESSION[username]',NOW(),0)") or die(mysql_error());
                    					}else{
										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_serv (
																	id_aktivitas_harian,id_pelanggan,tgl_aktivitas,
																	tgl_kunjungan_berikut,aktivitas,merk_kendaraan,type_kendaraan,
																	body_kendaraan,no_polisi,no_mesin,no_chasis,keterangan,
																	bukti_visit,created_by,created_date,deleted_flag)  
															 VALUES('','$id_pelanggan','$tgl_aktivitas','$tgl_kunjungan_berikut','Visit','$merk_kendaraan','$type_kendaraan','$body_kendaraan','$no_polisi','$no_mesin','$no_chasis','$keterangan','$gambar','$_SESSION[username]',NOW(),0)") or die(mysql_error());
										}
										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

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

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Foto Visit</label>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="input-group-addon">
															<input type="file" name="bukti_visit">
														</span>												
													</div>
													<span class="help-block">*Upload Foto Saat Bertemu Dengan Customer </span>							
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Merk Kendaraan</label>
												<select class="form-control select2me" name="merk_kendaraan">
													<option value="">- Pilih Merk Kendaraan -</option>
                                    			
                                    					<?php
															$sql=mysql_query("SELECT * FROM ms_merk");
																	while($row=mysql_fetch_array($sql))
																	{
															$id = $row['merk'];	
																	echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																}
														?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Model/Type</label>
												<input type="text" class="form-control" autocomplete="off" name="type_kendaraan" placeholder="Keterangan" required>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Karoseri</label>
												<select class="form-control select2me" name="body_kendaraan">
													<option value="">- Pilih Karoseri -</option>
                                    			
                                    					<?php
															$sql=mysql_query("SELECT * FROM ms_karoseri");
																	while($row=mysql_fetch_array($sql))
																	{
															$id = $row['karoseri'];	
																	echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																}
														?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Polisi</label>
												<input type="text" class="form-control" autocomplete="off" name="no_polisi" placeholder="Nomor Polisi" required>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Mesin</label>
												<input type="text" class="form-control" autocomplete="off" name="no_mesin" placeholder="Nomor Mesin" required>
											</div>		

											<div class="form-group input-xlarge">
												<label class="control-label">No. Chasis</label>
												<input type="text" class="form-control" autocomplete="off" name="no_chasis" placeholder="Nomor Chasis" required>
											</div>					

											<div class="form-group">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan"></textarea>
											</div>

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>

								<?php case"add_handcomp": ?>
									
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$merk_kendaraan = $_POST['merk_kendaraan'];
										$type_kendaraan = $_POST['type_kendaraan'];
										$body_kendaraan = $_POST['body_kendaraan'];
										$no_polisi = $_POST['no_polisi'];
										$no_mesin = $_POST['no_mesin'];
										$no_chasis = $_POST['no_chasis'];
										$initial = $_POST['initial'];
										$initial_visit = $_POST['initial_visit'];
										$detail_problem = addslashes( $_POST['detail_problem'] );
										$penyebab_problem = addslashes( $_POST['penyebab_problem'] );
										$tindakan_problem = addslashes( $_POST['tindakan_problem'] );
										$keterangan = addslashes( $_POST['keterangan'] );

										$tambah=mysql_query("INSERT INTO tb_aktivitas_harian_serv (id_aktivitas_harian,id_pelanggan,tgl_aktivitas,aktivitas,merk_kendaraan,type_kendaraan,body_kendaraan,no_polisi,no_mesin,no_chasis,initial,initial_visit,detail_problem,penyebab_problem,tindakan,keterangan,tgl_kunjungan_berikut,created_by,created_date,deleted_flag)  VALUES('','$id_pelanggan','$tgl_aktivitas','Handling Complain','$merk_kendaraan','$type_kendaraan','$body_kendaraan','$no_polisi','$no_mesin','$no_chasis','$initial','$initial_visit','$detail_problem','$penyebab_problem','$tindakan_problem','$keterangan','$tgl_kunjungan_berikut','$_SESSION[username]',NOW(),0)") or die(mysql_error());

										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_aktivitas"autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
	
											<div class="form-group input-xlarge">
												<label class="control-label">Merk Kendaraan</label>
												<select class="form-control select2me" name="merk_kendaraan">
													<option value="">- Pilih Merk Kendaraan -</option>
                                    			
                                    					<?php
															$sql=mysql_query("SELECT * FROM ms_merk");
																	while($row=mysql_fetch_array($sql))
																	{
															$id = $row['merk'];	
																	echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																}
														?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Model/Type</label>
												<input type="text" class="form-control" autocomplete="off" name="type_kendaraan" placeholder="Keterangan" required>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Karoseri</label>
												<select class="form-control select2me" name="body_kendaraan">
													<option value="">- Pilih Karoseri -</option>
                                    			
                                    					<?php
															$sql=mysql_query("SELECT * FROM ms_karoseri");
																	while($row=mysql_fetch_array($sql))
																	{
															$id = $row['karoseri'];	
																	echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																}
														?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Polisi</label>
												<input type="text" class="form-control" autocomplete="off" name="no_polisi" placeholder="Keterangan" required>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Mesin</label>
												<input type="text" class="form-control" autocomplete="off" name="no_mesin" placeholder="Keterangan" required>
											</div>		

											<div class="form-group input-xlarge">
												<label class="control-label">No. Chasis</label>
												<input type="text" class="form-control" autocomplete="off" name="no_chasis" placeholder="Keterangan" required>
											</div>	

											<div class="form-group input-xlarge">	
												<label class="control-label">Initial</label>
												<select class="form-control" name="initial" required>
													<option value="">- Pilih Initial -</option>
													<option value="Dealer Visit">Dealer Visit</option>
													<option value="Customer Datang">Customer Datang - Konsultasi</option>
												</select>
											</div>

											<div class="form-group input-xlarge">	
												<label class="control-label">Pilih Initial Visit</label>
												<select class="form-control" name="initial_visit">
													<option value="">- Pilih Initial Visit -</option>
													<option value="Free">Free Inspection</option>
													<option value="Tidak">Tidak</option>
												</select>
											</div>

											<div class="form-group">
												<label class="control-label">Detail Problem</label>
												<textarea type="text" class="form-control" autocomplete="off" name="detail_problem" placeholder="Keterangan" required></textarea>
											</div>

											<div class="form-group">
												<label class="control-label">Penyebab Problem</label>
												<textarea type="text" class="form-control" autocomplete="off" name="penyebab_problem" placeholder="Keterangan" required></textarea>
											</div>

											<div class="form-group">
												<label class="control-label">Tindakan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="tindakan_problem" placeholder="Keterangan" required></textarea>
											</div>

											<div class="form-group">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan" required></textarea>
											</div>							

											<div class="form-group">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>														
										</div>		
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>
								
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php } ?>

			<?php break; ?>

			<?php case "edit" : ?>

			<?php 
				if ($_SESSION[sublevel] == 'unit') {   	
				$result = mysql_query("SELECT a.id_aktivitas_harian, a.id_pelanggan, a.tgl_aktivitas, a.aktivitas, a.bukti_visit,
											  a.keterangan,	a.tgl_kunjungan_berikut, b.id_cabang, b.id_surveyor,d.id_perusahaan,
											  d.perusahaan, e.id_kota_perusahaan, e.kota_perusahaan, f.surveyor, f.no_hp AS hp_surveyor
									   FROM	tb_aktivitas_harian_unit a
									   LEFT JOIN tb_survey b ON b.id_aktivitas_harian = a.id_aktivitas_harian
									   LEFT JOIN ms_leasing c ON c.id_cabang = b.id_cabang
									   LEFT JOIN ms_leasing_nama d ON d.id_perusahaan = c.id_perusahaan
									   LEFT JOIN ms_leasing_kota e ON e.id_kota_perusahaan = c.id_kota_perusahaan
									   LEFT JOIN ms_leasing_surveyor f ON f.id_surveyor = b.id_surveyor
									   WHERE a.id_aktivitas_harian = '$id_aktivitas_harian'");
				
				}elseif ($_SESSION[sublevel] == 'part') {
				$result = mysql_query("SELECT * FROM tb_aktivitas_harian_part WHERE id_aktivitas_harian='$id_aktivitas_harian'");
				
				}elseif ($_SESSION[sublevel] == 'service') {
				$result = mysql_query("SELECT * FROM tb_aktivitas_harian_serv WHERE id_aktivitas_harian='$id_aktivitas_harian'");
				} 
				$array = mysql_fetch_array($result);
			?>

			<?php if($_SESSION[sublevel] == 'unit') { ?>
			
			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Form Edit Aktivitas Unit
							</div>
						</div>
						<div class="portlet-body form">
							<div class="tab-content">

								<?php 
            						switch($_GET[aktivitas]){
            						default:
          							break ; 
          						?>

          						<?php case"add_telp": ?>

          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$edit=mysql_query("UPDATE tb_aktivitas_harian_unit SET keterangan = '$keterangan',tgl_kunjungan_berikut ='$tgl_kunjungan_berikut',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian=$id_aktivitas_harian") or die(mysql_error());
										if($edit){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" end-date ="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" value = "<?php echo $array['tgl_aktivitas']; ?>" disabled >
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>								

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan"><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d'>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" value = "<?php echo $array['tgl_kunjungan_berikut']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>

								<?php break ; ?>

								<?php case"add_visit": ?>
										
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$sumber = $_FILES['bukti_visit']['tmp_name'];
                    					$target = 'picture/bukti/unit/';
                    					$gambar = $_FILES['bukti_visit']['name'];

                    					move_uploaded_file($sumber, $target.$gambar);

                    					if(empty($gambar)){
                    						$edit=mysql_query("UPDATE tb_aktivitas_harian_unit SET keterangan='$keterangan',tgl_kunjungan_berikut='$tgl_kunjungan_berikut',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());
                    					} else {
                    						$edit=mysql_query("UPDATE tb_aktivitas_harian_unit SET keterangan='$keterangan', bukti_visit='$gambar',tgl_kunjungan_berikut='$tgl_kunjungan_berikut',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());
                    					}
										
										if($edit){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" value = "<?php echo $array['tgl_aktivitas']; ?>" disabled>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Foto Visit</label>
												
												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
												<?php if (empty($array['bukti_visit'])) { ?>
													<img src="picture/bukti/noimage.png" >
												<?php } else { ?>
													<img src="picture/bukti/unit/<?php echo $array['bukti_visit'];?>" >
												<?php } ?>
												</div>
												<br><br>
												<span class="help-block">Foto Visit Yang Di Unggah Sebelumnya </span>
												<br>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="input-group-addon">
															<input type="file" name="bukti_visit">
														</span>												
													</div>
													<span class="help-block">*Upload Foto Saat Bertemu Dengan Customer </span>							
											</div>
								
											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan"><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" value = "<?php echo $array['tgl_kunjungan_berikut']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>

								<?php case"add_survey": ?>
									
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$id_lembaga = $_POST['id_lembaga'];
										$id_cabang = $_POST['id_cabang'];
										$id_surveyor = $_POST['id_cabang'];

										$tambah=mysql_query("UPDATE tb_aktivitas_harian_unit SET keterangan = '$keterangan', tgl_kunjungan_berikut='$tgl_kunjungan_berikut',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());

											mysql_query("UPDATE tb_survey SET id_cabang='$id_cabang',id_surveyor='$id_surveyor',id_perusahaan='$id_lembaga',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());

										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" value = "<?php echo $array['tgl_aktivitas']; ?>" disabled>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
	
											<div class="form-group input-xlarge">
												<label class="control-label">Pilih Lembaga Leasing </label>
												<select class="form-control lembaga" name="id_lembaga" required>
													<option value="">- Pilih Lembaga -</option>
														<?php
															$sql=mysql_query("SELECT * FROM ms_leasing_nama");
																while($row=mysql_fetch_array($sql))
																		{
															$id = $row['id_perusahaan'];	

															if($id == $array['id_perusahaan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['perusahaan'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['perusahaan'].'</option>';
																		}
																	}
														?>
												</select>								
											</div>

											<div class="form-group input-xlarge">	
												<label class="control-label">Pilih Cabang Leasing</label>
												<select class="form-control cabang" name="id_cabang" required>
													<option value="">- Pilih Cabang -</option>
														<?php
															$sql=mysql_query("SELECT * FROM ms_leasing a JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan WHERE id_perusahaan=$array[id_perusahaan]");
																while($row=mysql_fetch_array($sql))
																		{
															$id = $row['id_kota_perusahaan'];	

															if($id == $array['id_kota_perusahaan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['kota_perusahaan'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['kota_perusahaan'].'</option>';
																		}
																	}
														?>
												</select>
											</div>

											<div class="form-group input-xlarge">	
												<label class="control-label">Pilih Surveyor</label>
												<select class="form-control surveyor" name="id_surveyor">
													<option value="">- Pilih Cabang -</option>
														<?php
															$sql=mysql_query("SELECT * FROM ms_leasing_surveyor WHERE id_cabang=$array[id_cabang]");
																while($row=mysql_fetch_array($sql))
																		{
															$id = $row['id_surveyor'];	

															if($id == $array['id_surveyor']){
																echo '<option value="'.$id.'" selected="selected">'.$row['surveyor'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['surveyor'].'</option>';
																		}
																	}
														?>
												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan"><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" value = "<?php echo $array['tgl_kunjungan_berikut']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>														
										</div>		
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>
								
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php } elseif($_SESSION[sublevel] == 'part') { ?>
			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Form Edit Aktivitas Sparepart
							</div>

						</div>
						<div class="portlet-body form">
							<div class="tab-content">

								<?php 
            						switch($_GET[aktivitas]){
            						default:
          							break ; 
          						?>

          						<?php case"add_telp": ?>

          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$edit=mysql_query("UPDATE tb_aktivitas_harian_part SET keterangan = '$keterangan',tgl_kunjungan_berikut ='$tgl_kunjungan_berikut',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian=$id_aktivitas_harian") or die(mysql_error());
										if($edit){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" end-date ="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" value = "<?php echo $array['tgl_aktivitas']; ?>" disabled >
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>								

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan"><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d'>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" value = "<?php echo $array['tgl_kunjungan_berikut']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>

								<?php break ; ?>

								<?php case"add_visit": ?>
										
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$jenis_aktivitas = $_POST['jenis_aktivitas'] ;
										$keterangan = addslashes( $_POST['keterangan'] );

										$sumber = $_FILES['bukti_visit']['tmp_name'];
                    					$target = 'picture/bukti/part/';
                    					$gambar = $_FILES['bukti_visit']['name'];

                    					move_uploaded_file($sumber, $target.$gambar);

                    					if (empty($gambar)) {
										$edit=mysql_query("UPDATE tb_aktivitas_harian_part SET jenis_aktivitas= '$jenis_aktivitas', keterangan = '$keterangan', tgl_kunjungan_berikut = '$tgl_kunjungan_berikut', modified_by = '$_SESSION[username]', modified_date = NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());
										} else {
										$edit=mysql_query("UPDATE tb_aktivitas_harian_part SET jenis_aktivitas= '$jenis_aktivitas', keterangan = '$keterangan', tgl_kunjungan_berikut = '$tgl_kunjungan_berikut', modified_by = '$_SESSION[username]', modified_date = NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());	
										}
										if($edit){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" value="<?php echo $array['tgl_aktivitas']; ?>" disabled>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Jenis Aktivitas</label>
												<select class="form-control select2me" name="jenis_aktivitas">
													<option value="">- Pilih Jenis Aktivitas -</option>
                                    			
                                    				<?php
														$sql=mysql_query("SELECT * FROM ms_aktivitas_part");
															while($row=mysql_fetch_array($sql))
																		{
														$id = $row['id_aktivitas'];	

														if($id == $array['jenis_aktivitas']){
															echo '<option value="'.$id.'" selected="selected">'.$row['aktivitas'].'</option>';
														} else {
															echo '<option value="'.$id.'">'.$row['aktivitas'].'</option>';
																		}
																	}
													?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Foto Visit</label>
												
												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
												<?php if (empty($array['bukti_visit'])) { ?>
													<img src="picture/bukti/noimage.png" >
												<?php } else { ?>
													<img src="picture/bukti/part/<?php echo $array['bukti_visit'];?>" >
												<?php } ?>
												</div>
												<br><br>
												<span class="help-block">Foto Visit Yang Di Unggah Sebelumnya </span>
												<br>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="input-group-addon">
															<input type="file" name="bukti_visit">
														</span>												
													</div>
													<span class="help-block">*Upload Foto Saat Bertemu Dengan Customer </span>							
											</div>
								
											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan" ><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" value="<?php echo $array['tgl_aktivitas']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>
								
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php } elseif($_SESSION[sublevel] == 'service') { ?>

			<div class="row">
				<div class="col-md-6">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Form Edit Aktivitas Service
							</div>

						</div>
						<div class="portlet-body form">
							<div class="tab-content">

								<?php 
            						switch($_GET[aktivitas]){
            						default:
          							break ; 
          						?>

          						<?php case"add_telp": ?>

          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$edit=mysql_query("UPDATE tb_aktivitas_harian_serv SET keterangan = '$keterangan',tgl_kunjungan_berikut ='$tgl_kunjungan_berikut',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian=$id_aktivitas_harian") or die(mysql_error());
										if($edit){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" end-date ="+3d">
													<input type="text" class="form-control" name="tgl_aktivitas" autocomplete="off" value = "<?php echo $array['tgl_aktivitas']; ?>" disabled >
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>								

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan"><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group input-large">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d'>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut" autocomplete="off" value = "<?php echo $array['tgl_kunjungan_berikut']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>

								<?php break ; ?>

								<?php case"add_visit": ?>
										
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$merk_kendaraan = $_POST['merk_kendaraan'];
										$type_kendaraan = $_POST['type_kendaraan'];
										$body_kendaraan = $_POST['body_kendaraan'];
										$no_polisi = $_POST['no_polisi'];
										$no_mesin = $_POST['no_mesin'];
										$no_chasis = $_POST['no_chasis'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$sumber = $_FILES['bukti_visit']['tmp_name'];
                    					$target = 'picture/bukti/service/';
                    					$gambar = $_FILES['bukti_visit']['name'];

                    					move_uploaded_file($sumber, $target.$gambar);

										if(empty($gambar)) {
                    					$edit=mysql_query("UPDATE tb_aktivitas_harian_serv 
                    									   SET tgl_kunjungan_berikut='$tgl_kunjungan_berikut',
                    									   	   merk_kendaraan='$merk_kendaraan',type_kendaraan='$type_kendaraan',
                    									   	   body_kendaraan='$body_kendaraan',no_polisi='$no_polisi',
                    									   	   no_mesin='$no_mesin',no_chasis='$no_chasis',
                    									   	   keterangan='$keterangan',modified_by='$_SESSION[username]',
                    									   	   modified_date=NOW()
                    									   WHERE id_aktivitas_harian = $id_aktivitas_harian") 
                    									   OR DIE(mysql_error());
                    					}else{
										$edit=mysql_query("UPDATE tb_aktivitas_harian_serv 
                    									   SET tgl_kunjungan_berikut='$tgl_kunjungan_berikut',
                    									   	   merk_kendaraan='$merk_kendaraan',type_kendaraan='$type_kendaraan',
                    									   	   body_kendaraan='$body_kendaraan',no_polisi='$no_polisi',
                    									   	   no_mesin='$no_mesin',no_chasis='$no_chasis',
                    									   	   keterangan='$keterangan',bukti_visit='$gambar',
                    									   	   modified_by='$_SESSION[username]',
                    									   	   modified_date=NOW()
                    									   WHERE id_aktivitas_harian = $id_aktivitas_harian") 
                    									   OR DIE(mysql_error());
										}
										if($edit){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_aktivitas"autocomplete="off" value = "<?php echo $array['tgl_aktivitas']; ?>" disabled>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Foto Visit</label>
												
												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
												<?php if (empty($array['bukti_visit'])) { ?>
													<img src="picture/bukti/noimage.png" >
												<?php } else { ?>
													<img src="picture/bukti/service/<?php echo $array['bukti_visit'];?>" >
												<?php } ?>
												</div>
												<br><br>
												<span class="help-block">Foto Visit Yang Di Unggah Sebelumnya </span>
												<br>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="input-group-addon">
															<input type="file" name="bukti_visit">
														</span>												
													</div>
													<span class="help-block">*Upload Foto Saat Bertemu Dengan Customer </span>							
											</div>
									
											<div class="form-group input-xlarge">
												<label class="control-label">Merk Kendaraan</label>
												<select class="form-control select2me" name="merk_kendaraan">
													<option value="">- Pilih Merk Kendaraan -</option>
                                    			
                                    				<?php
														$sql=mysql_query("SELECT * FROM ms_merk ");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['merk'];	
														if($id == $array['merk_kendaraan']){
															echo '<option value="'.$id.'" selected="selected">'.$row['merk'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['merk'].'</option>';
															}}
													?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Model/Type</label>
												<input type="text" class="form-control" autocomplete="off" name="type_kendaraan" value = "<?php echo $array['type_kendaraan']; ?>">
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Karoseri</label>
												<select class="form-control select2me" name="body_kendaraan">
													<option value="">- Pilih Karoseri -</option>
                                    			
                                    				<?php
														$sql=mysql_query("SELECT * FROM ms_karoseri ");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['karoseri'];	
														if($id == $array['body_kendaraan']){
															echo '<option value="'.$id.'" selected="selected">'.$row['karoseri'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
															}}
													?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Polisi</label>
												<input type="text" class="form-control" autocomplete="off" name="no_polisi" value = "<?php echo $array['no_polisi']; ?>">
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Mesin</label>
												<input type="text" class="form-control" autocomplete="off" name="no_mesin" value = "<?php echo $array['no_mesin']; ?>">
											</div>		

											<div class="form-group input-xlarge">
												<label class="control-label">No. Chasis</label>
												<input type="text" class="form-control" autocomplete="off" name="no_chasis" value = "<?php echo $array['no_chasis']; ?>">
											</div>						

											<div class="form-group">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan"><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" value = "<?php echo $array['tgl_kunjungan_berikut']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>

								<?php case"add_handcomp": ?>
									
								<div class="skin skin-square">

									<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$tgl_aktivitas = $_POST['tgl_aktivitas'];
										$tgl_kunjungan_berikut = $_POST['tgl_kunjungan_berikut'];
										$merk_kendaraan = $_POST['merk_kendaraan'];
										$type_kendaraan = $_POST['type_kendaraan'];
										$body_kendaraan = $_POST['body_kendaraan'];
										$no_polisi = $_POST['no_polisi'];
										$no_mesin = $_POST['no_mesin'];
										$no_chasis = $_POST['no_chasis'];
										$initial = $_POST['initial'];
										$initial_visit = $_POST['initial_visit'];
										$detail_problem = addslashes( $_POST['detail_problem'] );
										$penyebab_problem = addslashes( $_POST['penyebab_problem'] );
										$tindakan_problem = addslashes( $_POST['tindakan_problem'] );
										$keterangan = addslashes( $_POST['keterangan'] );

										$edit=mysql_query("UPDATE tb_aktivitas_harian_serv 
                    									   SET tgl_kunjungan_berikut='$tgl_kunjungan_berikut',
                    									   	   merk_kendaraan='$merk_kendaraan',type_kendaraan='$type_kendaraan',
                    									   	   body_kendaraan='$body_kendaraan',no_polisi='$no_polisi',
                    									   	   no_mesin='$no_mesin',no_chasis='$no_chasis',initial='$initial',
                    									   	   initial_visit='$initial_visit',detail_problem='$detail_problem',
                    									   	   penyebab_problem = '$penyebab_problem',
                    									   	   tindakan = '$tindakan_problem',keterangan='$keterangan',
                    									   	   modified_by='$_SESSION[username]',modified_date=NOW()
                    									   WHERE id_aktivitas_harian = $id_aktivitas_harian") 
                    									   OR DIE(mysql_error());

										if($edit){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group">
												<label class="control-label">Tanggal Aktivitas</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-7d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_aktivitas"autocomplete="off" value = "<?php echo $array['tgl_aktivitas']; ?>" disabled>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
	
											<div class="form-group input-xlarge">
												<label class="control-label">Merk Kendaraan</label>
												<select class="form-control select2me" name="merk_kendaraan">
													<option value="">- Pilih Merk Kendaraan -</option>
                                    			
                                    				<?php
														$sql=mysql_query("SELECT * FROM ms_merk ");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['merk'];	
														if($id == $array['merk_kendaraan']){
															echo '<option value="'.$id.'" selected="selected">'.$row['merk'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['merk'].'</option>';
															}}
													?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Model/Type</label>
												<input type="text" class="form-control" autocomplete="off" name="type_kendaraan" value = "<?php echo $array['type_kendaraan']; ?>">
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Karoseri</label>
												<select class="form-control select2me" name="body_kendaraan">
													<option value="">- Pilih Karoseri -</option>
                                    			
                                    				<?php
														$sql=mysql_query("SELECT * FROM ms_karoseri ");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['karoseri'];	
														if($id == $array['body_kendaraan']){
															echo '<option value="'.$id.'" selected="selected">'.$row['karoseri'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
															}}
													?>

												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Polisi</label>
												<input type="text" class="form-control" autocomplete="off" name="no_polisi" value = "<?php echo $array['no_polisi']; ?>">
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">No. Mesin</label>
												<input type="text" class="form-control" autocomplete="off" name="no_mesin" value = "<?php echo $array['no_mesin']; ?>">
											</div>		

											<div class="form-group input-xlarge">
												<label class="control-label">No. Chasis</label>
												<input type="text" class="form-control" autocomplete="off" name="no_chasis" value = "<?php echo $array['no_chasis']; ?>">
											</div>	

											<div class="form-group input-xlarge">	
												<label class="control-label">Initial</label>
												<select class="form-control" name="initial" required>
													<option value="">- Pilih Initial -</option>
													<option value="Dealer Visit" <?php if($array['initial'] == 'Dealer Visit') { echo "selected"; } ?>>Dealer Visit</option>
													<option value="Customer Datang" <?php if($array['initial'] == 'Customer Datang') { echo "selected"; } ?>>Customer Datang - Konsultasi</option>
												</select>
											</div>

											<div class="form-group input-xlarge">	
												<label class="control-label">Pilih Initial Visit</label>
												<select class="form-control" name="initial_visit">
													<option value="">- Pilih Initial Visit -</option>
													<option value="Free" <?php if($array['initial_visit'] == 'Free') { echo "selected"; } ?>>Free Inspection</option>
													<option value="Tidak" <?php if ($array['initial_visit'] == 'Tidak' ) { echo "selected" ; }?>>Tidak</option>
												</select>
											</div>

											<div class="form-group">
												<label class="control-label">Detail Problem</label>
												<textarea type="text" class="form-control" autocomplete="off" name="detail_problem"><?php echo $array['detail_problem']; ?></textarea>
											</div>

											<div class="form-group">
												<label class="control-label">Penyebab Problem</label>
												<textarea type="text" class="form-control" autocomplete="off" name="penyebab_problem"><?php echo $array['penyebab_problem']; ?></textarea>
											</div>

											<div class="form-group">
												<label class="control-label">Tindakan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="tindakan_problem"><?php echo $array['tindakan']; ?></textarea>
											</div>

											<div class="form-group">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" autocomplete="off" name="keterangan"><?php echo $array['keterangan']; ?></textarea>
											</div>							

											<div class="form-group">
												<label class="control-label">Tanggal Knjungan Berikut</label>
												<div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" endDate: '+3d',>
													<input type="text" class="form-control" name="tgl_kunjungan_berikut"autocomplete="off" value = "<?php echo $array['tgl_kunjungan_berikut']; ?>">
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>														
										</div>		
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
										
								<?php break ; ?>
								
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php break; ?>

			<?php case "hasil_survey": ?>
			
			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Hasil Survey
							</div>
						</div>
						<div class="portlet-body form">
							<div class="tab-content">
          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$hasil_survey = $_POST['hasil_survey'];
										$keterangan = addslashes( $_POST['keterangan'] );

										$tambah=mysql_query("UPDATE tb_survey SET hasil_survey='$hasil_survey', keterangan='$keterangan',modified_by='$_SESSION[username]',modified_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());
										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Hasil Survey</label>
												<select class="form-control select2" name="hasil_survey">
													<option value="OK">OK</option>
													<option value="OK Bersyarat">OK Bersyarat</option>
                                    				<option value="Tidak OK">Tidak OK</option>
												</select>
											</div>								

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan" required></textarea>
											</div>							
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php break ; ?>

			<?php case "catatan_spv": ?>
			
			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Catatan SPV
							</div>
						</div>
						<div class="portlet-body form">
							<div class="tab-content">
          						<div class="skin skin-square">

          							<?php
										error_reporting (E_ALL ^ E_NOTICE);

										$post = (!empty($_POST)) ? true : false;
										if($post){
											$error = '';

										if(empty($error)){

										$keterangan = addslashes( $_POST['keterangan'] );

										if($_SESSION[sublevel] == 'unit') {
											$update=mysql_query("UPDATE tb_aktivitas_harian_unit SET catatan='$keterangan', catatan_by='$_SESSION[username]',catatan_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());
										}elseif($_SESSION[sublevel] == 'part'){ 
											$update=mysql_query("UPDATE tb_aktivitas_harian_part SET catatan='$keterangan', catatan_by='$_SESSION[username]',catatan_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error());
										}elseif($_SESSION[sublevel] == 'service'){
											$update=mysql_query("UPDATE tb_aktivitas_harian_serv SET catatan='$keterangan', catatan_by='$_SESSION[username]',catatan_date=NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian") or die(mysql_error()); 
										}
										if($update){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=4');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">							

											<div class="form-group input-xlarge">
												<label class="control-label">Keterangan</label>
												<textarea type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Keterangan" required></textarea>
											</div>							
														
										</div>
													
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>" type="button" class="btn default">Cancel</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php break ; ?>

			<?php case "delete": ?>

				<?php if ($_SESSION[sublevel] == 'unit') {
			
				$delete_aktivitas = mysql_query("UPDATE tb_aktivitas_harian_unit SET deleted_flag = 1 , deleted_by= '$_SESSION[username]', deleted_date = NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian");

				if($delete_aktivitas){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=3');
					}

				} elseif ($_SESSION[sublevel] == 'part') {

				$delete_aktivitas = mysql_query("UPDATE tb_aktivitas_harian_part SET deleted_flag = 1 , deleted_by= '$_SESSION[username]', deleted_date = NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian");

				if($delete_aktivitas){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=3');
					}

				} elseif ($_SESSION[sublevel] == 'service') {

				$delete_aktivitas = mysql_query("UPDATE tb_aktivitas_harian SET deleted_flag = 1 , deleted_by= '$_SESSION[username]', deleted_date = NOW() WHERE id_aktivitas_harian = $id_aktivitas_harian");

				if($delete_aktivitas){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=3');
					}
				} ?>

			<?php break; ?>

			<?php } ?>

		</div>
</div>