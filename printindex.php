<?php


include 'config.php';
session_start();

global $DateOfOrder;
$DateOfOrder=date('d-M-Y');


?>
<?php

if (isset($_GET['printid']))
{

    $print_rowid= $_GET['printid'];

    $select_print=mysqli_query($conn,"SELECT * FROM `reorder` WHERE id='$print_rowid'")or die('query failed');

if(mysqli_num_rows($select_print)>0){
  
while($f_row=mysqli_fetch_assoc($select_print))
{
global $supp_id;

$supp_id=$f_row['sup_id'];

}
}

$slect_sup=mysqli_query($conn,"SELECT * FROM `supplier` WHERE supplier_id='$supp_id'") or die('query failed');

if(mysqli_num_rows($slect_sup)>0){

    

    while($fetch_row=mysqli_fetch_assoc($slect_sup))
    {

        global  $supp_name;
global  $supp_email;
global $supp_add;
global $supp_contact;


    $supp_name=$fetch_row['Name'];
    $supp_email=$fetch_row['Email_id'];
    $supp_add=$fetch_row['Address'];
    $supp_contact=$fetch_row['Phone_no'];
    
  
    }}


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/printbill.css">

</head>
<body>



<section id="printsec">
    <div id="printdiv">
<div id="binvo"><p>INVOICE</p></div>



<div id="bdate"> <label>Date: </label> <p> <?php echo $DateOfOrder ?> </p> </div>
<div id="sup_details"> 
     <label>Supplier: </label> <p><?php echo $supp_name ?><br>
<?php echo $supp_email ?><br>
<?php echo $supp_add ?><br>
<?php echo $supp_contact ?></p>


</div>






<table >
    <tr>
        

        <th>No</th>
            <th>Supplier_id</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>


    </tr>

<?php


if (isset($_GET['printid']))
{
    $print_rowid= $_GET['printid'];

    $select_print=mysqli_query($conn,"SELECT * FROM `reorder` WHERE id='$print_rowid'")or die('query failed');

if(mysqli_num_rows($select_print)>0){

while($s_row=mysqli_fetch_assoc($select_print))
{


?>






<tr>
           



           <td><?php echo $s_row['id'];?></td>
               <td><?php echo $s_row['sup_id'];?></td>
               <td><?php echo $s_row['item_name'];?></td>
               <td><?php echo $s_row['item_qnty'];?></td>
               <td><?php echo $s_row['price'];?></td>
               


       </tr>




<?php

}


}
  
}
?>
</table>


<div class="pbtndiv">
    <button type="button" onclick=" window.print();"  id="print_btn"> print</button>

</div>

    </div>
</section>


</body>
</html>