		<div class="hor-menu hidden-sm hidden-xs">
			<ul class="nav navbar-nav">
				<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
				
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "dashboard") { echo 'active' ; } ?>">
				<a href="?module=dashboard">Dashboard </a></li>

				<li class="classic-menu-dropdown <?php if($_GET['module'] == "data_customer" OR $_GET['module'] == "impor_lintas" OR $_GET['module'] == "impor_divisi") { echo 'active' ; } ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Customer <i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=data_customer">Data Customer</a></li>

						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager" ) { ?> 
						<li><a href="?module=impor_divisi">Impor Customer</a></li>
						<?php } ?>

						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager") { ?>
						<li><a href="?module=impor_lintas">Impor Lintas Divisi</a></li>
						<?php } ?>
					</ul>
				</li>
				
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "gathering") { echo 'active' ; } ?>">
				<a href="?module=gathering">Gathering </a></li>

				<?php if($_SESSION['level'] == "sales") { ?>
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "r_aktivitas") { echo 'active' ; } ?>">
				<a href="?module=r_aktivitas">Rencana Aktivitas </a></li>
				<?php } ?>

				<?php if($_SESSION['level'] != "sales" ) { ?> 
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "database") { echo 'active' ; } ?>">
				<a href="?module=database">Database </a></li>
				<?php } ?>

				<?php if($_SESSION['level'] == "admin" ) { ?> 
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "user") { echo 'active' ; } ?>">
				<a href="?module=user">User </a></li>
				<?php } ?>

				<?php if($_SESSION['level'] == "admin" ) { ?> 
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "log") { echo 'active' ; } ?>">
				<a href="?module=log">Log Customer </a></li>
				<?php } ?>
				
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "laporan") { echo 'active' ; } ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Laporan <i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu pull-left">
						
						<?php if($_SESSION['level'] == "sales") { ?>  					
						<li><a href="?module=laporan">Laporan Aktivitas</a></li>
						<li><a href="?module=laporan">Laporan Visit</a></li>
						<?php if($_SESSION['sublevel'] == "unit") { ?> 
						<li><a href="?module=laporan&act=prospek">Laporan Prospek</a></li>
						<?php } }  ?>	

						<?php if($_SESSION['level'] == "supervisor") { ?>  					
						<li><a href="?module=laporan">Laporan Aktivitas</a></li>
						<li><a href="?module=laporan">Laporan Visit</a></li>
						<?php if($_SESSION['sublevel'] == "unit") { ?> 
						<li><a href="?module=laporan&act=prospek">Laporan Prospek</a></li>
						<li><a href="?module=laporan&act=join_visit">Laporan Join Visit</a></li>
						<?php } }  ?>

					</ul>

					<?php if ($_SESSION['level'] == "manager" OR $_SESSION['level'] == "admin" )  { ?>
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=laporan&act=monitor">Laporan Sales Monitoring</a></li>
						<li><a href="?module=laporan&act=kpi">Laporan KPI Insentif</a></li>
					</ul>
					<?php } ?>
				</li>

				<!----- BEGIN IT ZONE ---------------------------------->

				<?php if($_SESSION['level'] == "it" ) { ?>
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "up_absensi" OR 
														  $_GET['module'] == "up_polreg" OR 
														  $_GET['module'] == "up_lpg") 

														  { echo 'active' ; } 
												  ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Upload <i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=up_polreg">Upload Polreg</a></li>
						<li><a href="?module=up_lpg">Upload Lpg</a></li>
						<li><a href="?module=up_absensi">Upload Absensi</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php if($_SESSION['level'] == "it" ) { ?>
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "master_kendaraan" OR 
														  $_GET['module'] == "master_lembaga" OR 
														  $_GET['module'] == "master_memo") 

														  { echo 'active' ; } 
												  ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Master Data <i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=master_kendaraan">Master Kendaraan</a></li>
						<li><a href="?module=master_lembaga">Master Lembaga</a></li>
						<li><a href="?module=master_memo">Master Memo</a></li>
					</ul>
				</li>
				<?php } ?>
				<!----- BEGIN IT ZONE ---------------------------------->
		
			</ul>
		</div>