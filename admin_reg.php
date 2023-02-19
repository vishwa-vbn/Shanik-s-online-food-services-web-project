<?php

include 'config.php';

if(isset($_POST['submit']))
{
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['emailid']);
    $passw=mysqli_real_escape_string($conn,$_POST['pass']);
    $cpassw=mysqli_real_escape_string($conn,$_POST['cpass']);
    $dob=$_POST['biday'];

    


    $select_user=mysqli_query($conn, "SELECT * FROM `admin` WHERE Email_id='$email' AND Password='$passw' ")or die('query failed');

    if(mysqli_num_rows($select_user)>0){
        $message[]='User alraedy exist';
    }
    else{

        if($passw!=$cpassw){
            $message[]='Enter the password correctly!' ;
        }
        else{
            mysqli_query($conn,"INSERT INTO `admin` (Name,Email_id,Password,Dob) VALUES ('$name','$email','$passw','$dob')") or die('query failed');

            $message[]='registered successfully!';
        header('Refresh: 7; URL=http://localhost/online%20food%20order/admin_log.php');

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
    <link rel="stylesheet" href="./css/adreg_style.css">
   
</head>
<body >

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message2">
         <span>'.$message.'</span>
         <i class="RICON" onclick="this.parentElement.remove();">X</i>
      </div>
      ';
   }
}
?>
   

<div id="adminregi">
   
<form name="admform" id="adregform" method="post" onsubmit="return validateform()">

    <div class="admdiv">
<h1>Admin Register</h1>

      <div id="adlbl">
        <label>Name:</label>
        <label>Email:</label>
        <label>Password:</label>
        <label>Confirm Password:</label> 
        <label>Date of birth:</label>  

      </div>
        <input type="text" name="name" placeholder="Enter your name" id="name" pattern="[a-zA-Z'-'\s]*" title="special characters & numbers are not allowed" ><br/>

        <input type="email" name="emailid" placeholder="Enter your email"   pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address" required ><br/>
       
        <input type="password" name="pass" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" ><br/>
        
        <input type="password" name="cpass" placeholder="confirm password" ><br/>
        <input type="date" id="bdate" name="biday"  >


<div id="adminbut">
        <input type="submit" id="sbtn" name="submit">
        <p class="have">already have an account?    
        <a href="admin_log.php">login now</a></p>
</div>
  
    </div>
</form>


  <script src="./js/user.js"></script>  
</body>
</html>