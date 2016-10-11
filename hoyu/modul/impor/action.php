<?php
session_start();

include_once('../../../koneksi.php');

if(isset($_POST['impor_divisi'])){

mysql_query("UPDATE tb_pelanggan SET salesman = '$_POST[t_sales]' WHERE id_pelanggan IN (".implode(',', $_POST['users']).")");

$from = $_POST['f_sales'] ;
$to = $_POST['t_sales'] ;
$data =  $_POST['users'] ;

foreach($data as $id_pelanggan){
	mysql_query("INSERT INTO tb_import (id_import,data_import,from_salesman,to_salesman,import_by,import_time,import_date) VALUES('','$id_pelanggan','$from','$to','$_SESSION[username]',NOW(),NOW())");
}

header("Location:../../dashboard.php?module=impor_divisi&notif=1");

} elseif (isset($_POST['impor_lintas'])) {

if ($_POST['divisi'] == 'unit') {
	mysql_query("UPDATE tb_pelanggan SET salespart = '$_POST[salespart]', salesserv = '$_POST[salesserv]' WHERE id_pelanggan IN (".implode(',', $_POST['users']).")");
} elseif ($_POST['divisi'] == 'service') {
	mysql_query("UPDATE tb_pelanggan SET salesman = '$_POST[t_sales]', salespart = '$_POST[salespart]' WHERE id_pelanggan IN (".implode(',', $_POST['users']).")");
} elseif($_POST['divisi'] == 'part') {
	mysql_query("UPDATE tb_pelanggan SET salesman = '$_POST[t_sales]', salesserv = '$_POST[salesserv]' WHERE id_pelanggan IN (".implode(',', $_POST['users']).")");
}


header("Location:../../dashboard.php?module=impor_lintas&notif=1");

}

?>