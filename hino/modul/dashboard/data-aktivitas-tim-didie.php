<?php
ob_start();
session_start();
#Basic Line
require 'connection.php';


$r_ria = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'ria.puspitasari' AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl1 = array();
$tgl1['name'] = 'Interval Periode 7 Hari';
$ria['name'] = 'Ria';
while ($r = mysql_fetch_array($r_ria)) {
    $tgl1['data'][] = $r['calendar'];
    $ria['data'][] = $r['total_aktivitas'];
}

$r_alexander = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'alexander.pratomo'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl2 = array();
$tgl2['name'] = 'Interval Periode 7 Hari';
$alexander['name'] = 'alexander';
while ($r = mysql_fetch_array($r_alexander)) {
    $tgl2['data'][] = $r['calendar'];
    $alexander['data'][] = $r['total_aktivitas'];
}

$r_dedy = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'dedy.nuryanto'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl3 = array();
$tgl3['name'] = 'Interval Periode 7 Hari';
$dedy['name'] = 'Dedy';
while ($r = mysql_fetch_array($r_dedy)) {
    $tgl3['data'][] = $r['calendar'];
    $dedy['data'][] = $r['total_aktivitas'];
}

$r_benny = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'beny.himawan'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl4 = array();
$tgl4['name'] = 'Interval Periode 7 Hari';
$benny['name'] = 'Benny';
while ($r = mysql_fetch_array($r_benny)) {
    $tgl4['data'][] = $r['calendar'];
    $benny['data'][] = $r['total_aktivitas'];
}

$r_nurul = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'nurul.chasanah'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl5 = array();
$tgl5['name'] = 'Interval Periode 7 Hari';
$nurul['name'] = 'Nurul';
while ($r = mysql_fetch_array($r_nurul)) {
    $tgl5['data'][] = $r['calendar'];
    $nurul['data'][] = $r['total_aktivitas'];
}

$r_chuswatun = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'chuswatun'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl6 = array();
$tgl6['name'] = 'Interval Periode 7 Hari';
$chuswatun['name'] = 'Chuswatun';
while ($r = mysql_fetch_array($r_chuswatun)) {
    $tgl6['data'][] = $r['calendar'];
    $chuswatun['data'][] = $r['total_aktivitas'];
}




$rslt = array();
array_push($rslt, $tgl1);
array_push($rslt, $ria);
array_push($rslt, $alexander);
array_push($rslt, $dedy);
array_push($rslt, $benny);
array_push($rslt, $nurul);
array_push($rslt, $chuswatun);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);

