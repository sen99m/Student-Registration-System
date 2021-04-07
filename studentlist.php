<?php 
include("config.php");

// $sql = "SELECT * ,YEAR(CURDATE())-YEAR(DOB) AS age FROM student_info_master";

// $sql = "SELECT * FROM student_info_master where district = 10 order by dob asc limit 1, 2";

//$sql = "SELECT * FROM student_info_master where district = 10 order by dob asc";
//$sql = "SELECT * FROM (student_info_master s (INNER JOIN district_master d ON d.did = s.district)INNER JOIN subject_master su ON  su.sub_id = s.subject)";


// $sql="SELECT * FROM student_info_master LEFT JOIN district_master ON district_master.did = student_info_master.district LEFT JOIN subject_master ON subject_master.subid = student_info_master.subject where gender = '".$_REQUEST['gender']."' and subject in (".$_REQUEST['subid'].") order by dob";

if(!empty($_REQUEST['gender'])){
	if(!empty($_REQUEST['subid'])){
		$sql="SELECT * FROM student_info_master LEFT JOIN district_master ON district_master.did = student_info_master.district LEFT JOIN subject_master ON subject_master.subid = student_info_master.subject where gender = '".$_REQUEST['gender']."' and subject = '".$_REQUEST['subid']."' order by dob";
	}else{
		$sql="SELECT * FROM student_info_master LEFT JOIN district_master ON district_master.did = student_info_master.district LEFT JOIN subject_master ON subject_master.subid = student_info_master.subject where gender = '".$_REQUEST['gender']."' order by dob";
	}
}else{
	$sql="SELECT * FROM student_info_master LEFT JOIN district_master ON district_master.did = student_info_master.district LEFT JOIN subject_master ON subject_master.subid = student_info_master.subject order by dob";
}
$result = mysqli_query($conn, $sql);

// echo $data = mysqli_num_rows($result); die;

// $data = mysqli_fetch_assoc($result);


?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Student List</title>            
	</head>
	<body>
    <ul>
    	<li><a href="Studentlist.php">All</a></li>
        <li><a href="Studentlist.php?gender=M">Male</a></li>
        <li><a href="Studentlist.php?gender=F">Female</a></li>
   </ul>
		<table width="100%">
        	<caption><h3>STUDENT LIST</h3></caption>
                <tr>
                    <th>SID</th>
                    <th>NAME</th>
                    <th>DOB</th>
                    <th>GENDER</th>
                    <th>MOBILE NO</th>
                    <th>EMAIL</th>
                    <th>ADDRESS</th>
                    <th>DISTRICT</th>
                    <th>SUBJECT</th>
                    <th>AGE(Year)</th>
                    <th>EDIT</th>
                </tr>
                <?php
				$count = 0;
				if( mysqli_num_rows($result) > 0){
					while($data = mysqli_fetch_assoc($result)){	
						$count++;
						if(empty($data['mname'])){
							$fullname = $data['fname'].' '.$data['lname'];
						}else{
							$fullname = $data['fname'].' '.$data['mname'].' '.$data['lname'];;
						}
						
						if($data['gender'] == 'F'){
							$gender = 'Female';
						}else if($data['gender'] == 'M'){
							$gender = 'Male';
						}
						else if($data['gender'] == 'O'){
							$gender = 'Others';
						}
						else{
							$gender = 'Not Selected';
						}
							
						/*if($data['subject'] == 5){
							$subject = 'Bengali';
						}
						elseif($data['subject'] == 6){
							$subject = 'English';
						}
						elseif($data['subject'] == 7){
							$subject = 'Mathematics';
						}
						elseif($data['subject'] == 8){
							$subject = 'Geography';
						}
						elseif($data['subject'] == 9){
							$subject = 'History';
						}
						elseif($data['subject'] == 10){
							$subject = 'Life Sc.';
						}else{
							$subject="Not Available";
						}*/
												 
						$from = new DateTime($data['dob']);
						$to   = new DateTime('today');
						$age = $from->diff($to)->y;	
						//$district = $data['dname'];									
												
					?>
					<tr>
						<td align="center"><?php echo $count;?></td>
                        <td align="center"><?php echo ucfirst($fullname); ?></td>                        
						<td align="center"><?php echo date("d/m/Y", strtotime($data['dob']));?></td>
						<td align="center"><?php echo $gender;?></td>
						<td align="center"><?php echo $data['mobilenumber'];?></td>
						<td align="center"><?php echo $data['email'];?></td>
						<td align="center"><?php echo $data['address'];?></td>
						<td align="center"><?php echo $data['dname'];?></td>
						<td align="center"><?php echo $data['sub_name'];?></td>
                        <td align="center"><?php echo $age;?></td>
                        <td><a href="edit.php?id=<?= $data['sid'] ?>">edit</a></td>
					</tr>
					<?php
					}
				}else{
				?>
                <tr>
                	<td colspan="11">No data found</td>
				</tr>
                <?php
				}
				?>
		</table>
	</body>
</html>







