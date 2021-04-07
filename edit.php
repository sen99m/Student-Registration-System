<?php
include("includes/header.php");
include("config.php");
$row_id = $_GET['id'];

$sql = "SELECT * FROM student_info_master WHERE sid=".$row_id;
if (mysqli_query($conn, $sql)) {
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($result);
	/*echo " ".$data['fname']." ".$data['mname']." ".$data['lname']." ".$data['dob']." ".$data['gender']." ".$data['mobilenumber']." ".$data['email']." ".$data['address']." ".$data['district']." ".$data['subject'];*/
} else {
	 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 
$sql_dm = "SELECT * FROM district_master order by dname asc";
$result_dm = mysqli_query($conn, $sql_dm);
$sql_sm = "SELECT * FROM subject_master order by sub_name asc";
$result_sm = mysqli_query($conn, $sql_sm);
?>
<div class="container">

    <h2>Student Registration Form</h2>
    
    <form method="post" action="postedit.php">
    
    <input type="hidden" name="user_id" value="<?= $row_id ?>">
        <div class="form-container">
            <div class="name">
                <label>First Name</label>
                <input type="text" name="firstname" value="<?= $data['fname'] ?>">
            </div>
            <div class="name">
                <label>Middle Name</label>
                <input type="text" name="middlename" value="<?= $data['mname'] ?>">
            </div>
            <div class="name">
                <label>Last Name</label>
                <input type="text" name="lastname" value="<?= $data['lname'] ?>">
            </div>
            <div class="name">
                <label>Email</label>
                <input type="email" name="emailaddress" value="<?= $data['email'] ?>">
            </div>
            <div class="name">
                <label>Contact No</label>
                <input type="text" name="contactno" value="<?= $data['mobilenumber'] ?>">
            </div>
        	<!--DOB-->	
            <div class="name">
                <label>DOB</label>
                <input type="date" name="myDate" value="<?= $data['dob'] ?>" class="date">
            </div>
        
            <div class="name">
            	<label>Subject</label>
                <select name="subject_id">
                    <option value="">Select</option>
                    <?php
					if( mysqli_num_rows($result_sm) > 0){
						while($data2 = mysqli_fetch_assoc($result_sm)){	
						?>
                    		<option value="<?= $data2['subid']?>" <?= ($data['subject']==$data2['subid'])? "selected" : ''?>><?= $data2['sub_name'] ?></option>
                            
                        <?php
						}
					}
					?>
                </select>
            </div>
            <div class="gender">
                <label class="title">Gender</label>
                <label>Male </label>
                <input type="radio" name="gender" value="M" <?= ($data['gender']=='M') ? 'checked' : '' ?> /> 
                <label>Female </label>
                <input type="radio" name="gender" value="F" <?= ($data['gender']=='F') ? 'checked' : '' ?> />
                <label>Others </label>
                <input type="radio" name="gender" value="O" <?= ($data['gender']=='O') ? 'checked' : '' ?> />
            </div>
        
            
        
            <div class="address">
                <label>Address</label>
                <textarea title="Full address" name="fulladdress" value="<?= $data['address'] ?>"></textarea>
            </div> 
            <div class="name">
            	<label>District</label>
                <select name="district_id">
                    <option value="">Select</option>
                    <?php
					if( mysqli_num_rows($result_dm) > 0){
						while($data1 = mysqli_fetch_assoc($result_dm)){	
						?>
                    		<option value="<?= $data1['did']?>" <?= ($data['district']==$data1['did'])? "selected" : ''?>><?= $data1['dname'] ?></option>
                            
                        <?php
						}
					}
					?>
                    
                   
                </select>
            </div>
			
            <div class="subject">
            	<input type="submit" name="login" value="Update">
            </div>
            
        </div>
    </form>
</div>
<?php
include("includes/footer.php");
?>

