<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			User <small>Management</small>
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
				$username = $_GET['username']; 
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
                        Data User Berhasil diperbarui !!
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
								<i class="fa fa-reorder"></i>Tabel Data User
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="user">
							<thead>
							<tr>
								<th width="12%">Username</th>	
								<th width="20%">Nama Lengkap</th>
								<th width="5%">Level</th>
								<th width="5%">Grade</th>
								<th width="15%">Email</th>
								<th width="15%">No. Hp</th>
								<th width="5%">Status</th>
								<th width="12%">Atasan</th>
								<th width="14%">Action </th>

							</tr>
							</thead>
							<tbody>

							<?php
                           	$result = mysql_query("SELECT a.id_users,a.username,a.nama_lengkap,
                           								  (
                           								  	CASE a.grade
                           								  	WHEN 'no' THEN
                           								  		'No'
                           								  	WHEN 'trainee' THEN
                           								  		'Trainee'
                           								  	WHEN 'silver' THEN
                           								  		'Silver'
                           								  	WHEN 'gold' THEN 
                           								  		'Gold'
                           								  	WHEN 'platinum' THEN 
                           								  		'Platinum'
                           								  	WHEN 'diaomond' THEN
                           								  		'Diamond'
                           								  	ELSE 
                           								  			'-'
                           								  	END
                           								  	) AS grade, a.level,
                           								  a.email,a.no_telp,
															(
																CASE a.blokir
																WHEN 'N' THEN
																	'Aktif'
																WHEN 'Y' THEN
																	'Resign'
																ELSE
																		'-'
																END
															) AS status,
															a.divisi,c.username AS atasan
												  FROM	ms_users a
												  LEFT JOIN ms_users c ON c.id_users = a.id_parent 
												  WHERE a.divisi = 'hino'");
							while ($row = mysql_fetch_array($result)) {
							 ?>

							<tr>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['nama_lengkap'];?></td>
								<td><?php echo $row['level'];?></td>
								<td><?php echo $row['grade'];?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $row['no_telp'];?></td>
								<td><?php echo $row['status'];?></td>
								<td><?php echo $row['atasan'];?></td>
								<td>
									<a href="?module=user&act=delete&username=<?php echo $row['username'] ; ?>" class="btn btn-xs red tooltips" data-original-title="Hapus Data">
										 <i class="fa fa-times"></i>
									</a>

									<a href="?module=user&act=edit&username=<?php echo $row['username'] ; ?>" class="btn btn-xs green tooltips" data-original-title="Edit Data">
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

			<?php case "edit" : ?>

			<?php 
				$result = mysql_query("SELECT * FROM ms_users WHERE username='$username'");
				$array = mysql_fetch_array($result);
			?>

			<?php
				error_reporting (E_ALL ^ E_NOTICE);
 
				$post = (!empty($_POST)) ? true : false;
				if($post){
					$error = '';

				if(empty($error)){

					$nama_lengkap = $_POST['nama_lengkap'];
					$email = $_POST['email'];
					$no_telp = $_POST['no_telp'];
					$divisi = $_POST['divisi'];
					$level = $_POST['level'];
					$sublevel = $_POST['sublevel'];
					$kantor = $_POST['kantor'];
					$grade = $_POST['grade'];
					$id_parent = $_POST['id_parent'];

					$tambah=mysql_query("UPDATE ms_users SET nama_lengkap = '$nama_lengkap',
					 							email = '$email', no_telp = '$no_telp',  divisi = '$divisi',
					 							level = '$level', sublevel = '$sublevel', id_parent='$id_parent',
					 							kantor = '$kantor',grade = '$grade'
					 							WHERE username = '$username' ") or die(mysql_error());
				if($tambah){
						header('location:?module=user&notif=1');

											}
										}

											}
			?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-8 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box red ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Form Edit Data User
							</div>
						</div>
						<div class="portlet-body form">
 
							<form class="form-horizontal" role="form" method="post">
								<div class="form-body">

									<div class="form-group">
										<label class="col-md-3 control-label">Nama Lengkap</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="nama_lengkap" autocomplete="off" value="<?php echo $array['nama_lengkap'] ; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Email</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="email" autocomplete="off" value="<?php echo $array['email'] ; ?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">No. Hp</label>
										<div class="col-md-6">
											<input type="text" class="form-control"  name="no_telp" autocomplete="off" value="<?php echo $array['no_telp'] ; ?>">
										</div>
									</div>


									<div class="form-group">
										<label class="col-md-3 control-label">Divisi</label>
										<div class="col-md-6">
											<select class="form-control" name="divisi">
												<option>---Pilih Divisi---</option>
												<option value="hino"  <?php if($array['divisi'] == 'hino') { echo "selected"; } ?>>Hino</option>
												<option value="suzuki" <?php if($array['divisi'] == 'suzuki') { echo "selected"; } ?>>Suzuki</option>
												
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Level</label>
										<div class="col-md-6">
											<select class="form-control" name="level">
												<option>---Pilih Level---</option>
												<option value="manager" <?php if($array['level'] == 'manager') { echo "selected"; } ?>>Manager</option>
												<option value="admin" <?php if($array['level'] == 'admin') { echo "selected"; } ?>>Admin</option>
												<option value="supervisor" <?php if($array['level'] == 'supervisor') { echo "selected"; } ?>>Supervisor</option>
												<option value="sales" <?php if($array['level'] == 'sales') { echo "selected"; } ?>>Sales</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Sub Level</label>
										<div class="col-md-6">
											<select class="form-control" name="sublevel">
												<option>---Pilih Sub Level---</option>
												<option value="unit" <?php if($array['sublevel'] == 'unit') { echo "selected"; } ?>>Unit</option>
												<option value="part" <?php if($array['sublevel'] == 'part') { echo 'selected' ;} ?>>Sparepart</option>
												<option value="service" <?php if($array['sublevel'] == 'service') { echo 'selected' ;} ?>>Service</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Atasan / SPV</label>
										<div class="col-md-6">
											<select class="form-control select" name="id_parent">
												<option>---Pilih Atasan---</option>
												<?php
													$sql=mysql_query("SELECT * FROM ms_users WHERE level IN ('manager', 'supervisor', 'admin') AND blokir = 'N' ORDER BY nama_lengkap ASC");
														while($row=mysql_fetch_array($sql))
															{
													$id = $row['id_users'];	
													if($id == $array['id_parent']){
															echo '<option value="'.$id.'" selected="selected">'.$row['nama_lengkap'].'</option>';
																	} else {
														echo '<option value="'.$id.'">'.$row['nama_lengkap'].'</option>';
															}
														}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Kantor</label>
										<div class="col-md-6">
											<select class="form-control" name="kantor">
												<option>---Pilih Kantor---</option>
												<option value="kaligawe" <?php if($array['kantor'] == 'kaligawe') { echo "selected"; } ?>>SMG Kaligawe</option>
												<option value="cipto" <?php if($array['kantor'] == 'cipto') { echo "selected"; } ?>>SMG Cipto</option>
												<option value="banjarnegara" <?php if($array['kantor'] == 'banjarnegara') { echo "selected"; } ?>>Banjarnegara</option>
												<option value="magelang" <?php if($array['kantor'] == 'magelang') { echo "selected"; } ?>>Magelang</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Grade</label>
										<div class="col-md-6">
											<select class="form-control" name="grade">
												<option>---Pilih Grade---</option>
												<option value="no" <?php if($array['grade'] == 'no') { echo "selected"; } ?>>No</option>
												<option value="trainee" <?php if($array['grade'] == 'trainee') { echo "selected"; } ?>>Trainee</option>
												<option value="silver" <?php if($array['grade'] == 'silver') { echo "selected"; } ?>>Silver</option>
												<option value="gold" <?php if($array['grade'] == 'gold') { echo "selected"; } ?>>Gold</option>
												<option value="platinum" <?php if($array['grade'] == 'platinum') { echo "selected"; } ?>>Platinum</option>
												<option value="diaomond" <?php if($array['grade'] == 'diamond') { echo "selected"; } ?>>Diamond</option>
												
											</select>
										</div>
									</div>

								</div>
								<div class="form-actions right1">
									<button type="submit" class="btn green">Submit</button>
									<a href="?module=database" type="button" class="btn default">Cancel</button></a>
								</div>
							</form>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->		
				</div>

			</div>
			<!-- END PAGE CONTENT-->

			<?php break ; ?>

			<?php case "delete" : ?>

			<?php 

				$delete = mysql_query("UPDATE ms_users SET blokir = 'Y', tgl_resign = NOW() WHERE username = '$username'");

				if($delete){
					header('location:?module=user&notif=1');
					}
			?>

			<?php break ; ?>

			<?php } ?>
		</div>
</div>