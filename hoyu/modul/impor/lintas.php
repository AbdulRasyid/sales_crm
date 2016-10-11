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
				<div class="col-md-6">
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
                        	<div class="col-md-3">
								<label class="control-label">Pilih Unit</label>		
								<select class="form-control form-control-inline" name="divisi" onchange="ambil_divisi(this.value);">
									<option selected="selected">- Pilih Unit -</option>
									<option value="unit">Unit</option>
									<option value="service">Service</option>
									<option value="part">Sparepart</option>
								</select>
							</div>

							<div class="col-md-5">
								<label class="control-label">Salesman</label>		
								<select class="form-control form-control-inline" id="sales" name="sales">
									<option selected="selected">- Pilih Salesman -</option>

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
	
				$divisi = $_POST['divisi'];
				$sales = $_POST['sales'];

				if($divisi == 'unit'){
				$result = mysql_query("SELECT	a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.kategori_segmen, c.segmen, 
												e.nama_kota, a.hino,a.isuzu, a.mitsubishi, a.toyota, a.lain, d.status_prospek, 
												a.salesman, a.salespart, a.salesserv
									  FROM 	tb_pelanggan a
									  LEFT JOIN ms_segmen_kategori b ON b.id_kategori_segmen = a.id_kategori_segmen
									  LEFT JOIN ms_segmen c ON c.id_segmen = a.id_segmen
									  LEFT JOIN v_unit_latest_prospek d ON d.id_pelanggan = a.id_pelanggan
									  LEFT JOIN ms_kota e ON e.id_kota = a.id_kota
									  WHERE	a.salesman = '$sales'
									  ORDER BY	id_pelanggan DESC");	
				} elseif ($divisi == 'part') {
				$result = mysql_query("SELECT	a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.kategori_segmen, c.segmen, 
												e.nama_kota, a.hino,a.isuzu, a.mitsubishi, a.toyota, a.lain, d.status_prospek, 
												a.salesman, a.salespart, a.salesserv
									  FROM 	tb_pelanggan a
									  LEFT JOIN ms_segmen_kategori b ON b.id_kategori_segmen = a.id_kategori_segmen
									  LEFT JOIN ms_segmen c ON c.id_segmen = a.id_segmen
									  LEFT JOIN v_unit_latest_prospek d ON d.id_pelanggan = a.id_pelanggan
									  LEFT JOIN ms_kota e ON e.id_kota = a.id_kota
									  WHERE	a.salespart= '$sales'
									  ORDER BY	id_pelanggan DESC");
				} elseif ($divisi == 'serv') {
				$result = mysql_query("SELECT	a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.kategori_segmen, c.segmen, 
												e.nama_kota, a.hino,a.isuzu, a.mitsubishi, a.toyota, a.lain, d.status_prospek, 
												a.salesman, a.salespart, a.salesserv
									  FROM 	tb_pelanggan a
									  LEFT JOIN ms_segmen_kategori b ON b.id_kategori_segmen = a.id_kategori_segmen
									  LEFT JOIN ms_segmen c ON c.id_segmen = a.id_segmen
									  LEFT JOIN v_unit_latest_prospek d ON d.id_pelanggan = a.id_pelanggan
									  LEFT JOIN ms_kota e ON e.id_kota = a.id_kota
									  WHERE	a.salesserv = '$sales'
									  ORDER BY	id_pelanggan DESC");
				}
				
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
								<th width="15%">Segmen</th>
								<th width="15%">Kota</th>
								<th width="5%">Hino</th>
								<th width="5%">Toyota</th>
								<th width="5%">Mitsu</th>
								<th width="5%">Isuzu</th>
								<th width="5%">Lain</th>
								<?php if($divisi == 'unit'){ ?>
								<th width="12%">SalesPart</th>
								<th width="12%">SalesServ</th>

								<?php } elseif($divisi == 'part'){ ?>
								<th width="12%">SalesUnit</th>
								<th width="12%">SalesServ</th>

								<?php } elseif($divisi == 'service'){ ?>
								<th width="12%">SalesUnit</th>
								<th width="12%">SalesPart</th>
								<?php } ?>
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
								<td><?php echo $row['hino']?></td>
								<td><?php echo $row['isuzu']?></td>
								<td><?php echo $row['mitsubishi']?></td>
								<td><?php echo $row['toyota']?></td>
								<td><?php echo $row['lain']?></td>

								<?php if($divisi == 'unit'){ ?>
								<td><?php echo $row['salespart']?></td>
								<td><?php echo $row['salesserv']?></td>

								<?php } elseif($divisi == 'part'){ ?>
								<td><?php echo $row['salesman']?></td>
								<td><?php echo $row['salesserv']?></td>

								<?php } elseif($divisi == 'service'){ ?>
								<td><?php echo $row['salesman']?></td>
								<td><?php echo $row['salespart']?></td>
								<?php } ?>

							</tr>
							<?php }  ?>
							</tbody>
							</table>
							<div class="col-md-2">
							<input class="btn purple" value="Impor Ke Sales"/>
							<input type="hidden" name="divisi" value="<?php echo $divisi ; ?>" />
							</div>

							<?php if($divisi == 'unit'){ ?>
							<div class="col-md-3">
								<select class="form-control form-control-inline select2me" name="salespart">
										<option value="" selected="selected">- Pilih SalesPart -</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE level IN ('sales','supervisor') AND divisi = 'hino' AND sublevel = 'part' AND blokir = 'N' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  												
											echo '<option value="'.$id.'">'.$row['username'].'</option>';
													}
											?>
								</select>
							</div>

							<div class="col-md-3">
								<select class="form-control form-control-inline select2me" name="salesserv">
										<option value="" selected="selected">- Pilih SalesService -</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE level IN ('sales','supervisor') AND divisi = 'hino' AND sublevel = 'service' AND blokir = 'N' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  												
											echo '<option value="'.$id.'">'.$row['username'].'</option>';
													}
											?>
								</select>
							</div>

							<?php } elseif($divisi == 'part'){ ?>
							<div class="col-md-3">
								<select class="form-control form-control-inline select2me" name="salesman">
										<option value="" selected="selected">- Pilih SalesUnit -</option>
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

							<div class="col-md-3">
								<select class="form-control form-control-inline select2me" name="salesserv">
										<option value="" selected="selected">- Pilih SalesService -</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE level IN ('sales','supervisor') AND divisi = 'hino' AND sublevel = 'service' AND blokir = 'N' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  												
											echo '<option value="'.$id.'">'.$row['username'].'</option>';
													}
											?>
								</select>
							</div>

							<?php } elseif($divisi == 'service'){ ?>
							<div class="col-md-3">
								<select class="form-control form-control-inline select2me" name="salesman">
										<option value="" selected="selected">- Pilih SalesUnit -</option>
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

							<div class="col-md-3">
								<select class="form-control form-control-inline select2me" name="salespart">
										<option value="" selected="selected">- Pilih SalesPart -</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE level IN ('sales','supervisor') AND divisi = 'hino' AND sublevel = 'part' AND blokir = 'N' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  												
											echo '<option value="'.$id.'">'.$row['username'].'</option>';
													}
											?>
								</select>
							</div>
							<?php } ?>

							<input type="submit" class="btn btn-danger" name="impor_lintas" value="Impor"/>
							</form>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->	
				</div>
			</div>
			<!-- END PAGE CONTENT-->

			<?php } ?>

			<?php break; ?>

			<?php } ?>
		</div>
</div>