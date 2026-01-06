<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
   <span>Build smart, upgrade better</span>
   <h3>Power Your Setup With Premium Tech Components</h3>
   <p>Discover high-performance PC parts including processors, graphics cards, memory, and accessories built for speed, reliability, and power.</p>
   <a href="about.php" class="btn">about us</a>
</div>


   </section>

</div>

<section class="home-category">

   <h1 class="title">shop by category</h1>

   <div class="box-container">

      <div class="box">
   <img src="images/Casing.jpg" alt="">
   <h3>Casing</h3>
   <p>Durable PC casing designed to protect components and ensure proper airflow.</p>
   <a href="category.php?category=Casing" class="btn">Casing</a>
</div>

<div class="box">
   <img src="images/GPU.jpg" alt="">
   <h3>Graphics Card</h3>
   <p>High-performance GPU built for gaming, rendering, and graphic-intensive tasks.</p>
   <a href="category.php?category=GPU" class="btn">GPU</a>
</div>

<div class="box">
   <img src="images/Processor.jpg" alt="">
   <h3>Processor</h3>
   <p>Powerful CPU for multitasking, high speed processing, and system performance.</p>
   <a href="category.php?category=Processor" class="btn">Processor</a>
</div>

<div class="box">
   <img src="images/RAM1.jpg" alt="">
   <h3>RAM</h3>
   <p>Fast memory modules that improve system responsiveness and performance.</p>
   <a href="category.php?category=RAM" class="btn">RAM</a>
</div>


   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>