<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Database <small>Management</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Database</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->

			<?php 
				$id_database = $_GET['id_database']; 
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
                        Data Database Berhasil ditambahkan !!
                </div>
            <?php
			} else if ($_GET['notif'] == 2) {
			?>
				<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Data database Berhasil diperbarui !!
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
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Tabel Data Database
							</div>
							<div class="actions">
								<a href="?module=database&act=tambah" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Database </a>
								<!-- a href="javascript:;" class="btn btn-default btn-sm">
								<i class="fa fa-print"></i> Print </a -->
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="gathering">
							<thead>
							<tr>
								<th width="10%">Kode</th>	
								<th width="25%">Nama</th>
								<th width="25%">Keterangan</th>
								<th width="15%">Tgl Mulai</th>
								<th width="15%">Tgl Selesai</th>
								<th width="10%">Action </th>

							</tr>
							</thead>
							<tbody>

							<?php
                           	$result = mysql_query("SELECT * FROM tb_database WHERE divisi = '$_SESSION[divisi]' ORDER BY id_database DESC");
							while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td><?php echo $row['kode_database'] ?></td>
								<td><?php echo $row['nama_database']?></td>
								<td><?php echo $row['keterangan']?></td>
								<td><?php echo $row['tgl_mulai']?></td>
								<td><?php echo $row['tgl_selesai']?></td>
								<td>
									<a href="?module=database&act=delete&id_database=<?php echo $row['id_database'] ; ?>" 	class="btn btn-xs red tooltips" data-original-title="Hapus Data">
										 <i class="fa fa-times"></i>
									</a>

									<a href="?module=database&act=edit&id_database=<?php echo $row['id_database'] ; ?>" 	class="btn btn-xs green tooltips" data-original-title="Edit Data">
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

			<?php break; ?>

			<?php case "tambah" : ?>

			<?php
				error_reporting (E_ALL ^ E_NOTICE);

				$post = (!empty($_POST)) ? true : false;
				if($post){
					$error = '';

				if(empty($error)){

					$kode_database = $_POST['kode_database'];
					$nama_database = $_POST['nama_database'];
					$keterangan = addslashes( $_POST['keterangan'] );
					$tgl_mulai = $_POST['tgl_mulai'];
					$tgl_selesai = $_POST['tgl_selesai'];
					$divisi = $_SESSION['divisi'];

					$tambah=mysql_query("INSERT INTO tb_database (id_database,kode_database,nama_database,keterangan,tgl_mulai,
																  tgl_selesai,deleted_flag,divisi) 
										 VALUES('','$kode_database','$nama_database','$keterangan','$tgl_mulai','$tgl_selesai',
										 		 0,'$divisi')") or die(mysql_error());
					
				if($tambah){
					header('location:?module=database&notif=1');

									}
										}
								}
			?>

			<div class="row">
				<div class="col-md-4">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus"></i>Tambah Database
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="#" method="post">
								<div class="form-body">

									<div class="form-group">
										<label class="control-label">Kode Database</label>
										<input type="text" class="form-control" autocomplete="off" name="kode_database" placeholder="Kode Database">
									</div>

									<div class="form-group">
										<label class="control-label">Nama Database</label>
										<input type="text" class="form-control" autocomplete="off" name="nama_database" placeholder="Nama Database">
									</div>

									<div class="form-group">
										<label class="control-label">Keterangan</label>
										<textarea type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan" required></textarea>
									</div>

									<div class="form-group input-large">
										<label class="control-label">Tanggal Mulai </label>		
										<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off"  type="text" name="tgl_mulai" placeholder="Input Tanggal" />
									</div>

									<div class="form-group input-large">
										<label class="control-label">Tanggal Selesai </label>		
										<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off"  type="text" name="tgl_selesai" placeholder="Input Tanggal" />
									</div>

														
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=database" type="button" class="btn default">Cancel</a>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
			</div>

			<?php break ; ?>

			<?php case "edit" : ?>

			<?php 
				$result = mysql_query("SELECT * FROM tb_database WHERE id_database=$id_database");
				$array = mysql_fetch_array($result);
			?>

			<?php
				error_reporting (E_ALL ^ E_NOTICE);

				$post = (!empty($_POST)) ? true : false;
				if($post){
					$error = '';

				if(empty($error)){

					$kode_database = $_POST['kode_database'];
					$nama_database = $_POST['nama_database'];
					$keterangan = addslashes( $_POST['keterangan'] );
					$tgl_mulai = $_POST['tgl_mulai'];
					$tgl_selesai = $_POST['tgl_selesai'];
					$divisi = $_SESSION['divisi'];

					$edit=mysql_query("UPDATE tb_database SET kode_database = '$kode_database', nama_database = '$nama_database',
													keterangan = '$keterangan', tgl_mulai = '$tgl_mulai',
													tgl_selesai = '$tgl_selesai'
										 WHERE id_database = $id_database") or die(mysql_error());
					
				if($edit){
					header('location:?module=database&notif=2');

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
										<label class="control-label">Kode Database</label>
										<input type="text" class="form-control" autocomplete="off" name="kode_database" value="<?php echo $array['kode_database']; ?>">
									</div>

									<div class="form-group">
										<label class="control-label">Nama Database</label>
										<input type="text" class="form-control" autocomplete="off" name="nama_database" value="<?php echo $array['nama_database']; ?>">
									</div>

									<div class="form-group">
										<label class="control-label">Keterangan</label>
										<textarea type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Keterangan" required><?php echo $array['keterangan']; ?></textarea>
									</div>

									<div class="form-group input-large">
										<label class="control-label">Tanggal Mulai </label>		
										<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off"  type="text" name="tgl_mulai" value="<?php echo $array['tgl_mulai']; ?>" />
									</div>

									<div class="form-group input-large">
										<label class="control-label">Tanggal Selesai </label>		
										<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off"  type="text" name="tgl_selesai" value="<?php echo $array['tgl_selesai']; ?>" />
									</div>

														
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue" value="Input">Submit</button>
									<a href="?module=database" type="button" class="btn default">Cancel</a>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
				</div>
			</div>

			<?php break ; ?>



			<?php case "delete" : ?>

			<?php 

				$delete = mysql_query("UPDATE tb_database SET deleted_flag = 1 WHERE id_database = $id_database");

				if($delete){
					header('location:?module=database&notif=3');
					}
			?>

			<?php break ; ?>

			<?php } ?>
		</div>
</div>