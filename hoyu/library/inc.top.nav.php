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

						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager") { ?>
						<li><a href="?module=impor_lintas">Impor Lintas Divisi</a></li>
						<?php } ?>
					</ul>
				</li>
				
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "user") { echo 'active' ; } ?>">
				<a href="?module=user">User </a></li>
				
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "laporan") { echo 'active' ; } ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Laporan <i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu pull-left">				
						<li><a href="?module=laporan">Laporan Aktivitas</a></li>
						<li><a href="?module=laporan&act=prospek">Laporan Prospek</a></li>
						<li><a href="?module=laporan&act=join_visit">Laporan Join Visit</a></li>				
						<li><a href="?module=laporan&act=monitor">Laporan Sales Monitoring</a></li>
						<li><a href="?module=laporan&act=kpi">Laporan KPI Insentif</a></li>
					</ul>

				</li>
		
			</ul>
		</div>