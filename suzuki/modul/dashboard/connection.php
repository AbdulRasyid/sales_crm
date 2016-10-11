<?php
$con = mysql_connect("192.168.254.116","administrator","Dutac3m3");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("db_sales", $con);

?>
