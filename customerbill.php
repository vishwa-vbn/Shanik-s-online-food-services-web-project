<?php 

include 'config.php';

session_start();
$user_id=$_SESSION['user_id'];

if(!isset($user_id))
{
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/customerbill.css">

</head>
<body>


<div id="cus_bill_div">
    <div id="cus_child">
<img src="./image/Shanik's -logos__black (1).png" id="bill_logo">
<!-- <span> Cloud Kitchen</span> -->

<?php
if(isset($_GET['od_id']))
{


$billing_order= $_GET['od_id'];
$bill_noo;
$select_orders=mysqli_query( $conn,"SELECT * FROM `orders` WHERE id='$billing_order ' ") or die('query failed');
if(mysqli_num_rows($select_orders)>0)
{
   while($fetch_orders = mysqli_fetch_assoc($select_orders))
   {
     global $u_id;
     $u_id=$fetch_orders['user_id'];
     global $bill_noo;
     $bill_noo=$fetch_orders['id'];

 
     
      
     
   
?>




<?php 

   }
}


mysqli_query($conn,"UPDATE `orders` SET bill_no='$bill_noo' WHERE id='$billing_order '") or die('query failed');
}



?>

<div id="b_info" >

  <div id="bi_no">Bill no: <?php echo $bill_noo  ?></div>
 <div id="cus_no"> Customer no: <?php echo $u_id ?></div>

</div>



<table id="billtab">
<tr>
<th scope="col">food (Quantity)</th>
<th scope="col">Price</th>

   </tr>




<?php
$DateOfOrder=date('d-M-Y');
global $final_total;
$final_total=0;
$select_orders=mysqli_query( $conn,"SELECT * FROM `orders` WHERE id='$billing_order ' AND dateOforder='$DateOfOrder'") or die('query failed');
if(mysqli_num_rows($select_orders)>0)
{
   while($fetch_orders = mysqli_fetch_assoc($select_orders))
   {
?>


<div id= "bill">


<tr>
   <div id="ip" > <td> <?php  echo $fetch_orders['total_products'] ;?> </td> </div>
        <div id="ip2"> <td> <?php  echo $fetch_orders['total_price']; ?>/- </td> </div>   
            <!-- <div > Ordered on : <?php echo $fetch_orders['dateOforder']; ?> </div> -->
         

   </tr>

         </div> 

         


         

<?php

  $final_total += $fetch_orders['total_price'];

}
}
?>
<tr>


<div>
<td><label id="tlab"> Sub Total:</label></td>
<div id="ip3"><td><?php echo $final_total ?> /-</td></div>
</div>


</tr>





</table>
<div id="greet"><span> Thank you for ordering!</span></div>
<button type="button" onclick=" window.print();"  id="printcus_btn"> print</button>

</div>









</div>



</body>
</html>
   