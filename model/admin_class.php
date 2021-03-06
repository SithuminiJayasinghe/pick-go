<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include '../model/db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM systemusers where email = '".$email."' and password = '".md5($password)."'  ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../view/login.php");
	}	

	function save_parcel(){
		extract($_POST);
		// foreach($price as $k => $v){
			$data = "";
			foreach($_POST as $key => $val){
				if(!in_array($key, array('id')) && !is_numeric($key)){
					if(empty($data)){
						$data .= " $key='$val' ";
					}else{
						$data .= ", $key='$val' ";
					}
				}
			}
			// echo($data);
			// if(!isset($type)){
			// 	$data .= ", type='2' ";
			// }
				// $data .= ", height='{$height[$k]}' ";
				// $data .= ", width='{$width[$k]}' ";
				// $data .= ", length='{$length[$k]}' ";
				// $data .= ", weight='{$weight[$k]}' ";
				// $price[$k] = str_replace(',', '', $price[$k]);
				// $data .= ", price='{$price[$k]}' ";
			if(empty($id)){
				$i = 0;
				while($i == 0){
					$ref = sprintf("%'012d",mt_rand(0, 999999999999));
					$chk = $this->db->query("SELECT * FROM goods where reference_number = '$ref'")->num_rows;
					if($chk <= 0){
						$i = 1;
					}
				}
				$data .= ", reference_number='$ref' ";
				if($save[] = $this->db->query("INSERT INTO goods set $data"))
					$ids[]= $this->db->insert_id;
					
			}else{
				if($save[] = $this->db->query("UPDATE goods set $data where id = $id"))
					$ids[] = $id;
			}
		// }
		if(isset($save) && isset($ids)){
			// return json_encode(array('ids'=>$ids,'status'=>1));
			return 1;
		}
	}

	function update_parcel(){
		extract($_POST);
		$data = "";
		foreach($_POST as $key => $val){
			if(!in_array($key, array('id')) && !is_numeric($key)){
				if(empty($data)){
					$data .= " $key='$val' ";
				}else{
					$data .= ", $key='$val' ";
				}
			}
		}
		
		if($save[] = $this->db->query("UPDATE goods set $data where good_id = $id"))
					$ids[] = $id;
		
		if(isset($save) && isset($ids)){
			// return json_encode(array('ids'=>$ids,'status'=>1));
			return 1;
		}
	}

	function get_distance(){
			extract($_POST);
			$data = array();
			$parcel = $this->db->query("select * from distance_matrix where city_1 = $city_a and city_2 = $city_b ");

			if($parcel->num_rows > 0){
				while($row = $parcel->fetch_assoc()){
					$data[] = $row;
				}
			}else{

				$parcel2 = $this->db->query("select * from distance_matrix where city_2 = $city_a and city_1 = $city_b ");
				if($parcel2->num_rows > 0){
					while($row = $parcel2->fetch_assoc()){
						$data[] = $row;
					}
				}
			}	
			
			return json_encode($data);
			

	}

	function get_parcel_heistory(){
		
		extract($_POST);
		$data = array();
		$parcel = $this->db->query("SELECT * FROM goods where reference_number = '$ref_no'");
		if($parcel->num_rows <=0){
			return 2;
		}else{
			$parcel = $parcel->fetch_array();
			$data[] = array('status'=>'Item accepted by Courier','date_created'=>date("M d, Y h:i A",strtotime($parcel['date_created'])));
			$history = $this->db->query("SELECT * FROM goods_tracks where good_id = {$parcel['id']}");
			$status_arr = array("Item Accepted by Courier","Collected","Shipped","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","Unsuccessfull Delivery Attempt");
			while($row = $history->fetch_assoc()){
				$row['date_created'] = date("M d, Y h:i A",strtotime($row['date_created']));
				$row['status'] = $status_arr[$row['status']];
				$data[] = $row;
			}
			return json_encode($data);
		}
	}


}