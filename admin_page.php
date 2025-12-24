<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>

   <!-- font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- admin css -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
<?php include 'admin_header.php'; ?>



<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>$12500/-</h3>
         <p>total pendings</p>
         <a href="#" class="btn">see orders</a>
      </div>

      <div class="box">
         <h3>$45200/-</h3>
         <p>completed orders</p>
         <a href="#" class="btn">see orders</a>
      </div>

      <div class="box">
         <h3>48</h3>
         <p>orders placed</p>
         <a href="#" class="btn">see orders</a>
      </div>

      <div class="box">
         <h3>32</h3>
         <p>products added</p>
         <a href="#" class="btn">see products</a>
      </div>

      <div class="box">
         <h3>120</h3>
         <p>total users</p>
         <a href="#" class="btn">see accounts</a>
      </div>

      <div class="box">
         <h3>3</h3>
         <p>total admins</p>
         <a href="#" class="btn">see accounts</a>
      </div>

      <div class="box">
         <h3>123</h3>
         <p>total accounts</p>
         <a href="#" class="btn">see accounts</a>
      </div>

      <div class="box">
         <h3>14</h3>
         <p>total messages</p>
         <a href="#" class="btn">see messages</a>
      </div>

   </div>

</section>

<script src="js/script.js"></script>
</body>
</html>
