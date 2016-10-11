<?php
ob_start();
session_start();
#Basic Line
require 'connection.php';

$r_ria = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'ria.puspitasari'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln1 = array();
$bln1['name'] = 'Interval Periode 1 Tahun';
$ria['name'] = 'Ria';
while ($r = mysql_fetch_array($r_ria)) {
    $bln1['data'][] = $r['month_do'];
    $ria['data'][] = $r['total_do'];
}

$r_alexander = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'alexander.pratomo'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln2 = array();
$bln2['name'] = 'Interval Periode 1 Tahun';
$alexander['name'] = 'Alexander';
while ($r = mysql_fetch_array($r_alexander)) {
    $bln2['data'][] = $r['month_do'];
    $alexander['data'][] = $r['total_do'];
}

$r_dedy = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'dedy.nuryanto'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln3 = array();
$bln3['name'] = 'Interval Periode 1 Tahun';
$dedy['name'] = 'Dedy';
while ($r = mysql_fetch_array($r_dedy)) {
    $bln3['data'][] = $r['month_do'];
    $dedy['data'][] = $r['total_do'];
}

$r_benny = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'beny.himawan'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln4 = array();
$bln4['name'] = 'Interval Periode 1 Tahun';
$benny['name'] = 'Benny';
while ($r = mysql_fetch_array($r_benny)) {
    $bln4['data'][] = $r['month_do'];
    $benny['data'][] = $r['total_do'];
}

$r_nurul = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'nurul.chasanah'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln5 = array();
$bln5['name'] = 'Interval Periode 1 Tahun';
$nurul['name'] = 'Dedy';
while ($r = mysql_fetch_array($r_nurul)) {
    $bln5['data'][] = $r['month_do'];
    $nurul['data'][] = $r['total_do'];
}

$r_chuswatun = mysql_query("SELECT db_date, DATE_FORMAT(db_date, '%b %y') as month_do, IFNULL(SUM(jml_kendaraan),0) AS total_do
					   FROM	time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor, tgl_do, jml_kendaraan 
					   			  FROM v_unit_dashboard_sales_prospek
					   			  WHERE status_prospek LIKE '%DO%' AND salesman = 'chuswatun'
					   			  AND YEAR (tgl_do) = YEAR (NOW())) b 
					   		ON b.tgl_do=a.db_date
					   WHERE YEAR(db_date) = YEAR(NOW())
					   AND db_date < NOW()
					   GROUP BY	MONTH (db_date)
					   ORDER BY	db_date ASC");
$bln6 = array();
$bln6['name'] = 'Interval Periode 1 Tahun';
$chuswatun['name'] = 'Chuswatun';
while ($r = mysql_fetch_array($r_chuswatun)) {
    $bln6['data'][] = $r['month_do'];
    $chuswatun['data'][] = $r['total_do'];
}



$rslt = array();
array_push($rslt, $bln1);
array_push($rslt, $ria);
array_push($rslt, $alexander);
array_push($rslt, $dedy);
array_push($rslt, $benny);
array_push($rslt, $nurul);
array_push($rslt, $chuswatun);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);

