<?php
ob_start();
$dbserver="localhost";
$dbusername="root";
$dbpswd="";
$dbname="uploadddtmhs";
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_connect($dbserver,$dbusername,$dbpswd) or die("koneksi gagal");
mysql_select_db($dbname) or die("gagal ke db");
?>