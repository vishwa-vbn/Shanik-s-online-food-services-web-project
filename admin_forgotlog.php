<?php

include 'config.php';
session_start();

if(isset($_POST['lsubmit'])){

    $email=mysqli_real_escape_string($conn,$_POST['emailid']);
    $pass=mysqli_real_escape_string($conn,$_POST['password']);
    $up_date=$_POST['for_day'];
    $cpass=mysqli_real_escape_string($conn,$_POST['cpassword']);
    

    
    $select_mail=mysqli_query($conn,"SELECT * FROM `admin` WHERE Email_id='$email'  ") or die("query failed");
    if(mysqli_num_rows($select_mail) > 0)
    {
        while($row= mysqli_fetch_assoc($select_mail))
        {
           $present_date= $row['Dob'];

           if($up_date == $present_date)
           {
             if($pass!== $cpass)
             {
                $message[]='confirmed password did not match ';

             } else
             {
                 $update_users = mysqli_query($conn, "UPDATE `admin`  SET Password = '$pass' WHERE Email_id = '$email' ") or die('query failder');
                 $message[]='password updated successfuclly';
     
     
             }
           }else
           {
            $message[]='unknown id entered';

           }


        }
        

        


       
        header('Refresh: 7; URL=http://localhost/online%20food%20order/admin_log.php');
       
    }else
    {
        $message[]='email id does not exist';

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
    <link rel="stylesheet" type="text/css" href="./css/adlog_style.css">
</head>
<body class="adlogbody">





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

<section class="up-adlogsec">
    <div class="up-adloginform">
    <form name="adlogform" method="post">
         <img src="./image/Shanik's -logos__black (1).png" class="adlogoimg"> 

        <input type="email" name="emailid" placeholder="Enter your mail" required class="up-adloginput2">
        <input type="password" name="password" placeholder="Enter your password"   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required class="box">
        <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
        <br>
        <label>Select  Date of Birth:</label>
        <br>
        <input type="date" id="bdate" name="for_day"  >

        <input type="submit" name="lsubmit" value="login now" class="adloginbtn">
        <p class="adregp"> <a href="forgotlog.php">forgot password?</a></p>
        <p class="adregr">Don't have an account? <a href="admin_reg.php">Register</a></p>
        
    </form>
    </div>
</section>
    
</body>
</html>