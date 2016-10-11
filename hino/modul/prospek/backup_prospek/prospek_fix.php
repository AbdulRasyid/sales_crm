<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Prospek Unit <small>Manage</small>
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
			<?php $id_pelanggan = $_GET['id_pelanggan']; ?>

			<?php 
			switch($_GET[act]) {
  			default:
 			?>

 			<?php break ; ?>

 			<?php case "add": ?> 

			<!-- BEGIN PAGE CONTENT-->
		
			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-settings"></i> Form Tambah Prospek Unit
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

										$tgl_prospek = $_POST['tgl_prospek'];
										$no_prospek = $_POST['no_prospek'];
										$test_drive = $_POST['test_drive'];
										

										$id_kendaraan = $_POST['id_kendaraan'];
										$id_tipe_kendaraan = $_POST['id_tipe_kendaraan'];
										$id_warna = $_POST['id_warna'];
										$id_karoseri = $_POST['id_karoseri'];
										$jumlah = $_POST['jumlah'];

										$id_pembayaran = $_POST['id_pembayaran'];
										$id_lembaga = $_POST['id_lembaga'];
										$id_cabang = $_POST['id_cabang'];
										$id_dp = $_POST['id_dp'];
										$tenor - $_POST['tenor'];

										$id_status_prospek = $_POST['id_status_prospek'];
										$cek_money = $_POST['cek_money'];
										$ket_money = $_POST['ket_money'];
										$cek_auth = $_POST['cek_auth'];
										$ket_auth = $_POST['ket_auth'];
										$cek_need = $_POST['cek_need'];
										$ket_need = $_POST['ket_need'];



										$keterangan = addslashes( $_POST['keterangan'] );

										if($id_pembayaran == '1'){
											if($id_status_prospek == '1') {
												$tambah=mysql_query("INSERT INTO tb_prospek (
																	 id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,
																	 id_warna,id_karoseri,tgl_prospek,no_prospek,test_drive,
																	 jml_kendaraan,id_pembayaran,id_status_prospek,created_by,
																	 created_date,deleted_flag,tgl_touch,cek_money,cek_auth,
																	 cek_need,ket_money,ket_auth,ket_need)  
																	 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan'
																	 ,'$id_warna','$id_karoseri','$tgl_prospek','$no_prospek'
																	 ,'$test_drive','$jumlah','$id_pembayaran','$id_status_prospek'
																	 ,'$_SESSION[username]',NOW(),0,NOW(),'$cek_money','$cek_auth'
																	 ,'$cek_need','$ket_money','$ket_auth','$ket_need') ") 
																	or die(mysql_error());
											} elseif($id_status_prospek == '2') {
												$tambah=mysql_query("INSERT INTO tb_prospek (
																	 id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,
																	 id_warna,id_karoseri,tgl_prospek,no_prospek,test_drive,
																	 jml_kendaraan,id_pembayaran,id_status_prospek,created_by,
																	 created_date,deleted_flag,tgl_touch,cek_money,cek_auth,
																	 cek_need,ket_money,ket_auth,ket_need)  
																	 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan'
																	 ,'$id_warna','$id_karoseri','$tgl_prospek','$no_prospek'
																	 ,'$test_drive','$jumlah','$id_pembayaran','$id_status_prospek'
																	 ,'$_SESSION[username]',NOW(),0,NOW(),'$cek_money','$cek_auth'
																	 ,'$cek_need','$ket_money','$ket_auth','$ket_need') ") 
																	or die(mysql_error());
											} elseif($id_status_prospek == '3') {
												$tambah=mysql_query("INSERT INTO tb_prospek (
																	 id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,
																	 id_warna,id_karoseri,tgl_prospek,no_prospek,test_drive,
																	 jml_kendaraan,id_pembayaran,id_status_prospek,created_by,
																	 created_date,deleted_flag,tgl_touch,cek_money,cek_auth,
																	 cek_need,ket_money,ket_auth,ket_need)  
																	 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan'
																	 ,'$id_warna','$id_karoseri','$tgl_prospek','$no_prospek'
																	 ,'$test_drive','$jumlah','$id_pembayaran','$id_status_prospek'
																	 ,'$_SESSION[username]',NOW(),0,NOW(),'$cek_money','$cek_auth'
																	 ,'$cek_need','$ket_money','$ket_auth','$ket_need' )") 
																	or die(mysql_error());
											} elseif($id_status_prospek == '4') {

											}
										} elseif ($id_pembayaran == '2') {
											if($id_status_prospek == '1') {
												$tambah=mysql_query("INSERT INTO tb_prospek (
																	 id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,
																	 id_warna,id_karoseri,tgl_prospek,no_prospek,test_drive,
																	 jml_kendaraan,id_pembayaran,id_status_prospek,created_by,
																	 created_date,deleted_flag,tgl_touch,cek_money,cek_auth,
																	 cek_need,ket_money,ket_auth,ket_need)  
																	 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan'
																	 ,'$id_warna','$id_karoseri','$tgl_prospek','$no_prospek'
																	 ,'$test_drive','$jumlah','$id_pembayaran','$id_status_prospek'
																	 ,'$_SESSION[username]',NOW(),0,NOW(),'$cek_money','$cek_auth'
																	 ,'$cek_need','$ket_money','$ket_auth','$ket_need')") 
																	or die(mysql_error());

												$q = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          								    	$r = mysql_fetch_array($q);

													mysql_query("INSERT INTO tb_kredit(id_kredit,id_kota_perusahaan,id_perusahaan,
																 id_dp,tenor,id_prospek)  
																 VALUES('','$id_cabang','$id_lembaga','$id_dp','$tenor','$r[getID]')") or die(mysql_error());

											} elseif($id_status_prospek == '2') {

											} elseif($id_status_prospek == '3') {

											} elseif($id_status_prospek == '4') {
												
											}
										}
										

											

										if($tambah){
										header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=1');

											}
										}
											}
									?>

									<form action="#" enctype="multipart/form-data" method="post">
										<div class="form-body">

											<div class="form-group input-large">
												<label class="control-label">Tanggal Prospek</label>
												<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
													<input type="text" class="form-control" name="tgl_prospek" autocomplete="off" required>
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
											
											<div class="form-group input-large">
												<label class="control-label">No. Prospek</label>
												<input type="text" class="form-control" autocomplete="off" name="no_prospek" placeholder="No. Prospek" required>
											</div>	

											<div class="form-group">
												<label>Test Drive</label>
												<div class="radio-list"> 			
													<label class="radio-inline"> 
													<input type="radio" name="test_drive" value="Y"> Ya </label>
													<label class="radio-inline">
													<input type="radio" name="test_drive" value="N"> Tidak </label>
												</div>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Pilih Kendaraan</label>
												<select class="form-control merk" name="id_kendaraan" required>
													<option value="">- Merk Kendaraan -</option>
														<?php
															$sql=mysql_query("SELECT * FROM ms_kendaraan WHERE id_kendaraan IN (2,3)");
																while($row=mysql_fetch_array($sql))
																				{
															$id = $row['id_kendaraan'];	
																echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																				}
														?>
												</select>								
											</div>

											<div class="form-group input-xlarge">	
												<label class="control-label">Pilih Model/Type</label>
												<select class="form-control select2 model" name="id_tipe_kendaraan" required>
													<option value="">- Pilih Model/Type -</option>
										
												</select>
											</div>

											<div class="form-group input-xlarge">	
												<label class="control-label">Pilih Warna</label>
												<select class="form-control warna" name="id_warna">
													<option value="">- Pilih Warna -</option>
										
												</select>
											</div>

											<div class="form-group input-xlarge">
												<label class="control-label">Pilih Karoseri</label>
												<select class="form-control select2me" name="id_karoseri" required>
													<option value="">- Pilih Karoseri -</option>
														<?php
															$sql=mysql_query("SELECT * FROM ms_karoseri");
																while($row=mysql_fetch_array($sql))
																				{
															$id = $row['id_karoseri'];	
																echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																				}
														?>
												</select>								
											</div>

											<div class="form-group input-small">
												<label class="control-label">Jumlah</label>
												<input type="text" class="form-control" autocomplete="off" name="jumlah" placeholder="Jumlah" required>
											</div>							

											<div class="form-group input-large">	
												<label class="control-label">Pembayaran</label>
												<select class="form-control pembayaran" name="id_pembayaran">
													<option value="">Pilih Pembayaran</option>
													<option value="1">Cash/Tunai</option>
													<option value="2">Kredit</option>
												</select>
											</div>

											<div class="form-group input-large">	
												<label class="control-label">Status Prospek</label>
												<select class="form-control status" name="id_status_prospek">
													<option value="">Pilih Status Prospek</option>
														<?php
															$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (1,2,3,4) ORDER BY urutan");
																while($row=mysql_fetch_array($sql))
																				{
															$id = $row['id_status_prospek'];	
																echo '<option value="'.$id.'">'.$row['status_prospek'].'</option>';
																				}
														?>
												</select>
											</div>

										</div>		
										<div class="form-actions">
											<button type="submit" class="btn blue" value="Input">Submit</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</form>
								</div>										

							</div>
						</div>
					</div>
				</div>

				<br><br>
				
				<div class="col-md-5 kredit">				
				</div>
				
				<div class="col-md-5 prospek">
				</div>
				
			</div>

			<?php break; ?>

			<?php case "edit" : ?>

			<?php 
				$id_aktivitas_harian = $_GET['id_aktivitas_harian'];	

				if ($_SESSION[sublevel] == 'unit') {   	
				$result = mysql_query("SELECT * FROM tb_aktivitas WHERE id_pelanggan='$id_pelanggan'");
				
				}elseif ($_SESSION[sublevel] == 'part') {
				$result = mysql_query("SELECT * FROM tb_aktivitas_harian_part WHERE id_aktivitas_harian='$id_aktivitas_harian'");
				
				}elseif ($_SESSION[sublevel] == 'service') {
				$result = mysql_query("SELECT * FROM tb_aktivitas_harian_serv WHERE id_aktivitas_harian='$id_aktivitas_harian'");
				} 
				$array = mysql_fetch_array($result);
			?>

			<?php break; ?>

			<?php case "delete": ?>

			<?php break; ?>

			<?php } ?>

		</div>
</div>