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

			<?php 

				$tab_large =   '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
				$tab_medium =  '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
				$tab_small =   '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

				$en=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","January","February","March",
					"April","May","June","July","August","September","October","November","December");
 
 				$id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Januari","Pebruari","Maret","April","Mei",
 					"Juni","Juli","Agustus","September","Oktober","Nopember","Desember");

			?>

			<?php 
            	switch($_GET[act]){
            	default:
          	?>

          	<?php
			$notif = $_GET['notif'];
			
			if ($_GET['notif'] == 1) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Pelanggan Berhasil ditambahkan !!
                </div>
            <?php
			} else if ($_GET['notif'] == 2) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Pelanggan Berhasil diperbarui !!
                </div>
             <?php
			} else if ($_GET['notif'] == 3) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Pelanggan Berhasil hapus !!
                </div>
			<?php 
				} 
			?>

    <!-- BEGIN SAMPLE FORM PORTLET--> 
    <div class="row">
		<div class="col-md-6">  
            <div class="portlet box red">
                <div class="portlet-title">
                  	<div class="caption">
						<i class="fa fa-cogs"></i>Filter Customer
				  	</div>
                </div>
                
                <div class="portlet-body">
                     
					<form method="post" action="">
                        <div class="row">   
							<div class="col-md-5">
								<label class="control-label">Sales / SPV (Unit, Part, Serv)</label>		
								<select class="form-control form-control-inline select2me" name="sales">
										<option selected="selected" value="">- Pilih Sales / SPV -</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE divisi IN ('hino','hino3') AND level IN ('supervisor','sales') AND sublevel IN ('unit','service','part')  AND blokir = 'N' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  											?>	
											<option value="<?php echo $id ; ?>"> 
												<?php if($row['sublevel'] == 'unit') { echo 'Unit'; } 
													  elseif($row['sublevel'] == 'part') { echo 'Part'; } 
													  elseif($row['sublevel'] == 'service') { echo 'Serv'; } 
												?> - 
												<?php echo $row['username'] ; ?>
											</option>
											<?php 	} ?>
								</select>
							</div>

							<div class="col-md-5">
								<label class="control-label">Nama Customer</label>		
								<input class="form-control form-control-inline "  type="text"  name="nama_perush" 
								autocomplete="off" placeholder="Nama Customer"  />
							</div>
					
							
							<div class="col-md-2">
						 	    <label class="control-label"> &nbsp</label>
								<input type="submit" value="Submit" name="submit" class="btn red btn-block">
                            </div>

                        </div>
                     </form>

                </div>
            </div>
        </div>
    </div>
             <!-- END SAMPLE FORM PORTLET-->


            <?php
   
			if(isset($_POST['submit'])){
				$supervisor = $_POST['supervisor'];
				$sales = $_POST['sales'];
				$nama_perush = $_POST['nama_perush'];
				$alamat = $_POST['alamat'];
				$from = $_POST['from'];
				$to = $_POST['to'];

		
			$result = mysql_query("SELECT a.id_pelanggan, a.nama_perush, a.id_pelanggan, a.nama_pengurus, a.salesman,
										  a.salespart,a.salesserv, a.sesuai_ktp, 
										  DATE_FORMAT(b.tgl_aktivitas, '%d %M %Y') AS tgl_aktivitas, 
										  DATE_FORMAT(b.tgl_kunjungan_berikut, '%d %M %Y') AS tgl_kunjungan_berikut, 
										  k.status_prospek, d.from_salesman, d.to_salesman, e.nama_database 
								   FROM tb_pelanggan a
								   LEFT JOIN v_unit_latest_activity_id i ON i.id_pelanggan = a.id_pelanggan
								   LEFT JOIN tb_aktivitas_harian_unit b ON b.id_aktivitas_harian = i.max_aktivitas
								   LEFT JOIN v_unit_latest_prospek_id j ON j.id_pelanggan = a.id_pelanggan
    							   LEFT JOIN ms_status_prospek k ON k.id_status_prospek = j.id_status_prospek
								   LEFT JOIN (SELECT data_import,from_salesman,to_salesman FROM tb_import 
								   			  WHERE to_salesman LIKE '%$sales%' AND deleted_flag = 0) 
								   			  d ON d.data_import = a.id_pelanggan
								   LEFT JOIN tb_database e ON e.id_database = a.id_database
								   LEFT JOIN ms_users h ON h.username = a.salesman

								   WHERE a.nama_perush LIKE '%$nama_perush%' 
								   AND (a.salesman LIKE '%$sales%')
								   AND (h.divisi IN ('hino','hino3'))
								   AND a.deleted_flag = '0'
								   
								   ORDER BY a.id_pelanggan DESC") or die (mysql_error());
			?>
			
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					 <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Data Customer
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="sample_3">
							<thead>
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Nama Perusahaan</th>
								<th>Pengurus</th>
								<th>Jabatan</th>
								<th>Status</th>
								<th>Salesman</th>
								<th>SalesPart</th>
								<th>SalesServ</th>
							</tr>
							</thead>
							<tbody>
							<?php
								while ($row = mysql_fetch_array($result)) {
							?>
							<tr>
								<td>#</td>
								<td><?php echo $row['id_pelanggan'];?></td>
								<td>
									<a href="?module=data_customer&act=detail&id_pelanggan=<?php echo $row['id_pelanggan'];?>" target="_blank">			
									<?php echo $row['nama_perush'];?>
									</a> &nbsp&nbsp
									<?php if($row['sesuai_ktp'] == '1') { ?> 
										<div class="label label-xs label-info">
												<i class="fa fa-star"></i>
										</div>
									<?php } ?>
								</td>
								<td><?php echo $row['nama_pengurus'];?> </td>
								<td><?php echo $row['jabatan'];?></td>
								<td><?php echo $row['status_prospek'];?></td>
								<td><?php echo $row['salesman'];?></td>
								<td><?php echo $row['salespart'];?></td>
								<td><?php echo $row['salesserv'];?></td>
							</tr>
							<?php } ?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php } ?>
			<?php break ; ?>

			<?php case "tambah" : ?>

			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-user"></i>Form Tambah Data Customer
					</div>
					<div class="tools">
					</div>
				</div>

					<?php
					error_reporting (E_ALL ^ E_NOTICE);
					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';



						if(empty($error)){

							$kode_pelanggan = '';
							$id_asal_prospek = $_POST['id_asal_prospek'];
							$id_database = $_POST['id_database'];
							$id_bidang_usaha = $_POST['id_bidang_usaha'];
							$nama_perush = addslashes($_POST['nama_perush']);
							$id_kategori_segmen_old = '';
							$id_segmen_old = '';
							$id_kategori_segmen = $_POST['id_kategori_segmen'];
							$id_segmen = $_POST['id_segmen'];
							$alamat_kantor = addslashes($_POST['alamat_kantor']);
							$telp_kantor = $_POST['telp_kantor'];
							$fax_kantor = $_POST['fax_kantor'];
							$email_kantor = $_POST['email_kantor'];

							$hino = $_POST['hino'];
							$mitsubishi = $_POST['mitsubishi'];
							$toyota = $_POST['toyota'];
							$isuzu = $_POST['isuzu'];
							$lain = $_POST['lain'];

							$nama_pengurus = addslashes($_POST['nama_pengurus']);
							$jabatan = $_POST['jabatan'];
							$no_hp = $_POST['no_hp'];
							$email = $_POST['email'];
							$no_ktp = $_POST['no_ktp'];
							$tmpt_lahir = $_POST['tmpt_lahir'];
							$tgl_lahir = $_POST['tgl_lahir'];
							$jns_kelamin = $_POST['jns_kelamin'];
							$agama = $_POST['agama'];
							$gol_darah = $_POST['gol_darah'];
							$status_perkawinan = $_POST['status_perkawinan'];
							$id_pekerjaan = $_POST['id_pekerjaan'];
							$kewarganegaraan = $_POST['kewarganegaraan'];
							$id_prov = $_POST['id_prov'];
							$id_kota = $_POST['id_kota'];
							$id_kecamatan = $_POST['id_kecamatan'];
							$id_kelurahan = $_POST['id_kelurahan'];
							$alamat_rumah = addslashes($_POST['alamat_rumah']);
							$rt = $_POST['rt'];
							$rw = $_POST['rw'];
							$kodepos = $_POST['kodepos'];
							$telp_rumah = $_POST['telp_rumah'];
							$hobi1 = $_POST['hobi1'];
							$hobi2 = $_POST['hobi2'];
							$hobi3 = $_POST['hobi3'];
							$hobi4 = $_POST['hobi4'];
							

							$salesman = $_POST['sales'];
							$salespart = $_POST['sales'];
							$salesserv = $_POST['sales'];

							$created_by = $_POST['sales'];
							
							$merk_oli = $_POST['merk_oli'];
							$merk_part = $_POST['merk_part'];
							$toko_part = $_POST['toko_part'];
							$toko_serv = $_POST['toko_serv'];
							
							$sesuai_ktp = $_POST['sesuai_ktp'];
							$validasi_by = $_SESSION['username'];

					if ($_SESSION[sublevel] == 'unit') {
					$tambah = mysql_query("INSERT INTO tb_pelanggan(
												 id_pelanggan,kode_pelanggan,id_asal_prospek,id_database,id_bidang_usaha,
												 nama_perush,id_kategori_segmen,id_segmen,alamat_kantor,telp_kantor,
												 fax_kantor,email_kantor,hino,mitsubishi,toyota,isuzu,lain,nama_pengurus,
												 jabatan,no_hp,email,no_ktp,tmpt_lahir,tgl_lahir,jns_kelamin,agama,gol_darah,
												 status_perkawinan,id_pekerjaan,kewarganegaraan,id_prov,id_kota,id_kecamatan,
												 id_kelurahan,alamat_rumah,rt,rw,kodepos,telp_rumah,hobi1,hobi2,hobi3,hobi4,
												 salesman,created_by,created_date)
											VALUES('','$kode_pelanggan','$id_asal_prospek','$id_database','$id_bidang_usaha','$nama_perush','$id_kategori_segmen','$id_segmen','$alamat_kantor','$telp_kantor','$fax_kantor','$email_kantor','$hino','$mitsubishi','$toyota','$isuzu','$lain','$nama_pengurus','$jabatan','$no_hp','$email','$no_ktp','$tmpt_lahir','$tgl_lahir','$jns_kelamin','$agama' ,'$gol_darah' ,'$status_perkawinan','$id_pekerjaan','$kewarganegaraan','$id_prov' ,'$id_kota','$id_kecamatan' ,'$id_kelurahan' ,'$alamat_rumah','$rt','$rw','$kodepos','$telp_rumah','$hobi1','$hobi2','$hobi3','$hobi4','$salesman','$salesman',NOW())") 
											OR DIE(mysql_error());

						$q = mysql_query("SELECT MAX(id_pelanggan) AS getID FROM tb_pelanggan");   
          				$r = mysql_fetch_array($q);

							  mysql_query("INSERT INTO tb_kuisioner(
												 id_kuisioner,id_pelanggan,merk_oli,merk_part,toko_part,toko_serv,created_by,
												 created_date)
											VALUES('','$r[getID]','$merk_oli','$merk_part','$toko_part','$toko_serv',
											'$salesman',NOW())") 
											OR DIE(mysql_error());

					} elseif ($_SESSION[sublevel] == 'part') {
					$tambah = mysql_query("INSERT INTO tb_pelanggan (
												 id_pelanggan,kode_pelanggan,id_asal_prospek,id_database,id_bidang_usaha,
												 nama_perush,id_kategori_segmen,id_segmen,alamat_kantor,telp_kantor,
												 fax_kantor,email_kantor,hino,mitsubishi,toyota,isuzu,lain,nama_pengurus,
												 jabatan,no_hp,email,no_ktp,tmpt_lahir,tgl_lahir,jns_kelamin,agama,gol_darah,
												 status_perkawinan,id_pekerjaan,kewarganegaraan,id_prov,id_kota,id_kecamatan,
												 id_kelurahan,alamat_rumah,rt,rw,kodepos,telp_rumah,hobi1,hobi2,hobi3,hobi4,
												 salespart,created_by,created_date)
											VALUES('','$kode_pelanggan','$id_asal_prospek','$id_database','$id_bidang_usaha','$nama_perush','$id_kategori_segmen','$id_segmen','$alamat_kantor','$telp_kantor','$fax_kantor','$email_kantor','$hino','$mitsubishi','$toyota','$isuzu','$lain','$nama_pengurus','$jabatan','$no_hp','$email','$no_ktp','$tmpt_lahir','$tgl_lahir','$jns_kelamin','$agama' ,'$gol_darah' ,'$status_perkawinan','$id_pekerjaan','$kewarganegaraan','$id_prov' ,'$id_kota','$id_kecamatan' ,'$id_kelurahan' ,'$alamat_rumah','$rt','$rw','$kodepos','$telp_rumah','$hobi1','$hobi2','$hobi3','$hobi4','$salespart','$salespart',NOW())") 
											OR DIE(mysql_error());
						$q = mysql_query("SELECT MAX(id_pelanggan) AS getID FROM tb_pelanggan");   
          				$r = mysql_fetch_array($q);

							  mysql_query("INSERT INTO tb_kuisioner(
												 id_kuisioner,id_pelanggan,merk_oli,merk_part,toko_part,toko_serv,created_by,
												 created_date)
											VALUES('','$r[getID]','$merk_oli','$merk_part','$toko_part','$toko_serv',
											'$salesman',NOW())") 
											OR DIE(mysql_error());
					
					} elseif ($_SESSION[sublevel] == 'service') {
					$tambah = mysql_query("INSERT INTO tb_pelanggan (
												 id_pelanggan,kode_pelanggan,id_asal_prospek,id_database,id_bidang_usaha,
												 nama_perush,id_kategori_segmen,id_segmen,alamat_kantor,telp_kantor,
												 fax_kantor,email_kantor,hino,mitsubishi,toyota,isuzu,lain,nama_pengurus,
												 jabatan,no_hp,email,no_ktp,tmpt_lahir,tgl_lahir,jns_kelamin,agama,gol_darah,
												 status_perkawinan,id_pekerjaan,kewarganegaraan,id_prov,id_kota,id_kecamatan,
												 id_kelurahan,alamat_rumah,rt,rw,kodepos,telp_rumah,hobi1,hobi2,hobi3,hobi4,
												 salesserv,created_by,created_date)
											VALUES('','$kode_pelanggan','$id_asal_prospek','$id_database','$id_bidang_usaha','$nama_perush','$id_kategori_segmen','$id_segmen','$alamat_kantor','$telp_kantor','$fax_kantor','$email_kantor','$hino','$mitsubishi','$toyota','$isuzu','$lain','$nama_pengurus','$jabatan','$no_hp','$email','$no_ktp','$tmpt_lahir','$tgl_lahir','$jns_kelamin','$agama' ,'$gol_darah' ,'$status_perkawinan','$id_pekerjaan','$kewarganegaraan','$id_prov' ,'$id_kota','$id_kecamatan' ,'$id_kelurahan' ,'$alamat_rumah','$rt','$rw','$kodepos','$telp_rumah','$hobi1','$hobi2','$hobi3','$hobi4','$salesserv','$salesserv',NOW())") 
											OR DIE(mysql_error());

						$q = mysql_query("SELECT MAX(id_pelanggan) AS getID FROM tb_pelanggan");   
          				$r = mysql_fetch_array($q);

							  mysql_query("INSERT INTO tb_kuisioner(
												 id_kuisioner,id_pelanggan,merk_oli,merk_part,toko_part,toko_serv,created_by,
												 created_date)
											VALUES('','$r[getID]','$merk_oli','$merk_part','$toko_part','$toko_serv',
											'$salesman',NOW())") 
											OR DIE(mysql_error());
					}
						if($tambah){
							header('location:?module=data_customer&act=data&notif=1');

											}
										}
											}
					?>
				
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="#" method="post" class="horizontal-form">
						<div class="form-body">
								
								<h3 class="form-section">Profil Perusahaan</h3>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Sales</label>
											<input type="text"  class="form-control" readonly="readonly" name="sales" value ="<?php echo $_SESSION['username'] ?>">
										</div>
									</div>
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Asal Prospek</label>
											<select class="form-control select2me" name="id_asal_prospek" required >
												<option selected="selected" value="">- Pilih Asal Prospek -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_asal_prospek");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_asal_prospek'];	
															echo '<option value="'.$id.'">'.$row['nama'].'</option>';
															}
													?>
											</select>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kode Database</label>
											<select required="required" class="form-control select2me " name="id_database">
												<option selected="selected" >- Pilih Kode Database -</option>
													<?php
														$sql=mysql_query("SELECT * FROM tb_database WHERE deleted_flag=0 AND divisi = 'hino'");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_database'];	
															echo '<option value="'.$id.'">'.$row['nama_database'].'</option>';
															}
													?>
											</select>
										</div>
									</div>
													
								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Badan Usaha</label>
											<select class="form-control " name="id_bidang_usaha" required>
												<option  selected="selected" value="">- Pilih Badan Usaha -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_bidang_usaha");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_bidang_usaha'];	
															echo '<option value="'.$id.'">'.$row['nama'].'</option>';
															}
													?>
											</select>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Nama Perusahaan/Pribadi</label>
											<input type="text" class="form-control" autocomplete="off"  name="nama_perush" placeholder="Nama Perusahaan / Pribadi" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Main Segmen</label>
											<select required="required" class="form-control select2me main_segmen" id="main_segmen" name="id_kategori_segmen" required>
												<option selected="selected" value="">- Pilih Segmen -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_segmen_kategori");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_kategori_segmen'];	
															echo '<option value="'.$id.'">'.$row['kategori_segmen'].'</option>';
															}
													?>
											</select>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Sub Segmen</label>
											<select class="form-control sub_segmen" id="sub_segmen" name="id_segmen" required>
												<option selected="selected" value="">- Pilih Sub Segmen -</option>
													<?php
														$sql=mysql_query("SELECT * FROM tb_database WHERE deleted_flag=0");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_database'];	
															echo '<option value="'.$id.'">'.$row['nama_database'].'</option>';
															}
													?>
											</select>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>
													
								</div>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Alamat Kantor</label>
											<textarea class="form-control" rows="3" name="alamat_kantor" placeholder="Alamat Kantor"></textarea>
											<span class="help-block">Jika tidak ada isi dengan (-) </span>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Telepon Kantor</label>
											<input type="text" class="form-control" autocomplete="off" name="telp_kantor" placeholder="Telp. Kantor">
											<span class="help-block">Jika tidak ada isi dengan (-) </span>
										</div>
									</div>				
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Fax Kantor</label>
											<input type="text"  class="form-control" autocomplete="off" name="fax_kantor" placeholder="Fax Kantor" >
											<span class="help-block">Jika tidak ada isi dengan (-) </span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Email Kantor</label>
											<input type="text"  class="form-control" autocomplete="off" name="email_kantor" placeholder="Email Kantor" >
											<span class="help-block">Jika tidak ada isi dengan (-) </span>
										</div>
									</div>
													
								</div>

								<h3 class="form-section">Populasi Unit Yang Dimiliki</h3>
								
								<div class="row">
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Hino</label>
											<input type="text" class="form-control" autocomplete="off" name="hino" placeholder="Jumlah Unit" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Mitsubishi</label>
											<input type="text" class="form-control" autocomplete="off" name="mitsubishi" placeholder="Jumlah Unit" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Toyota</label>
											<input type="text" class="form-control" autocomplete="off" name="toyota" placeholder="Jumlah Unit" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>		
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Isuzu</label>
											<input type="text" class="form-control" autocomplete="off" name="isuzu" placeholder="Jumlah Unit" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Merk Lain</label>
											<input type="text" class="form-control" autocomplete="off" name="lain" placeholder="Jumlah Unit" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>
													
								</div>

								<h3 class="form-section">Kuisioner After Sales</h3>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Merk Oli </label>
											<input type="text" class="form-control" autocomplete="off" name="merk_oli" placeholder="Yang Biasa Digunakan" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Merk Spareparts</label>
											<input type="text" class="form-control" autocomplete="off" name="merk_part" placeholder="Yang Biasa Dipakai" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tempat Pembelian Parts/Oli</label>
											<input type="text" class="form-control" autocomplete="off" name="toko_part" placeholder="Nama Toko" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>		
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tempat Service Unit</label>
											<input type="text" class="form-control" autocomplete="off" name="toko_serv" placeholder="Nama Bengkel" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>
													
								</div>

								<h3 class="form-section">Profil Pemilik/Pengurus</h3>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Nama Pemilik/Pengurus</label>
											<input type="text" class="form-control" autocomplete="off" name="nama_pengurus" placeholder="Nama Pemilik/Pengurus" required>
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Jabatan</label>
											<input type="text" class="form-control" autocomplete="off" name="jabatan" placeholder="Jabatan" required >
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Hp</label>
											<input type="text" class="form-control" autocomplete="off" name="no_hp" placeholder="No. Handphone" required >
											<span class="help-block">*Wajib diisi </span>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Email</label>
											<input type="text" class="form-control" autocomplete="off" name="email" placeholder="@Email" >
											<span class="help-block">Jika tidak ada isi dengan (-) </span>
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. KTP</label>
											<input type="text" class="form-control" autocomplete="off" name="no_ktp" placeholder="Nomor Identitas" >
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tempat Lahir</label>
											<input type="text" class="form-control" autocomplete="off" name="tmpt_lahir" placeholder="Tempat Lahir" >
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Tgl lahir</label>
											<input type="text" class="form-control date-picker" autocomplete="off" data-date-format="yyyy-mm-dd"  name="tgl_lahir" placeholder="Tgl Lahir" >
										</div>
									</div>
								
								</div>

								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Jenis Kelamin</label>
											<select class="form-control" name="jns_kelamin">
												<option value='0' selected>- Pilih Jenis Kelamin -</option>
												<option value="L">Laki-Laki</option>
												<option value="P">Perempuan</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Agama</label>
											<select class="form-control" name="agama">
												<option value='0' selected>- Pilih Agama -</option>
												<option value="1">Islam</option>
												<option value="2">Kristen</option>
												<option value="3">Katholik</option>
												<option value="4">Budha</option>
												<option value="5">Hindu</option>
												<option value="6">Lain-lain</option>
											</select>
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Golongan Darah</label>
											<select class="form-control" name="gol_darah">
												<option value='0' selected>- Pilih Golongan Darah -</option>
												<option value="1">A</option>
												<option value="2">B</option>
												<option value="3">AB</option>
												<option value="4">O</option>
												<option value="5">-</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Status Perkawinan</label>
											<select class="form-control" name="status_perkawinan">
												<option value='0' selected>- Pilih Satus -</option>
												<option value="1">Belum Kawin</option>
												<option value="2">Kawin</option>
												<option value="3">Duda</option>
												<option value="4">Janda</option>
											</select>
										</div>
									</div>
								
								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Jenis Pekerjaan</label>
											<select class="form-control select2me" name="id_pekerjaan">
												<option value='0' selected="selected">- Pilih Jenis Pekerjaan -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_pekerjaan");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_pekerjaan'];	
															echo '<option value="'.$id.'">'.$row['pekerjaan'].'</option>';
															}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kewarganegaraan</label>
											<select class="form-control" name="kewarganegaraan">
												<option value='0' selected>- Pilih Kewarganegaraan -</option>
												<option value="1">WNI : Indonesia</option>
												<option value="2">WNA : Asing</option>
											</select>
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Provinsi</label>
											<select class="form-control select2me provinsi" name="id_prov">
												<option value="0" selected="selected">- Pilih Provinsi -</option>
													<?php
														$sql=mysql_query("SELECT id_prov, nama_prov FROM ms_prov ORDER BY id_prov ASC");
															while($row=mysql_fetch_array($sql))
																	{
														echo "<option value='$row[id_prov]'"; if ($row[id_prov] == '33') { echo "selected='selected'"; echo ">$row[nama_prov]</option>";
                                                }
                                                else {
                                                      echo ">$row[nama_prov]</option>";
                                                }
															}
													?>
											</select>
										</div>
									</div>
										
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kota</label>
											<select class="form-control select2 kota" name="id_kota">
												<?php
														$sql=mysql_query("SELECT * FROM ms_kota WHERE id_prov = 33 ORDER BY id_kota ASC");
															while($row=mysql_fetch_array($sql))
																	{
														echo "<option value='$row[id_kota]'"; if ($row[id_kota] == '3374') { echo "selected='selected'"; echo ">$row[nama_kota]</option>";
                                                }
                                                else {
                                                      echo ">$row[nama_kota]</option>";
                                                }
															}
												?>
											</select>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kecamatan</label>
											<select class="form-control select2 kecamatan" name="id_kecamatan">
												<option value='0' selected>- Pilih Kecamatan -</option>
												<?php
														$sql=mysql_query("SELECT * FROM ms_kecamatan WHERE id_kota = 3374 ORDER BY id_kecamatan ASC");
															while($row=mysql_fetch_array($sql))
																	{
														
														$id = $row['id_kecamatan'];	
															echo '<option value="'.$id.'">'.$row['nama_kecamatan'].'</option>';
															
															}
												?>

											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kelurahan</label>
											<select class="form-control select2 kelurahan" name="id_kelurahan">
												<option value='0' selected>- Pilih Kelurahan -</option>

											</select>
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Alamat Rumah</label>
											<textarea class="form-control" rows="3" autocomplete="off" name="alamat_rumah" placeholder="Alamat Kantor"></textarea>
										</div>
									</div>
									
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">RT</label>
											<input type="text" class="form-control" autocomplete="off" name="rt" placeholder="RT">
										</div>
									</div>				
									
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">RW</label>
											<input type="text"  class="form-control" autocomplete="off" name="rw" placeholder="RW" >
										</div>
									</div>

									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">KodePos</label>
											<input type="text" class="form-control" autocomplete="off" name="kodepos" placeholder="KodePos" >
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Telepon Rumah</label>
											<input type="text"  class="form-control" autocomplete="off" name="telp_rumah" placeholder="No. Telp" >
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 1</label>
											<select class="form-control select2me" name="hobi1">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];	
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 2</label>
											<select class="form-control select2me" name="hobi2">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];	
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 3</label>
											<select class="form-control select2me" name="hobi3">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];	
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 4</label>
											<select class="form-control select2me" name="hobi4">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];	
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															}
													?>
											</select>
										</div>
									</div>
								
								</div>
								
						</div>
						<div class="form-actions right">
							<a href='?module=data_customer&act=data' type="button" class="btn default">Cancel</a>
							<button type="submit" class="btn blue" value="Input">Submit</button>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>

			<?php break ; ?>


			<?php case "detail" : ?>

			<?php
			$notif = $_GET['notif'];
			
			if ($_GET['notif'] == 1) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Aktivitas Harian Berhasil ditambahkan !!
                </div>
            <?php
			} else if ($_GET['notif'] == 2) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Prospek Berhasil ditambahkan !!
                </div>
             <?php
			} else if ($_GET['notif'] == 3) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Pelanggan Berhasil diperbarui !!
                </div>
            <?php
			} else if ($_GET['notif'] == 4) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Aktivitas Harian Berhasil diperbarui !!
                </div>
            <?php
			} else if ($_GET['notif'] == 5) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Prospek Berhasil diperbarui !!
                </div>
            <?php
			} else if ($_GET['notif'] == 6) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Pelanggan Berhasil hapus !!
                </div>
            <?php
			} else if ($_GET['notif'] == 7) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Aktivitas Harian Berhasil hapus !!
                </div>
            <?php
			} else if ($_GET['notif'] == 8) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Prospek Berhasil hapus !!
                </div>
			<?php 
				} 
			?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable-line boxless tabbable-reversed">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_0" data-toggle="tab">Detail Customer </a>
							</li>
							<li>
								<a href="#tab_1" data-toggle="tab">Data Prospek </a>
							</li>
							<li>
								<a href="#tab_2" data-toggle="tab">Aktivitas Unit </a>
							</li>
							<li>
								<a href="#tab_3" data-toggle="tab">Aktivitas Sparepart </a>
							</li>
							<li>
								<a href="#tab_4" data-toggle="tab">Aktivitas Service </a>
							</li>
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_0">
								<div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption">
										<i class="fa fa-gift"></i>Profil Customer
										</div>
									</div>
				
									<?php 
										$id_pelanggan = $_GET['id_pelanggan'];	   	
										$result = mysql_query("SELECT * FROM tb_pelanggan 
															   LEFT JOIN tb_kuisioner ON tb_kuisioner.id_pelanggan = tb_pelanggan.id_pelanggan WHERE tb_pelanggan.id_pelanggan='$id_pelanggan'");
										$array = mysql_fetch_array($result);
									?>

									<div class="portlet-body">
						
										<div class="form-body">
						
											<h3 class="form-section">Profil Perusahaan</h3>
									
											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Sales</label>
														<input type="text"  class="form-control" name="sales" value ="<?php echo $array['salesman'] ?>"  disabled >
													</div>
												</div>
																
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Asal Prospek</label>
														<select class="form-control select2me" name="id_asal_prospek"  disabled>
														<option>- Pilih Asal Prospek -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_asal_prospek");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_asal_prospek'];

																	if($id == $array['id_asal_prospek']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['nama'].'</option>';
																				}	else {
																		echo '<option value="'.$id.'">'.$row['nama'].'</option>';
																			}
																		}
																?>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Kode Database</label>
														<select class="form-control select2me " name="id_database" disabled>
														<option>- Pilih Kode Database -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM tb_database WHERE deleted_flag=0");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_database'];	
																	if($id == $array['id_database']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['nama_database'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['nama_database'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>
																
											</div>

											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Bidang Usaha</label>
														<select class="form-control" nama="id_bidang_usaha" disabled>
														<option>- Pilih Bidang Usaha -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_bidang_usaha");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_bidang_usaha'];	
																	if($id == $array['id_bidang_usaha']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['nama'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['nama'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Nama Perusahaan/Pribadi</label>
														<input type="text" class="form-control" autocomplete="off" name="nama_perush" value="<?php echo $array['nama_perush']; ?>" readonly>
													</div>
												</div>
																
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Main Segmen</label>
														<select class="form-control select2me main_segmen" id="main_segmen" name="id_kategori_segmen" disabled>
															<option>- Pilih Main Segmen -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_segmen_kategori");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_kategori_segmen'];	
																	if($id == $array['id_kategori_segmen']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['kategori_segmen'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['kategori_segmen'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Sub Segmen</label>
														<select class="form-control sub_segmen" id="sub_segmen" name="id_segmen" disabled>
																<option>- Pilih Sub Segmen -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_segmen ");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_segmen'];	
																	if($id == $array['id_segmen']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['segmen'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['segmen'].'</option>';
																		}}
																?>
														</select>
													</div>
												</div>
																
											</div>
									
											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Alamat Kantor</label>
														<textarea class="form-control" rows="3" name="alamat_kantor" readonly><?php echo $array['alamat_kantor']; ?></textarea>
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Telepon Kantor</label>
														<input type="text" class="form-control" autocomplete="off" name="telp_kantor" value="<?php echo $array['telp_kantor']; ?>" disabled>
													</div>
												</div>				
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Fax Kantor</label>
														<input type="text"  class="form-control" autocomplete="off" name="fax_kantor" value="<?php echo $array['fax_kantor']; ?>" disabled>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Email Kantor</label>
														<input type="text"  class="form-control" autocomplete="off" name="email_kantor" value="<?php echo $array['email_kantor']; ?>" disabled>
													</div>
												</div>
																
											</div>

											<h3 class="form-section">Populasi Unit Yang Dimiliki</h3>
											
											<div class="row">
												
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">Hino</label>
														<input type="text" class="form-control" autocomplete="off" name="hino" value="<?php echo $array['hino']; ?>" disabled>
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">Mitsubishi</label>
														<input type="text" class="form-control" autocomplete="off" name="mitsubishi" value="<?php echo $array['mitsubishi']; ?>" disabled>
													</div>
												</div>
												
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">Toyota</label>
														<input type="text" class="form-control" autocomplete="off" name="toyota" value="<?php echo $array['toyota']; ?>" disabled>
													</div>
												</div>		
												
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">Isuzu</label>
														<input type="text" class="form-control" autocomplete="off" name="isuzu" value="<?php echo $array['isuzu']; ?>" disabled>
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">Merk Lain</label>
														<input type="text" class="form-control" autocomplete="off" name="lain" value="<?php echo $array['lain']; ?>" disabled>
													</div>
												</div>
																
											</div>

											<h3 class="form-section">Kuisioner After Sales</h3>
											
											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Merk Oli </label>
														<input type="text" class="form-control" autocomplete="off" name="merk_oli" value="<?php echo $array['merk_oli']; ?>" disabled>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Merk Spareparts</label>
														<input type="text" class="form-control" autocomplete="off" name="merk_part" value="<?php echo $array['merk_part']; ?>" disabled>
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Tempat Pembelian Parts/Oli</label>
														<input type="text" class="form-control" autocomplete="off" name="toko_part" value="<?php echo $array['toko_part']; ?>" disabled>
													</div>
												</div>		
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Tempat Service Unit</label>
														<input type="text" class="form-control" autocomplete="off" name="toko_serv" value="<?php echo $array['toko_serv']; ?>" disabled>
													</div>
												</div>
																
											</div>

											<h3 class="form-section">Profil Pemilik/Pengurus</h3>
											
											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Nama Pemilik/Pengurus</label>
														<input type="text" class="form-control" autocomplete="off" name="nama_pengurus" value="<?php echo $array['nama_pengurus']; ?>" readonly>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Jabatan</label>
														<input type="text" class="form-control" autocomplete="off" name="jabatan" value="<?php echo $array['jabatan']; ?>" readonly>
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">No. Hp</label>
														<input type="text" class="form-control" autocomplete="off" name="no_hp" value="<?php echo $array['no_hp']; ?>" readonly>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Email</label>
														<input type="text" class="form-control" autocomplete="off" name="email" value="<?php echo $array['email']; ?>" readonly>
													</div>
												</div>

											</div>

											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">No. KTP</label>
														<input type="text" class="form-control" autocomplete="off" name="no_ktp" value="<?php echo $array['no_ktp']; ?>" disabled>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Tempat Lahir</label>
														<input type="text" class="form-control" autocomplete="off" name="tmpt_lahir" value="<?php echo $array['tmpt_lahir']; ?>" disabled >
													</div>
												</div>
												
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">Tgl lahir</label>
														<input type="text" class="form-control date-picker" autocomplete="off" data-date-format="yyyy-mm-dd"  name="tgl_lahir" value="<?php echo $array['tgl_lahir']; ?>" disabled >
													</div>
												</div>
											</div>

											<div class="row">

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Jenis Kelamin</label>
														<select class="form-control" name="jns_kelamin" disabled="">
															<option value='0'>- Pilih Jenis Kelamin -</option>
															<option value="L" <?php if($array['jns_kelamin'] == 'l') { echo "selected"; } ?>>Laki-Laki</option>
															<option value="P" <?php if($array['jns_kelamin'] == 'p') { echo "selected"; } ?>>Perempuan</option>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Agama</label>
														<select class="form-control" name="agama" disabled="">
															<option value='0' selected>- Pilih Agama -</option>
															<option value="1" <?php if($array['agama'] == '1') { echo "selected"; } ?>>Islam</option>
															<option value="2" <?php if($array['agama'] == '2') { echo "selected"; } ?>>Kristen</option>
															<option value="3" <?php if($array['agama'] == '3') { echo "selected"; } ?>>Katholik</option>
															<option value="4" <?php if($array['agama'] == '4') { echo "selected"; } ?>>Budha</option>
															<option value="5" <?php if($array['agama'] == '5') { echo "selected"; } ?>>Hindu</option>
															<option value="6" <?php if($array['agama'] == '6') { echo "selected"; } ?>>Lain-lain</option>
														</select>
													</div>
												</div>

											</div>

											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Golongan Darah</label>
														<select class="form-control" name="gol_darah" disabled="">
															<option value='0' selected>- Pilih Golongan Darah -</option>
															<option value="1" <?php if($array['gol_darah'] == '1') { echo "selected"; } ?>>A</option>
															<option value="2" <?php if($array['gol_darah'] == '2') { echo "selected"; } ?>>B</option>
															<option value="3" <?php if($array['gol_darah'] == '3') { echo "selected"; } ?>>AB</option>
															<option value="4" <?php if($array['gol_darah'] == '4') { echo "selected"; } ?>>O</option>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Status Perkawinan</label>
														<select class="form-control" name="status_perkawinan" disabled="">
															<option value='0' selected>- Pilih Satus -</option>
															<option value="1" <?php if($array['status_perkawinan'] == '1') { echo "selected"; } ?>>Belum Kawin</option>
															<option value="2" <?php if($array['status_perkawinan'] == '2') { echo "selected"; } ?>>Kawin</option>
															<option value="3" <?php if($array['status_perkawinan'] == '3') { echo "selected"; } ?>>Duda</option>
															<option value="4" <?php if($array['status_perkawinan'] == '4') { echo "selected"; } ?>>Janda</option>
														</select>
													</div>
												</div>
											
											</div>

											<div class="row">	
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Jenis Pekerjaan</label>
														<select class="form-control select2me" name="id_pekerjaan" disabled="">
															<option value='0' selected="selected">- Pilih Jenis Pekerjaan -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_pekerjaan");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_pekerjaan'];	
																	if($id == $array['id_pekerjaan']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['pekerjaan'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['pekerjaan'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Kewarganegaraan</label>
														<select class="form-control" name="kewarganegaraan" disabled="">
															<option value='0' selected="selected">- Pilih Kewarganegaraan -</option>
															<option value="1" <?php if($array['kewarganegaraan'] == '1') { echo "selected"; } ?>>WNI : Indonesia</option>
															<option value="2" <?php if($array['kewarganegaraan'] == '2') { echo "selected"; } ?>>WNA : Asing</option>
														</select>
													</div>
												</div>

											</div>

											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Provinsi</label>
														<select class="form-control select2me provinsi" name="id_prov" disabled="">
															<option value="0" selected="selected">- Pilih Provinsi -</option>
																<?php
																	$sql=mysql_query("SELECT id_prov, nama_prov FROM ms_prov ORDER BY id_prov ASC");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_prov'];	
																	if($id == $array['id_prov']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['nama_prov'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['nama_prov'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>
													
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Kota</label>
														<select class="form-control select2 kota" name="id_kota" disabled="">
															<option value="0" selected="selected">- Pilih Provinsi -</option>
															<?php
																	$sql=mysql_query("SELECT * FROM ms_kota WHERE id_prov = '$array[id_prov]' ORDER BY id_kota ASC");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_kota'];	
																	if($id == $array['id_kota']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['nama_kota'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['nama_kota'].'</option>';
																		} }
															?>
														</select>
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Kecamatan</label>
														<select class="form-control select2 kecamatan" name="id_kecamatan" disabled>
															<option value='0' selected>- Pilih Kecamatan -</option>
															<?php
																	$sql=mysql_query("SELECT * FROM ms_kecamatan WHERE id_kota = $array[id_kota] ORDER BY id_kecamatan ASC");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_kecamatan'];	
																	if($id == $array['id_kecamatan']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['nama_kecamatan'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['nama_kecamatan'].'</option>';
																		} }
															?>

														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Kelurahan</label>
														<select class="form-control select2 kelurahan" name="id_kelurahan" disabled="">
															<option value='0' selected>- Pilih Kelurahan -</option>
															<?php
																	$sql=mysql_query("SELECT * FROM ms_kelurahan WHERE id_kecamatan=$array[id_kecamatan] ORDER BY id_kelurahan ASC");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_kelurahan'];	
																	if($id == $array['id_kelurahan']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['nama_kelurahan'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['nama_kelurahan'].'</option>';
																		} }
															?>
														</select>
													</div>
												</div>

											</div>

											<div class="row">
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Alamat Rumah</label>
														<textarea class="form-control" rows="3" autocomplete="off" name="alamat_rumah" readonly=""><?php echo $array['alamat_rumah']; ?></textarea>
													</div>
												</div>
												
												<div class="col-md-1">
													<div class="form-group">
														<label class="control-label">RT</label>
														<input type="text" class="form-control" autocomplete="off" name="rt" value="<?php echo $array['rt']; ?>" disabled>
													</div>
												</div>				
												
												<div class="col-md-1">
													<div class="form-group">
														<label class="control-label">RW</label>
														<input type="text"  class="form-control" autocomplete="off" name="rw" value="<?php echo $array['rw']; ?>" disabled >
													</div>
												</div>

												<div class="col-md-1">
													<div class="form-group">
														<label class="control-label">KodePos</label>
														<input type="text" class="form-control" autocomplete="off" name="kodepos" value="<?php echo $array['kodepos']; ?>" disabled >
													</div>
												</div>

												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">Telepon Rumah</label>
														<input type="text"  class="form-control" autocomplete="off" name="telp_rumah" value="<?php echo $array['telp_rumah']; ?>" disabled >
													</div>
												</div>

												<?php if($_SESSION[level] == 'admin') { ?> 
												<div class="col-md-1">
													<div class="form-group">
														<label class="control-label">Validasi</label>
														<input type="checkbox" name="sesuai_ktp" value="1" <?php if ($array['sesuai_ktp'] == '1' ) { echo "checked" ; } ?> class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>" disabled>
														
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Kode Pelanggang Ksystem</label>
														<input type="text" class="form-control" autocomplete="off" name="kode_pelanggan" value="<?php echo $array['kode_pelanggan']; ?>" disabled >
													</div>
												</div>
												<?php } ?>
											</div>

											<div class="row">	
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Hobi 1</label>
														<select class="form-control select2me" name="hobi1" disabled>
															<option value= "0" selected="selected">- Pilih Hobi -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_hobi");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_hobi'];	
																	if($id == $array['hobi1']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Hobi 2</label>
														<select class="form-control select2me" name="hobi2" disabled>
															<option value= "0" selected="selected">- Pilih Hobi -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_hobi");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_hobi'];
																	if($id == $array['hobi2']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																				} else {	
																		echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Hobi 3</label>
														<select class="form-control select2me" name="hobi3" disabled>
															<option value= "0" selected="selected">- Pilih Hobi -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_hobi");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_hobi'];	
																	if($id == $array['hobi3']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
																		} }
																?>
														</select>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Hobi 4</label>
														<select class="form-control select2me" name="hobi4" disabled>
															<option value= "0" selected="selected">- Pilih Hobi -</option>
																<?php
																	$sql=mysql_query("SELECT * FROM ms_hobi");
																		while($row=mysql_fetch_array($sql))
																				{
																	$id = $row['id_hobi'];	
																	if($id == $array['hobi4']){
																		echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																				} else {
																		echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
																		}}
																?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<br>
										<div class="form-actions right">
											<a href='?module=data_customer&act=edit&id_pelanggan=<?php echo $id_pelanggan ; ?>'>
												<button type="submit" class="btn blue" value="Input">Edit Data Customer</button>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab_1">
								<div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-cogs"></i>Tabel Prospek Unit
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse"></a>
										</div>
										<div class="actions">
											<a href="?module=prospek&act=add&id_pelanggan=<?php echo $id_pelanggan ?>" class="btn btn-default btn-sm">
											<i class="fa fa-plus"></i> Tambah Prospek </a>						
									  	</div>
									</div>
									<div class="portlet-body">
										<div class="table-scrollable">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Tgl Prospek <?php echo $tab_small ; ?></th>
														<th>No. Prospek</th>
														<th>Data Kendaraan <?php echo $tab_large ; ?></th>
														<th>Body Kendaraan</th>
														<th>Test Drive </th>
														<th>Jumlah</th>
														<th>Pembayaran</th>
														<th>Lembaga <?php echo $tab_medium; ?></th>
														<th>DP <?php echo $tab_small ; ?></th>
														<th>Tenor <?php echo $tab_small ; ?></th>
														<th>Status Prospek</th>
														<th>No. SPK</th>
														<th>Estimasi Pengiriman</th>
														<th>Tgl Pengiriman (DO)</th>
														<th>Action Aktivitas <?php echo $tab_small ; ?></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$no=1;
					                           			$result = mysql_query("SELECT a.id_prospek,	a.id_pelanggan,
					                           										  DATE_FORMAT(a.tgl_prospek, '%d %M %Y') AS tgl_prospek,
					                           										  a.no_prospek,	b.merk,	c.tipe,	d.warna, e.karoseri,
					                           										  (
					                           										  	CASE a.test_drive
					                           										  		WHEN 'Y' THEN 'Ya'
					                           										  		WHEN 'N' THEN 'Tidak'
					                           										  		ELSE '-'
					                           										  	END
					                           										  ) AS test_drive,
					                           										  a.jml_kendaraan,
					                           										  a.id_pembayaran,
					                           										  (
					                           										  	CASE a.id_pembayaran
					                           										  		WHEN '1' THEN 'Cash/Tunai'
					                           										  		WHEN '2' THEN 'Kredit'
					                           										  		ELSE '-'
					                           										  	END
					                           										  ) AS pembayaran,
					                           										  f.perusahaan,	g.kota_perusahaan, h.dp, w.tenor,
					                           										  a.id_status_prospek,
					                           										  i.status_prospek, x.no_spk,
					                           										  DATE_FORMAT(y.tgl_estimasi, '%d %M %Y') AS tgl_estimasi,
					                           										  DATE_FORMAT(z.tgl_do, '%d %M %Y') AS tgl_pengiriman,
					                           										  a.created_by,	a.created_date
					                           									FROM tb_prospek a
																				LEFT JOIN tb_kredit w ON w.id_prospek = a.id_prospek
																				LEFT JOIN tb_spk x ON x.id_prospek = a.id_prospek
																				LEFT JOIN tb_po y ON y.id_prospek = a.id_prospek
																				LEFT JOIN tb_do z ON z.id_prospek = a.id_prospek
																				LEFT JOIN ms_kendaraan b ON b.id_kendaraan = a.id_kendaraan
																				LEFT JOIN ms_tipe_kendaraan c ON c.id_tipe_kendaraan = a.id_tipe_kendaraan
																				LEFT JOIN ms_warna d ON d.id_warna = a.id_warna
																				LEFT JOIN ms_karoseri e ON e.id_karoseri = a.id_karoseri
																				LEFT JOIN ms_perusahaan f ON f.id_perusahaan = w.id_perusahaan
																				LEFT JOIN ms_kota_perusahaan g ON g.id_kota_perusahaan = w.id_kota_perusahaan
																				LEFT JOIN ms_dp h ON h.id_dp = w.id_dp
																				LEFT JOIN ms_status_prospek i ON i.id_status_prospek = a.id_status_prospek

																				WHERE a.id_pelanggan = $id_pelanggan AND deleted_flag = 0 ORDER BY id_prospek DESC");
																	while ($row = mysql_fetch_array($result)) {
												 	?>
													<tr>
														<td><?php echo $row['tgl_prospek']; ?></td>
														<td><?php echo $row['no_prospek']; ?></td>
														<td><?php echo $row['merk']; ?><?php echo $row['tipe']; ?></td>
														<td><?php echo $row['karoseri']; ?></td>
														<td><?php echo $row['test_drive']; ?></td>
														<td><?php echo $row['jml_kendaraan']; ?></td>
														<td><?php echo $row['pembayaran']; ?></td>

														<?php if ($row['id_pembayaran'] == '2') { ?> 
														<td><?php echo $row['perusahaan']; ?></td>
														<?php } elseif ($row['id_pembayaran'] == '1') { ?>
														<td>-</td> <?php } ?>

														<?php if ($row['id_pembayaran'] == '2') { ?> 
														<td><?php echo $row['dp']; ?></td>
														<?php } elseif ($row['id_pembayaran'] == '1') { ?>
														<td>-</td> <?php } ?>

														<?php if ($row['id_pembayaran'] == '2') { ?> 
														<td><?php echo $row['tenor']; ?> Tahun</td>
														<?php } elseif ($row['id_pembayaran'] == '1') { ?>
														<td>-</td> <?php } ?>

														<td><?php echo $row['status_prospek']; ?></td>
														<td><?php echo $row['no_spk']; ?></td>
														<td><?php echo str_replace($en, $id, $row['tgl_estimasi']); ?></td>
														<td><?php echo str_replace($en, $id, $row['tgl_pengiriman']); ?></td>
														<td align="center">
															 <a href="#" data-toggle="modal" class="btn btn-xs red tooltips" data-original-title="Hapus Data" data-target="#small<?php echo $row['id_prospek'];?>">
															 <i class="fa fa-times"></i></a>

															 <?php if($row['id_status_prospek'] == '1' OR $row['id_status_prospek'] == '2' OR $row['id_status_prospek'] == '3') { ?>
															 <a href="?module=prospek&act=edit&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_prospek=<?php echo $row['id_prospek'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
															 <i class="fa fa-edit"></i></a>

															 <?php } elseif ($row['id_status_prospek'] == '4') { ?>
															  <a href="?module=prospek&act=edit_spk&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_prospek=<?php echo $row['id_prospek'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
															 <i class="fa fa-edit"></i></a>

															  <?php } elseif ($row['id_status_prospek'] == '7') { ?>
															  <a href="?module=prospek&act=edit_po&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_prospek=<?php echo $row['id_prospek'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">

															 <i class="fa fa-edit"></i></a>
															  <?php } elseif ($row['id_status_prospek'] == '5') { ?>
															  <a href="?module=prospek&act=edit_do&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_prospek=<?php echo $row['id_prospek'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">

															 <i class="fa fa-edit"></i></a>
															  <?php } elseif ($row['id_status_prospek'] == '6') { ?>
															  <a href="?module=prospek&act=edit_lost&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_prospek=<?php echo $row['id_prospek'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
															 <i class="fa fa-edit"></i></a>
															 <?php } ?>
															 
															 <?php if($_SESSION['level'] == 'supervisor') { ?> 
															 <a href="#" data-toggle="modal" class="btn btn-xs blue tooltips" data-original-title="Join Visit" data-target="#large<?php echo $row['id_prospek'] ; ?>">
															 <i class="fa fa-fax"></i></a>
															 <?php } ?>
														</td>
													</tr>
													
													<script type="text/javascript">
														function pindah(url)
														{
														window.location = url;
														}
													</script> 

													<!-- /.modal -->
													<div class="modal fade bs-modal-sm" id="small<?php echo $row['id_prospek'];?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<h4 align="center" class="modal-title">Kofirmasi Hapus</h4>
															</div>
															<div class="modal-body">
																<p align="center"> Apakah Anda ingin menghapus data ini ?? </p>
															</div>
															<div class="modal-footer"> <p align="center">
																<button type="button" class="btn default btn-sm" data-dismiss="modal">Tidak</button>
																<button type="button" class="btn blue btn-sm" onclick="pindah('?module=prospek&act=delete&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_prospek=<?php echo $row['id_prospek']; ?>')">Ya</button>
															</div>
														</div>
													</div>
												</div>
												<!-- /.modal -->
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab_2">
								<div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-cogs"></i>Tabel Aktivitas Harian Unit
										</div>
										<div class="actions">
											<a href="?module=aktivitas&act=add&aktivitas=add_telp&divisi=unit&id_pelanggan=<?php echo $id_pelanggan ?>" class="btn btn-default btn-sm">
											<i class="fa fa-plus"></i> Tambah Aktivitas Harian </a>						
									  	</div>
									</div>
									<div class="portlet-body">
										<table class="table table-striped table-bordered table-hover" id="aktivitas_unit">
											<thead>
												<tr>
													<th>#</th>
													<th>Tgl Aktivitas <?php echo $tab_small ; ?></th>
													<th>Aktivitas</th>
													<th>Keterangan Aktivitas Harian <?php echo $tab_large ; ?></th>
													
													<th>Tgl Knjgn Berikut</th>
													<th>Catatan Spv <?php echo $tab_large ; ?></th>
													<th>Lembaga <?php echo $tab_small ; ?></th>
													<th>Cabang <?php echo $tab_small ; ?></th>
													<th>Surveyor <?php echo $tab_small ; ?></th>
													<th>Hasil Survey</th>
													<th>Keterangan Survey <?php echo $tab_large ; ?></th>
													<th>Action Aktivitas <?php echo $tab_small ; ?></th>
												</tr>
											</thead>
											<tbody>
												<?php
													$no=1;
				                           			$result = mysql_query("SELECT a.id_aktivitas_harian, 
				                           											DATE_FORMAT(a.tgl_aktivitas, '%d %M %Y') AS tgl_aktivitas, 
				                           											DATE_FORMAT(a.tgl_kunjungan_berikut, '%d %M %Y') AS tgl_kunjungan_berikut,
																					(
																						CASE a.aktivitas
																							WHEN 'visit' THEN
																								'Visit'
																							WHEN 'telp' THEN
																								'Telepon'
																							WHEN 'survey' THEN
																								'Survey'
																							ELSE
																									'-'
																						END
																					) AS aktivitas,
																					a.keterangan,
																					a.catatan,
																					b.hasil_survey,
																					b.keterangan AS keterangan_survey,
																					d.surveyor,
																					e.perusahaan,
																					f.kota_perusahaan

																		   FROM tb_aktivitas_harian_unit a
																		   LEFT JOIN tb_survey b ON b.id_aktivitas_harian = a.id_aktivitas_harian
																		   LEFT JOIN ms_leasing c ON c.id_cabang = b.id_cabang
																		   LEFT JOIN ms_leasing_surveyor d ON d.id_surveyor = b.id_surveyor
																		   LEFT JOIN ms_leasing_nama e ON e.id_perusahaan = b.id_perusahaan
																		   LEFT JOIN ms_leasing_kota f ON f.id_kota_perusahaan = c.id_kota_perusahaan
																		   WHERE a.id_pelanggan = $id_pelanggan AND a.deleted_flag = 0
																		   ORDER BY tgl_aktivitas DESC");
																while ($row = mysql_fetch_array($result)) {
											 	?>
												<tr>
													<td>#</td>
													<td><?php echo $row['tgl_aktivitas'];?> </td>
													<td><?php echo $row['aktivitas']; ?></td>
													<td><?php echo $row['keterangan']; ?></td>									
													<td><?php echo str_replace($en, $id, $row['tgl_kunjungan_berikut']); ?></td>
													<td><strong><?php echo $row['catatan']; ?></strong></td>
													<td><?php echo $row['perusahaan']; ?></td>
													<td><?php echo $row['kota_perusahaan']; ?></td>
													<td><?php echo $row['surveyor']; ?></td>
													<td><?php echo $row['hasil_survey']; ?></td>
													<td><?php echo $row['keterangan_survey']; ?></td>
													<td>
														 <a href="?module=aktivitas&act=delete&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs red tooltips" data-original-title="Hapus Data">
														 <i class="fa fa-times"></i></a>
														 <?php if($row['aktivitas'] == 'Telepon') { ?> 
														 <a href="?module=aktivitas&act=edit&aktivitas=add_telp&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } elseif ($row['aktivitas'] == 'Visit') { ?>
														 <a href="?module=aktivitas&act=edit&aktivitas=add_visit&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } elseif ($row['aktivitas'] == 'Survey') { ?>
														 <a href="?module=aktivitas&act=edit&aktivitas=add_survey&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } ?>
														 <?php if($row['aktivitas'] == 'Survey') { ?> 
														 <a href="?module=aktivitas&act=hasil_survey&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs purple tooltips" data-original-title="Hasil Survey">
														 <i class="fa fa-fax"></i></a>
														 <?php } ?>
														 <?php if($_SESSION['level'] == 'supervisor') { ?> 
														 <a href="?module=aktivitas&act=catatan_spv&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs blue tooltips" data-original-title="Catatan">
														 <i class="fa fa-retweet"></i></a>
														 <?php } ?>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>					
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab_3">
								<div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-cogs"></i>Tabel Aktivitas Harian Sparepart
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse"></a>
										</div>
										<div class="actions">
											<a href="?module=aktivitas&act=add&aktivitas=add_telp&divisi=part&id_pelanggan=<?php echo $id_pelanggan ?>" class="btn btn-default btn-sm">
											<i class="fa fa-plus"></i> Tambah Aktivitas Harian </a>						
									  	</div>
									</div>
									<div class="portlet-body">
										<table class="table table-striped table-bordered table-hover" id="aktivitas_part">
											<thead>
												<tr>
													<th>#</th>
													<th>Tgl Aktivitas</th>
													<th>Aktivitas</th>
													<th>Jenis Aktivitas <?php echo $tab_small ; ?></th>
													<th>Keterangan Aktivitas Harian <?php echo $tab_large ; ?></th>				
													<th>Tgl Knjgn Berikut</th>
													<th>Catatan Spv <?php echo $tab_large ; ?></th>
													<th>Action Aktivitas <?php echo $tab_small ; ?></th>
												</tr>
											</thead>
											<tbody>
												<?php
													$no=1;
				                           			$result = mysql_query("SELECT a.id_aktivitas_harian, 
				                           											DATE_FORMAT(a.tgl_aktivitas, '%d %M %Y') AS tgl_aktivitas, 
				                           											DATE_FORMAT(a.tgl_kunjungan_berikut, '%d %M %Y') AS tgl_kunjungan_berikut,
																					a.aktivitas,
																					b.aktivitas AS jenis_aktivitas,
																					a.keterangan,
																					a.catatan

																		   FROM tb_aktivitas_harian_part a
																		   JOIN ms_aktivitas_part b ON b.id_aktivitas=a.jenis_aktivitas
																		   WHERE id_pelanggan = $id_pelanggan AND deleted_flag = 0
																		   ORDER BY tgl_aktivitas DESC");
																while ($row = mysql_fetch_array($result)) {
											 	?>
												<tr>
													<td>#</td>
													<td><?php echo str_replace($en, $id, $row['tgl_aktivitas']);?> </td>
													<td><?php echo $row['aktivitas']; ?></td>
													<td><?php echo $row['jenis_aktivitas']; ?></td>
													<td><?php echo $row['keterangan']; ?></td>									
													<td><?php echo str_replace($en, $id, $row['tgl_kunjungan_berikut']); ?></td>
													<td><strong><?php echo $row['catatan']; ?></strong></td>
													<td>
														 <a href="?module=aktivitas&act=delete&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs red tooltips" data-original-title="Hapus Data">
														 <i class="fa fa-times"></i></a>

														 <?php if($row['aktivitas'] == 'Telepon') { ?> 
														 <a href="?module=aktivitas&act=edit&aktivitas=add_telp&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } elseif ($row['aktivitas'] == 'Visit') { ?>
														 <a href="?module=aktivitas&act=edit&aktivitas=add_visit&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } ?>

														 <?php if($_SESSION['level'] == 'supervisor') { ?> 
														 <a href="?module=aktivitas&act=catatan_spv&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs blue tooltips" data-original-title="Catatan">
														 <i class="fa fa-retweet"></i></a>
														 <?php } ?>
													</td>
												</tr>


												<?php } ?>
											</tbody>
										</table>					
									</div>
								</div>	
							</div>
							<div class="tab-pane" id="tab_4">
								<div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-cogs"></i>Tabel Aktivitas Harian Service
										</div>
										<div class="actions">
											<a href="?module=aktivitas&act=add&aktivitas=add_telp&divisi=serv&id_pelanggan=<?php echo $id_pelanggan ?>" class="btn btn-default btn-sm">
											<i class="fa fa-plus"></i> Tambah Aktivitas Harian </a>						
									  	</div>
									</div>
									<div class="portlet-body">
										<table class="table table-striped table-bordered table-hover" id="aktivitas_serv">
											<thead>
												<tr>
													<th>Tgl Aktivitas</th>
													<th>Jenis Aktivitas <?php echo $tab_small ; ?></th>
													<th>Merk Kendaraan</th>
													<th>Type Kendaraan</th>
													<th>Body Kendaraan</th>
													<th>No. Polisi</th>
													<th>No. Mesin</th>
													<th>No. Chasis</th>
													<th>Keterangan Aktivitas Harian <?php echo $tab_large ; ?></th>
													<th>Tgl Knjgn Brkt</th>
													<th>Action Aktivitas</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$no=1;
				                           			$result = mysql_query("SELECT a.id_aktivitas_harian,DATE_FORMAT(a.tgl_aktivitas, '%d %M %Y') 							AS tgl_aktivitas, 
				                           											DATE_FORMAT(a.tgl_kunjungan_berikut, '%d %M %Y') AS tgl_kunjungan_berikut,
																					a.aktivitas,
																				  a.merk_kendaraan,
																				  a.type_kendaraan,
																				  a.body_kendaraan,
																				  a.no_polisi,
																				  a.no_mesin,
																				  a.no_chasis,
																				  a.keterangan
																		   FROM
																				tb_aktivitas_harian_serv a
																		   WHERE id_pelanggan = $id_pelanggan AND deleted_flag = 0
																		   ORDER BY tgl_aktivitas DESC");
																while ($row = mysql_fetch_array($result)) {
											 	?>
												<tr>
													<td><?php echo str_replace($en, $id, $row['tgl_aktivitas']);?></td>
													<td><?php echo $row['aktivitas']; ?></td>
													<td><?php echo $row['merk_kendaraan']; ?></td>
													<td><?php echo $row['type_kendaraan']; ?></td>
													<td><?php echo $row['body_kendaraan']; ?></td>
													<td><?php echo $row['no_polisi']; ?></td>
													<td><?php echo $row['no_mesin']; ?></td>
													<td><?php echo $row['no_chasis']; ?></td>
													<td><?php echo $row['keterangan']; ?></td>
													<td><?php echo str_replace($en, $id, $row['tgl_kunjungan_berikut']);?></td>
													<td align="center">
														 <a href="?module=aktivitas&act=delete&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs red tooltips" data-original-title="Hapus Data">
														 <i class="fa fa-times"></i></a>
														 <?php if($row['aktivitas'] == 'Telepon') { ?> 
														 <a href="?module=aktivitas&act=edit&aktivitas=add_telp&id_pelanggan=<?php echo $id_pelanggan ; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } elseif ($row['aktivitas'] == 'Visit') { ?>
														 <a href="?module=aktivitas&act=edit&aktivitas=add_visit&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } elseif ($row['aktivitas'] == 'Handling Complain') { ?>
														 <a href="?module=aktivitas&act=edit&aktivitas=add_handcomp&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
														 <i class="fa fa-edit"></i></a>
														 <?php } ?>
														 <?php if($_SESSION['level'] == 'supervisor') { ?> 
														 <a href="?module=aktivitas&act=catatan_spv&id_pelanggan=<?php echo $id_pelanggan; ?>&id_aktivitas_harian=<?php echo $row['id_aktivitas_harian'] ; ?>" class="btn btn-xs blue tooltips" data-original-title="Catatan">
														 <i class="fa fa-retweet"></i></a>
														 <?php } ?>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>					
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php break ; ?>

			<?php case "edit": ?>

			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Profil Customer
					</div>
					<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					</div>
				</div>
				
				<?php 
				$id_pelanggan = $_GET['id_pelanggan'];	   	
				$result = mysql_query("SELECT * FROM tb_pelanggan 
									   LEFT JOIN tb_kuisioner ON tb_kuisioner.id_pelanggan = tb_pelanggan.id_pelanggan 
									   WHERE tb_pelanggan.id_pelanggan='$id_pelanggan'");
				$array = mysql_fetch_array($result);
				?>

				<?php
					error_reporting (E_ALL ^ E_NOTICE);
					$post = (!empty($_POST)) ? true : false;
						if($post){
						$error = '';



						if(empty($error)){

							$kode_pelanggan = $_POST['kode_pelanggan'];
							$id_asal_prospek = $_POST['id_asal_prospek'];
							$id_database = $_POST['id_database'];
							$id_bidang_usaha = $_POST['id_bidang_usaha'];
							$nama_perush = addslashes($_POST['nama_perush']);
							$id_kategori_segmen_old = '';
							$id_segmen_old = '';
							$id_kategori_segmen = $_POST['id_kategori_segmen'];
							$id_segmen = $_POST['id_segmen'];
							$alamat_kantor = addslashes($_POST['alamat_kantor']);
							$telp_kantor = $_POST['telp_kantor'];
							$fax_kantor = $_POST['fax_kantor'];
							$email_kantor = $_POST['email_kantor'];

							$hino = $_POST['hino'];
							$mitsubishi = $_POST['mitsubishi'];
							$toyota = $_POST['toyota'];
							$isuzu = $_POST['isuzu'];
							$lain = $_POST['lain'];

							$nama_pengurus = addslashes($_POST['nama_pengurus']);
							$jabatan = $_POST['jabatan'];
							$no_hp = $_POST['no_hp'];
							$email = $_POST['email'];
							$no_ktp = $_POST['no_ktp'];
							$tmpt_lahir = $_POST['tmpt_lahir'];
							$tgl_lahir = $_POST['tgl_lahir'];
							$jns_kelamin = $_POST['jns_kelamin'];
							$agama = $_POST['agama'];
							$gol_darah = $_POST['gol_darah'];
							$status_perkawinan = $_POST['status_perkawinan'];
							$id_pekerjaan = $_POST['id_pekerjaan'];
							$kewarganegaraan = $_POST['kewarganegaraan'];
							$id_prov = $_POST['id_prov'];
							$id_kota = $_POST['id_kota'];
							$id_kecamatan = $_POST['id_kecamatan'];
							$id_kelurahan = $_POST['id_kelurahan'];
							$alamat_rumah = addslashes($_POST['alamat_rumah']);
							$rt = $_POST['rt'];
							$rw = $_POST['rw'];
							$kodepos = $_POST['kodepos'];
							$telp_rumah = $_POST['telp_rumah'];
							$hobi1 = $_POST['hobi1'];
							$hobi2 = $_POST['hobi2'];
							$hobi3 = $_POST['hobi3'];
							$hobi4 = $_POST['hobi4'];
							

							$salesman = $_POST['sales'];
							$salespart = $_POST['sales'];
							$salesserv = $_POST['sales'];

							$created_by = $_POST['sales'];
							
							$merk_oli = $_POST['merk_oli'];
							$merk_part = $_POST['merk_part'];
							$toko_part = $_POST['toko_part'];
							$toko_serv = $_POST['toko_serv'];
							
							
							$import_date = '';
							$modified_by = $_SESSION['username'];
							$sesuai_ktp = $_POST['sesuai_ktp'];
							$validasi_by = $_SESSION['username'];

							$nama_perush_asal = addslashes($_POST['nama_perush_asal']);
							$nama_pengurus_asal = addslashes($_POST['nama_pengurus_asal']);
							$no_hp_asal = $_POST['no_hp_asal'];
							$alamat_rumah_asal = addslashes($_POST['alamat_rumah_asal']);

							$keterangan_log = 'Nama Customer Asal :'.$nama_perush_asal.' <br>
											   Nama Customer Sekarang :'.$nama_perush.' <br>
											   Nama Pengurus Asal :'.$nama_pengurus_asal.' <br>
											   Nama Pengurus Sekarang :'.$nama_pengurus.' <br>
											   No. Hp Asal :'.$no_hp_asal.' <br>
											   No. Hp Sekarang :'.$no_hp.' <br>
											   Alamat Rumah Asal :'.$alamat_rumah_asal.' <br>
											   Alamat Rumah Sekarang :'.$alamat_rumah.' <br>';

					if ($_SESSION[level] != 'sales') {

					if (empty($sesuai_ktp)) {
					$edit = mysql_query("UPDATE tb_pelanggan 
										   SET kode_pelanggan = '$kode_pelanggan',id_asal_prospek ='$id_asal_prospek',
										   	   id_database='$id_database',id_bidang_usaha='$id_bidang_usaha',
										   	   nama_perush='$nama_perush',id_kategori_segmen='$id_kategori_segmen',
										   	   id_segmen='$id_segmen',alamat_kantor='$alamat_kantor',telp_kantor='$telp_kantor',
										   	   fax_kantor='$fax_kantor',email_kantor='$email_kantor',hino='$hino',
										   	   mitsubishi='$mitsubishi',toyota='$toyota',isuzu='$isuzu',lain='$lain',
										   	   nama_pengurus='$nama_pengurus',jabatan='$jabatan',no_hp='$no_hp',email='$email',
										   	   no_ktp='$no_ktp',tmpt_lahir='$tmpt_lahir',tgl_lahir='$tgl_lahir',
										   	   jns_kelamin='$jns_kelamin',agama='$agama' ,gol_darah='$gol_darah',
										   	   status_perkawinan='$status_perkawinan',id_pekerjaan='$id_pekerjaan',
										   	   kewarganegaraan='$kewarganegaraan',id_prov='$id_prov',id_kota='$id_kota',
										   	   id_kecamatan='$id_kecamatan',id_kelurahan='$id_kelurahan',
										   	   alamat_rumah='$alamat_rumah',rt='$rt',rw='$rw',kodepos='$kodepos',
										   	   telp_rumah='$telp_rumah',hobi1='$hobi1',hobi2='$hobi2',hobi3='$hobi3',
										   	   hobi4='$hobi4',modified_by = '$_SESSION[username]', modified_date = NOW()
										 WHERE id_pelanggan = $id_pelanggan") 
											OR DIE(mysql_error());

							mysql_query("UPDATE tb_kuisioner SET merk_oli='$merk_oli',merk_part='$merk_part',
												toko_part='$toko_part',toko_serv='$toko_serv',modified_by='$_SESSION[username]',
												modified_date=NOW()") 
										 OR DIE(mysql_error());

							mysql_query("INSERT INTO tb_log_customer (id_log_customer,modified_by,time_modified,
																		date_modified,id_pelanggan,keterangan) 
										 VALUES ('','$_SESSION[username]',NOW(),NOW(),'$id_pelanggan','$keterangan_log')") 
										 OR DIE(mysql_error());
										 
					} elseif (!empty($sesuai_ktp)) {
					$edit = mysql_query("UPDATE tb_pelanggan 
										   SET kode_pelanggan = '$kode_pelanggan',id_asal_prospek ='$id_asal_prospek',
										   	   id_database='$id_database',id_bidang_usaha='$id_bidang_usaha',
										   	   nama_perush='$nama_perush',id_kategori_segmen='$id_kategori_segmen',
										   	   id_segmen='$id_segmen',alamat_kantor='$alamat_kantor',telp_kantor='$telp_kantor',
										   	   fax_kantor='$fax_kantor',email_kantor='$email_kantor',hino='$hino',
										   	   mitsubishi='$mitsubishi',toyota='$toyota',isuzu='$isuzu',lain='$lain',
										   	   nama_pengurus='$nama_pengurus',jabatan='$jabatan',no_hp='$no_hp',email='$email',
										   	   no_ktp='$no_ktp',tmpt_lahir='$tmpt_lahir',tgl_lahir='$tgl_lahir',
										   	   jns_kelamin='$jns_kelamin',agama='$agama' ,gol_darah='$gol_darah',
										   	   status_perkawinan='$status_perkawinan',id_pekerjaan='$id_pekerjaan',
										   	   kewarganegaraan='$kewarganegaraan',id_prov='$id_prov',id_kota='$id_kota',
										   	   id_kecamatan='$id_kecamatan',id_kelurahan='$id_kelurahan',
										   	   alamat_rumah='$alamat_rumah',rt='$rt',rw='$rw',kodepos='$kodepos',
										   	   telp_rumah='$telp_rumah',hobi1='$hobi1',hobi2='$hobi2',hobi3='$hobi3',
										   	   hobi4='$hobi4',modified_by = '$_SESSION[username]', modified_date = NOW(), 
										   	   sesuai_ktp='$sesuai_ktp'
										 WHERE id_pelanggan = $id_pelanggan") 
											OR DIE(mysql_error());

							mysql_query("UPDATE tb_kuisioner SET merk_oli='$merk_oli',merk_part='$merk_part',
												toko_part='$toko_part',toko_serv='$toko_serv',modified_by='$_SESSION[username]',
												modified_date=NOW()") 
										 OR DIE(mysql_error());

							mysql_query("INSERT INTO tb_log_customer (id_log_customer,modified_by,time_modified,
																		date_modified,id_pelanggan,keterangan) 
										 VALUES ('','$_SESSION[username]',NOW(),NOW(),'$id_pelanggan','$keterangan_log')") 
										 OR DIE(mysql_error());				
					}

					} elseif ($_SESSION[level] == 'sales') {
					$edit = mysql_query("UPDATE tb_pelanggan 
										   SET id_asal_prospek ='$id_asal_prospek',
										   	   id_database='$id_database',id_bidang_usaha='$id_bidang_usaha',
										   	   nama_perush='$nama_perush',id_kategori_segmen='$id_kategori_segmen',
										   	   id_segmen='$id_segmen',alamat_kantor='$alamat_kantor',telp_kantor='$telp_kantor',
										   	   fax_kantor='$fax_kantor',email_kantor='$email_kantor',hino='$hino',
										   	   mitsubishi='$mitsubishi',toyota='$toyota',isuzu='$isuzu',lain='$lain',
										   	   nama_pengurus='$nama_pengurus',jabatan='$jabatan',no_hp='$no_hp',email='$email',
										   	   no_ktp='$no_ktp',tmpt_lahir='$tmpt_lahir',tgl_lahir='$tgl_lahir',
										   	   jns_kelamin='$jns_kelamin',agama='$agama' ,gol_darah='$gol_darah',
										   	   status_perkawinan='$status_perkawinan',id_pekerjaan='$id_pekerjaan',
										   	   kewarganegaraan='$kewarganegaraan',id_prov='$id_prov',id_kota='$id_kota',
										   	   id_kecamatan='$id_kecamatan',id_kelurahan='$id_kelurahan',
										   	   alamat_rumah='$alamat_rumah',rt='$rt',rw='$rw',kodepos='$kodepos',
										   	   telp_rumah='$telp_rumah',hobi1='$hobi1',hobi2='$hobi2',hobi3='$hobi3',
										   	   hobi4='$hobi4',modified_by = '$_SESSION[username]', modified_date = NOW()
										 WHERE id_pelanggan = $id_pelanggan") 
											OR DIE(mysql_error());

							mysql_query("UPDATE tb_kuisioner SET merk_oli='$merk_oli',merk_part='$merk_part',
												toko_part='$toko_part',toko_serv='$toko_serv',modified_by='$_SESSION[username]',
												modified_date=NOW()") 
										 OR DIE(mysql_error());

							mysql_query("INSERT INTO tb_log_customer (id_log_customer,modified_by,time_modified,
																		date_modified,id_pelanggan,keterangan) 
										 VALUES ('','$_SESSION[username]',NOW(),NOW(),'$id_pelanggan','$keterangan_log')") 
										 OR DIE(mysql_error());
					
					} 
						if($edit){
							header('location:?module=data_customer&act=detail&id_pelanggan='.$id_pelanggan.'&notif=3');

											}
										}
											}
					?>

				<div class="portlet-body form">
					<form action="#" method="post" class="horizontal-form">
						<div class="form-body">
								
								<h3 class="form-section">Profil Perusahaan</h3>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Sales</label>
											<input type="text"  class="form-control" name="sales" value ="<?php echo $array['salesman'] ?>" disabled>
										</div>
									</div>
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Asal Prospek</label>
											<select class="form-control select2me" name="id_asal_prospek" required>
											<option value="">- Pilih Asal Prospek -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_asal_prospek ORDER BY nama ASC");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_asal_prospek'];

														if($id == $array['id_asal_prospek']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama'].'</option>';
																	}	else {
															echo '<option value="'.$id.'">'.$row['nama'].'</option>';
																}
															}
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kode Database</label>
											<select class="form-control select2me " name="id_database">
											<option value="">- Pilih Kode Database -</option>
													<?php
														$sql=mysql_query("SELECT * FROM tb_database WHERE deleted_flag=0 ORDER BY tgl_mulai DESC");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_database'];	
														if($id == $array['id_database']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama_database'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['nama_database'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>
													
								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Badan Usaha</label>
											<select class="form-control" name="id_bidang_usaha" required>
											<option value="">- Pilih Badan Usaha -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_bidang_usaha");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_bidang_usaha'];	
														if($id == $array['id_bidang_usaha']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['nama'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Nama Perusahaan/Pribadi</label>
											<input type="text" class="form-control" autocomplete="off" name="nama_perush" value="<?php echo $array['nama_perush']; ?>">
											<input type="hidden" class="form-control" autocomplete="off" name="nama_perush_asal" value="<?php echo $array['nama_perush']; ?>">
										</div>
									</div>
													
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Main Segmen</label>
											<select class="form-control select2me main_segmen" id="main_segmen" name="id_kategori_segmen" required>
												<option value="">- Pilih Main Segmen -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_segmen_kategori");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_kategori_segmen'];	
														if($id == $array['id_kategori_segmen']){
															echo '<option value="'.$id.'" selected="selected">'.$row['kategori_segmen'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['kategori_segmen'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Sub Segmen</label>
											<select class="form-control sub_segmen" id="sub_segmen" name="id_segmen" required>
													<option value>- Pilih Sub Segmen -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_segmen ");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_segmen'];	
														if($id == $array['id_segmen']){
															echo '<option value="'.$id.'" selected="selected">'.$row['segmen'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['segmen'].'</option>';
															}}
													?>
											</select>
										</div>
									</div>
													
								</div>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Alamat Kantor</label>
											<textarea class="form-control" rows="3" name="alamat_kantor"><?php echo $array['alamat_kantor']; ?></textarea>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Telepon Kantor</label>
											<input type="text" class="form-control" autocomplete="off" name="telp_kantor" value="<?php echo $array['telp_kantor']; ?>">
										</div>
									</div>				
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Fax Kantor</label>
											<input type="text"  class="form-control" autocomplete="off" name="fax_kantor" value="<?php echo $array['fax_kantor']; ?>">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Email Kantor</label>
											<input type="text"  class="form-control" autocomplete="off" name="email_kantor" value="<?php echo $array['email_kantor']; ?>">
										</div>
									</div>
													
								</div>

								<h3 class="form-section">Populasi Unit Yang Dimiliki</h3>
								
								<div class="row">
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Hino</label>
											<input type="text" class="form-control" autocomplete="off" name="hino" value="<?php echo $array['hino']; ?>">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Mitsubishi</label>
											<input type="text" class="form-control" autocomplete="off" name="mitsubishi" value="<?php echo $array['mitsubishi']; ?>">
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Toyota</label>
											<input type="text" class="form-control" autocomplete="off" name="toyota" value="<?php echo $array['toyota']; ?>">
										</div>
									</div>		
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Isuzu</label>
											<input type="text" class="form-control" autocomplete="off" name="isuzu" value="<?php echo $array['isuzu']; ?>">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Merk Lain</label>
											<input type="text" class="form-control" autocomplete="off" name="lain" value="<?php echo $array['lain']; ?>">
										</div>
									</div>
													
								</div>

								<h3 class="form-section">Kuisioner After Sales</h3>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Merk Oli </label>
											<input type="text" class="form-control" autocomplete="off" name="merk_oli" value="<?php echo $array['merk_oli']; ?>">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Merk Spareparts</label>
											<input type="text" class="form-control" autocomplete="off" name="merk_part" value="<?php echo $array['merk_part']; ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tempat Pembelian Parts/Oli</label>
											<input type="text" class="form-control" autocomplete="off" name="toko_part" value="<?php echo $array['toko_part']; ?>">
										</div>
									</div>		
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tempat Service Unit</label>
											<input type="text" class="form-control" autocomplete="off" name="toko_serv" value="<?php echo $array['toko_serv']; ?>">
										</div>
									</div>
													
								</div>

								<h3 class="form-section">Profil Pemilik/Pengurus</h3>
								
								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Nama Pemilik/Pengurus</label>
											<input type="text" class="form-control" autocomplete="off" name="nama_pengurus" value="<?php echo $array['nama_pengurus']; ?>">
											<input type="hidden" class="form-control" autocomplete="off" name="nama_pengurus_asal" value="<?php echo $array['nama_pengurus']; ?>">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Jabatan</label>
											<input type="text" class="form-control" autocomplete="off" name="jabatan" value="<?php echo $array['jabatan']; ?>">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Hp</label>
											<input type="text" class="form-control" autocomplete="off" name="no_hp" value="<?php echo $array['no_hp']; ?>">
											<input type="hidden" class="form-control" autocomplete="off" name="no_hp_asal" value="<?php echo $array['no_hp']; ?>">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Email</label>
											<input type="text" class="form-control" autocomplete="off" name="email" value="<?php echo $array['email']; ?>">
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. KTP</label>
											<input type="text" class="form-control" autocomplete="off" name="no_ktp" value="<?php echo $array['no_ktp']; ?>">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tempat Lahir</label>
											<input type="text" class="form-control" autocomplete="off" name="tmpt_lahir" value="<?php echo $array['tmpt_lahir']; ?>">
										</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Tgl lahir</label>
											<input type="text" class="form-control date date-picker" autocomplete="off" data-date-format="yyyy-mm-dd"  name="tgl_lahir" value="<?php echo $array['tgl_lahir']; ?>">
										</div>
									</div>
								</div>

								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Jenis Kelamin</label>
											<select class="form-control" name="jns_kelamin">
												<option value='0'>- Pilih Jenis Kelamin -</option>
												<option value="L" <?php if($array['jns_kelamin'] == 'l') { echo "selected"; } ?>>Laki-Laki</option>
												<option value="P" <?php if($array['jns_kelamin'] == 'p') { echo "selected"; } ?>>Perempuan</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Agama</label>
											<select class="form-control" name="agama">
												<option value='0' selected>- Pilih Agama -</option>
												<option value="1" <?php if($array['agama'] == '1') { echo "selected"; } ?>>Islam</option>
												<option value="2" <?php if($array['agama'] == '2') { echo "selected"; } ?>>Kristen</option>
												<option value="3" <?php if($array['agama'] == '3') { echo "selected"; } ?>>Katholik</option>
												<option value="4" <?php if($array['agama'] == '4') { echo "selected"; } ?>>Budha</option>
												<option value="5" <?php if($array['agama'] == '5') { echo "selected"; } ?>>Hindu</option>
												<option value="6" <?php if($array['agama'] == '6') { echo "selected"; } ?>>Lain-lain</option>
											</select>
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Golongan Darah</label>
											<select class="form-control" name="gol_darah">
												<option value='0' selected>- Pilih Golongan Darah -</option>
												<option value="1" <?php if($array['gol_darah'] == '1') { echo "selected"; } ?>>A</option>
												<option value="2" <?php if($array['gol_darah'] == '2') { echo "selected"; } ?>>B</option>
												<option value="3" <?php if($array['gol_darah'] == '3') { echo "selected"; } ?>>A"B</option>
												<option value="4" <?php if($array['gol_darah'] == '4') { echo "selected"; } ?>>O</option>
												<option value="5" <?php if($array['gol_darah'] == '5') { echo "selected"; } ?>>-</option>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Status Perkawinan</label>
											<select class="form-control" name="status_perkawinan" >
												<option value='0' selected>- Pilih Satus -</option>
												<option value="1" <?php if($array['status_perkawinan'] == '1') { echo "selected"; } ?>>Belum Kawin</option>
												<option value="2" <?php if($array['status_perkawinan'] == '2') { echo "selected"; } ?>>Kawin</option>
												<option value="3" <?php if($array['status_perkawinan'] == '3') { echo "selected"; } ?>>Duda</option>
												<option value="4" <?php if($array['status_perkawinan'] == '4') { echo "selected"; } ?>>Janda</option>
											</select>
										</div>
									</div>
								
								</div>

								<div class="row">	
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Jenis Pekerjaan</label>
											<select class="form-control select2me" name="id_pekerjaan">
												<option value='0' selected="selected">- Pilih Jenis Pekerjaan -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_pekerjaan ORDER BY pekerjaan ASC");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_pekerjaan'];	
														if($id == $array['id_pekerjaan']){
															echo '<option value="'.$id.'" selected="selected">'.$row['pekerjaan'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['pekerjaan'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kewarganegaraan</label>
											<select class="form-control" name="kewarganegaraan">
												<option value='0' selected="selected">- Pilih Kewarganegaraan -</option>
												<option value="1" <?php if($array['kewarganegaraan'] == '1') { echo "selected"; } ?>>WNI : Indonesia</option>
												<option value="2" <?php if($array['kewarganegaraan'] == '2') { echo "selected"; } ?>>WNA : Asing</option>
											</select>
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Provinsi</label>
											<select class="form-control select2me provinsi" name="id_prov">
												<option value="0" selected="selected">- Pilih Provinsi -</option>
													<?php
														$sql=mysql_query("SELECT id_prov, nama_prov FROM ms_prov ORDER BY id_prov ASC");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_prov'];	
														if($id == $array['id_prov']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama_prov'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['nama_prov'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>
										
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kota</label>
											<select class="form-control select2 kota" name="id_kota">
												<option value="0" selected="selected">- Pilih Provinsi -</option>
												<?php
														$sql=mysql_query("SELECT * FROM ms_kota WHERE id_prov = $array[id_prov] ORDER BY id_kota ASC");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_kota'];	
														if($id == $array['id_kota']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama_kota'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['nama_kota'].'</option>';
															} }
												?>
											</select>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kecamatan</label>
											<select class="form-control select2 kecamatan" name="id_kecamatan">
												<option value='0' selected>- Pilih Kecamatan -</option>
												<?php
														$sql=mysql_query("SELECT * FROM ms_kecamatan WHERE id_kota = $array[id_kota] ORDER BY id_kecamatan ASC");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_kecamatan'];	
														if($id == $array['id_kecamatan']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama_kecamatan'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['nama_kecamatan'].'</option>';
															} }
												?>

											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kelurahan</label>
											<select class="form-control select2 kelurahan" name="id_kelurahan">
												<option value='0' selected>- Pilih Kelurahan -</option>
												<?php
														$sql=mysql_query("SELECT * FROM ms_kelurahan WHERE id_kecamatan=$array[id_kecamatan] ORDER BY id_kelurahan ASC");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_kelurahan'];	
														if($id == $array['id_kelurahan']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama_kelurahan'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['nama_kelurahan'].'</option>';
															} }
												?>
											</select>
										</div>
									</div>

								</div>

								<div class="row">
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Alamat Rumah</label>
											<textarea class="form-control" rows="3" autocomplete="off" name="alamat_rumah"><?php echo $array['alamat_rumah']; ?></textarea>
											<input type="hidden" class="form-control" autocomplete="off" name="alamat_rumah_asal" value="<?php echo $array['no_hp']; ?>">
										</div>
									</div>
									
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">RT</label>
											<input type="text" class="form-control" autocomplete="off" name="rt" value="<?php echo $array['rt']; ?>">
										</div>
									</div>				
									
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">RW</label>
											<input type="text"  class="form-control" autocomplete="off" name="rw" value="<?php echo $array['rw']; ?>">
										</div>
									</div>

									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">KodePos</label>
											<input type="text" class="form-control" autocomplete="off" name="kodepos" value="<?php echo $array['kodepos']; ?>">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Telepon Rumah</label>
											<input type="text"  class="form-control" autocomplete="off" name="telp_rumah" value="<?php echo $array['telp_rumah']; ?>">
										</div>
									</div>

									<?php if($_SESSION[level] == 'admin') { ?>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Validasi</label>
											<input type="checkbox" name="sesuai_ktp" value="1" <?php if ($array['sesuai_ktp'] == '1' ) { echo "checked" ; } ?> class="make-switch switch-large" data-label-icon="fa fa-fullscreen" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
											
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Kode Pelanggang Ksystem</label>
											<input type="text" class="form-control" autocomplete="off" name="kode_pelanggan" placeholder="No. Telp"  value="<?php echo $array['kode_pelanggan']; ?>">
										</div>
									</div>
									<?php } ?>
								</div>

								<div class="row">	
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 1</label>
											<select class="form-control select2me" name="hobi1">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];	
														if($id == $array['hobi1']){
															echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 2</label>
											<select class="form-control select2me" name="hobi2">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];
														if($id == $array['hobi2']){
															echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																	} else {	
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 3</label>
											<select class="form-control select2me" name="hobi3">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];	
														if($id == $array['hobi3']){
															echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															} }
													?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Hobi 4</label>
											<select class="form-control select2me" name="hobi4">
												<option value= "0" selected="selected">- Pilih Hobi -</option>
													<?php
														$sql=mysql_query("SELECT * FROM ms_hobi");
															while($row=mysql_fetch_array($sql))
																	{
														$id = $row['id_hobi'];	
														if($id == $array['hobi4']){
															echo '<option value="'.$id.'" selected="selected">'.$row['hobi'].'</option>';
																	} else {
															echo '<option value="'.$id.'">'.$row['hobi'].'</option>';
															}}
													?>
											</select>
										</div>
									</div>
								</div>
						</div>
						<div class="form-actions right">
								<a href='?module=data_customer&act=detail&id_pelanggan=<?php echo $id_pelanggan ; ?>' type="button" class="btn blue" value="Input">Cancel</a>
							<button type="submit" class="btn blue" value="Input">Simpan Perubahan</button>
						</div>
					</form>
					<!-- END FORM-->
				</div>
			</div>

			<?php break ; ?>

			<?php } ?>
		</div>
</div>