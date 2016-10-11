		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu page-sidebar-menu-light " data-slide-speed="200" data-auto-scroll="true">
				<li class="sidebar-search-wrapper"></li>
				
				<li><a href="?module=dashboard">Dashboard <span class="selected"></span></a></li>

				<li>
					<a>Customer<span class="arrow"></span></a>
					<ul class="sub-menu">
						<li><a href="?module=data_customer">Data Customer</a></li>
						
						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager" ) { ?> 
						<li><a href="ui_general.html">Impor Customer</a></li>	
						<?php } ?>

						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager" AND $_SESSION['sublevel'] == "part" OR $_SESSION['sublevel'] == "service"  ) { ?>
						<li><a href="?module=impor_unit">Impor From Unit</a></li>
						<?php } ?>				
					</ul>
				</li>

				<li><a href="?module=gathering">Gathering <span class="selected"></span></a></li>
				
				<?php if ($_SESSION['level'] == "admin" ) { ?>
				<li><a href="index.html">Database <span class="selected"></span></a></li>
				<?php } ?>

				<li>
					<a>Laporan <span class="arrow"></span></a>
					
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

				<!----- BEGIN IT ZONE ---------------------------------->
				<?php if($_SESSION['level'] == "it" ) { ?>
				<li>
					<a>Upload <span class="arrow"></span></a>
					<ul class="sub-menu">
						<li><a href="?module=up_polreg">Upload Polreg</a></li>
						<li><a href="?module=up_lpg">Upload LPG</a></li>
						<li><a href="?module=up_absensi">Upload Absensi</a></li>					
					</ul>
				</li>

				<li>
					<a>Master Data <span class="arrow"></span></a>
					<ul class="sub-menu">
						<li><a href="?module=master_kendaraan">Master Kendaraan</a></li>
						<li><a href="?module=master_lembaga">Master Lembaga</a></li>					
					</ul>
				</li>
				<?php } ?>
				<!----- END IT ZONE ---------------------------------->


			</ul>
		</div>