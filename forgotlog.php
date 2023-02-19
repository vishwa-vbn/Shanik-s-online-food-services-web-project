<?php

include 'config.php';
session_start();

if(isset($_POST['upmit'])){

    $email = mysqli_real_escape_string($conn, $_POST['emailid']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass=mysqli_real_escape_string($conn,$_POST['cpassword']);
    $for_date=$_POST['fdate'];



//     $select_mail=mysqli_query($conn,"SELECT * FROM `customer` WHERE Email_id='$email'  ") or die("query failed");
//     if(mysqli_num_rows($select_mail) > 0)
//     {
//         while($row= mysqli_fetch_assoc($select_mail))
//         {
//         //    $present_date= $row['Dob'];

//         //    if($for_date == $present_date)
//         //    {
//              if($pass!== $cpass)
//              {
//                 $message[]='confirmed password didnot match ';

//              } else
//              {
//                  $update_users = mysqli_query($conn, "UPDATE `customer`  SET Password = '$pass' WHERE Email_id = '$email' ") or die('query failder');
//                  $message[]='password updated successfuclly';
     
     
//              }
//         //    }else
//         //    {
//         //     $message[]='email id not exist';

//         //    }


//         }
        

        


       
//         header('Refresh: 7; URL=http://localhost/online%20food%20order/login.php');
       
//     }else
//     {
//         $message[]='email id does not exist';

//     }
  
// }








$select_mail=mysqli_query($conn,"SELECT * FROM `customer` WHERE Email_id='$email'  ") or die("query failed");
if(mysqli_num_rows($select_mail) > 0)
{
    while($row= mysqli_fetch_assoc($select_mail))
    {
       $present_date= $row['Dob'];

       if($for_date == $present_date)
       {
         if($pass!== $cpass)
         {
            $message[]='confirmed password did not match ';

         } else
         {
             $update_users = mysqli_query($conn, "UPDATE `customer`  SET Password = '$pass' WHERE Email_id = '$email' ") or die('query failder');
             $message[]='password updated successfuclly';
 
 
         }
       }else
       {
        $message[]='unknown id entered';

       }


    }
    

    


   
    header('Refresh: 7; URL=http://localhost/online%20food%20order/login.php');
   
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
    <link rel="stylesheet" type="text/css" href="./css/logstyle.css">

</head>
<body class="logbody" style=" background:url('./image/indian-condiments-with-copy-space-view.jpg'); background-repeat:no-repeat; background-size:cover;" >


    <section class="logsec">

        <div class="loginform2">

            

                <form action="" method="post">
                    
                <img src="./image/Shanik's -logos__white (1).png" class="logoimg">
                    
                     <input  type="email" name="emailid" placeholder="enter your email" required class="loginput1">
                     <input type="password" name="password" placeholder="enter your password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required class="box">
                     <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
                      <label id="doblbl">Select date of birth:</label>
                      <input type="date" id="datein" name="fdate">
                     <input type="submit" name="upmit" value="Update" class="loginbtn">
                       
                 </form>

           
        </div>
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
    
</body>
</html>