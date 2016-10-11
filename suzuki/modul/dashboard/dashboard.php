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

			<?php if ($_SESSION[level] == 'sales' ) { ?>

			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_customer = mysql_query("SELECT salesman, COUNT(nama_perush) as total FROM tb_pelanggan 
														   WHERE salesman = '$_SESSION[username]' AND deleted_flag = 0");

							$r_customer = mysql_fetch_array($total_customer) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_customer['total'] ; ?>
							</div>
							<div class="desc">
								Total Customer
							</div>
						</div>
						<a class="more" href="?module=data_customer">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_touch = mysql_query("SELECT COUNT(id_pelanggan) AS total_touch
														FROM tb_prospek
														WHERE id_status_prospek = 1
														AND YEAR (tgl_touch) = YEAR (NOW())
														AND MONTH (tgl_touch) = MONTH (NOW())
														AND created_by = '$_SESSION[username]'");

							$r_touch = mysql_fetch_array($total_touch) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_touch['total_touch'] ; ?>
							</div>
							<div class="desc">
								Total Customer Touch
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Bulan ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_nego = mysql_query("SELECT COUNT(id_pelanggan) AS total_nego
													   FROM tb_prospek
													   WHERE id_status_prospek = 2
													   AND YEAR (tgl_touch) = YEAR (NOW())
													   AND MONTH (tgl_touch) = MONTH (NOW())
													   AND created_by = '$_SESSION[username]'");

							$r_nego = mysql_fetch_array($total_nego) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_nego['total_nego'] ; ?>
							</div>
							<div class="desc">
								Total Customer Nego
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Bulan ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_do = mysql_query("SELECT salesman, IFNULL(SUM(jml_kendaraan),0) AS total_do
													 FROM v_unit_dashboard_sales_prospek
													 WHERE status_prospek LIKE '%DO%'
													 AND YEAR (tgl_do) = YEAR (NOW())
													 AND salesman LIKE '$_SESSION[username]'");

							$r_do = mysql_fetch_array($total_do) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_do['total_do'] ; ?>
							</div>
							<div class="desc">
								Total Penjualan Unit
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Tahun ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->

			
			<div class="clearfix">
			</div>
			
			<!-- START RECENT ACTIVITY  -->
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES ACTIVITY</span>
								<span class="caption-helper">Board...</span>
							</div>

						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								
								<?php 

								$recent = mysql_query("SELECT salesman, supervisor, aktivitas, SUBSTR(nama_perush, 1, 22) 
															  AS nama_perush, tgl_aktivitas AS calendar, 
															  DATE_FORMAT(tgl_aktivitas,'%d %b %y') AS tgl_aktivitas,
															  DATE_FORMAT(tgl_kunjungan_berikut,'%d %b %y') AS tgl_kunjungan
													   FROM v_unit_dashboard_sales_activity
													   WHERE salesman = '$_SESSION[username]' 
													   ORDER BY calendar DESC LIMIT 10") or die (mysql_error());
								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['aktivitas'] == 'telp') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-phone"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-user"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-paste"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Visit </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp
														
														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[tgl_aktivitas] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-body">
							<div id="site_activities_content" class="display-none">
							<div id="aktivitas-sales"  style="min-width: 400px; height: 377px; margin: 0 auto">
							</div>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>		
			</div>
			<!-- END RECENT ACTIVITY -->


			<!-- START RECENT PROSPEK  -->
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES PROSPECT</span>
								<span class="caption-helper">Board...</span>
							</div>
						</div>

						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								<?php 
									$recent = mysql_query("SELECT status_prospek, SUBSTR(nama_perush, 1, 10) AS nama_perush,
									 							  tipe_kendaraan, tgl_prospek,
									 							  DATE_FORMAT(tgl_prospek, '%d %b %y') AS calendar
														FROM v_unit_dashboard_sales_prospek
														WHERE salesman = '$_SESSION[username]' AND status_prospek IN  ('Touch', 'Nego' ,'SPK') AND YEAR(tgl_prospek) = YEAR(NOW())
														ORDER BY tgl_prospek DESC LIMIT 10") or die (mysql_error());

								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-check"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-comments"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-map-marker"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-flag"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-edit"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-car"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-thumbs-down"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Touch </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Nego </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Hot </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> SPK </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> PO </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> DO </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Lost </span> &nbsp
														<?php } ?>

														<?php if ($_SESSION[leveluser] == 'supervisor') { ?>
															<span class="label label-sm label-info "> <?php echo $r_recent[salesman] ; ?> </span> &nbsp
														<?php	} ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp

														<span class="label label-sm label-default "><i class="fa fa-shopping-cart"></i> <?php echo $r_recent[tipe_kendaraan] ; ?> </span> &nbsp

													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[calendar] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-body">
							<div id="prospek-sales"  style="min-width: 400px; height: 377px; margin: 0 auto">
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>		
			</div>
			<!-- END RECENT PROSPEK -->
			</div>

			<div id="site_activities_content" class="display-none">
				<div id="site_activities" style="height: 228px;">
				</div>
			</div>

			<?php } ?>


			<?php if ($_SESSION[level] == 'supervisor' ) { ?>

			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_customer = mysql_query("SELECT b.supervisor as supervisor, 
																  COUNT(a.nama_perush) as total 
														   FROM tb_pelanggan a
														   JOIN v_data_users b ON b.salesman=a.salesman
														WHERE b.supervisor = '$_SESSION[username]' AND deleted_flag = 0");

							$r_customer = mysql_fetch_array($total_customer) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_customer['total'] ; ?>
							</div>
							<div class="desc">
								Total Customer Dalam Tim
							</div>
						</div>
						<a class="more" href="?module=data_customer">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_touch = mysql_query("SELECT IFNULL(COUNT(nama_perush),0) AS total_touch
													FROM v_unit_dashboard_sales_prospek
													WHERE status_prospek LIKE '%Touch%'
													AND YEAR (tgl_touch) = YEAR (NOW())
													AND MONTH (tgl_touch) = MONTH (NOW())
													AND supervisor = '$_SESSION[username]'");

							$r_touch = mysql_fetch_array($total_touch) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_touch['total_touch'] ; ?>
							</div>
							<div class="desc">
								Total Customer Touch Dalam Tim
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Bulan ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_nego = mysql_query("SELECT IFNULL(COUNT(nama_perush), 0) AS total_nego
													   FROM v_unit_dashboard_sales_prospek
													   WHERE status_prospek LIKE '%Nego%'
													   AND YEAR (tgl_nego) = YEAR (NOW())
													   AND MONTH (tgl_nego) = MONTH (NOW())
													   AND supervisor = '$_SESSION[username]'");

							$r_nego = mysql_fetch_array($total_nego) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_nego['total_nego'] ; ?>
							</div>
							<div class="desc">
								Total Customer Nego Dalam Tim
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Bulan ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_do = mysql_query("SELECT salesman, IFNULL(SUM(jml_kendaraan),0) AS total_do
													FROM v_unit_dashboard_sales_prospek
													WHERE status_prospek LIKE '%DO%'
													AND YEAR (tgl_do) = YEAR (NOW())
													AND supervisor = '$_SESSION[username]'");

							$r_do = mysql_fetch_array($total_do) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_do['total_do'] ; ?>
							</div>
							<div class="desc">
								Total Penjualan Unit
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Tahun ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->

			<!-- START RECENT ACTIVITY PROSPEK TIM  -->
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES ACTIVITY TIM</span>
								<span class="caption-helper">Board...</span>
							</div>

						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								
								<?php 

								$recent = mysql_query("SELECT salesman,	supervisor,	aktivitas,
															  SUBSTR(nama_perush, 1, 22) AS nama_perush,
															  tgl_aktivitas AS calendar,
															  DATE_FORMAT(tgl_aktivitas, '%d %b %y') AS tgl_aktivitas,
															  DATE_FORMAT(tgl_kunjungan_berikut,'%d %b %y') AS tgl_kunjungan
													   FROM	v_unit_dashboard_sales_activity
													   WHERE supervisor = '$_SESSION[username]'
													   AND YEAR (tgl_aktivitas) = YEAR (NOW())
													   GROUP BY	nama_perush
													   ORDER BY	calendar DESC LIMIT 25") or die (mysql_error());
								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['aktivitas'] == 'telp') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-phone"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-user"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-paste"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<span class="label label-sm label-info "> <?php echo $r_recent[salesman] ; ?> </span> &nbsp

														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Visit </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp
														
														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[tgl_aktivitas] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES PROSPECT TIM</span>
								<span class="caption-helper">Board...</span>
							</div>
						</div>

						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								<?php 
									$recent = mysql_query("SELECT salesman,status_prospek, 
																  SUBSTR(nama_perush, 1, 10) AS nama_perush,
									 							  SUBSTR(tipe_kendaraan, 1, 11) AS tipe_kendaraan, tgl_prospek,
									 							  DATE_FORMAT(tgl_prospek, '%d %b %y') AS calendar
														FROM v_unit_dashboard_sales_prospek
														WHERE supervisor = '$_SESSION[username]' AND status_prospek IN  ('Touch', 'Nego' ,'SPK') AND YEAR(tgl_prospek) = YEAR(NOW())
														ORDER BY tgl_prospek DESC LIMIT 25") or die (mysql_error());

								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-check"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-comments"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-map-marker"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-flag"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-edit"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-car"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-thumbs-down"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Touch </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Nego </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Hot </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> SPK </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> PO </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> DO </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Lost </span> &nbsp
														<?php } ?>

														<?php if ($_SESSION[leveluser] == 'supervisor') { ?>
															<span class="label label-sm label-info "> <?php echo $r_recent[salesman] ; ?> </span> &nbsp
														<?php	} ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp

														<span class="label label-sm label-default "><i class="fa fa-shopping-cart"></i> <?php echo $r_recent[tipe_kendaraan] ; ?> </span> &nbsp

													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[calendar] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
			<!-- END RECENT ACTIVITY PROSPEK TIM-->

			<!-- START GRAPH AKTIVITAS  -->
			<!--div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="portlet light ">
						<div class="portlet-body">
							<div id="site_activities_content" class="display-none">
								<div id="aktivitas-tim-eko"  style="min-width: 400px; height: 377px; margin: 0 auto">
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div-->

			<!-- END GRAPH AKTIVITAS -->

			<!-- START GRAPH PROSPEK  -->
			<!--div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="portlet light ">
						<div class="portlet-body">
							<div id="prospek-tim-eko"  style="min-width: 400px; height: 377px; margin: 0 auto">
							</div>
						</div>
					</div>	
				</div>
			</div-->

			<!-- END GRAPH PROSPEK -->
			<?php } ?>

			<?php if ($_SESSION[level] == 'admin' ) { ?>

			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_customer = mysql_query("SELECT b.supervisor as supervisor, 
																  COUNT(a.nama_perush) as total 
														   FROM tb_pelanggan a
														   JOIN v_data_users b ON b.salesman=a.salesman
														WHERE b.supervisor = '$_SESSION[username]' AND deleted_flag = 0");

							$r_customer = mysql_fetch_array($total_customer) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_customer['total'] ; ?>
							</div>
							<div class="desc">
								Total Customer Dalam Tim
							</div>
						</div>
						<a class="more" href="?module=data_customer">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_touch = mysql_query("SELECT IFNULL(COUNT(nama_perush),0) AS total_touch
													FROM v_unit_dashboard_sales_prospek
													WHERE status_prospek LIKE '%Touch%'
													AND YEAR (tgl_touch) = YEAR (NOW())
													AND MONTH (tgl_touch) = MONTH (NOW())
													AND supervisor = '$_SESSION[username]'");

							$r_touch = mysql_fetch_array($total_touch) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_touch['total_touch'] ; ?>
							</div>
							<div class="desc">
								Total Customer Touch Dalam Tim
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Bulan ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_nego = mysql_query("SELECT IFNULL(COUNT(nama_perush), 0) AS total_nego
													   FROM v_unit_dashboard_sales_prospek
													   WHERE status_prospek LIKE '%Nego%'
													   AND YEAR (tgl_nego) = YEAR (NOW())
													   AND MONTH (tgl_nego) = MONTH (NOW())
													   AND supervisor = '$_SESSION[username]'");

							$r_nego = mysql_fetch_array($total_nego) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_nego['total_nego'] ; ?>
							</div>
							<div class="desc">
								Total Customer Nego Dalam Tim
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Bulan ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>

						<?php 
							$total_do = mysql_query("SELECT salesman, IFNULL(SUM(jml_kendaraan),0) AS total_do
													FROM v_unit_dashboard_sales_prospek
													WHERE status_prospek LIKE '%DO%'
													AND YEAR (tgl_do) = YEAR (NOW())
													AND supervisor = '$_SESSION[username]'");

							$r_do = mysql_fetch_array($total_do) ;
						?>

						<div class="details">
							<div class="number">
								 <?php echo $r_do['total_do'] ; ?>
							</div>
							<div class="desc">
								Total Penjualan Unit
							</div>
						</div>
						<a class="more" href="javascript:;">
						Dalam Tahun ini <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->

			<!-- START RECENT ACTIVITY PROSPEK TIM  -->
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES ACTIVITY TIM</span>
								<span class="caption-helper">Board...</span>
							</div>

						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								
								<?php 

								$recent = mysql_query("SELECT salesman,	supervisor,	aktivitas,
															  SUBSTR(nama_perush, 1, 22) AS nama_perush,
															  tgl_aktivitas AS calendar,
															  DATE_FORMAT(tgl_aktivitas, '%d %b %y') AS tgl_aktivitas,
															  DATE_FORMAT(tgl_kunjungan_berikut,'%d %b %y') AS tgl_kunjungan
													   FROM	v_unit_dashboard_sales_activity
													   WHERE supervisor = '$_SESSION[username]'
													   AND YEAR (tgl_aktivitas) = YEAR (NOW())
													   GROUP BY	nama_perush
													   ORDER BY	calendar DESC LIMIT 25") or die (mysql_error());
								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['aktivitas'] == 'telp') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-phone"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-user"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-paste"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<span class="label label-sm label-info "> <?php echo $r_recent[salesman] ; ?> </span> &nbsp

														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Visit </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp
														
														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[tgl_aktivitas] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES PROSPECT TIM</span>
								<span class="caption-helper">Board...</span>
							</div>
						</div>

						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								<?php 
									$recent = mysql_query("SELECT salesman,status_prospek, 
																  SUBSTR(nama_perush, 1, 10) AS nama_perush,
									 							  SUBSTR(tipe_kendaraan, 1, 11) AS tipe_kendaraan, tgl_prospek,
									 							  DATE_FORMAT(tgl_prospek, '%d %b %y') AS calendar
														FROM v_unit_dashboard_sales_prospek
														WHERE supervisor = '$_SESSION[username]' AND status_prospek IN  ('Touch', 'Nego' ,'SPK') AND YEAR(tgl_prospek) = YEAR(NOW())
														ORDER BY tgl_prospek DESC LIMIT 25") or die (mysql_error());

								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-check"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-comments"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-map-marker"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-flag"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-edit"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-car"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-thumbs-down"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Touch </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Nego </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Hot </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> SPK </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> PO </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> DO </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Lost </span> &nbsp
														<?php } ?>

														<?php if ($_SESSION[leveluser] == 'supervisor') { ?>
															<span class="label label-sm label-info "> <?php echo $r_recent[salesman] ; ?> </span> &nbsp
														<?php	} ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp

														<span class="label label-sm label-default "><i class="fa fa-shopping-cart"></i> <?php echo $r_recent[tipe_kendaraan] ; ?> </span> &nbsp

													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[calendar] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
			<!-- END RECENT ACTIVITY PROSPEK TIM-->

			<hr>

			<!-- START RECENT ACTIVITY PROSPEK TIM PAK EKO  -->
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES ACTIVITY - TIM EKO</span>
								<span class="caption-helper">Board...</span>
							</div>

						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								
								<?php 

								$recent = mysql_query("SELECT salesman,	supervisor,	aktivitas,
															  SUBSTR(nama_perush, 1, 22) AS nama_perush,
															  tgl_aktivitas AS calendar,
															  DATE_FORMAT(tgl_aktivitas, '%d %b %y') AS tgl_aktivitas,
															  DATE_FORMAT(tgl_kunjungan_berikut,'%d %b %y') AS tgl_kunjungan
													   FROM	v_unit_dashboard_sales_activity
													   WHERE supervisor = 'eko.hariyanto'
													   AND YEAR (tgl_aktivitas) = YEAR (NOW())
													   GROUP BY	nama_perush
													   ORDER BY	calendar DESC LIMIT 25") or die (mysql_error());
								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['aktivitas'] == 'telp') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-phone"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-user"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-paste"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<span class="label label-sm label-info "> <?php echo $r_recent[salesman] ; ?> </span> &nbsp

														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Visit </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-default "><i class="fa fa-share"></i> Telp </span> &nbsp
														<?php } ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp
														
														<?php if ($r_recent['aktivitas'] == 'telp') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } elseif ($r_recent['aktivitas'] == 'visit') { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-sign-in"></i> <?php echo $r_recent[tgl_kunjungan] ; ?> </span> &nbsp
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[tgl_aktivitas] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase">SALES PROSPECT - TIM EKO</span>
								<span class="caption-helper">Board...</span>
							</div>
						</div>

						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
								<?php 
									$recent = mysql_query("SELECT salesman,status_prospek, 
																  SUBSTR(nama_perush, 1, 10) AS nama_perush,
									 							  SUBSTR(tipe_kendaraan, 1, 11) AS tipe_kendaraan, tgl_prospek,
									 							  DATE_FORMAT(tgl_prospek, '%d %b %y') AS calendar
														FROM v_unit_dashboard_sales_prospek
														WHERE supervisor = 'eko.hariyanto' AND status_prospek IN  ('Touch', 'Nego' ,'SPK') AND YEAR(tgl_prospek) = YEAR(NOW())
														ORDER BY tgl_prospek DESC LIMIT 25") or die (mysql_error());

								while ($r_recent = mysql_fetch_array($recent)) {
								?>
									<li>
										<div class="col1">
											<div class="cont">
												<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-check"></i>
													</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-comments"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-map-marker"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-flag"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-edit"></i>
												</div>
												</div>

												<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
												<div class="cont-col1">
												<div class="label label-sm label-success">
														<i class="fa fa-car"></i>
												</div>
												</div>

												<?php } else { ?>
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-thumbs-down"></i>
													</div>
												</div>
												<?php } ?>

												<div class="cont-col2">
													<div class="desc">
														<?php if ($r_recent['status_prospek'] == 'Touch') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Touch </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Nego') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Nego </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'Hot') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Hot </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'SPK') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> SPK </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'PO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> PO </span> &nbsp
														<?php } elseif ($r_recent['status_prospek'] == 'DO') { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> DO </span> &nbsp
														<?php } else { ?>
														<span class="label label-sm label-info "><i class="fa fa-bookmark"></i> Lost </span> &nbsp
														<?php } ?>

														<?php if ($_SESSION[leveluser] == 'supervisor') { ?>
															<span class="label label-sm label-info "> <?php echo $r_recent[salesman] ; ?> </span> &nbsp
														<?php	} ?>

														<span class="label label-sm label-danger "> <?php echo $r_recent[nama_perush] ; ?> </span> &nbsp

														<span class="label label-sm label-default "><i class="fa fa-shopping-cart"></i> <?php echo $r_recent[tipe_kendaraan] ; ?> </span> &nbsp

													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 <?php echo $r_recent[calendar] ; ?>
											</div>
										</div>
									</li>
									<?php } ?>


								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
			<!-- END RECENT ACTIVITY PROSPEK TIM PAK EKO-->


			<!-- END GRAPH PROSPEK -->
			<?php } ?>




		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->


