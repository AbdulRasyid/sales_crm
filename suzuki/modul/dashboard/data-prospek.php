<?php
ob_start();
session_start();
#Basic Line
require 'connection.php';

$result = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = '$_SESSION[username]'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln = array();
$bln['name'] = 'Interval Periode 1 Tahun';
$rows['name'] = 'Total Penjualan';
while ($r = mysql_fetch_array($result)) {
    $bln['data'][] = $r['month_do'];
    $rows['data'][] = $r['total_do'];
}


$rslt = array();
array_push($rslt, $bln);
array_push($rslt, $rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);

