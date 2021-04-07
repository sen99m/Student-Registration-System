<?php
include('config.php');

if(isset($_POST) && !empty($_POST) && $_POST['login'] == 'Sign In'){
	//echo '<pre>'; print_r($_POST); die;
	
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	if ($_FILES["profile_pic"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["profile_pic"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	
	$error = 0;
	if(!empty($_POST['firstname']) && $_POST['firstname'] != ''){ 
		$fname = $_POST['firstname'];
	}else{
		$errormsg = 'Please Enter FirstName <a href="StudentRegistration.php">Back</a>';
		$error = 1;
	}
	/*if($_POST['middlename'] != ''){
		$mname = $_POST['middlename'];
	}else{
		$errormsg =  'Please Enter MiddleName <a href="StudentRegistration.php">Back</a>';
		$error = 1;
	}*/
	if($_POST['lastname'] != ''){
		 $lname = $_POST['lastname'];
	}else{
		$errormsg = 'Please Enter LastName <a href="StudentRegistration.php">Back</a>';
		$error = 1;
	}
	
	$dob = date("Y-m-d", strtotime($_POST['myDate']));
	// Validation end
	if($error == 0){	
         $sql = "INSERT INTO student_info_master (fname, mname, lname, dob, gender, mobilenumber, email, address, district,subject,profile_pic) VALUES ('".$_POST['firstname']."', '".$_POST['middlename']."' , '".$lname."' , '".$dob."', '".$_POST['gender']."' ,'".$_POST['contactno']."', '".$_POST['emailaddress']."' ,'".$_POST['fulladdress']."', '".$_POST['district_id']."' , '".$_POST['subject_id']."','".$_FILES["profile_pic"]["name"]."')";
	
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}else{
		echo $errormsg;
	}
}else{
	echo 'Please re-submit <a href="StudentRegistration.php">Back</a>';
}

?>