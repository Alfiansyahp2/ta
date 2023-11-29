<?php

	session_start();
	
	if (!isset($_SESSION["keranjang"])) {
		$_SESSION["keranjang"] = array();
	}

	$keranjang = $_SESSION["keranjang"];
	$id_kue = $_POST["id_kue"];
	$value = $_POST["value"];
	
	if (!is_numeric($value)) {
		exit;
	}

	if($value > 0){
		$keranjang[$id_kue]["qty"] = $value;
	}else{
		if (isset($keranjang[$id_kue])) {
			unset($keranjang[$id_kue]);
		}
	}

	$_SESSION["keranjang"] = $keranjang;

	var_dump($keranjang, $id_kue, $value);
?>