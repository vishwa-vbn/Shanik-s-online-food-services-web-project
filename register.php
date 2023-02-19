




<?php


include 'config.php';

if(isset($_POST['rsubmit']))
{
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $phone=mysqli_real_escape_string($conn,$_POST['phoneno']);
    $email=mysqli_real_escape_string($conn,$_POST['emailid']);
    $dob=$_POST['cdate'];
    $pass=mysqli_real_escape_string($conn,$_POST['pass']);
    $user_type=$_POST['user_type'];

    $cpass=mysqli_real_escape_string($conn,$_POST['cpass']);
    $city=mysqli_real_escape_string($conn,$_POST['city']);
    $pincode=mysqli_real_escape_string($conn,$_POST['pincode']);

$select_username= mysqli_query($conn,"SELECT * FROM  `customer` WHERE Email_id ='$email'" ) or die("query failed");
if(mysqli_num_rows($select_username) >0)
{
    $message[]="user already exist!";
}else{


if($pass!=$cpass){
        $message[]='Enter the password correctly!';
    }else{
     
        mysqli_query($conn,"INSERT INTO `customer` (Name,Email_id,Address,Password,Phone,Pincode,City,Dob) VALUES('$name','$email','$address','$pass','$phone','$pincode','$city','$dob')") or die('query failed');
    
        $message[] = 'registered successfully!';

        header('Refresh: 7; URL=http://localhost/online%20food%20order/login.php');


    }
}

    }




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body  >

<section  id="regsec">

<form  action="" name="myform" id="regform" method="post" onsubmit="return validateform()">
  <div class="regdiv">
        <h1>Register</h1>
        <label>Name:</label> 
<br/>
<input type="text" name="name" placeholder="Enter Your Name" id="name" pattern="[a-zA-Z'-'\s]*" title="special characters are not allowed" required >
<label>Address:</label> <br/>  <input type="text"  name="address" placeholder=" Enter address" required>
<label>Contact:</label><br/>  <input type="tel" name="phoneno" placeholder="Enter your number"  pattern="[6-9]{1}[0-9]{9}"  title="Phone number with 6-9 and remaing 9 digit with 0-9" required>
       
  
 <input type="hidden" name="user_type" value="user">


        <label>Email:</label><br/>  <input type="email" name="emailid"  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address" placeholder="Enter your email">
     <label>Date of birth:</label><input type="date" id="idate" name="cdate" >
        <label>Password:</label><br/>  <input type="password" name="pass"   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="enter password" >
        <label>Confirm Password:</label><br/>  <input type="password" name="cpass" placeholder="confirm password"  minlength="8"> 
        <label>City:</label><br/>  <input type="text" name="city" placeholder="City">
        <label>PinCode:</label><br/>  <input type="text"  name="pincode"placeholder="pincode">

        <input type="submit" id="sbtn"   name="rsubmit" >
        <p class="have">already have an account? <a href="login.php">login now</a></p>
  </div>
  <br/>
   
</form> 


</section>


<div id="mess_div">
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <div id="m_head"><h3 >'.$message.'</h3></div>
         <div onclick="this.parentElement.remove();"><button type="button" >X</button></div>
        
      </div>
      ';
   }
}
?> 
</div>



    
    <script src="./js/user_script.js"></script>
</body>
</html>