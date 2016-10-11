<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>

				<li class="start ">
					<a href="?module=dashboard">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
				


				<li>
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">Customer</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						
						<li><a href="?module=data_customer">Data Customer</a></li>
						
						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager" ) { ?> 
						<li><a href="?module=impor_customer">Impor Customer</a></li>
						<?php } ?>

						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager" AND $_SESSION['sublevel'] == "part" OR $_SESSION['sublevel'] == "service"  ) { ?>
						<li><a href="?module=impor_unit">Impor From Unit</a></li>
						<?php } ?>

					</ul>
				</li>

				<li>
					<a href="javascript:;">
					<i class="icon-docs"></i>
					<span class="title">Laporan</span>
					<span class="arrow "></span>
					</a>

					<?php if($_SESSION['level'] == "sales" ) { ?>  
					<ul class="sub-menu">						
						<li><a href="?module=lap_aktivitas_sales">Laporan Aktivitas</a></li>
						<?php if($_SESSION['sublevel'] == "unit" ) { ?>
						<li><a href="?module=lap_prospek_sales">Laporan Prospek</a></li>
						<?php }  ?>
					</ul>

					<?php } elseif ($_SESSION['level'] == "supervisor" ) { ?>
					<ul class="sub-menu">						
						<li><a href="?module=lap_join_visit">Laporan Join Visit</a></li>
					</ul>

					<?php } elseif ($_SESSION['level'] == "manager" OR $_SESSION['level'] == "admin" )  { ?>
					<ul class="subm-menu">						
						<li><a href="?module=lap_sales_mointoring">Laporan Sales Monitoring</a></li>
						<li><a href="?module=lap_kpi_insentif">Laporan KPI Insentif</a></li>
						<li><a href="?module=lap_its">Laporan ITS</a></li>
					</ul>
					<?php } ?>
				</li>

				<li class="start ">
					<a href="?module=gathering">
					<i class="icon-present"></i>
					<span class="title">Gathering</span>
					</a>
				</li>

				<?php if ($_SESSION['level'] == "admin" ) { ?>
				<li class="start ">
					<a href="javascript:;">
					<i class="icon-briefcase"></i>
					<span class="title">Database</span>
					</a>
				</li>
				<?php } ?>

				<?php if( $_SESSION['leveluser'] == "it" ) { ?>
				<li>
					<a href="javascript:;">
					<i class="icon-puzzle"></i>
					<span class="title">Upload</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li><a href="?module=up_polreg">Upload Polreg</a></li>
						<li><a href="?module=up_lpg">Upload LPG</a></li>
						<li><a href="?module=up_absensi">Upload Absensi</a></li>	
					</ul>
				</li>
				
				<li>
					<a href="javascript:;">
					<i class="icon-settings"></i>
					<span class="title">Master Data</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li><a href="?module=master_kendaraan">Master Kendaraan</a></li>
						<li><a href="?module=master_lembaga">Master Lembaga</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>