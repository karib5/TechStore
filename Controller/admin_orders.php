<?php include 'admin_orders_query.php'; ?>
<?php
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Orders</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
   <?php
if (isset($_SESSION['message'])) {
   echo '
   <div class="message">
      <span>'.$_SESSION['message'].'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
   unset($_SESSION['message']);
}
?>


<?php include 'admin_header.php'; ?>

<section class="placed-orders">

<h1 class="title">Placed Orders</h1>

<div class="box-container">

<?php
$select_orders = $conn->prepare("SELECT * FROM `orders`");
$select_orders->execute();

if ($select_orders->rowCount() > 0) {
   while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="box">
<p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
<p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
<p> name : <span><?= $fetch_orders['name']; ?></span> </p>
<p> email : <span><?= $fetch_orders['email']; ?></span> </p>
<p> number : <span><?= $fetch_orders['number']; ?></span> </p>
<p> address : <span><?= $fetch_orders['address']; ?></span> </p>
<p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
<p> total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
<p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>

<form action="" method="POST">
   <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">

   <select name="update_payment" class="drop-down" required>
      <option value="" disabled selected><?= $fetch_orders['payment_status']; ?></option>
      <option value="pending">pending</option>
      <option value="completed">completed</option>
   </select>

   <div class="flex-btn">
      <input type="submit" name="update_order" class="option-btn" value="update">
      <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>"
         class="delete-btn"
         onclick="return confirm('Delete this order?');">
         delete
      </a>
   </div>
</form>
</div>

<?php
   }
} else {
   echo '<p class="empty">No orders placed yet!</p>';
}
?>

</div>
</section>

<script src="js/script.js"></script>
</body>
</html>
