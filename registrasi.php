<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->

<html lang="en">
<?php include "koneksi.php" ; ?>
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>SalesCRM | DCM - Duta Cemerlang Motors </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="rt-ico.png"/>
</head>
<!-- END HEAD -->

<body class="page-md page-header-fixed page-quick-sidebar-over-content page-full-width">

<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
			<div class="col-md-2 ">
			</div>
			
			<div class="col-md-8 ">				
				<h3 class="page-title">
					PT. Duta Cemerlang Motors  <small>SalesCRM</small>
				</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
					</ul>
				</div>
			</div>

			<div class="col-md-2 ">
			</div>
			</div>
			<!-- END PAGE HEADER-->

			<?php 
				$username = $_GET['username'] ;
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
					$id_parent = $_POST['id_parent'];

					$tambah=mysql_query("UPDATE ms_users SET tgl_masuk = NOW() , id_grade = 1, nama_lengkap = '$nama_lengkap',
					 							email = '$email', no_telp = '$no_telp',  divisi = '$divisi',
					 							level = '$level', sublevel = '$sublevel', blokir = 'N', id_parent = '$id_parent'
					 							kantor = '$kantor',grade = 'trainee' 
					 					 WHERE username = '$username' ") or die(mysql_error());
				if($tambah){
						header('location:index.php?notif=5');

											}
										}

											}
			?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-2 ">
				</div>
				<div class="col-md-8 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Form Registrasi
							</div>
						</div>
						<div class="portlet-body form">
 
							<form class="form-horizontal" role="form" method="post">
								<div class="form-body">

									<div class="form-group">
										<label class="col-md-3 control-label">Nama Lengkap</label>
										<div class="col-md-6">
											<input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" autocomplete="off" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Email</label>
										<div class="col-md-6">
											<input type="text" class="form-control" placeholder="Nama Lengkap" name="email" autocomplete="off" required>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">No. Hp</label>
										<div class="col-md-6">
											<input type="text" class="form-control" placeholder="No. Handphone" name="no_telp" autocomplete="off" required>
										</div>
									</div>


									<div class="form-group">
										<label class="col-md-3 control-label">Divisi</label>
										<div class="col-md-6">
											<select class="form-control" name="divisi">
												<option>---Pilih Divisi---</option>
												<option value="hino">Hino</option>
												<option value="suzuki">Suzuki</option>
												
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Level</label>
										<div class="col-md-6">
											<select class="form-control" name="level">
												<option>---Pilih Level---</option>
												<option value="manager">Manager</option>
												<option value="admin">Admin</option>
												<option value="supervisor">Supervisor</option>
												<option value="sales">Sales</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label">Sub Level</label>
										<div class="col-md-6">
											<select class="form-control" name="sublevel">
												<option>---Pilih Sub Level---</option>
												<option value="unit" <?php if($array['sublevel'] == 'unit') { echo "selected"; } ?>>Unit</option>
												<option value="part" <?php if($array[sublevel] == 'part') { echo 'selected' ;} ?>>Sparepart</option>
												<option value="service" <?php if($array[sublevel] == 'service') { echo 'selected' ;} ?>>Service</option>
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
														echo '<option value="'.$id.'">'.$row['nama_lengkap'].'</option>';
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
												<option value="kaligawe">SMG Kaligawe</option>
												<option value="cipto">SMG Cipto</option>
												<option value="banjarnegara">Banjarnegara</option>
												<option value="magelang">Magelang</option>
											</select>
										</div>
									</div>

								</div>
								<div class="form-actions right1">
									<button type="submit" class="btn green">Submit</button>
								</div>
							</form>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->		
				</div>
				<div class="col-md-2 ">
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2015 © Metronic. SalesCRM - Duta Cemerlang Motors.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {   
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>