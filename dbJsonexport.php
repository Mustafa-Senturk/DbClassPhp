<?php
require_once('dbClass.php');
$tablo 	= $_GET['t'];
$id 	= @$_GET['id'];
$cikti = $dbSorgula->co($tablo);
header("Content-type: application/json; charset=utf-8");
print_r(json_encode($cikti));
?>