<?php
ob_start();
session_start();
#Basic Line
require 'connection.php';


$r_candra = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'candra.prastianto'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl = array();
$tgl['name'] = 'Interval Periode 7 Hari';
$candra['name'] = 'Candra';
while ($r = mysql_fetch_array($r_candra)) {
    $tgl['data'][] = $r['calendar'];
    $candra['data'][] = $r['total_aktivitas'];
}

$r_robby = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'robby.handoko'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl2 = array();
$tgl2['name'] = 'Interval Periode 7 Hari';
$robby['name'] = 'Robby';
while ($r = mysql_fetch_array($r_robby)) {
    $tgl2['data'][] = $r['calendar'];
    $robby['data'][] = $r['total_aktivitas'];
}

$r_paulus = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'paulus.jatmiko'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl3 = array();
$tgl3['name'] = 'Interval Periode 7 Hari';
$paulus['name'] = 'Paulus';
while ($r = mysql_fetch_array($r_paulus)) {
    $tgl3['data'][] = $r['calendar'];
    $paulus['data'][] = $r['total_aktivitas'];
}

$r_adrianto = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'adrianto.ismawan'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl4 = array();
$tgl4['name'] = 'Interval Periode 7 Hari';
$adrianto['name'] = 'Adrianto';
while ($r = mysql_fetch_array($r_adrianto)) {
    $tgl4['data'][] = $r['calendar'];
    $adrianto['data'][] = $r['total_aktivitas'];
}





$rslt = array();
array_push($rslt, $tgl);
array_push($rslt, $candra);
array_push($rslt, $robby);
array_push($rslt, $paulus);
array_push($rslt, $adrianto);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);

