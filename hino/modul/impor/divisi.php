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
				$id_gathering = $_GET['id_gathering']; 
			?>
			
			<?php 
            	switch($_GET[act]){
            	default:
          	?>

          	<div class="row">
				<div class="col-md-5">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
				  	<div class="portlet box red">
                  		<div class="portlet-title">
                 			 <div class="caption">
								<i class="fa fa-cogs"></i>Filter Salesman
				 			 </div>
				 			 <div class="actions">
								<a href="?module=impor_divisi&act=data_import" target="_blank" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Data Import </a>
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
 											$sql= mysql_query("SELECT * FROM ms_users WHERE level IN ('sales','supervisor') AND divisi = 'hino' AND sublevel = 'unit' AND blokir = 'Y' ORDER BY username ASC");
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
				
				<div class="col-md-6">
					<?php
						$notif = $_GET['notif'];
			
						if ($_GET['notif'] == 1) {
					?>
						<div class="alert alert-danger alert-dismissable">
                        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                       		 Data Customer Berhasil Diimpor !!!
                		</div>

           			<?php } ?>
				
				</div>
			</div>

			<?php 
				
				if(isset($_POST['submit'])){
	
				$sales = $_POST['sales'];

				$result = mysql_query("SELECT	a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.kategori_segmen, c.segmen, 
												e.nama_kota, f.nama_kecamatan, a.hino,a.isuzu, a.mitsubishi, a.toyota, a.lain, 
												d.status_prospek
									  FROM 	tb_pelanggan a
									  LEFT JOIN ms_segmen_kategori b ON b.id_kategori_segmen = a.id_kategori_segmen
									  LEFT JOIN ms_segmen c ON c.id_segmen = a.id_segmen
									  LEFT JOIN v_unit_latest_prospek d ON d.id_pelanggan = a.id_pelanggan
									  LEFT JOIN ms_kota e ON e.id_kota = a.id_kota
									  LEFT JOIN ms_kecamatan f ON f.id_kecamatan = a.id_kecamatan
									  WHERE	a.salesman = '$sales'
									  ORDER BY	id_pelanggan DESC");
			?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Data Customer Sales <?php echo $sales ; ?>
							</div>
						</div>
						<div class="portlet-body">
							<form action="modul/impor/action.php" enctype="multipart/form-data" method="POST">
							<table class="table table-striped table-bordered table-hover" id="impor_divisi">
							<thead>
							<tr>
								<th class="table-checkbox">
									<input type="checkbox" class="group-checkable" data-set="#impor_divisi .checkboxes"/>
								</th>
								<th width="20%">Nama Perusahaan</th>
								<th width="15%">Pengurus</th>
								<th width="15%">Segmen</th>
								<th width="15%">Kota</th>
								<th width="15%">Kecamatan</th>
								<th width="5%">Status</th>

							</tr>
							</thead>
							<tbody>

							<?php
							while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td>
								<input type="checkbox" class="checkboxes" name="users[]" value="<?php echo $row['id_pelanggan'] ?>"/>
								<input type="hidden" name="f_sales" value="<?php echo $sales ; ?>" />
								</td>
								<td><?php echo $row['nama_perush'] ?></td>
								<td><?php echo $row['nama_pengurus']?></td>
								<td><?php echo $row['segmen']?></td>
								<td><?php echo $row['nama_kota']?></td>
								<td><?php echo $row['nama_kecamatan']?></td>
								<td><?php echo $row['status_prospek']?></td>
							</tr>
							<?php }     ?>
							</tbody>
							</table>
							<div class="col-md-2">
							<input class="btn purple" value="Impor Ke Sales"/>
							</div>
							<div class="col-md-3">
								<select class="form-control form-control-inline select2me" name="t_sales">
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
							<input type="submit" class="btn btn-danger" name="impor_divisi" value="Impor"/>
							</form>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php } ?>

			<?php break; ?>

			<?php case"data_import" : ?>

			<div class="row">
				<div class="col-md-12">
					<?php
						$notif = $_GET['notif'];
			
						if ($_GET['notif'] == 1) {
					?>
						<div class="alert alert-danger alert-dismissable">
                        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                       		 Data Customer Berhasil Diimpor !!!
                		</div>

           			<?php } ?>
				
				</div>
			</div>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Data Import Customer
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="data_import">
							<thead>
							<tr>
								<th width="5%">ID</th>
								<th width="20%">Nama Perusahaan</th>
								<th width="20%">Pengurus</th>
								<th width="15%">From Salesman</th>
								<th width="15%">To Salesman</th>
								<th width="5%">Tgl Impor</th>
								<th width="5%">Action</th>
							</tr>
							</thead>
							<tbody>

							<?php
								$result = mysql_query("SELECT a.id_import, a.data_import, b.nama_perush, b.nama_pengurus, 
															  a.from_salesman, a.to_salesman, a.import_date 
													   FROM tb_import a
													   JOIN tb_pelanggan b ON b.id_pelanggan = a.data_import 
													   WHERE a.from_salesman IN ($get_child_users_all) AND a.deleted_flag = 0
													   ORDER BY a.import_date DESC");
								while ($row = mysql_fetch_array($result)) {
							?>

							<tr>
								<td><?php echo $row['id_import'] ?></td>
								<td><?php echo $row['nama_perush'] ?></td>
								<td><?php echo $row['nama_pengurus']?></td>
								<td><?php echo $row['from_salesman']?></td>
								<td><?php echo $row['to_salesman']?></td>
								<td><?php echo $row['import_date']?></td>
								<td><a href="?module=impor_divisi&act=undo_import&id_import=<?php echo $row['id_import'] ; ?>"
											class="btn default btn-xs purple">
										<i class="fa fa-edit"></i> Undo </a></td>
							</tr>
							<?php }     ?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php break ; ?>

			<?php case "undo_import": ?>

			<?php 

				$id_import = $_GET['id_import'];
				$r_import = mysql_query("SELECT * FROM tb_import WHERE id_import=$_GET[id_import]");
    			$r = mysql_fetch_array($r_import);

				mysql_query("UPDATE tb_pelanggan SET salesman = '$r[from_salesman]'
									 WHERE id_pelanggan = $r[data_import]");

				mysql_query("UPDATE tb_import SET undo_date = NOW(), deleted_flag = 1
									 WHERE id_import = $id_import");
						
				header('location:?module=impor_divisi&act=data_import&notif=1');

			?>

			<?php break ; ?>

			<?php } ?>
		</div>
</div>