<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];
include '../model/admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}


ob_end_flush();
?>
