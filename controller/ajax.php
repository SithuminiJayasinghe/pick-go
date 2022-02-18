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
if($action == 'save_parcel'){
	$save = $crud->save_parcel();
	if($save)
		echo $save;
}
if($action == 'update_parcel'){
	$save = $crud->update_parcel();
	if($save)
		echo $save;
}
if($action == 'get_distance'){
	$get = $crud->get_distance();
	if($get)
		echo $get;
}
if($action == 'get_parcel_heistory'){
	$get = $crud->get_parcel_heistory();
	if($get)
		echo $get;
}


ob_end_flush();
?>
