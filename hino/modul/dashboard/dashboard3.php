	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Selamat Datang di SalesCRM ... </h4>
						</div>
						<div class="modal-body">
							 Diberitahukan untuk kepada semua sales, berikut merupakan tampilan baru untuk SalesCRM dimana setiap salesman login maka akan diarahkan pada halaman dashboard, di halaman dashboard ini salesman bisa melihat statistik aktivitas harian maupun prospek penjualan, dikarenakan versi ini masih dalam versi beta/uji coba apabila terdapat erorr/sebagainya harap menghubungi TIM IT agar segera bisa ditindak lanjuti.
						</div>
					</div>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>reports & statistics</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<a href="#portlet-config" data-toggle="modal" class="config">
							<i class="fa fa-angle-right"></i>
						</a>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->

			<div class="clearfix">
			</div>

			<!-- START CHART STATS -->
			<?php 
			if ($_SESSION[level] == 'sales') { ?>
			
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-body">
							<div id="aktivitas" style="min-width: 400px; height: 400px; margin: 0 auto">
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>

				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->

					<!-- END PORTLET-->
				</div>
			</div>

			<?php } elseif ($_SESSION[level] == 'supervisor') { ?>

			<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-body">
							<div id="aktivitas-tim" style="min-width: 400px; height: 400px; margin: 0 auto">
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-body">
							<div id="prospek-tim" style="min-width: 400px; height: 400px; margin: 0 auto">
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>

			<?php } ?>
			<!-- END CHART STATS -->

			<div class="clearfix">
			</div>








		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->


