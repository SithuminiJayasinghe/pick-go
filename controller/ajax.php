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
if($action == 'update_parcel'){
	$save = $crud->update_parcel();
	if($save)
		echo $save;
}
if($action == 'update_status'){
	$save = $crud->update_status();
	if($save)
		echo $save;
}
ob_end_flush();
?>
