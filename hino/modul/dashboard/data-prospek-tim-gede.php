<?php
ob_start();
session_start();
#Basic Line
require 'connection.php';

$r_candra = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'candra.prastianto'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln1 = array();
$bln1['name'] = 'Interval Periode 1 Tahun';
$candra['name'] = 'Candra';
while ($r = mysql_fetch_array($r_candra)) {
    $bln1['data'][] = $r['month_do'];
    $candra['data'][] = $r['total_do'];
}

$r_robby = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'robby.handoko'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln2 = array();
$bln2['name'] = 'Interval Periode 1 Tahun';
$robby['name'] = 'Robby';
while ($r = mysql_fetch_array($r_robby)) {
    $bln2['data'][] = $r['month_do'];
    $robby['data'][] = $r['total_do'];
}

$r_paulus = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'paulus.jatmiko'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln3 = array();
$bln3['name'] = 'Interval Periode 1 Tahun';
$paulus['name'] = 'Paulus';
while ($r = mysql_fetch_array($r_paulus)) {
    $bln3['data'][] = $r['month_do'];
    $paulus['data'][] = $r['total_do'];
}

$r_adrianto = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'adrianto.ismawan'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln4 = array();
$bln4['name'] = 'Interval Periode 1 Tahun';
$adrianto['name'] = 'Adrianto';
while ($r = mysql_fetch_array($r_adrianto)) {
    $bln4['data'][] = $r['month_do'];
    $adrianto['data'][] = $r['total_do'];
}



$rslt = array();
array_push($rslt, $bln1);
array_push($rslt, $candra);
array_push($rslt, $robby);
array_push($rslt, $paulus);
array_push($rslt, $adrianto);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);

