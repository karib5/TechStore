<?php include '../Model/admin_page_query.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../View/admin_style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>$<?= $total_pendings; ?>/-</h3>
         <p>total pendings</p>
         <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <h3>$<?= $total_completed; ?>/-</h3>
         <p>completed orders</p>
         <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <h3><?= $number_of_orders; ?></h3>
         <p>orders placed</p>
         <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="admin_products.php" class="btn">see products</a>
      </div>

      <div class="box">
         <h3><?= $number_of_users; ?></h3>
         <p>total users</p>
         <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box">
         <h3><?= $number_of_admins; ?></h3>
         <p>total admins</p>
         <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box">
         <h3><?= $number_of_accounts; ?></h3>
         <p>total accounts</p>
         <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box">
         <h3><?= $number_of_messages; ?></h3>
         <p>total messages</p>
         <a href="admin_contacts.php" class="btn">see messages</a>
      </div>

   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>
