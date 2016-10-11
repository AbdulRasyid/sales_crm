<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Customer Data <small>Management</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.php">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="index.php?page=mod_customer_data">Customer Data</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					
					<!-- BEGIN FORM WIZARD -->
					<div class="portlet box purple" id="form_wizard_1">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-users"></i> Tambah Customer Baru - <span class="step-title">
								Step 1 of 4 </span>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form" method="POST">
								<div class="form-wizard">
									<div class="form-body">
										
										<ul class="nav nav-pills nav-justified steps">
											<li>
												<a href="#tab1" data-toggle="tab" class="step">
												<span class="number">
												1 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Detail Customer </span>
												</a>
											</li>
											<li>
												<a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Profile Customer </span>
												</a>
											</li>
											<li>
												<a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Data Customer </span>
												</a>
											</li>
											<li>
												<a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Konfirmasi </span>
												</a>
											</li>
										</ul>

										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
											</div>
										</div>

										<div class="tab-content">
											
											<!-- BEGIN NOTIFIKASI -->
											<div class="alert alert-danger display-none">
												<button class="close" data-dismiss="alert"></button>
												Silahkan cek lagi, Isi field yang diperlukan
											</div>
											<div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div>
											<!-- END NOTIFIKASI -->

											<div class="tab-pane active" id="tab1">
												
											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Kode Customer 
														<span class="required"> * </span>
													</label>
													<div class="col-md-5">
														<input type="text" class="form-control"  name="kode_customer"/>
														<span class="help-block">
														Kode Customer Bersifat Permanen </span>
													</div>
												</div>
												</div>
												
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Bidang Usaha 
														<span class="required"> * </span>
													</label>
													<div class="col-md-7">
														<select class="form-control select2me" name="id_bidang_usaha">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">		
													<div class="form-group">
														<label class="control-label col-md-3">Asal Prospek 
															<span class="required">* </span>
														</label>
													<div class="col-md-7">
													<select class="form-control select2me" name="id_asal_prospek">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
													</div>
												</div>
												
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Database <span class="required">
													* </span>
													</label>
													<div class="col-md-7">
													<select class="form-control select2me" name="id_database">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">		
												<div class="form-group">
													<label class="control-label col-md-3">Main Segmen <span class="required">
													* </span>
													</label>
													<div class="col-md-7">
													<select class="form-control" name="id_main_segmen">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												</div>
												
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Sub Segmen <span class="required">
													* </span>
													</label>
													<div class="col-md-7">
													<select class="form-control select2me" name="id_sub_segmen">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												</div>
											</div>
											
											<h3 class="form-section">Unit Yang Dimiliki</h3>
											
											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-7">Unit Hino <span class="required">
													* </span>
													</label>
													<div class="col-md-2">
														<input type="text" class="form-control" autocomplete="off" name="unit_hino"/>
													</div>
												</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-7">Unit Toyota
														<span class="required"> * </span>
													</label>
													<div class="col-md-2">
														<input type="text" class="form-control" autocomplete="off"  name="unit_toyota"/>
													</div>
												</div>
												</div>
												<div class="col-md-4">
												<div class="form-group">
													<label class="control-label col-md-4">Unit Mitsubishi
														<span class="required"> * </span>
													</label>
													<div class="col-md-3">
														<input type="text" class="form-control" autocomplete="off"  name="unit_mitsubishi"/>
													</div>
												</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-7">Unit Isuzu
														<span class="required"> * </span>
													</label>
													<div class="col-md-2">
														<input type="text" class="form-control" autocomplete="off"  name="unit_isuzu"/>
													</div>
												</div>
												</div>
												<div class="col-md-4">
												<div class="form-group">
													<label class="control-label col-md-4">Unit Lain
														<span class="required"> * </span>
													</label>
													<div class="col-md-3">
														<input type="text" class="form-control" autocomplete="off"  name="unit_lain"/>
													</div>
												</div>
												</div>
											</div>
										
											</div>

											<div class="tab-pane" id="tab2">

												<div class="form-group">
													<label class="control-label col-md-3">Nama Perusahaan / Instansi / Pribadi <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control uppercase" autocomplete="off"  name="nama_kantor"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Nama Pengurus / Pemilik <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control uppercase" autocomplete="off"  name="nama_customer"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Jabatan <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control uppercase" autocomplete="off"  name="jabatan_customer"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Nomor KTP
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" autocomplete="off"  name="no_ktp"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Email</label>
													<div class="col-md-4">
														<input type="text" class="form-control" autocomplete="off" name="email_customer"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">No. Handphone <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" autocomplete="off" name="no_hp"/>
														<span class="help-block">
														Provide your phone number </span>
													</div>
												</div>
												<divider>
												<div class="form-group">
													<label class="control-label col-md-3">Alamat Rumah <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control uppercase" autocomplete="off"  name="alamat_rumah"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">RT
													</label>
													<div class="col-md-1">
														<input type="text" class="form-control" autocomplete="off" name="rt_rumah"/>
													</div>
												</div>
											
												<div class="form-group">
													<label class="control-label col-md-4">RW
													</label>
													<div class="col-md-1">
														<input type="text" class="form-control" autocomplete="off" name="rw_rumah"/>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label col-md-4">Kode Pos
														<span class="required"> * </span>
													</label>
													<div class="col-md-2">
														<input type="text" class="form-control" autocomplete="off" name="kode_pos_rumah"/>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label col-md-4">Kota <span class="required">
													* </span>
													</label>
													<div class="col-md-3">
														<input type="text" class="form-control uppercase" autocomplete="off"  name="kota_rumah"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Telp. Rumah</label>
													<div class="col-md-4">
														<input type="text" class="form-control" autocomplete="off" name="telp_rumah"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Alamat Kantor <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control uppercase" autocomplete="off"  name="alamat_kantor"/>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label col-md-4">Kode Pos
														<span class="required"> * </span>
													</label>
													<div class="col-md-2">
														<input type="text" class="form-control" autocomplete="off" name="kode_pos_kantor"/>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label col-md-4">Kota <span class="required">
													* </span>
													</label>
													<div class="col-md-3">
														<input type="text" class="form-control uppercase" autocomplete="off"  name="kota_kantor"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Telp. Kantor</label>
													<div class="col-md-4">
														<input type="text" class="form-control" autocomplete="off" name="telp_kantor"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Faximile</label>
													<div class="col-md-4">
														<input type="text" class="form-control" autocomplete="off" name="fax_kantor"/>
													</div>
												</div>
												
											</div>

											<div class="tab-pane" id="tab3">

												<div class="form-group">
													<label class="control-label col-md-3">Gender <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<div class="radio-list">
															<label>
															<input type="radio" name="gender" value="M" data-title="Male"/>
															Male </label>
															<label>
															<input type="radio" name="gender" value="F" data-title="Female"/>
															Female </label>
														</div>
														<div id="form_gender_error">
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Golongan Darah <span class="required"> * </span>
													</label>
													<div class="col-md-4">
													<select class="form-control select2me" name="gol_darah">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Agama <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
													<select class="form-control select2me" name="id_agama">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Status Perkawinan <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
													<select class="form-control select2me" name="id_status">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Kewarganegaraan <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
													<select class="form-control select2me" name="id_warga">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Hobi <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
													<select class="form-control select2me" name="id_hobi">
														<option value="">Select...</option>
														<option value="Option 1">Option 1</option>
														<option value="Option 2">Option 2</option>
														<option value="Option 3">Option 3</option>
														<option value="Option 4">Option 4</option>
													</select>
												</div>
												</div>
											</div>
											
											<div class="tab-pane" id="tab4">
												<h3 class="block">Konfirmasi Input Customer Baru</h3>
																																			
												<div class="form-group">
													<label class="control-label col-md-3">Kode Customer :</label>
													<div class="col-md-5">
														<p class="form-control-static" data-display="kode_customer">
														</p>
													</div>
												</div>
																								
												<div class="form-group">
													<label class="control-label col-md-3">Bidang Usaha :</label>
													<div class="col-md-7">
														<p class="form-control-static" data-display="id_bidang_usaha">
														</p>
													</div>
												</div>
												
												
												<div class="form-group">
													<label class="control-label col-md-3">Asal Prospek :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="id_asal_prospek">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Database :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="id_database">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Main Segmen :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="id_main_segmen">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Sub Segmen :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="id_sub_segmen">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Unit Hino :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="unit_hino">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Unit Toyota :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="unit_toyota">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Unit Isuzu :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="unit_isuzu">
														</p>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Unit Mitsubishi :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="unit_mitsubishi">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Unit Lain :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="unit_lain">
														</p>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Nama Perusahaan / Instansi / Pribadi :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="nama_kantor">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Nama Pengurus / Pemilik :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="nama_customer">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Jabatan :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="jabatan_customer">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">No KTP :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="no_ktp">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Email :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="email_customer">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">No Handphone :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="no_hp">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Alamat Rumah :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="alamat_rumah">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">RT :</label>
													<div class="col-md-1">
														<p class="form-control-static" data-display="rt_rumah">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">RW :</label>
													<div class="col-md-1">
														<p class="form-control-static" data-display="rw_rumah">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">Kode Pos :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="kode_pos_rumah">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">Kota :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="kota_rumah">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Telepon Rumah :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="tlp_rumah">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Alamat Kantor :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="alamat_kantor">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">Kode Pos :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="kode_pos_kantor">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">Kota :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="kota_kantor">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Telepon Kantor :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="tlp_kantor">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Faximile :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="fax_kantor">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Jenis Kelamin :</label>
													<div class="col-md-1">
														<p class="form-control-static" data-display="gender">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Golongan Darah :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="id_gol_darah">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Agama :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="id_agama">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Status Perkawinan :</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="id_status">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Kewarganegaraan :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="id_warga">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Hobi :</label>
													<div class="col-md-3">
														<p class="form-control-static" data-display="id_hobi">
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<a href="javascript:;" class="btn default button-previous">
												<i class="m-icon-swapleft"></i> Back </a>
												<a href="javascript:;" class="btn blue button-next">
												Continue <i class="m-icon-swapright m-icon-white"></i>
												</a>
												<a href="javascript:;" class="btn green button-submit">
												Submit <i class="m-icon-swapright m-icon-white"></i>
												</a>
											</div>
										</div>
									</div>

								</div>
							</form>
						</div>
					</div>
					<!-- END FORM WIZARD -->

				</div>
			</div>
			<!-- END PAGE CONTENT-->

		</div>
</div>