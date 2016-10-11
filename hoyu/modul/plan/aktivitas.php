<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Gathering <small>Management</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Gathering</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->

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
                        Data Gathering Berhasil ditambahkan !!
                </div>
            <?php
			} else if ($_GET['notif'] == 2) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Gathering Berhasil diperbarui !!
                </div>
            <?php
			} else if ($_GET['notif'] == 3) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data Gathering Berhasil dihapus !!
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
								<i class="fa fa-reorder"></i>Tabel Rencana Aktivitas
							</div>
							<div class="actions">
								<a href="modul/laporan/cetak_rencana_aktivitas.php?sales=<?php echo $_SESSION['username'] ;?>" target="_blank" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Cetak Form Kunjungan </a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="r_aktivitas">
							<thead>
							<tr>
								<th width="20%">Nama Perush</th>
								<th width="15%">Pengurus</th>
								<th width="10%">Tgl Knjgn Sebelum</th>
								<th width="15%">Tgl Knjungan </th>
								<th width="20%">Unit Prospek </th>
								<th width="10%">Keterangan</th>
								<th width="10%">Tgl Kunjungan Berikut</th>
							</tr>
							</thead>
							<tbody>

							<?php
                           	$result = mysql_query("SELECT a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.tgl_aktivitas,
                           								  c.day_name, b.tgl_kunjungan_berikut,f.tipe
                           						   FROM tb_pelanggan a
                           						   LEFT JOIN tb_aktivitas_harian_unit b ON b.id_pelanggan = a.id_pelanggan
                           						   JOIN time_dimension c ON c.db_date = b.tgl_kunjungan_berikut
                           						   LEFT JOIN v_unit_latest_prospek_id d ON d.id_pelanggan = a.id_pelanggan
                           						   LEFT JOIN tb_prospek e ON e.id_prospek = d.max_prospek
                           						   LEFT JOIN ms_tipe_kendaraan f ON f.id_tipe_kendaraan = e.id_tipe_kendaraan
                           						   WHERE a.salesman = '$_SESSION[username]' 
                           						   AND b.tgl_kunjungan_berikut BETWEEN CURDATE() AND (NOW() + INTERVAL 2 DAY)
                           						   GROUP BY a.nama_perush, b.tgl_kunjungan_berikut
                           						   ORDER BY b.tgl_kunjungan_berikut ASC");
                           			  while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td><?php echo $row['nama_perush'] ?></td>
								<td><?php echo $row['nama_pengurus']?></td>
								<td><?php echo $row['tgl_aktivitas']?></td>
								<td><?php echo $row['day_name'] ?>,<?php echo $row['tgl_kunjungan_berikut'] ?></td>
								<td><?php echo $row['tipe']?></td>
								<td></td>
								<td></td>
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

			<?php break; ?>

			<?php case "tambah" : ?>

			<?php
				error_reporting (E_ALL ^ E_NOTICE);

				$post = (!empty($_POST)) ? true : false;
				if($post){
					$error = '';

				if(empty($error)){

					$nama_gathering = $_POST['nama_gathering'];
					$tgl_gathering = $_POST['tgl_gathering'];
					$lokasi = $_POST['lokasi'];

					$tambah=mysql_query("INSERT INTO tb_gathering (id_gathering,nama_gathering,tgl_gathering,lokasi,deleted_flag) 
										 VALUES('','$nama_gathering','$tgl_gathering','$lokasi',0)") or die(mysql_error());
					
				if($tambah){
					header('location:?module=gathering&notif=1');

									}
										}
								}
			?>

			<div class="portlet box red">
                  <div class="portlet-title">
                  <div class="caption">
						<i class="fa fa-cogs"></i>Tambah Gathering
				  </div>
                  </div>
                  <div class="portlet-body">
                     
					 <form action="#" enctype="multipart/form-data" method="post">
                        <div class="row">

							<div class="col-md-4">
								<label class="control-label">Nama Gathering</label>		
								<input class="form-control form-control-inline "  type="text"  name="nama_gathering" 
								 autocompelete ="off" placeholder="Nama Gathering"  />
							</div>

							<div class="col-md-3">
								<label class="control-label">Tanggal Gathering</label>		
								<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text"  name="tgl_gathering" autocompelete ="off"
								placeholder="Tanggal Gathering" />
							</div> 

							<div class="col-md-3">
								<label class="control-label">Lokasi</label>		
								<input class="form-control form-control-inline"  type="text"  name="lokasi" 
								autocomplete="off" placeholder="Lokasi Gathering"  />
							</div>
							
							<div class="col-md-1">
						 	    <label class="control-label"> &nbsp&nbsp</label>
								<button type="submit" class="btn blue" value="Input">Submit</button>
                            </div>

                            <div class="col-md-1">
						 	    <label class="control-label"> &nbsp</label>
								<a href="?module=gathering" type="button" class="btn default">Cancel</a>
                            </div>

                        </div>
                     </form>

                  </div>
            </div>

			<?php break ; ?>

			<?php case "edit" : ?>

			<?php 
				$result = mysql_query("SELECT * FROM tb_gathering WHERE id_gathering=$id_gathering");
				$array = mysql_fetch_array($result);
			?>

			<?php
				error_reporting (E_ALL ^ E_NOTICE);

				$post = (!empty($_POST)) ? true : false;
				if($post){
					$error = '';

				if(empty($error)){

					$nama_gathering = $_POST['nama_gathering'];
					$tgl_gathering = $_POST['tgl_gathering'];
					$lokasi = $_POST['lokasi'];

					$tambah=mysql_query("UPDATE tb_gathering SET nama_gathering = '$nama_gathering',
												tgl_gathering ='$tgl_gathering',lokasi = '$lokasi'
										 WHERE id_gathering = $id_gathering") or die(mysql_error());
					
				if($tambah){
					header('location:?module=gathering&notif=2');

									}
										}
								}
			?>

			<div class="portlet box red">
                  <div class="portlet-title">
                  <div class="caption">
						<i class="fa fa-cogs"></i>Edit Gathering
				  </div>
                  </div>
                  <div class="portlet-body">
                     
					 <form method="post" action="">
                        <div class="row">

							<div class="col-md-4">
								<label class="control-label">Nama Gathering</label>		
								<input class="form-control form-control-inline "  type="text"  name="nama_gathering" autocomplete="off"	value="<?php echo $array['nama_gathering']; ?>"  />
							</div>

							<div class="col-md-3">
								<label class="control-label">Target Aktivitas</label>		
								<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text"  name="tgl_gathering" 
								value="<?php echo $array['tgl_gathering'];?>" />
							</div> 

							<div class="col-md-3">
								<label class="control-label">Lokasi</label>		
								<input class="form-control form-control-inline "  type="text"  name="lokasi" autocomplete="off"
									value="<?php echo $array['lokasi'];?>"  />
							</div>
							
							<div class="col-md-1">
						 	    <label class="control-label"> &nbsp&nbsp</label>
								<button type="submit" class="btn blue" value="Input">Submit</button>
                            </div>

                            <div class="col-md-1">
						 	    <label class="control-label"> &nbsp</label>
								<a href="?module=gathering" type="button" class="btn default">Cancel</a>
                            </div>

                        </div>
                     </form>

                  </div>
            </div>

			<?php break ; ?>


			<?php case "undangan" : ?>

			<?php 
				$tab_large =   '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
				$tab_medium =  '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
				$tab_small =   '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
			?>

			<?php if ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) { ?>

            <div class="row">
				<div class="col-md-5">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
				  	<div class="portlet box red">
                  		<div class="portlet-title">
                 			 <div class="caption">
								<i class="fa fa-cogs"></i>Filter Salesman
				 			 </div>
                 		</div>

                  		<div class="portlet-body">
                     
					 	<form method="post" action="">
                        <div class="row">   
							<div class="col-md-8">
								<label class="control-label">Salesman</label>		
								<select class="form-control form-control-inline select2me" name="sales">
										<option selected="selected">- Pilih Salesman -</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE level IN ('sales','supervisor') AND divisi = 'hino' AND sublevel = 'unit' AND blokir = 'N' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  												
											echo '<option value="'.$id.'">'.$row['username'].'</option>';
													}
											?>
								</select>
							</div>
							
							<div class="col-md-4">
						 	    <label class="control-label"> &nbsp</label>
								<input type="submit" value="Submit" name="submit" class="btn red btn-block">
                            </div>
                        </div>
                     </form>

                  </div>
            		</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>

			<?php } ?>

			<?php 

			if ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) {
				
				if(isset($_POST['submit'])){
	
				$sales = $_POST['sales'];

				$result = mysql_query("SELECT a.id_pelanggan,a.nama_perush,a.nama_pengurus, b.segmen, a.salesman,
											  c.nama_kota, e.status_prospek
                           			   FROM tb_pelanggan a 
                           			   LEFT JOIN ms_segmen b ON b.id_segmen = a.id_segmen
                           			   LEFT JOIN ms_kota c ON c.id_kota = a.id_kota
                           			   LEFT JOIN v_unit_latest_prospek_id d ON d.id_pelanggan = a.id_pelanggan
                           			   LEFT JOIN ms_status_prospek e ON e.id_status_prospek = d.id_status_prospek
                           			   WHERE a.deleted_flag = 0 AND a.salesman = '$sales' "); 
			
					}

			} elseif ($_SESSION[level] == 'sales' OR $_SESSION[level] == 'supervisor') {

				$result = mysql_query("SELECT a.id_pelanggan,a.nama_perush,a.nama_pengurus, b.segmen, 
											  c.nama_kota, e.status_prospek
                           			   FROM tb_pelanggan a 
                           			   LEFT JOIN ms_segmen b ON b.id_segmen = a.id_segmen
                           			   LEFT JOIN ms_kota c ON c.id_kota = a.id_kota
                           			   LEFT JOIN v_unit_latest_prospek_id d ON d.id_pelanggan = a.id_pelanggan
                           			   LEFT JOIN ms_status_prospek e ON e.id_status_prospek = d.id_status_prospek
                           			   WHERE a.deleted_flag = 0 AND a.salesman = '$_SESSION[username]' ");
									  
			}
			?>

			<div class="row">
				<div class="col-md-6">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Customer Calon Undangan
							</div>
						</div>

						
						<div class="portlet-body">
							<form action="#" enctype="multipart/form-data" method="post">
							<table class="table table-striped table-bordered table-hover" id="c_undangan">
							<thead>
							<tr>
								<th>Action </th>
								<?php if ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) { ?>
								<th>Salesman</th>
								<?php } ?>
								<th>Nama Perusahaan <?php echo $tab_medium ; ?></th>
								<th>Segmen  <?php echo $tab_medium ; ?></th>
								<th>Kota  <?php echo $tab_medium ; ?></th>
								<th>Status Prospek</th>

							</tr>
							</thead>
							<tbody>

							<?php
								while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td>
									<a href="?module=gathering&act=tambah_undangan&id_pelanggan=<?php echo $row[id_pelanggan];?>&id_gathering=<?php echo $id_gathering;?>" class="btn btn-xs blue tooltips" data-original-title="Undang Customer">
										 <i class="fa fa-retweet"></i>
									</a>
								</td>
								<?php if ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) { ?>
								<td><?php echo $row['salesman'];?></td>
								<?php } ?>
								<td><?php echo $row['nama_perush']?></td>
								<td><?php echo $row['segmen']?></td>
								<td><?php echo $row['nama_kota']?></td>
								<td><?php echo $row['status_prospek'] ?></td>
							</tr>
							<?php 
									}
                        	 ?>
							</tbody>
							</table>

							<div class="form-actions">
								<button type="submit" class="btn blue" value="Input">Undang Customer</button>					
							</div>
							</form>
						</div>
						

					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>

				<div class="col-md-6">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Customer Penerima Undangan
							</div>
						</div>
						<div class="portlet-body">
							<form action="#" enctype="multipart/form-data" method="post">
							<table class="table table-striped table-bordered table-hover" id="p_undangan">
							<thead>
							<tr>
								<th>Action </th>

								<?php if ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) { ?>
								<th>Salesman</th>
								<?php } ?>

								<th>Nama Perusahaan <?php echo $tab_medium ; ?></th>
								<th>Segmen  <?php echo $tab_medium ; ?></th>
								<th>Kota  <?php echo $tab_medium ; ?></th>
								<th>Status Prospek</th>

							</tr>
							</thead>
							<tbody>

				
							<?php
								if ($_SESSION[level] == 'sales') { 

                           		$result = mysql_query("SELECT a.id_pelanggan,a.nama_perush,a.nama_pengurus, b.segmen, c.nama_kota
                           									, e.status_prospek, f.id_undangan
                           							   FROM tb_pelanggan a 
                           							   LEFT JOIN ms_segmen b ON b.id_segmen = a.id_segmen
                           							   LEFT JOIN ms_kota c ON c.id_kota = a.id_kota
                           							   JOIN tb_undangan f ON f.id_pelanggan = a.id_pelanggan
                           							   LEFT JOIN v_unit_latest_prospek_id d ON d.id_pelanggan = a.id_pelanggan
                           							   LEFT JOIN ms_status_prospek e ON e.id_status_prospek = d.id_status_prospek
                           							   WHERE a.deleted_flag = 0 AND f.id_gathering = $id_gathering AND a.salesman = '$_SESSION[username]' ");

                           		} elseif ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) {

                           		$result = mysql_query("SELECT a.id_pelanggan,a.nama_perush,a.nama_pengurus,a.salesman, b.segmen, 
                           									  c.nama_kota, e.status_prospek, f.id_undangan
                           							   FROM tb_pelanggan a 
                           							   LEFT JOIN ms_segmen b ON b.id_segmen = a.id_segmen
                           							   LEFT JOIN ms_kota c ON c.id_kota = a.id_kota
                           							   JOIN tb_undangan f ON f.id_pelanggan = a.id_pelanggan
                           							   LEFT JOIN v_unit_latest_prospek_id d ON d.id_pelanggan = a.id_pelanggan
                           							   LEFT JOIN ms_status_prospek e ON e.id_status_prospek = d.id_status_prospek
                           							   WHERE a.deleted_flag = 0 AND f.id_gathering = $id_gathering ");
                           		}
										  while ($row = mysql_fetch_array($result)) {

										  $no = 1 ;
							 ?>

							<tr>
								<td>
									<a href="?module=gathering&act=batal_undangan&id_undangan=<?php echo $row[id_undangan];?>&id_gathering=<?php echo $id_gathering;?>" class="btn btn-xs red tooltips" data-original-title="Undang Customer">
										 <i class="fa fa-retweet"></i>
									</a>
								</td>
								<?php if ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) { ?>
								<td><?php echo $row['salesman'];?></td>
								<?php } ?>
								<td><?php echo $row['nama_perush'];?></td>
								<td><?php echo $row['segmen'];?></td>
								<td><?php echo $row['nama_kota'];?></td>
								<td><?php echo $row['status_prospek']; ?></td>
							</tr>
							<?php 
									}
                        	 ?>
							</tbody>
							</table>

							<div class="form-actions">
								<button type="submit" class="btn blue" value="Input">Batal Undang</button>
								<?php if ($_SESSION[level] == 'admin' OR $_SESSION[level] == 'manager' ) { ?>
								<a href="excel/gathering.php?id_gathering=<?php echo $id_gathering;?>"><button type="button" class="btn default">Export Excel</button></a>
								<?php } ?>
							</div>
							</form>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<?php break ; ?>

			<?php case "tambah_undangan" : ?>

				<?php 
					$id_pelanggan = $_GET['id_pelanggan'];
					$id_gathering = $_GET['id_gathering'];

					$tambah_undangan = mysql_query("INSERT INTO tb_undangan VALUES ('','$id_pelanggan','$id_gathering')");

				if($tambah_undangan){
					header('location:?module=gathering&act=undangan&id_gathering='.$id_gathering.'');
					}
				?>

			<?php break ; ?>

			<?php case "batal_undangan" : ?>

				<?php 
					$id_pelanggan = $_GET['id_pelanggan'];
					$id_undangan = $_GET['id_undangan'];
					$id_gathering = $_GET['id_gathering'];

					$tambah_undangan = mysql_query("DELETE FROM tb_undangan WHERE id_undangan = $id_undangan");

				if($tambah_undangan){
					header('location:?module=gathering&act=undangan&id_gathering='.$id_gathering.'');
					}
				?>

			<?php break ; ?>

			<?php case "delete" : ?>

			<?php 

				$delete = mysql_query("UPDATE tb_gathering SET deleted_flag = 1 WHERE id_gathering = $id_gathering");

				if($delete){
					header('location:?module=gathering&notif=3');
					}
			?>

			<?php break ; ?>

			<?php } ?>
		</div>
</div>