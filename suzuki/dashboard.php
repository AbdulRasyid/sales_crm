<?php
ob_start(); session_start();
error_reporting(0);
include "../timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:../logout.php');
}
else{
if (empty($_SESSION['username']) 
    AND empty($_SESSION['password']) 
    AND $_SESSION['login']==0){
  header ("location: index.php?notif=2");
}
else{
?>

<!DOCTYPE html>
<html lang="en">
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
-->

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<!--<![endif]-->

<!-- BEGIN HEAD -->
<?php 
include 'library/inc.css.head.php';
?>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-full-width">

<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
	
	<!-- BEGIN HEADER INNER -->
	<?php
	include 'library/inc.header.php';
	?>
	<!-- END HEADER INNER -->

</div>
<!-- END HEADER -->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">
	
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		
		<!-- BEGIN HORIZONTAL RESPONSIVE MENU -->
		<?php 
		include 'library/inc.side.nav.php';
		?>
		<!-- END HORIZONTAL RESPONSIVE MENU -->

	</div>
	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->
		<?php include "content_dashboard.php"; ?>
	<!-- END CONTENT -->


	<!-- BEGIN QUICK SIDEBAR -->
	<?php 
	include 'library/inc.sidebar.php';
	?>
	<!-- END QUICK SIDEBAR -->

</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<?php 
include 'library/inc.footer.php';
?>
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<?php 
include 'library/inc.js.footer.php';
?>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->

</html>

<?php 
		}
	}
?>