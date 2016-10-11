		<div class="hor-menu hidden-sm hidden-xs">
			<ul class="nav navbar-nav">
				<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
				
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "dashboard") { echo 'active' ; } ?>">
				<a href="?module=dashboard">Dashboard </a></li>

				<li class="classic-menu-dropdown <?php if($_GET['module'] == "data_customer" OR $_GET['module'] == "impor_unit" OR $_GET['module'] == "impor_customer") { echo 'active' ; } ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Customer <i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=data_customer">Data Customer</a></li>

						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager" ) { ?> 
						<li><a href="?module=impor_customer">Impor Customer</a></li>
						<?php } ?>

						<?php if($_SESSION['level'] == "admin" OR $_SESSION['level'] == "manager") { ?>
						<li><a href="?module=impor_unit">Impor Lintas Divisi</a></li>
						<?php } ?>
					</ul>
				</li>
				
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "gathering") { echo 'active' ; } ?>">
				<a href="?module=gathering">Gathering </a></li>

				<?php if($_SESSION['level'] != "sales" ) { ?> 
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "database") { echo 'active' ; } ?>">
				<a href="?module=database">Database </a></li>
				<?php } ?>
				
				<li class="classic-menu-dropdown  <?php if($_GET['module'] == "laporan") { echo 'active' ; } ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Laporan <i class="fa fa-angle-down"></i>
					</a>
					
					<?php if($_SESSION['level'] == "sales" ) { ?>  
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=laporan">Laporan Aktivitas</a></li>
						<?php if($_SESSION['sublevel'] == "unit" ) { ?>
						<li><a href="?module=laporan&act=prospek">Laporan Prospek</a></li>
						<?php }  ?>
					</ul>

					<?php } elseif ($_SESSION['level'] == "manager" OR $_SESSION['level'] == "admin" OR $_SESSION['level'] == "supervisor" )  { ?>
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=laporan&act=kdp">Laporan KDP</a></li>
						<li><a href="?module=laporan&act=its">Laporan ITS</a></li>
						<li><a href="?module=laporan&act=database">Laporan Database</a></li>
						<li><a href="?module=laporan&act=asal_prospek">Laporan Asal Prospek</a></li>
					</ul>
					<?php } ?>
				</li>

				<?php if($_SESSION['level'] == "admin" ) { ?>
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "master")  { echo 'active' ; } ?>">
					
					<a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">
						Master Data <i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu pull-left">						
						<li><a href="?module=master&act=kendaraan">Master Kendaraan</a></li>
						<li><a href="?module=master&act=lembaga">Master Lembaga</a></li>
					</ul>
				</li>
				<?php } ?>

				<?php if($_SESSION['level'] == "admin" ) { ?> 
				<li class="classic-menu-dropdown <?php if($_GET['module'] == "user") { echo 'active' ; } ?>">
				<a href="?module=user">User </a></li>
				<?php } ?>

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

				
				<!----- BEGIN IT ZONE ---------------------------------->
		
			</ul>
		</div>