<?php


include 'config.php';
session_start();
$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id))
{
    header('location:admin_log.php');

}


if(isset($_POST['submit']))
{
    $name=mysqli_real_escape_string($conn,$_POST['suppliername']);
    $addres=mysqli_real_escape_string($conn,$_POST['address']);
    $phone=mysqli_real_escape_string($conn,$_POST['phoneno']);
    $email=mysqli_real_escape_string($conn,$_POST['emailid']);
    $supid=mysqli_real_escape_string($conn,$_POST['supplierid']);


  

$select_user=mysqli_query($conn, "SELECT  Email_id FROM `supplier` WHERE Email_id='$email'");


if(mysqli_num_rows($select_user) > 0){
$message[]='Supplier already exist';
}else{
     
        mysqli_query($conn,"INSERT INTO `supplier` (supplier_id,Email_id,Name,Address,Phone_no) VALUES('$supid','$email','$name','$addres','$phone') ");
    
        $message[] = 'new supplier added successfully!';


    }
}


?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/supplier.css">
</head>
<body>

    <?php include 'adminheader.php'; ?>


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

   
    <div class="supdiv">
    <h1 id="addhead">Add Supplier</h1>
    
    <form  id="supform" method="post" action="">
        <input type="email" name="emailid"  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address"   placeholder="Enter supplier email">
        <input type="text" name="supplierid"  pattern="\d{3}|\d{8}" 
         title="must be 3 or 8 digit" placeholder="Enter your supplier id">
        <input type="text" name="suppliername" pattern="[a-zA-Z'-'\s]*" title="special characters & numbers are not allowed"  placeholder="Enter your supplier name">
        <input type="text" name="address" placeholder="Enter  address">
        <input type="tel" name="phoneno"  pattern="[7-9]{1}[0-9]{9}"  title="Phone number with 7-9 and remaing 9 digit with 0-9"   placeholder="Enter phone number">
        <div id="supbutons">
        <input type="submit" id="sbtn"  name="submit"  value="add">
       <div id="uplink" ><a href="updatesuplier.php" id="link">Update</a></div>
       <div id="dellink" ><a href="updatesuplier.php" id="d_link">delete</a></div>
        </div>
    </form>
</div>
    <section class="show_supplier">
    <h3 id="supplier_table">Supplier Table</h3>
    <div class="box-sup">
    <div class="box1">

<table border="2px">
<tr>
    <th>Supplier_id</th>
    <th>Name</th>
    <th>Email-ID</th>
    <th>Address</th>
    <th>Phone no</th> 
</tr>

    <?php

    $select_supp=mysqli_query($conn,"SELECT * FROM `supplier`") or die('query failed');
    if(mysqli_num_rows($select_supp)>0){
        while($fetch_supp=mysqli_fetch_assoc($select_supp)){
            global $id,$e_mail,$addres,$name,$phone;
            $id=$fetch_supp['supplier_id'];
            $name=$fetch_supp['Name'];
            $email=$fetch_supp['Email_id'];
            $addres=$fetch_supp['Address'];
            $phone=$fetch_supp['Phone_no'];

        
    ?>
    
    <tr>
        <td id="sup_id"><?php echo $id ?></td>
        <td id="sup_name"><?php echo $name ?></td>
        <td id="sup_email"><?php echo $email ?></td>
        <td id="sup_address"><?php echo $addres ?></td>
        <td id="sup_phone"><?php echo $phone ?></td>

    </tr>

    

<?php
        }
    }
?>
</table>

</div>


    </div>

    </section>
    

</body>
</html>