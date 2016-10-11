<?php
ob_start();
session_start();
#Basic Line
require 'connection.php';

$result = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar, tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman,supervisor,aktivitas,tgl_aktivitas
					   			  FROM v_unit_dashboard_sales_activity
					   			  WHERE salesman = '$_SESSION[username]'
					   			  AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					   		ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY 
					   AND db_date < NOW() 
					   GROUP BY	db_date
					   ORDER BY	db_date ASC");

$tgl = array();
$tgl['name'] = 'Interval Periode 7 Hari';
$rows['name'] = 'Total Aktivitas';
while ($r = mysql_fetch_array($result)) {
    $tgl['data'][] = $r['calendar'];
    $rows['data'][] = $r['total_aktivitas'];
}


$rslt = array();
array_push($rslt, $tgl);
array_push($rslt, $rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);

