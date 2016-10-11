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
			
			<?php
				$id_pelanggan = $_GET['id_pelanggan']; 
				$id_prospek = $_GET['id_prospek'];

				$result = mysql_query("SELECT a.id_prospek,a.id_pelanggan,a.tgl_prospek,a.no_prospek,b.id_kendaraan,b.merk,
											  c.id_tipe_kendaraan,c.tipe,d.id_warna,d.warna,e.id_karoseri,e.karoseri,
											  a.test_drive,a.jml_kendaraan,a.id_pembayaran,f.id_perusahaan,f.perusahaan,
											  g.id_kota_perusahaan,g.kota_perusahaan,h.id_dp,h.dp,w.tenor,i.id_status_prospek,
											  i.status_prospek,a.tgl_touch,a.tgl_nego,a.tgl_hot,x.tgl_spk,y.tgl_purchase_order,
											  z.tgl_do,a.cek_money,a.cek_auth,a.cek_need,a.ket_money,a.ket_auth,a.ket_need,
											  x.no_spk,y.estimated_delivery,y.status,y.no_purchase_order,
											  u.id_analisa_lost,v.analisa_lost,a.created_by,a.created_date
									   FROM tb_prospek a
									   LEFT JOIN tb_kredit w ON w.id_prospek = a.id_prospek
									   LEFT JOIN tb_spk x ON x.id_prospek = a.id_prospek
									   LEFT JOIN tb_po y ON y.id_prospek = a.id_prospek
									   LEFT JOIN tb_do z ON z.id_prospek = a.id_prospek
									   LEFT JOIN tb_lost u ON u.id_prospek = a.id_prospek
									   LEFT JOIN ms_analisa_lost v ON v.id_p_analisa_lost = u.id_analisa_lost
									   LEFT JOIN ms_kendaraan b ON b.id_kendaraan = a.id_kendaraan
									   LEFT JOIN ms_tipe_kendaraan c ON c.id_tipe_kendaraan = a.id_tipe_kendaraan
									   LEFT JOIN ms_warna d ON d.id_warna = a.id_warna
									   LEFT JOIN ms_karoseri e ON e.id_karoseri = a.id_karoseri
									   LEFT JOIN ms_perusahaan f ON f.id_perusahaan = w.id_perusahaan
									   LEFT JOIN ms_kota_perusahaan g ON g.id_kota_perusahaan = w.id_kota_perusahaan
									   LEFT JOIN ms_dp h ON h.id_dp = w.id_dp
									   LEFT JOIN ms_status_prospek i ON i.id_status_prospek = a.id_status_prospek
									   WHERE a.id_prospek = '$id_prospek'"); 
				$array = mysql_fetch_array($result);
			?>

			<?php 
			switch($_GET[act]) {
  			default:
 			?>

 			<?php break ; ?>

 			<?php case "add": ?> 
	
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
					$tenor = $_POST['tenor'];

					$id_status_prospek = $_POST['id_status_prospek'];
					$cek_money = $_POST['cek_money'];
					$ket_money = $_POST['ket_money'];
					$cek_auth = $_POST['cek_auth'];
					$ket_auth = $_POST['ket_auth'];
					$cek_need = $_POST['cek_need'];
					$ket_need = $_POST['ket_need'];

					$tgl_spk = $_POST['tgl_spk'];
					$no_spk = $_POST['no_spk'];

					$tgl_estimasi = $_POST['tgl_estimasi'];
					$status = $_POST['status'];
					$tgl_po = $_POST['tgl_po'];
					$no_po = $_POST['no_po'];

					$tgl_do = $_POST['tgl_do'];
					$no_rangka = $_POST['no_rangka'];
					$no_mesin = $_POST['no_mesin'];
					$no_nota = $_POST['no_nota'];

					$id_analisa = $_POST['id_analisa'];
					$keterangan = addslashes( $_POST['keterangan'] );

				if($id_pembayaran == '1'){
					if($id_status_prospek == '1') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_touch,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());
					
					} elseif($id_status_prospek == '2') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_nego,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());
											
					} elseif($id_status_prospek == '3') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_hot,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());
					
					} elseif($id_status_prospek == '4') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_hot,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());
						
						$spk = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_spk = mysql_fetch_array($spk);

							mysql_query("INSERT INTO tb_spk(id_spk,id_pelanggan,id_prospek,tgl_spk,no_spk,plat,created_date,
															created_by)  
										 VALUES('','$id_pelanggan','$r_spk[getID]','$tgl_spk','$no_spk','hitam',NOW(),'$_SESSION[username]')")
										 OR DIE(mysql_error());
					}
				
				} elseif ($id_pembayaran == '2') {
					if($id_status_prospek == '1') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_touch,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());

						$kr = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_kr = mysql_fetch_array($kr);

							mysql_query("INSERT INTO tb_kredit(id_kredit,id_kota_perusahaan,id_perusahaan,id_dp,tenor,id_prospek)  
										 VALUES('','$id_cabang','$id_lembaga','$id_dp','$tenor','$r_kr[getID]')")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '2') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_touch,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());

						$kr = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_kr = mysql_fetch_array($kr);

							mysql_query("INSERT INTO tb_kredit(id_kredit,id_kota_perusahaan,id_perusahaan,id_dp,tenor,id_prospek)  
										 VALUES('','$id_cabang','$id_lembaga','$id_dp','$tenor','$r_kr[getID]')")
										 OR DIE(mysql_error());
					} elseif($id_status_prospek == '3') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_touch,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());

						$kr = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_kr = mysql_fetch_array($kr);

							mysql_query("INSERT INTO tb_kredit(id_kredit,id_kota_perusahaan,id_perusahaan,id_dp,tenor,id_prospek)  
										 VALUES('','$id_cabang','$id_lembaga','$id_dp','$tenor','$r[getID]')")
										 OR DIE(mysql_error());
					} elseif($id_status_prospek == '4') {
						$tambah=mysql_query("INSERT INTO tb_prospek (
												id_prospek,id_pelanggan,id_kendaraan,id_tipe_kendaraan,id_warna,id_karoseri,
												tgl_prospek,no_prospek,test_drive,jml_kendaraan,id_pembayaran,id_status_prospek,
												created_by,created_date,deleted_flag,tgl_touch,cek_money,cek_auth,cek_need,
												ket_money,ket_auth,ket_need)  
											 VALUES('','$id_pelanggan','$id_kendaraan','$id_tipe_kendaraan','$id_warna',
											 	'$id_karoseri','$tgl_prospek','$no_prospek','$test_drive','$jumlah',
											 	'$id_pembayaran','$id_status_prospek','$_SESSION[username]',NOW(),0,NOW(),
											 	'$cek_money','$cek_auth','$cek_need','$ket_money','$ket_auth','$ket_need') ") 
											 or die(mysql_error());

						$kr = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_kr = mysql_fetch_array($kr);

							mysql_query("INSERT INTO tb_kredit(id_kredit,id_kota_perusahaan,id_perusahaan,id_dp,tenor,id_prospek)  
										 VALUES('','$id_cabang','$id_lembaga','$id_dp','$tenor','$r[getID]')")
										 OR DIE(mysql_error());

						$spk = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_spk = mysql_fetch_array($spk);

							mysql_query("INSERT INTO tb_spk(id_spk,id_pelanggan,id_prospek,tgl_spk,no_spk,plat,created_date,
															created_by)  
										 VALUES('','$id_pelanggan','$r_spk[getID]','$tgl_spk','$no_spk','hitam',NOW(),'$_SESSION[username]')")
										 OR DIE(mysql_error());

					}
				
				}
				
				if($tambah){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=2');

								}
							}
						}
			?>

			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-settings"></i> Form Tambah Prospek Unit
					</div>
				</div>
				
				<div class="portlet-body form">
					<form action="#" enctype="multipart/form-data" method="post">
						<div class="form-body">
							
								<h4 class="form-section">Detail Prospek</h4>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Prospek</label>
											<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
											<input type="text" class="form-control" name="tgl_prospek" autocomplete="off" required>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Prospek</label>
											<input type="text" class="form-control" autocomplete="off" name="no_prospek" placeholder="No. Prospek" required>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label>Test Drive</label>
											<div class="radio-list"> 			
												<label class="radio-inline"> 
												<input type="radio" name="test_drive" value="Y"> Ya </label>
												<label class="radio-inline">
												<input type="radio" name="test_drive" value="N"> Tidak </label>
											</div>
										</div>
									</div>

								</div> <hr>

								<h4 class="form-section">Unit Prospek</h4>
								
								<div class="row">
													
									<div class="col-md-3">
										<div class="form-group">
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
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Model/Type</label>
											<select class="form-control select2 model" name="id_tipe_kendaraan" required>
												<option value="">- Pilih Model/Type -</option>
										
											</select>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Warna</label>
												<select class="form-control warna" name="id_warna">
													<option value="">- Pilih Warna -</option>
										
												</select>
										</div>
									</div>

								</div>

								<div class="row">
											
									<div class="col-md-3">
										<div class="form-group">
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
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Jumlah</label>
											<input type="text" class="form-control" autocomplete="off" name="jumlah" placeholder="Jumlah" required>
										</div>
									</div>

								</div> <hr>
							
								<h4 class="form-section">Metode Pembayaran</h4>
								
								<div class="row">
									
									<div class="col-md-3 ">
										<div class="form-group">
											<label class="control-label">Pembayaran</label>
											<select class="form-control pembayaran" name="id_pembayaran">
												<option value="">Pilih Pembayaran</option>
												<option value="1">Cash/Tunai</option>
												<option value="2">Kredit</option>
											</select>
										</div>
									</div>

								</div>

								<!-- Load Pembayaran Kredit -->
								<div class="kredit"> </div> <hr>
								<!-- Load Pembayaran Kredit -->

								<h4 class="form-section">Status Prospek</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
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

								</div> <hr>

								<!-- Load Pembayaran Kredit -->
								<div class="prospek"> </div>
								<!-- Load Pembayaran Kredit -->
	
						</div>
						<div class="form-actions right">
							<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>"><button type="button" class="btn default">Cancel</button></a>
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
						</div>
					</form>

				</div>
			</div>


			<?php break; ?>

			<?php case "edit" : ?>

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
					$tenor = $_POST['tenor'];

					$id_status_prospek = $_POST['id_status_prospek'];
					$cek_money = $_POST['cek_money'];
					$ket_money = $_POST['ket_money'];
					$cek_auth = $_POST['cek_auth'];
					$ket_auth = $_POST['ket_auth'];
					$cek_need = $_POST['cek_need'];
					$ket_need = $_POST['ket_need'];

					$tgl_spk = $_POST['tgl_spk'];
					$no_spk = $_POST['no_spk'];

					$tgl_estimasi = $_POST['tgl_estimasi'];
					$status = $_POST['status'];
					$tgl_po = $_POST['tgl_po'];
					$no_po = $_POST['no_po'];

					$tgl_do = $_POST['tgl_do'];
					$no_rangka = $_POST['no_rangka'];
					$no_mesin = $_POST['no_mesin'];
					$no_nota = $_POST['no_nota'];

					$id_analisa = $_POST['id_analisa'];
					$keterangan = addslashes( $_POST['keterangan'] );

				if($id_pembayaran == '1'){
					if($id_status_prospek == '1') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());
					
					} elseif($id_status_prospek == '2') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_nego = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());
											
					} elseif($id_status_prospek == '3') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_hot = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE (mysql_error());
					
					} elseif($id_status_prospek == '4') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money', ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE(mysql_error());

						$spk = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_spk = mysql_fetch_array($spk);

							mysql_query("INSERT INTO tb_spk(id_spk,id_pelanggan,id_prospek,tgl_spk,no_spk,plat,created_date,
															created_by)  
										 VALUES('','$id_pelanggan','$r_spk[getID]','$tgl_spk','$no_spk','hitam',NOW(),'$_SESSION[username]')")
										 OR DIE(mysql_error());
					}
				
				} elseif ($id_pembayaran == '2') {
					if($id_status_prospek == '1') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek	") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '2') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek	") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '3') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek	") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '4') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek	") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

						$spk = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_spk = mysql_fetch_array($spk);

							mysql_query("INSERT INTO tb_spk(id_spk,id_pelanggan,id_prospek,tgl_spk,no_spk,plat,created_date,
															created_by)  
										 VALUES('','$id_pelanggan','$r_spk[getID]','$tgl_spk','$no_spk','hitam',NOW(),'$_SESSION[username]')")
										 OR DIE(mysql_error());

					}
				
				}
				
				if($tambah){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=2');

								}
							}
						}
			?>

			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Form Sample
					</div>
				</div>
				<div class="portlet-body form">
					<form action="#" class="horizontal-form">
						<div class="form-body">
							
								<h4 class="form-section">Detail Prospek</h4>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Prospek</label>
											<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
											<input type="text" class="form-control" name="tgl_prospek" autocomplete="off" value="<?php echo $array['tgl_prospek']; ?>" readonly>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Prospek</label>
											<input type="text" class="form-control" autocomplete="off" name="no_prospek" value="<?php echo $array['no_prospek']; ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label>Test Drive</label>
											<div class="radio-list"> 			
												<label class="radio-inline"> 
												<input type="radio" name="test_drive" value="Y" <?php if ( $array['test_drive'] == 'Y') { echo 'checked' ; } ?>> Ya </label>
												<label class="radio-inline">
												<input type="radio" name="test_drive" value="N"  <?php if ( $array['test_drive'] == 'N') { echo 'checked' ; } ?>> Tidak </label>
											</div>
										</div>
									</div>

								</div> <hr>

								<h4 class="form-section">Unit Prospek</h4>
								
								<div class="row">
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Kendaraan</label>
											<select class="form-control merk" name="id_kendaraan" required>
												<option value="">- Merk Kendaraan -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_kendaraan WHERE id_kendaraan IN (2,3)");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_kendaraan'];	

														if($id == $array['id_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['merk'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Model/Type</label>
											<select class="form-control select2 model" name="id_tipe_kendaraan" required>
												<?php
														$sql=mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan = $array[id_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_tipe_kendaraan'];	

														if($id == $array['id_tipe_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['tipe'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['tipe'].'</option>';
																				}
																		}
													?>
												
											</select>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Warna</label>
												<select class="form-control warna" name="id_warna">
													<?php
														$sql=mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan = $array[id_tipe_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_warna'];	

														if($id == $array['id_warna']){
																echo '<option value="'.$id.'" selected="selected">'.$row['warna'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['warna'].'</option>';
																				}
																		}
													?>
										
												</select>
										</div>
									</div>

								</div>

								<div class="row">
											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Karoseri</label>
											<select class="form-control select2me" name="id_karoseri" required>
												<option value="">- Pilih Karoseri -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_karoseri");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_karoseri'];

														if($id == $array['id_karoseri']){
																echo '<option value="'.$id.'" selected="selected">'.$row['karoseri'].'</option>';
															} else {	
																echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Jumlah</label>
											<input type="text" class="form-control" autocomplete="off" name="jumlah" value="<?php echo $array['jml_kendaraan']; ?>">
										</div>
									</div>

								</div> <hr>
							
								<h4 class="form-section">Metode Pembayaran</h4>
								
								<div class="row">
									
									<div class="col-md-3 ">
										<div class="form-group">
											<label class="control-label">Pembayaran</label>
											<select class="form-control pembayaran" name="id_pembayaran">
												<option value="">Pilih Pembayaran</option>
												<option value="1" <?php if ( $array['id_pembayaran'] == '1') { echo 'selected' ; } ?>>Cash/Tunai</option>
												<option value="2" <?php if ( $array['id_pembayaran'] == '2') { echo 'selected' ; } ?>>Kredit</option>
											</select>
										</div>
									</div>

								</div>

								<!-- Load Pembayaran Kredit -->
								<div class="kredit">

								<?php if ($array['id_pembayaran'] == '2'){?>
								
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
														if($id == $array['id_perusahaan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['perusahaan'].'</option>';
															} else {
														echo '<option value="'.$id.'">'.$row['perusahaan'].'</option>';
																		}
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
													<?php
														$sql=mysql_query("SELECT * FROM ms_leasing a JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan WHERE id_perusahaan = $array[id_perusahaan]");
														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_perusahaan'];	
														
														if($id == $array['id_perusahaan']){
														echo '<option value="'.$id.'" selected="selected">'.$row['kota_perusahaan'].'</option>';
														} else {
														echo '<option value="'.$id.'">'.$row['kota_perusahaan'].'</option>';
																		}
																	}
													?>
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

														if($id == $array['id_dp']){
														echo '<option value="'.$id.'" selected="selected">'.$row['dp'].'</option>';
														} else {	
														echo '<option value="'.$id.'">'.$row['dp'].'</option>';
																		}
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
												<option value="1" <?php if ( $array['tenor'] == '1') { echo 'selected' ; } ?>>1 Tahun</option>
												<option value="2" <?php if ( $array['tenor'] == '2') { echo 'selected' ; } ?>>2 Tahun</option>
												<option value="3" <?php if ( $array['tenor'] == '3') { echo 'selected' ; } ?>>3 Tahun</option>
												<option value="4" <?php if ( $array['tenor'] == '4') { echo 'selected' ; } ?>>4 Tahun</option>
												<option value="5" <?php if ( $array['tenor'] == '5') { echo 'selected' ; } ?>>5 Tahun</option>
											</select>				
										</div>
									</div>
													
								</div> 
								<?php } ?>
								</div> <hr>
								<!-- Load Pembayaran Kredit -->

								<h4 class="form-section">Status Prospek</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Status Prospek</label>
											<select class="form-control status" name="id_status_prospek">
												<option value="">Pilih Status Prospek</option>
													<?php
														if($array['id_status_prospek'] == '1') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (1,2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '2') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '3') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (3,4,6) ORDER BY urutan");

														}

														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_status_prospek'];	

														if($id == $array['id_status_prospek']){
														echo '<option value="'.$id.'" selected="selected">'.$row['status_prospek'].'</option>';
														} else {
															echo '<option value="'.$id.'">'.$row['status_prospek'].'</option>';
																				}
																	}
													?>
											</select>
										</div>
									</div>

								</div> <hr>

								<!-- MAN . Money Authority Need -->
								<div class="prospek">
							
								<h4 class="form-section">MAN (Money | Authority | Need)</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label>Kecukupan Dana (Money)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_money" value="Y" checked="<?php if ( $array['cek_money'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_money" autocomplete="off" value="<?php echo $array['ket_money']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Memiliki Wewenang (Authority)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_auth" value="Y" checked="<?php if ( $array['cek_auth'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_auth" autocomplete="off" value="<?php echo $array['ket_auth']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Kebutuhan Unit (Need)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_need" value="Y" checked="<?php if ( $array['cek_need'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_need" autocomplete="off" value="<?php echo $array['ket_need']; ?>">
											</div>
										</div>
									</div>
								</div> <hr>

								<?php if($id_status_prospek == '4' OR $id_status_prospek == '7' OR $id_status_prospek == '5') { ?> 
								<h4 class="form-section">Detail SPK</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal SPK</label>
											<input type="text" class="form-control" name="tgl_spk" autocomplete="off" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. SPK</label>
											<input type="text" class="form-control" name="no_spk" autocomplete="off">
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '7' OR $id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Purchase Order</h4>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Perkiraan Tanggal Pengiriman</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Status</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggak Purchase Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. Purchase Order</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Delivery Order</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Delivery Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Rangka</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Mesin</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Nota</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '6') { ?>
								<h4 class="form-section">Analisa Lost Case</h4>
								
								<div class="row">

									<div class="col-md-3">
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

								</div>
								<!-- Load Pembayaran Kredit -->			
						
						</div>
						<div class="form-actions right">
							
							<button type="button" class="btn default">Cancel</a></button>
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
						</div>
					</form>

				</div>
			</div>

			<?php break; ?>


			<?php case "edit_spk" : ?>

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
					$tenor = $_POST['tenor'];

					$id_status_prospek = $_POST['id_status_prospek'];
					$cek_money = $_POST['cek_money'];
					$ket_money = $_POST['ket_money'];
					$cek_auth = $_POST['cek_auth'];
					$ket_auth = $_POST['ket_auth'];
					$cek_need = $_POST['cek_need'];
					$ket_need = $_POST['ket_need'];

					$tgl_spk = $_POST['tgl_spk'];
					$no_spk = $_POST['no_spk'];

					$tgl_estimasi = $_POST['tgl_estimasi'];
					$status = $_POST['status'];
					$tgl_po = $_POST['tgl_po'];
					$no_po = $_POST['no_po'];

					$tgl_do = $_POST['tgl_do'];
					$no_rangka = $_POST['no_rangka'];
					$no_mesin = $_POST['no_mesin'];
					$no_nota = $_POST['no_nota'];

					$id_analisa = $_POST['id_analisa'];
					$keterangan = addslashes( $_POST['keterangan'] );

				if($id_pembayaran == '1'){
					if($id_status_prospek == '4') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());
								
								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());

					
					} elseif($id_status_prospek == '7') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money', ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE(mysql_error());

								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());

						$po = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_po = mysql_fetch_array($po);

							mysql_query("INSERT INTO tb_po(id_po,id_prospek,estimated_delivery,status,tgl_po,no_po,created_by,
															created_date)  
										 VALUES('','$r_spo[getID]','$tgl_estimasi','$status','$tgl_po','$no_po','$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '6') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money', ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE(mysql_error());

						$lost = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_lost = mysql_fetch_array($lost);

							mysql_query("INSERT INTO tb_lost(id_lost,id_pelanggan,id_prospek,id_analisa_lost,catatan,created_by,
															created_date)  
										 VALUES('',$id_pelanggan,'$r_lost[getID]','$id_analisa','$keterangan',
										 		  '$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());
					}

				
				} elseif ($id_pembayaran == '2') {
					if($id_status_prospek == '4') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());

								
					} elseif($id_status_prospek == '7') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());

						$po = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_po = mysql_fetch_array($po);

							mysql_query("INSERT INTO tb_po(id_po,id_prospek,estimated_delivery,status,tgl_po,no_po,created_by,
															created_date)  
										 VALUES('','$r_spo[getID]','$tgl_estimasi','$status','$tgl_po','$no_po','$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '6') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

						$lost = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_lost = mysql_fetch_array($lost);

							mysql_query("INSERT INTO tb_lost(id_lost,id_pelanggan,id_prospek,id_analisa_lost,catatan,created_by,
															created_date)  
										 VALUES('',$id_pelanggan,'$r_lost[getID]','$id_analisa','$keterangan',
										 		  '$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());
					}

					}
				
				}
				
				if($tambah){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=2');

								}
							}
						}
			?>

			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Form Sample
					</div>
				</div>
				<div class="portlet-body form">
					<form action="#" class="horizontal-form">
						<div class="form-body">
							
								<h4 class="form-section">Detail Prospek</h4>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Prospek</label>
											<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
											<input type="text" class="form-control" name="tgl_prospek" autocomplete="off" value="<?php echo $array['tgl_prospek']; ?>" readonly>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Prospek</label>
											<input type="text" class="form-control" autocomplete="off" name="no_prospek" value="<?php echo $array['no_prospek']; ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label>Test Drive</label>
											<div class="radio-list"> 			
												<label class="radio-inline"> 
												<input type="radio" name="test_drive" value="Y" <?php if ( $array['test_drive'] == 'Y') { echo 'checked' ; } ?>> Ya </label>
												<label class="radio-inline">
												<input type="radio" name="test_drive" value="N"  <?php if ( $array['test_drive'] == 'N') { echo 'checked' ; } ?>> Tidak </label>
											</div>
										</div>
									</div>

								</div> <hr>

								<h4 class="form-section">Unit Prospek</h4>
								
								<div class="row">
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Kendaraan</label>
											<select class="form-control merk" name="id_kendaraan" required>
												<option value="">- Merk Kendaraan -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_kendaraan WHERE id_kendaraan IN (2,3)");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_kendaraan'];	

														if($id == $array['id_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['merk'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Model/Type</label>
											<select class="form-control select2 model" name="id_tipe_kendaraan" required>
												<?php
														$sql=mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan = $array[id_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_tipe_kendaraan'];	

														if($id == $array['id_tipe_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['tipe'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['tipe'].'</option>';
																				}
																		}
													?>
												
											</select>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Warna</label>
												<select class="form-control warna" name="id_warna">
													<?php
														$sql=mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan = $array[id_tipe_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_warna'];	

														if($id == $array['id_warna']){
																echo '<option value="'.$id.'" selected="selected">'.$row['warna'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['warna'].'</option>';
																				}
																		}
													?>
										
												</select>
										</div>
									</div>

								</div>

								<div class="row">
											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Karoseri</label>
											<select class="form-control select2me" name="id_karoseri" required>
												<option value="">- Pilih Karoseri -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_karoseri");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_karoseri'];

														if($id == $array['id_karoseri']){
																echo '<option value="'.$id.'" selected="selected">'.$row['karoseri'].'</option>';
															} else {	
																echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Jumlah</label>
											<input type="text" class="form-control" autocomplete="off" name="jumlah" value="<?php echo $array['jml_kendaraan']; ?>">
										</div>
									</div>

								</div> <hr>
							
								<h4 class="form-section">Metode Pembayaran</h4>
								
								<div class="row">
									
									<div class="col-md-3 ">
										<div class="form-group">
											<label class="control-label">Pembayaran</label>
											<select class="form-control pembayaran" name="id_pembayaran">
												<option value="">Pilih Pembayaran</option>
												<option value="1" <?php if ( $array['id_pembayaran'] == '1') { echo 'selected' ; } ?>>Cash/Tunai</option>
												<option value="2" <?php if ( $array['id_pembayaran'] == '2') { echo 'selected' ; } ?>>Kredit</option>
											</select>
										</div>
									</div>

								</div>

								<!-- Load Pembayaran Kredit -->
								<div class="kredit">

								<?php if ($array['id_pembayaran'] == '2'){?>
								
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
														if($id == $array['id_perusahaan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['perusahaan'].'</option>';
															} else {
														echo '<option value="'.$id.'">'.$row['perusahaan'].'</option>';
																		}
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
													<?php
														$sql=mysql_query("SELECT * FROM ms_leasing a JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan WHERE id_perusahaan = $array[id_perusahaan]");
														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_perusahaan'];	
														
														if($id == $array['id_perusahaan']){
														echo '<option value="'.$id.'" selected="selected">'.$row['kota_perusahaan'].'</option>';
														} else {
														echo '<option value="'.$id.'">'.$row['kota_perusahaan'].'</option>';
																		}
																	}
													?>
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

														if($id == $array['id_dp']){
														echo '<option value="'.$id.'" selected="selected">'.$row['dp'].'</option>';
														} else {	
														echo '<option value="'.$id.'">'.$row['dp'].'</option>';
																		}
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
												<option value="1" <?php if ( $array['tenor'] == '1') { echo 'selected' ; } ?>>1 Tahun</option>
												<option value="2" <?php if ( $array['tenor'] == '2') { echo 'selected' ; } ?>>2 Tahun</option>
												<option value="3" <?php if ( $array['tenor'] == '3') { echo 'selected' ; } ?>>3 Tahun</option>
												<option value="4" <?php if ( $array['tenor'] == '4') { echo 'selected' ; } ?>>4 Tahun</option>
												<option value="5" <?php if ( $array['tenor'] == '5') { echo 'selected' ; } ?>>5 Tahun</option>
											</select>				
										</div>
									</div>
													
								</div> 
								<?php } ?>
								</div> <hr>
								<!-- Load Pembayaran Kredit -->

								<h4 class="form-section">Status Prospek</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Status Prospek</label>
											<select class="form-control status" name="id_status_prospek">
												<option value="">Pilih Status Prospek</option>
													<?php
														if($array['id_status_prospek'] == '1') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (1,2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '2') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '3') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (3,4,6) ORDER BY urutan");

														}elseif ($array['id_status_prospek']== '4') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (4,6,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '7') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (5,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '5') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek = 5 ORDER BY urutan");
														}

														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_status_prospek'];	

														if($id == $array['id_status_prospek']){
														echo '<option value="'.$id.'" selected="selected">'.$row['status_prospek'].'</option>';
														} else {
															echo '<option value="'.$id.'">'.$row['status_prospek'].'</option>';
																				}
																	}
													?>
											</select>
										</div>
									</div>

								</div> <hr>

								<!-- Load Pembayaran Kredit -->
								<div class="prospek">
							
								<h4 class="form-section">MAN (Money | Authority | Need)</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label>Kecukupan Dana (Money)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_money" value="Y" checked="<?php if ( $array['cek_money'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_money" autocomplete="off" value="<?php echo $array['ket_money']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Memiliki Wewenang (Authority)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_auth" value="Y" checked="<?php if ( $array['cek_auth'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_auth" autocomplete="off" value="<?php echo $array['ket_auth']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Kebutuhan Unit (Need)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_need" value="Y" checked="<?php if ( $array['cek_need'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_need" autocomplete="off" value="<?php echo $array['ket_need']; ?>">
											</div>
										</div>
									</div>
								</div> <hr>

								<?php if($id_status_prospek == '4' OR $id_status_prospek == '7' OR $id_status_prospek == '5') { ?> 
								<h4 class="form-section">Detail SPK</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal SPK</label>
											<input type="text" class="form-control" name="tgl_spk" autocomplete="off" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. SPK</label>
											<input type="text" class="form-control" name="no_spk" autocomplete="off">
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '7' OR $id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Purchase Order</h4>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Perkiraan Tanggal Pengiriman</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Status</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggak Purchase Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. Purchase Order</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Delivery Order</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Delivery Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Rangka</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Mesin</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Nota</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '6') { ?>
								<h4 class="form-section">Analisa Lost Case</h4>
								
								<div class="row">

									<div class="col-md-3">
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

								</div>
								<!-- Load Pembayaran Kredit -->			
						
						</div>
						<div class="form-actions right">
							
							<button type="button" class="btn default">Cancel</a></button>
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
						</div>
					</form>

				</div>
			</div>

			<?php break; ?>

			<?php case "edit_po" : ?>

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
					$tenor = $_POST['tenor'];

					$id_status_prospek = $_POST['id_status_prospek'];
					$cek_money = $_POST['cek_money'];
					$ket_money = $_POST['ket_money'];
					$cek_auth = $_POST['cek_auth'];
					$ket_auth = $_POST['ket_auth'];
					$cek_need = $_POST['cek_need'];
					$ket_need = $_POST['ket_need'];

					$tgl_spk = $_POST['tgl_spk'];
					$no_spk = $_POST['no_spk'];

					$tgl_estimasi = $_POST['tgl_estimasi'];
					$status = $_POST['status'];
					$tgl_po = $_POST['tgl_po'];
					$no_po = $_POST['no_po'];

					$tgl_do = $_POST['tgl_do'];
					$no_rangka = $_POST['no_rangka'];
					$no_mesin = $_POST['no_mesin'];
					$no_nota = $_POST['no_nota'];

					$id_analisa = $_POST['id_analisa'];
					$keterangan = addslashes( $_POST['keterangan'] );

				if($id_pembayaran == '1'){
					if($id_status_prospek == '7') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());
								
								mysql_query("UPDATE tb_po SET tgl_estimasi='$tgl_estimasi',status='$status',tgl_po='$tgl_po',
															 modified_by = '$_SESSION[username]',modified_date = NOW() 
											 WHERE id_prospek = $id_prospek")
										 	 OR DIE(mysql_error());

					
					} elseif($id_status_prospek == '5') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money', ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE(mysql_error());

						$do = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_do = mysql_fetch_array($do);

							mysql_query("INSERT INTO tb_do(id_do,id_pelanggan,id_prospek,tgl_do,no_rangka,no_mesin,no_nota,
															created_by, created_date)  
										 VALUES('',$id_pelanggan,'$r_spo[getID]','$tgl_do','$no_rangka','$no_mesin','$no_nota',
										 		'$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '6') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money', ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE(mysql_error());

						$lost = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_lost = mysql_fetch_array($lost);

							mysql_query("INSERT INTO tb_lost(id_lost,id_pelanggan,id_prospek,id_analisa_lost,catatan,created_by,
															created_date)  
										 VALUES('',$id_pelanggan,'$r_lost[getID]','$id_analisa','$keterangan',
										 		  '$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());
					}

				
				} elseif ($id_pembayaran == '2') {
					if($id_status_prospek == '7') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());

								mysql_query("UPDATE tb_po SET tgl_estimasi='$tgl_estimasi',status='$status',tgl_po='$tgl_po',
															 modified_by = '$_SESSION[username]',modified_date = NOW() 
											 WHERE id_prospek = $id_prospek")
										 	 OR DIE(mysql_error());

								
					} elseif($id_status_prospek == '5') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

						$do = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_do = mysql_fetch_array($do);

							mysql_query("INSERT INTO tb_do(id_do,id_pelanggan,id_prospek,tgl_do,no_rangka,no_mesin,no_nota,
															created_by, created_date)  
										 VALUES('',$id_pelanggan,'$r_spo[getID]','$tgl_do','$no_rangka','$no_mesin','$no_nota',
										 		'$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());

					} elseif($id_status_prospek == '6') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

						$lost = mysql_query("SELECT MAX(id_prospek) AS getID FROM tb_prospek WHERE id_pelanggan = $id_pelanggan");   
          				$r_lost = mysql_fetch_array($lost);

							mysql_query("INSERT INTO tb_lost(id_lost,id_pelanggan,id_prospek,id_analisa_lost,catatan,created_by,
															created_date)  
										 VALUES('',$id_pelanggan,'$r_lost[getID]','$id_analisa','$keterangan',
										 		  '$_SESSION[username]',NOW())")
										 OR DIE(mysql_error());
					}

					}
				
				}
				
				if($tambah){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=2');

								}
							}
						}
			?>

			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Form Sample
					</div>
				</div>
				<div class="portlet-body form">
					<form action="#" class="horizontal-form">
						<div class="form-body">
							
								<h4 class="form-section">Detail Prospek</h4>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Prospek</label>
											<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
											<input type="text" class="form-control" name="tgl_prospek" autocomplete="off" value="<?php echo $array['tgl_prospek']; ?>" readonly>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Prospek</label>
											<input type="text" class="form-control" autocomplete="off" name="no_prospek" value="<?php echo $array['no_prospek']; ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label>Test Drive</label>
											<div class="radio-list"> 			
												<label class="radio-inline"> 
												<input type="radio" name="test_drive" value="Y" <?php if ( $array['test_drive'] == 'Y') { echo 'checked' ; } ?>> Ya </label>
												<label class="radio-inline">
												<input type="radio" name="test_drive" value="N"  <?php if ( $array['test_drive'] == 'N') { echo 'checked' ; } ?>> Tidak </label>
											</div>
										</div>
									</div>

								</div> <hr>

								<h4 class="form-section">Unit Prospek</h4>
								
								<div class="row">
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Kendaraan</label>
											<select class="form-control merk" name="id_kendaraan" required>
												<option value="">- Merk Kendaraan -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_kendaraan WHERE id_kendaraan IN (2,3)");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_kendaraan'];	

														if($id == $array['id_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['merk'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Model/Type</label>
											<select class="form-control select2 model" name="id_tipe_kendaraan" required>
												<?php
														$sql=mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan = $array[id_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_tipe_kendaraan'];	

														if($id == $array['id_tipe_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['tipe'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['tipe'].'</option>';
																				}
																		}
													?>
												
											</select>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Warna</label>
												<select class="form-control warna" name="id_warna">
													<?php
														$sql=mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan = $array[id_tipe_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_warna'];	

														if($id == $array['id_warna']){
																echo '<option value="'.$id.'" selected="selected">'.$row['warna'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['warna'].'</option>';
																				}
																		}
													?>
										
												</select>
										</div>
									</div>

								</div>

								<div class="row">
											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Karoseri</label>
											<select class="form-control select2me" name="id_karoseri" required>
												<option value="">- Pilih Karoseri -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_karoseri");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_karoseri'];

														if($id == $array['id_karoseri']){
																echo '<option value="'.$id.'" selected="selected">'.$row['karoseri'].'</option>';
															} else {	
																echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Jumlah</label>
											<input type="text" class="form-control" autocomplete="off" name="jumlah" value="<?php echo $array['jml_kendaraan']; ?>">
										</div>
									</div>

								</div> <hr>
							
								<h4 class="form-section">Metode Pembayaran</h4>
								
								<div class="row">
									
									<div class="col-md-3 ">
										<div class="form-group">
											<label class="control-label">Pembayaran</label>
											<select class="form-control pembayaran" name="id_pembayaran">
												<option value="">Pilih Pembayaran</option>
												<option value="1" <?php if ( $array['id_pembayaran'] == '1') { echo 'selected' ; } ?>>Cash/Tunai</option>
												<option value="2" <?php if ( $array['id_pembayaran'] == '2') { echo 'selected' ; } ?>>Kredit</option>
											</select>
										</div>
									</div>

								</div>

								<!-- Load Pembayaran Kredit -->
								<div class="kredit">

								<?php if ($array['id_pembayaran'] == '2'){?>
								
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
														if($id == $array['id_perusahaan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['perusahaan'].'</option>';
															} else {
														echo '<option value="'.$id.'">'.$row['perusahaan'].'</option>';
																		}
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
													<?php
														$sql=mysql_query("SELECT * FROM ms_leasing a JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan WHERE id_perusahaan = $array[id_perusahaan]");
														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_perusahaan'];	
														
														if($id == $array['id_perusahaan']){
														echo '<option value="'.$id.'" selected="selected">'.$row['kota_perusahaan'].'</option>';
														} else {
														echo '<option value="'.$id.'">'.$row['kota_perusahaan'].'</option>';
																		}
																	}
													?>
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

														if($id == $array['id_dp']){
														echo '<option value="'.$id.'" selected="selected">'.$row['dp'].'</option>';
														} else {	
														echo '<option value="'.$id.'">'.$row['dp'].'</option>';
																		}
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
												<option value="1" <?php if ( $array['tenor'] == '1') { echo 'selected' ; } ?>>1 Tahun</option>
												<option value="2" <?php if ( $array['tenor'] == '2') { echo 'selected' ; } ?>>2 Tahun</option>
												<option value="3" <?php if ( $array['tenor'] == '3') { echo 'selected' ; } ?>>3 Tahun</option>
												<option value="4" <?php if ( $array['tenor'] == '4') { echo 'selected' ; } ?>>4 Tahun</option>
												<option value="5" <?php if ( $array['tenor'] == '5') { echo 'selected' ; } ?>>5 Tahun</option>
											</select>				
										</div>
									</div>
													
								</div> 
								<?php } ?>
								</div> <hr>
								<!-- Load Pembayaran Kredit -->

								<h4 class="form-section">Status Prospek</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Status Prospek</label>
											<select class="form-control status" name="id_status_prospek">
												<option value="">Pilih Status Prospek</option>
													<?php
														if($array['id_status_prospek'] == '1') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (1,2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '2') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '3') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (3,4,6) ORDER BY urutan");

														}elseif ($array['id_status_prospek']== '4') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (4,6,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '7') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (5,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '5') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek = 5 ORDER BY urutan");
														}

														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_status_prospek'];	

														if($id == $array['id_status_prospek']){
														echo '<option value="'.$id.'" selected="selected">'.$row['status_prospek'].'</option>';
														} else {
															echo '<option value="'.$id.'">'.$row['status_prospek'].'</option>';
																				}
																	}
													?>
											</select>
										</div>
									</div>

								</div> <hr>

								<!-- Load Pembayaran Kredit -->
								<div class="prospek">
							
								<h4 class="form-section">MAN (Money | Authority | Need)</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label>Kecukupan Dana (Money)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_money" value="Y" checked="<?php if ( $array['cek_money'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_money" autocomplete="off" value="<?php echo $array['ket_money']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Memiliki Wewenang (Authority)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_auth" value="Y" checked="<?php if ( $array['cek_auth'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_auth" autocomplete="off" value="<?php echo $array['ket_auth']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Kebutuhan Unit (Need)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_need" value="Y" checked="<?php if ( $array['cek_need'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_need" autocomplete="off" value="<?php echo $array['ket_need']; ?>">
											</div>
										</div>
									</div>
								</div> <hr>

								<?php if($id_status_prospek == '4' OR $id_status_prospek == '7' OR $id_status_prospek == '5') { ?> 
								<h4 class="form-section">Detail SPK</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal SPK</label>
											<input type="text" class="form-control" name="tgl_spk" autocomplete="off" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. SPK</label>
											<input type="text" class="form-control" name="no_spk" autocomplete="off">
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '7' OR $id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Purchase Order</h4>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Perkiraan Tanggal Pengiriman</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Status</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggak Purchase Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. Purchase Order</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Delivery Order</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Delivery Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Rangka</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Mesin</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Nota</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '6') { ?>
								<h4 class="form-section">Analisa Lost Case</h4>
								
								<div class="row">

									<div class="col-md-3">
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

								</div>
								<!-- Load Pembayaran Kredit -->			
						
						</div>
						<div class="form-actions right">
							
							<button type="button" class="btn default">Cancel</a></button>
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
						</div>
					</form>

				</div>
			</div>

			<?php break; ?>

			<?php case "edit_do" : ?>

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
					$tenor = $_POST['tenor'];

					$id_status_prospek = $_POST['id_status_prospek'];
					$cek_money = $_POST['cek_money'];
					$ket_money = $_POST['ket_money'];
					$cek_auth = $_POST['cek_auth'];
					$ket_auth = $_POST['ket_auth'];
					$cek_need = $_POST['cek_need'];
					$ket_need = $_POST['ket_need'];

					$tgl_spk = $_POST['tgl_spk'];
					$no_spk = $_POST['no_spk'];

					$tgl_estimasi = $_POST['tgl_estimasi'];
					$status = $_POST['status'];
					$tgl_po = $_POST['tgl_po'];
					$no_po = $_POST['no_po'];

					$tgl_do = $_POST['tgl_do'];
					$no_rangka = $_POST['no_rangka'];
					$no_mesin = $_POST['no_mesin'];
					$no_nota = $_POST['no_nota'];

					$id_analisa = $_POST['id_analisa'];
					$keterangan = addslashes( $_POST['keterangan'] );

				if($id_pembayaran == '1'){
					if($id_status_prospek == '5') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money', ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE(mysql_error());

								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());
								
								mysql_query("UPDATE tb_po SET tgl_estimasi='$tgl_estimasi',status='$status',tgl_po='$tgl_po',
															 modified_by = '$_SESSION[username]',modified_date = NOW() 
											 WHERE id_prospek = $id_prospek")
										 	 OR DIE(mysql_error());

								mysql_query("UPDATE tb_do SET tgl_do = '$tgl_do', no_rangka = '$no_rangka', no_mesin ='$no_mesin'
															, no_nota = '$no_nota', modified_by = '$_SESSION[username]'
															, modified_date = NOW()
											 WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());
					}

				
				} elseif ($id_pembayaran == '2') {
					if($id_status_prospek == '5') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_kredit SET id_kota_perusahaan='$id_cabang', id_perusahaan='$id_lembaga',
													id_dp='$id_dp',tenor='$tenor' WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

								mysql_query("UPDATE tb_spk SET tgl_spk ='$tgl_spk', no_spk = '$no_spk',modified_date = NOW(),
													modified_by = '$_SESSION[username]'")
										 	 OR DIE(mysql_error());
								
								mysql_query("UPDATE tb_po SET tgl_estimasi='$tgl_estimasi',status='$status',tgl_po='$tgl_po',
															 modified_by = '$_SESSION[username]',modified_date = NOW() 
											 WHERE id_prospek = $id_prospek")
										 	 OR DIE(mysql_error());

								mysql_query("UPDATE tb_do SET tgl_do = '$tgl_do', no_rangka = '$no_rangka', no_mesin ='$no_mesin'
															, no_nota = '$no_nota', modified_by = '$_SESSION[username]'
															, modified_date = NOW()
											 WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

					} 

					}
				
				}
				
				if($tambah){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=2');

								}
							}
						}
			?>

			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Form Sample
					</div>
				</div>
				<div class="portlet-body form">
					<form action="#" class="horizontal-form">
						<div class="form-body">
							
								<h4 class="form-section">Detail Prospek</h4>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Prospek</label>
											<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
											<input type="text" class="form-control" name="tgl_prospek" autocomplete="off" value="<?php echo $array['tgl_prospek']; ?>" readonly>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Prospek</label>
											<input type="text" class="form-control" autocomplete="off" name="no_prospek" value="<?php echo $array['no_prospek']; ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label>Test Drive</label>
											<div class="radio-list"> 			
												<label class="radio-inline"> 
												<input type="radio" name="test_drive" value="Y" <?php if ( $array['test_drive'] == 'Y') { echo 'checked' ; } ?>> Ya </label>
												<label class="radio-inline">
												<input type="radio" name="test_drive" value="N"  <?php if ( $array['test_drive'] == 'N') { echo 'checked' ; } ?>> Tidak </label>
											</div>
										</div>
									</div>

								</div> <hr>

								<h4 class="form-section">Unit Prospek</h4>
								
								<div class="row">
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Kendaraan</label>
											<select class="form-control merk" name="id_kendaraan" required>
												<option value="">- Merk Kendaraan -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_kendaraan WHERE id_kendaraan IN (2,3)");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_kendaraan'];	

														if($id == $array['id_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['merk'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Model/Type</label>
											<select class="form-control select2 model" name="id_tipe_kendaraan" required>
												<?php
														$sql=mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan = $array[id_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_tipe_kendaraan'];	

														if($id == $array['id_tipe_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['tipe'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['tipe'].'</option>';
																				}
																		}
													?>
												
											</select>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Warna</label>
												<select class="form-control warna" name="id_warna">
													<?php
														$sql=mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan = $array[id_tipe_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_warna'];	

														if($id == $array['id_warna']){
																echo '<option value="'.$id.'" selected="selected">'.$row['warna'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['warna'].'</option>';
																				}
																		}
													?>
										
												</select>
										</div>
									</div>

								</div>

								<div class="row">
											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Karoseri</label>
											<select class="form-control select2me" name="id_karoseri" required>
												<option value="">- Pilih Karoseri -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_karoseri");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_karoseri'];

														if($id == $array['id_karoseri']){
																echo '<option value="'.$id.'" selected="selected">'.$row['karoseri'].'</option>';
															} else {	
																echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Jumlah</label>
											<input type="text" class="form-control" autocomplete="off" name="jumlah" value="<?php echo $array['jml_kendaraan']; ?>">
										</div>
									</div>

								</div> <hr>
							
								<h4 class="form-section">Metode Pembayaran</h4>
								
								<div class="row">
									
									<div class="col-md-3 ">
										<div class="form-group">
											<label class="control-label">Pembayaran</label>
											<select class="form-control pembayaran" name="id_pembayaran">
												<option value="">Pilih Pembayaran</option>
												<option value="1" <?php if ( $array['id_pembayaran'] == '1') { echo 'selected' ; } ?>>Cash/Tunai</option>
												<option value="2" <?php if ( $array['id_pembayaran'] == '2') { echo 'selected' ; } ?>>Kredit</option>
											</select>
										</div>
									</div>

								</div>

								<!-- Load Pembayaran Kredit -->
								<div class="kredit">

								<?php if ($array['id_pembayaran'] == '2'){?>
								
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
														if($id == $array['id_perusahaan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['perusahaan'].'</option>';
															} else {
														echo '<option value="'.$id.'">'.$row['perusahaan'].'</option>';
																		}
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
													<?php
														$sql=mysql_query("SELECT * FROM ms_leasing a JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan WHERE id_perusahaan = $array[id_perusahaan]");
														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_perusahaan'];	
														
														if($id == $array['id_perusahaan']){
														echo '<option value="'.$id.'" selected="selected">'.$row['kota_perusahaan'].'</option>';
														} else {
														echo '<option value="'.$id.'">'.$row['kota_perusahaan'].'</option>';
																		}
																	}
													?>
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

														if($id == $array['id_dp']){
														echo '<option value="'.$id.'" selected="selected">'.$row['dp'].'</option>';
														} else {	
														echo '<option value="'.$id.'">'.$row['dp'].'</option>';
																		}
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
												<option value="1" <?php if ( $array['tenor'] == '1') { echo 'selected' ; } ?>>1 Tahun</option>
												<option value="2" <?php if ( $array['tenor'] == '2') { echo 'selected' ; } ?>>2 Tahun</option>
												<option value="3" <?php if ( $array['tenor'] == '3') { echo 'selected' ; } ?>>3 Tahun</option>
												<option value="4" <?php if ( $array['tenor'] == '4') { echo 'selected' ; } ?>>4 Tahun</option>
												<option value="5" <?php if ( $array['tenor'] == '5') { echo 'selected' ; } ?>>5 Tahun</option>
											</select>				
										</div>
									</div>
													
								</div> 
								<?php } ?>
								</div> <hr>
								<!-- Load Pembayaran Kredit -->

								<h4 class="form-section">Status Prospek</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Status Prospek</label>
											<select class="form-control status" name="id_status_prospek">
												<option value="">Pilih Status Prospek</option>
													<?php
														if($array['id_status_prospek'] == '1') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (1,2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '2') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '3') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (3,4,6) ORDER BY urutan");

														}elseif ($array['id_status_prospek']== '4') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (4,6,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '7') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (5,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '5') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek = 5 ORDER BY urutan");
														}

														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_status_prospek'];	

														if($id == $array['id_status_prospek']){
														echo '<option value="'.$id.'" selected="selected">'.$row['status_prospek'].'</option>';
														} else {
															echo '<option value="'.$id.'">'.$row['status_prospek'].'</option>';
																				}
																	}
													?>
											</select>
										</div>
									</div>

								</div> <hr>

								<!-- Load Pembayaran Kredit -->
								<div class="prospek">
							
								<h4 class="form-section">MAN (Money | Authority | Need)</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label>Kecukupan Dana (Money)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_money" value="Y" checked="<?php if ( $array['cek_money'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_money" autocomplete="off" value="<?php echo $array['ket_money']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Memiliki Wewenang (Authority)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_auth" value="Y" checked="<?php if ( $array['cek_auth'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_auth" autocomplete="off" value="<?php echo $array['ket_auth']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Kebutuhan Unit (Need)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_need" value="Y" checked="<?php if ( $array['cek_need'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_need" autocomplete="off" value="<?php echo $array['ket_need']; ?>">
											</div>
										</div>
									</div>
								</div> <hr>

								<?php if($id_status_prospek == '4' OR $id_status_prospek == '7' OR $id_status_prospek == '5') { ?> 
								<h4 class="form-section">Detail SPK</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal SPK</label>
											<input type="text" class="form-control" name="tgl_spk" autocomplete="off" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. SPK</label>
											<input type="text" class="form-control" name="no_spk" autocomplete="off">
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '7' OR $id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Purchase Order</h4>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Perkiraan Tanggal Pengiriman</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Status</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggak Purchase Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. Purchase Order</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Delivery Order</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Delivery Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Rangka</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Mesin</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Nota</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '6') { ?>
								<h4 class="form-section">Analisa Lost Case</h4>
								
								<div class="row">

									<div class="col-md-3">
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

								</div>
								<!-- Load Pembayaran Kredit -->			
						
						</div>
						<div class="form-actions right">
							
							<button type="button" class="btn default">Cancel</a></button>
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
						</div>
					</form>

				</div>
			</div>

			<?php break; ?>

			<?php case "edit_lost" : ?>

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
					$tenor = $_POST['tenor'];

					$id_status_prospek = $_POST['id_status_prospek'];
					$cek_money = $_POST['cek_money'];
					$ket_money = $_POST['ket_money'];
					$cek_auth = $_POST['cek_auth'];
					$ket_auth = $_POST['ket_auth'];
					$cek_need = $_POST['cek_need'];
					$ket_need = $_POST['ket_need'];

					$tgl_spk = $_POST['tgl_spk'];
					$no_spk = $_POST['no_spk'];

					$tgl_estimasi = $_POST['tgl_estimasi'];
					$status = $_POST['status'];
					$tgl_po = $_POST['tgl_po'];
					$no_po = $_POST['no_po'];

					$tgl_do = $_POST['tgl_do'];
					$no_rangka = $_POST['no_rangka'];
					$no_mesin = $_POST['no_mesin'];
					$no_nota = $_POST['no_nota'];

					$id_analisa = $_POST['id_analisa'];
					$keterangan = addslashes( $_POST['keterangan'] );

				if($id_pembayaran == '1'){
					if($id_status_prospek == '6') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money', ket_auth = '$ket_auth',ket_need = '$ket_need'
											 WHERE id_prospek = $id_prospek ")  
											 OR DIE(mysql_error());

								mysql_query("UPDATE tb_lost SET id_analisa_lost = '$id_analisa', catatan = '$keterangan'
																modified_by = '$_SESSION[username]'	, modified_date = NOW()
											 WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());
					}

				
				} elseif ($id_pembayaran == '2') {
					if($id_status_prospek == '6') {
						$tambah=mysql_query("UPDATE tb_prospek SET id_kendaraan = '$id_kendaraan', 
													id_tipe_kendaraan = '$id_tipe_kendaraan',id_warna = '$id_warna',
													id_karoseri = '$id_karoseri',no_prospek = '$no_prospek',
													test_drive = '$test_drive',jml_kendaraan = '$jumlah',
													id_pembayaran = '$id_pembayaran', id_status_prospek = '$id_status_prospek',
													modified_by = '$_SESSION[username]', modified_date = NOW(),tgl_touch = NOW(),
													cek_money ='$cek_money', cek_auth = '$cek_auth', cek_need = '$cek_need',
													ket_money = '$ket_money',ket_auth = '$ket_auth',ket_need = '$ket_need' 
											 WHERE id_prospek = $id_prospek ") 
											 OR DIE (mysql_error());

								mysql_query("UPDATE tb_lost SET id_analisa_lost = '$id_analisa', catatan = '$keterangan'
																modified_by = '$_SESSION[username]'	, modified_date = NOW()
											 WHERE id_prospek = $id_prospek")
										 OR DIE(mysql_error());

					} 

					}
				
				}
				
				if($tambah){
					header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=2');

								}
							}
						}
			?>

			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Form Sample
					</div>
				</div>
				<div class="portlet-body form">
					<form action="#" class="horizontal-form">
						<div class="form-body">
							
								<h4 class="form-section">Detail Prospek</h4>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Prospek</label>
											<div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="-3d"  maxDate="+3d">
											<input type="text" class="form-control" name="tgl_prospek" autocomplete="off" value="<?php echo $array['tgl_prospek']; ?>" readonly>
											<span class="input-group-btn">
											<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Prospek</label>
											<input type="text" class="form-control" autocomplete="off" name="no_prospek" value="<?php echo $array['no_prospek']; ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label>Test Drive</label>
											<div class="radio-list"> 			
												<label class="radio-inline"> 
												<input type="radio" name="test_drive" value="Y" <?php if ( $array['test_drive'] == 'Y') { echo 'checked' ; } ?>> Ya </label>
												<label class="radio-inline">
												<input type="radio" name="test_drive" value="N"  <?php if ( $array['test_drive'] == 'N') { echo 'checked' ; } ?>> Tidak </label>
											</div>
										</div>
									</div>

								</div> <hr>

								<h4 class="form-section">Unit Prospek</h4>
								
								<div class="row">
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Kendaraan</label>
											<select class="form-control merk" name="id_kendaraan" required>
												<option value="">- Merk Kendaraan -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_kendaraan WHERE id_kendaraan IN (2,3)");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_kendaraan'];	

														if($id == $array['id_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['merk'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['merk'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Model/Type</label>
											<select class="form-control select2 model" name="id_tipe_kendaraan" required>
												<?php
														$sql=mysql_query("SELECT * FROM ms_tipe_kendaraan WHERE id_kendaraan = $array[id_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_tipe_kendaraan'];	

														if($id == $array['id_tipe_kendaraan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['tipe'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['tipe'].'</option>';
																				}
																		}
													?>
												
											</select>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Warna</label>
												<select class="form-control warna" name="id_warna">
													<?php
														$sql=mysql_query("SELECT * FROM ms_warna WHERE id_tipe_kendaraan = $array[id_tipe_kendaraan]");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_warna'];	

														if($id == $array['id_warna']){
																echo '<option value="'.$id.'" selected="selected">'.$row['warna'].'</option>';
															} else {
																echo '<option value="'.$id.'">'.$row['warna'].'</option>';
																				}
																		}
													?>
										
												</select>
										</div>
									</div>

								</div>

								<div class="row">
											
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Pilih Karoseri</label>
											<select class="form-control select2me" name="id_karoseri" required>
												<option value="">- Pilih Karoseri -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_karoseri");
																while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_karoseri'];

														if($id == $array['id_karoseri']){
																echo '<option value="'.$id.'" selected="selected">'.$row['karoseri'].'</option>';
															} else {	
																echo '<option value="'.$id.'">'.$row['karoseri'].'</option>';
																				}
																		}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Jumlah</label>
											<input type="text" class="form-control" autocomplete="off" name="jumlah" value="<?php echo $array['jml_kendaraan']; ?>">
										</div>
									</div>

								</div> <hr>
							
								<h4 class="form-section">Metode Pembayaran</h4>
								
								<div class="row">
									
									<div class="col-md-3 ">
										<div class="form-group">
											<label class="control-label">Pembayaran</label>
											<select class="form-control pembayaran" name="id_pembayaran">
												<option value="">Pilih Pembayaran</option>
												<option value="1" <?php if ( $array['id_pembayaran'] == '1') { echo 'selected' ; } ?>>Cash/Tunai</option>
												<option value="2" <?php if ( $array['id_pembayaran'] == '2') { echo 'selected' ; } ?>>Kredit</option>
											</select>
										</div>
									</div>

								</div>

								<!-- Load Pembayaran Kredit -->
								<div class="kredit">

								<?php if ($array['id_pembayaran'] == '2'){?>
								
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
														if($id == $array['id_perusahaan']){
																echo '<option value="'.$id.'" selected="selected">'.$row['perusahaan'].'</option>';
															} else {
														echo '<option value="'.$id.'">'.$row['perusahaan'].'</option>';
																		}
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
													<?php
														$sql=mysql_query("SELECT * FROM ms_leasing a JOIN ms_leasing_kota b ON b.id_kota_perusahaan = a.id_kota_perusahaan WHERE id_perusahaan = $array[id_perusahaan]");
														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_perusahaan'];	
														
														if($id == $array['id_perusahaan']){
														echo '<option value="'.$id.'" selected="selected">'.$row['kota_perusahaan'].'</option>';
														} else {
														echo '<option value="'.$id.'">'.$row['kota_perusahaan'].'</option>';
																		}
																	}
													?>
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

														if($id == $array['id_dp']){
														echo '<option value="'.$id.'" selected="selected">'.$row['dp'].'</option>';
														} else {	
														echo '<option value="'.$id.'">'.$row['dp'].'</option>';
																		}
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
												<option value="1" <?php if ( $array['tenor'] == '1') { echo 'selected' ; } ?>>1 Tahun</option>
												<option value="2" <?php if ( $array['tenor'] == '2') { echo 'selected' ; } ?>>2 Tahun</option>
												<option value="3" <?php if ( $array['tenor'] == '3') { echo 'selected' ; } ?>>3 Tahun</option>
												<option value="4" <?php if ( $array['tenor'] == '4') { echo 'selected' ; } ?>>4 Tahun</option>
												<option value="5" <?php if ( $array['tenor'] == '5') { echo 'selected' ; } ?>>5 Tahun</option>
											</select>				
										</div>
									</div>
													
								</div> 
								<?php } ?>
								</div> <hr>
								<!-- Load Pembayaran Kredit -->

								<h4 class="form-section">Status Prospek</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Status Prospek</label>
											<select class="form-control status" name="id_status_prospek">
												<option value="">Pilih Status Prospek</option>
													<?php
														if($array['id_status_prospek'] == '1') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (1,2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '2') {
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (2,3,4,6) ORDER BY urutan");
														
														}elseif ($array['id_status_prospek'] == '3') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (3,4,6) ORDER BY urutan");

														}elseif ($array['id_status_prospek']== '4') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (4,6,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '7') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek IN (5,7) ORDER BY urutan");

														}elseif ($array['id_status_prospek'] == '5') { 
														$sql=mysql_query("SELECT * FROM ms_status_prospek WHERE id_status_prospek = 5 ORDER BY urutan");
														}

														while($row=mysql_fetch_array($sql))
																				{
														$id = $row['id_status_prospek'];	

														if($id == $array['id_status_prospek']){
														echo '<option value="'.$id.'" selected="selected">'.$row['status_prospek'].'</option>';
														} else {
															echo '<option value="'.$id.'">'.$row['status_prospek'].'</option>';
																				}
																	}
													?>
											</select>
										</div>
									</div>

								</div> <hr>

								<!-- Load Pembayaran Kredit -->
								<div class="prospek">
							
								<h4 class="form-section">MAN (Money | Authority | Need)</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label>Kecukupan Dana (Money)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_money" value="Y" checked="<?php if ( $array['cek_money'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_money" autocomplete="off" value="<?php echo $array['ket_money']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Memiliki Wewenang (Authority)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_auth" value="Y" checked="<?php if ( $array['cek_auth'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_auth" autocomplete="off" value="<?php echo $array['ket_auth']; ?>">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Kebutuhan Unit (Need)</label>
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="cek_need" value="Y" checked="<?php if ( $array['cek_need'] == 'Y') { echo 'checked' ; } ?>">
												</span>
											<input type="text" class="form-control" name="ket_need" autocomplete="off" value="<?php echo $array['ket_need']; ?>">
											</div>
										</div>
									</div>
								</div> <hr>

								<?php if($id_status_prospek == '4' OR $id_status_prospek == '7' OR $id_status_prospek == '5') { ?> 
								<h4 class="form-section">Detail SPK</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal SPK</label>
											<input type="text" class="form-control" name="tgl_spk" autocomplete="off" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. SPK</label>
											<input type="text" class="form-control" name="no_spk" autocomplete="off">
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '7' OR $id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Purchase Order</h4>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Perkiraan Tanggal Pengiriman</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>Status</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggak Purchase Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label>No. Purchase Order</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '5') { ?>
								<h4 class="form-section">Detail Delivery Order</h4>
								
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tanggal Delivery Order</label>
											<input type="text" class="form-control" name="tgl_spk" id ="tgl_prospek" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Rangka</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Mesin</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>
												
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Nota</label>
											<input type="text" class="form-control" autocomplete="off" required>
										</div>
									</div>

								</div> <hr>
								<?php } ?>

								<?php if($id_status_prospek == '6') { ?>
								<h4 class="form-section">Analisa Lost Case</h4>
								
								<div class="row">

									<div class="col-md-3">
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

								</div>
								<!-- Load Pembayaran Kredit -->			
						
						</div>
						<div class="form-actions right">
							
							<button type="button" class="btn default">Cancel</a></button>
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
						</div>
					</form>

				</div>
			</div>

			<?php break; ?>

			<?php case "delete": ?>

			<?php break; ?>

			<?php } ?>

		</div>
</div>