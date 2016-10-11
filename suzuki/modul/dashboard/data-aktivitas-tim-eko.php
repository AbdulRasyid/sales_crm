<?php
ob_start();
session_start();
#Basic Line
require 'connection.php';


$r_diana = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'diana.sari'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl1 = array();
$tgl1['name'] = 'Interval Periode 7 Hari';
$diana['name'] = 'Diana';
while ($r = mysql_fetch_array($r_diana)) {
    $tgl['data'][] = $r['calendar'];
    $diana['data'][] = $r['total_aktivitas'];
}

$r_rendy = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'rendy.aditama'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl2 = array();
$tgl2['name'] = 'Interval Periode 7 Hari';
$rendy['name'] = 'Rendy';
while ($r = mysql_fetch_array($r_rendy)) {
    $tgl2['data'][] = $r['calendar'];
    $rendy['data'][] = $r['total_aktivitas'];
}

$r_indra = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'indra.setiawan'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl3 = array();
$tgl3['name'] = 'Interval Periode 7 Hari';
$indra['name'] = 'Indra';
while ($r = mysql_fetch_array($r_indra)) {
    $tgl3['data'][] = $r['calendar'];
    $indra['data'][] = $r['total_aktivitas'];
}

$r_dimas = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'dimas.raharjo'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl4 = array();
$tgl4['name'] = 'Interval Periode 7 Hari';
$dimas['name'] = 'Dimas';
while ($r = mysql_fetch_array($r_dimas)) {
    $tgl4['data'][] = $r['calendar'];
    $dimas['data'][] = $r['total_aktivitas'];
}

$r_wahyu = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'wahyu.rintayadi'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl5 = array();
$tgl5['name'] = 'Interval Periode 7 Hari';
$wahyu['name'] = 'Wahyu';
while ($r = mysql_fetch_array($r_wahyu)) {
    $tgl5['data'][] = $r['calendar'];
    $wahyu['data'][] = $r['total_aktivitas'];
}

$r_purwanto = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'purwanto.joko'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl6 = array();
$tgl6['name'] = 'Interval Periode 7 Hari';
$purwanto['name'] = 'Purwanto';
while ($r = mysql_fetch_array($r_purwanto)) {
    $tgl6['data'][] = $r['calendar'];
    $purwanto['data'][] = $r['total_aktivitas'];
}

$r_faiza = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'faiza.putri'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl7 = array();
$tgl7['name'] = 'Interval Periode 7 Hari';
$faiza['name'] = 'Faiza';
while ($r = mysql_fetch_array($r_faiza)) {
    $tgl7['data'][] = $r['calendar'];
    $faiza['data'][] = $r['total_aktivitas'];
}

$r_alfonus = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'alfonsus.loekito'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl8 = array();
$tgl8['name'] = 'Interval Periode 7 Hari';
$alfonus['name'] = 'Alfonus';
while ($r = mysql_fetch_array($r_alfonus)) {
    $tgl8['data'][] = $r['calendar'];
    $alfonus['data'][] = $r['total_aktivitas'];
}

$r_titus = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'titus.andiyanto'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl9 = array();
$tgl9['name'] = 'Interval Periode 7 Hari';
$titus['name'] = 'Titus';
while ($r = mysql_fetch_array($r_titus)) {
    $tgl9['data'][] = $r['calendar'];
    $titus['data'][] = $r['total_aktivitas'];
}

$r_choirul = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'choirul.anwar'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl10 = array();
$tgl10['name'] = 'Interval Periode 7 Hari';
$choirul['name'] = 'Choirul';
while ($r = mysql_fetch_array($r_choirul)) {
    $tgl10['data'][] = $r['calendar'];
    $choirul['data'][] = $r['total_aktivitas'];
}

$r_mega = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'mega.handoko'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl11 = array();
$tgl11['name'] = 'Interval Periode 7 Hari';
$mega['name'] = 'Mega';
while ($r = mysql_fetch_array($r_mega)) {
    $tgl11['data'][] = $r['calendar'];
    $mega['data'][] = $r['total_aktivitas'];
}

$r_hanifah = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'hanifah'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl12 = array();
$tgl12['name'] = 'Interval Periode 7 Hari';
$hanifah['name'] = 'Hanifah';
while ($r = mysql_fetch_array($r_hanifah)) {
    $tgl12['data'][] = $r['calendar'];
    $hanifah['data'][] = $r['total_aktivitas'];
}

$r_hanung = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'hanung.aryo'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl13 = array();
$tgl13['name'] = 'Interval Periode 7 Hari';
$hanung['name'] = 'Hanung';
while ($r = mysql_fetch_array($r_hanung)) {
    $tgl13['data'][] = $r['calendar'];
    $hanung['data'][] = $r['total_aktivitas'];
}

$r_heru = mysql_query("SELECT db_date,DATE_FORMAT(db_date, '%d-%b') as calendar,tgl_aktivitas,COUNT(aktivitas) AS total_aktivitas
					   FROM time_dimension a
					   LEFT JOIN (SELECT salesman, supervisor,	aktivitas,	tgl_aktivitas FROM	v_unit_dashboard_sales_activity
					   			  WHERE salesman = 'heru.hariyanto'	AND YEAR (tgl_aktivitas) = YEAR (NOW())) b
					        ON b.tgl_aktivitas=a.db_date
					   WHERE db_date > NOW() - INTERVAL 7 DAY AND db_date < NOW()
					   GROUP BY	db_date ORDER BY db_date ASC");

$tgl14 = array();
$tgl14['name'] = 'Interval Periode 7 Hari';
$heru['name'] = 'Heru';
while ($r = mysql_fetch_array($r_heru)) {
    $tgl14['data'][] = $r['calendar'];
    $heru['data'][] = $r['total_aktivitas'];
}



$rslt = array();
array_push($rslt, $tgl1);
array_push($rslt, $diana);
array_push($rslt, $rendy);
array_push($rslt, $indra);
array_push($rslt, $dimas);
array_push($rslt, $wahyu);
array_push($rslt, $purwanto);
array_push($rslt, $faiza);
array_push($rslt, $alfonus);
array_push($rslt, $titus);
array_push($rslt, $choirul);
array_push($rslt, $mega);
array_push($rslt, $hanifah);
array_push($rslt, $hanung);
array_push($rslt, $heru);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);

