<?php
// mysql settings
$server = "192.168.254.116";
$username = "administrator";
$password = "Dutac3m3";
$database = "db_sales";

//$basepath = "http://localhost/salesCRM/"; 
//$basepath = "http://salescrm.dutacemerlang.co.id/SalesCRM/";

// Koneksi dan memilih database di server
$db = mysql_connect($server, $username, $password) or die("Koneksi gagal");
mysql_select_db($database, $db) or die("Database tidak bisa dibuka");

?>
