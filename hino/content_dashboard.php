<?php

include "library/inc.koneksi.php";    
include "library/fungsi_hierarki.php";
include "library/fungsi_indotgl.php";


 /* show hierarki */
$tingkat = $_SESSION[id]; //level hierarchy
$str = hierarki($tingkat,""); //get hierarchy function
$str_all = hierarki_all($tingkat,""); //get hierarchy function
$get_child_users = substr($str,1);
$get_child_users_all = substr($str_all,1);

$inUsers = "'".$_SESSION[username]. "'" . $str; // show hierarchy function
/* close hierarki */

// Bagian Home
if ($_GET['module']=='dashboard'){
  
include "modul/dashboard/dashboard.php";
 
}

elseif ($_GET['module']=='data_customer'){
    include "modul/customer/data_customer.php";  
}

elseif ($_GET['module']=='impor_customer'){
    include "modul/customer/impor_customer.php";  
}

elseif ($_GET['module']=='impor_unit'){
    include "modul/customer/impor_unit.php";  
}

elseif ($_GET['module']=='aktivitas'){
    include "modul/aktivitas/aktivitas.php";  
}

elseif ($_GET['module']=='prospek'){
    include "modul/prospek/prospek.php";  
}

elseif ($_GET['module']=='gathering'){
    include "modul/gathering/gathering.php";  
}

elseif ($_GET['module']=='r_aktivitas'){
    include "modul/plan/aktivitas.php";  
}

elseif ($_GET['module']=='database'){
   if ($_SESSION[level] != 'sales') {
        include "modul/database/database.php";
     }
    else {
        include "404.php";
    }
}

elseif ($_GET['module']=='user'){
   if ($_SESSION[level] == 'manager' OR $_SESSION[level] == 'admin') {
        include "modul/user/user.php";
     }
    else {
        include "404.php";
    }
}

elseif ($_GET['module']=='m_lembaga'){
    include "modul/master/m_lembaga.php";
}

elseif ($_GET['module']=='laporan'){
    include "modul/laporan/laporan.php"; 
}

elseif ($_GET['module']=='impor_divisi'){
    include "modul/impor/divisi.php";  
}

elseif ($_GET['module']=='impor_lintas'){
    include "modul/impor/lintas.php";  
}

elseif ($_GET['module']=='customers'){
    include "modul/mod_customers/customers.php";
	
	       if ($_SESSION[leveluser] == 'sales' AND $_SESSION[subleveluser] == 'unit' ) {
				$query = mysql_query("SELECT * FROM tb_pelanggan 
								  JOIN ms_users ON ms_users.username = tb_pelanggan.salesman
								  WHERE tb_pelanggan.id_pelanggan = '$_GET[id]'
								  AND tb_pelanggan.salesman = '$_SESSION[namauser]'");
			}
            elseif ( $_SESSION[leveluser] == 'sales' AND $_SESSION[subleveluser] == 'part' ){
                $query = mysql_query("SELECT * FROM tb_pelanggan 
								  JOIN ms_users ON ms_users.username = tb_pelanggan.salesman
								  WHERE tb_pelanggan.id_pelanggan = '$_GET[id]'");
            }
			else {
				$query = mysql_query("SELECT * FROM tb_pelanggan 
								  JOIN ms_users ON ms_users.username = tb_pelanggan.salesman
								  WHERE tb_pelanggan.id_pelanggan = '$_GET[id]'
								  AND tb_pelanggan.salesman IN ($inUsers)");
			}
			$r = mysql_num_rows($query);
	if ($r == 1) {
	   if ( $_SESSION[leveluser] == 'sales' AND $_SESSION[subleveluser] == 'part' ){
	       include "modul/mod_daily_activity/partdaily.php";
		   include "modul/mod_prospect/partprospect.php";
        }
        else {
		   include "modul/mod_daily_activity/table_daily.php";
		   include "modul/mod_prospect/table_prospect.php";
        }
	} // close if ($r==1)
			else {
				echo "";
	}
}
elseif ($_GET['module']=='lembaga'){
    include "modul/mod_lembaga/lembaga.php";
}
elseif ($_GET['module']=='kendaraan'){
    include "modul/mod_settings/kendaraan.php";
}

elseif ($_GET['module']=='laporan'){
    include "modul/mod_laporan/laporan.php";
}
elseif ($_GET['module']=='impor'){
     if ($_SESSION[leveluser] != 'sales') {
        include "modul/mod_impor/impor.php";
     }
    else {
        include "404.php";
    }
}
elseif ($_GET['module']=='birt'){
    if ($_SESSION[leveluser] == 'it') {
        include "modul/mod_birt/birt.php";
    }
    else {
        include "404.php";
    }
}
elseif ($_GET['module']=='settings'){
         if ($_SESSION[leveluser] == 'it' OR $_SESSION[leveluser] == 'admin' OR $_SESSION[leveluser] == 'manager') {
            include "modul/mod_settings/settings.php";
         }
         else {
            include "404.php";
        }
}
elseif ($_GET['module']=='hobi'){
        if ($_SESSION[leveluser] == 'it' OR $_SESSION[leveluser] == 'admin' OR $_SESSION[leveluser] == 'manager') {
            include "modul/mod_hobi/hobi.php";
         }
         else {
            include "404.php";
        }
}
elseif ($_GET['module']=='gathering'){
    //if ($_SESSION[leveluser] == 'it' OR $_SESSION[leveluser] == 'admin') {
            include "modul/mod_gathering/gathering.php";
      /*      }
         else {
            include "404.php";
        }*/
 
}

elseif ($_GET['module']=='rpt'){
            include "laporan/Laporan_SPKsmry.php";
}
elseif ($_GET['module']=='log_customers'){
            include "modul/mod_log/edit_customer_log.php";
}

elseif ($_GET['module']=='polreg'){
  if ($_SESSION[leveluser] == 'it'){
          echo "<iframe src='http://salescrm.dutacemerlang.co.id/SalesCRM/upload_polreg/' width='100%' height='600'></iframe>";
 }
}

elseif ($_GET['module']=='upload_k3'){
  if ($_SESSION[leveluser] == 'admin' && $_SESSION[divisi] == 'hino3'){
          echo "<iframe src='http://salescrm.dutacemerlang.co.id/SalesCRM/upload_kat_3/' width='100%' height='600'></iframe>";
 }
}

elseif ($_GET['module']=='absensi'){
  if ($_SESSION[leveluser] == 'it'){
          echo "<iframe src='http://salescrm.dutacemerlang.co.id/SalesCRM/upload_absensi/' width='100%' height='600'></iframe>";
 }
}

elseif ($_GET['module']=='best'){
         if ($_SESSION[leveluser] == 'it' || $_SESSION[namauser] == 'chris.hemasurya' || $_SESSION[namauser] == 'dwi.suradi') {
            include "modul/mod_best/best.php";
         }
         else {
            include "404.php";
        }
}

// Apabila modul tidak ditemukan
else{
   include "404.php";
}
?>
