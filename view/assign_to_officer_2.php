<?php
include '../model/db_connect.php';
$qry = $conn->query("SELECT * FROM goods where good_id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'assign_to_officer_3.php';
?>