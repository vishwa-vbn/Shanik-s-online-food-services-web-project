


<?php

include 'config.php';

session_start();
$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id))
{
   header('location:admin_log.php');
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
   <link rel="stylesheet" href="css/adstyle.css">

</head>
<body>
<?php include 'adminheader.php'; ?>



<div id="box-dash">


<div id="dashbox">

<?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>order placed</p>
      </div>





<div id="dashbox">


<?php 
            $select_customers = mysqli_query($conn, "SELECT * FROM `customer` ") or die('query failed');
            $no_of_customers = mysqli_num_rows($select_customers);
         ?>
         <h3><?php echo $no_of_customers; ?></h3>
         <p>Total Customers</p>

</div>



<div id="dashbox">

<?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $no_of_items = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $no_of_items; ?></h3>
         <p> Food products </p>
      </div>






<div id="dashbox">

<?php 
            $select_reviews = mysqli_query($conn, "SELECT * FROM `reviews`") or die('query failed');
            $no_of_reviews = mysqli_num_rows($select_reviews);
         ?>
         <h3><?php echo $no_of_reviews; ?></h3>
         <p>  Total reviews</p>
      </div>





<div id="dashbox">

<?php 
            $select_porders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status='pending'") or die('query failed');
            $no_of_porders = mysqli_num_rows($select_porders);
         ?>
         <h3><?php echo $no_of_porders; ?></h3>
         <p> Payment pending</p>
      </div>




<div id="dashbox">

<?php 
            $select_corders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status='completed'") or die('query failed');
            $no_of_corders = mysqli_num_rows($select_corders);
         ?>
         <h3><?php echo $no_of_corders; ?></h3>
         <p> Payment completed</p>
      </div>






<div id="dashbox">

<?php 
$final_total=0;
$today=date('d-M-Y');
            $select_revenue = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status='completed' and dateOforder='$today' ") or die('query failed');
            if(mysqli_num_rows($select_revenue) > 0){
                while($fetch_revenue = mysqli_fetch_assoc($select_revenue)){
                   $total_price = $fetch_revenue['total_price'];
                   $final_total += $total_price;
                };
             };


         ?>
         <h3><?php echo $final_total; ?></h3>
         <p> Total revenue</p>
      </div>




<div id="dashbox">

<?php 
            $select_invent = mysqli_query($conn, "SELECT * FROM `inventory`") or die('query failed');
            $no_of_initems = mysqli_num_rows($select_invent);
         ?>
         <h3><?php echo $no_of_initems; ?></h3>
         <p> Inventory items</p>
      </div>




</div>




</body>
</html>