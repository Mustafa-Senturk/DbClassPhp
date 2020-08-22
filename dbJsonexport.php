<?php
require_once('dbClass.php');
$tablo 	= $_GET['t'];
$id 	= @$_GET['id'];
$token  = @$_GET['token'];
$key = 	'1q2w3e';
if($key == $token && isset($_GET['token']) ){
	$cikti = $dbSorgula->co($tablo);
	header('Access-Control-Allow-Origin: *');
	header("Content-type: application/json; charset=utf-8");
	echo json_encode($cikti);
}else{
	header('HTTP/1.1 400 Not Found');
	echo 'lütfen Parametrelerinizi kontrol edin !...';
}


?>
