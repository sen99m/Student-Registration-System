<?php
include('config.php');
$row_id = $_POST['user_id'];
if(isset($_POST) && !empty($_POST) && $_POST['login'] == 'Update'){
	//echo '<pre>'; print_r($_POST); die;
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
		 $sql = 'UPDATE student_info_master SET fname = "'.$_POST['firstname'].'" , mname = "'.$_POST['middlename'].'" , lname = "'.$lname.'" , dob = "'.$dob.'" , gender = "'.$_POST['gender'].'", mobilenumber = "'.$_POST['contactno'].'" , email = "'.$_POST['emailaddress'].'" , address = "'.$_POST['fulladdress'].'", district = "'.$_POST['district_id'].'", subject = "'.$_POST['subject_id'].'" WHERE sid='.$row_id;
         
	
		if (mysqli_query($conn, $sql)) {
			echo "Record updated successfully";
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