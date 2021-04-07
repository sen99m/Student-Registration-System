<?php
include("includes/header.php");
include("config.php");
$sql_dm = "SELECT * FROM district_master order by dname asc";
$result_dm = mysqli_query($conn, $sql_dm);
$sql_sm = "SELECT * FROM subject_master order by sub_name asc";
$result_sm = mysqli_query($conn, $sql_sm);
?>
<div class="container">

    <h2>Student Registration Form</h2>
    <!--reg.php-->
    	<form method="post" action="reg.php" id="myForm" onsubmit="submitClick()" enctype="multipart/form-data">
        <div class="form-container">
            <div class="name">
                <label>First Name</label>
                <input type="text" name="firstname" value="">
            </div>
            <div class="name">
                <label>Middle Name</label>
                <input type="text" name="middlename" value="">
            </div>
            <div class="name">
                <label>Last Name</label>
                <input type="text" name="lastname" value="">
            </div>
            <div class="name">
                <label>Email</label>
                <input type="text" name="emailaddress" value="">
            </div>
            <div class="name">
                <label>Contact No</label>
                <input type="text" name="contactno" value="">
            </div>
        	<!--DOB-->	
			<div class="name">
                <label>DOB</label>
                <input type="date" name="myDate" value="" class="date">
            </div>
        
            <div class="name">
            	<label>Subject</label>
                <select name="subject_id">
                    <option value="0">Select</option>
                    <?php
					if(mysqli_num_rows($result_sm) > 0){
						while($data2 = mysqli_fetch_assoc($result_sm)){
							?>
                            	<option value = "<?= $data2['subid'] ?>"><?= $data2['sub_name'] ?></option>
                            <?php
						}
					}
					?>
                </select>
            </div>
            <div class="gender">
                <label class="title">Gender</label>
                <label>Male </label>
                <input type="radio" name="gender" value="M" checked="checked">
                <label>Female </label>
                <input type="radio" name="gender" value="F">
                <label>Others </label>
                <input type="radio" name="gender" value="O">
            </div>
        
            <br class="clear">
           
        	<div class="address">
                <label>Address</label>
                <textarea title="Full address" name="fulladdress"></textarea>
            </div>
        	<div class="name">
            	<label>District</label>
                <select name="district_id">
                    <option value="">Select</option>
                    <?php
					if( mysqli_num_rows($result_dm) > 0){
						while($data1 = mysqli_fetch_assoc($result_dm)){	
						?>
                    		<option value="<?=$data1['did']?>"><?=$data1['dname']?></option>
                        <?php
						}
					}
					?>
                    
                </select>
            </div>
            <div class="name">
            	<label>Photo</label>
                <input type="file" name="profile_pic" value="">
            </div>
        	<div class="subject">
            	<input type="submit" name="login" value="Sign In">
            </div>
        </div>
    </form>
</div>
<?php
include("includes/footer.php");
?>


<script type="text/javascript">
function submitClick() {
	
	var f_name=document.forms['myForm']['firstname'].value;
	var m_name=document.forms['myForm']['middlename'].value;
	var l_name=document.forms['myForm']['lastname'].value;
	var mailformat = /^[a-z][a-zA-Z0-9_]*(\.[a-zA-Z][a-zA-Z0-9_]*)?@[a-z][a-zA-Z-0-9]*\.[a-z]+(\.[a-z]+)?$/ ;
	//var phoneno = /^\d{10}$/;
	var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	var email = document.forms['myForm']['emailaddress'].value;
	var phone = document.forms['myForm']['contactno'].value;
	var district = document.forms['myForm']['district_id'].value;
	var subject = document.forms['myForm']['subject_id'].value;
	var gender =  document.getElementById("myCheck").checked;
	
	//alert(district);
	//var genders = document.getElementsByName("gender");
	//alert(f_name);
	flag = true;
	console.log('jjd');
	//alert(document.myForm.firstname.value);
    if (f_name == "") { 
      alert("Please fill in your First Name!");
      flag = false;
	  return flag;
    }  
	
	else if (l_name == "") { 
      alert("Please fill in your Last Name!");
      flag = false;
	  return flag;
    } 
	
	else if(!(phone.value.match(phoneno))
	{
		alert("Please enter valid contact number!");
		flag = false;
	  	return flag;
	}
	/*if(district==""){ 
      alert("Please select district!");
      flag = false;
	  return flag;
    }
	if(subject==0){ 
      alert("Please select subject!");
      flag = false;
	  return flag;
    }
	/*if (gender ==  )
	{
		alert("Please select gender!");
      	flag = false;
	  	return flag;
	}
	if (address == "") { 
      alert("Please fill in your Address!");
      flag = false;
	  return flag;
    }
	if(!mailformat.test(email)){ 
      alert("Invalid or empty email id!");
      flag = false;
	  return flag;
    }
	
	if(!phoneno.test(phone)){ 
      alert("Invalid or empty phone no!");
      flag = false;
	  return flag;
    }*/
	
	 else{
		return flag;
	}
}
</script>