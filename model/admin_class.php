<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
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

	function update_parcel(){
		extract($_POST);
		$update = $this->db->query("UPDATE goods set status_id= $status where good_id = $id");
		$save = $this->db->query("UPDATE goods_track set status_id= $status , goods_id = $id");
		if($update && $save)
			return 1;  
	}

	function update_status(){
		extract($_POST);

		$target_dir = "../assets/uploads/";
		$isReadytoUpload = 1;
		$image_upload_error_message = "";
		if(isset($_FILES['pic'])){
		  $file_name = $_FILES['pic']['name'];
		}
		$fileUploading = $target_dir . basename($_FILES["pic"]["name"]);
		$imageFileType = strtolower(pathinfo($fileUploading,PATHINFO_EXTENSION));
		// checking for already exicting files
		if (file_exists($fileUploading)) {
			$isReadytoUpload = 0;
			return 2;
		}
		// Only allow JPG, PNG and GIF image formats
		elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$image_upload_error_message = "";
			$isReadytoUpload = 0;
			return 3;
		}
		// Check if $isReadytoUpload is set to 0 by an error
		elseif ($isReadytoUpload == 0) {
			$image_upload_error_message = "Image uploading failed!";
			return 4;
		// if everything is ok, try to upload file
		} 
		else 
		{
			if (move_uploaded_file($_FILES["pic"]["tmp_name"], $fileUploading)) 
			{
				$update_original = $this->db->query("UPDATE goods SET status_id=0, receivers_photograph='$fileUploading' WHERE reference_number = $idno");
				if($update_original)
					return 1;
			} else {
				$image_upload_error_message = "There is some error in uploading your image";
				return 4;
			}
		} 	
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../view/login.php");
	}
	
}