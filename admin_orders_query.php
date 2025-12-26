<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit;
}


if (isset($_POST['update_order'])) {
   $order_id = $_POST['order_id'];
   $update_payment = filter_var($_POST['update_payment'], FILTER_SANITIZE_STRING);

   $update_orders = $conn->prepare(
      "UPDATE `orders` SET payment_status = ? WHERE id = ?"
   );
   $update_orders->execute([$update_payment, $order_id]);

   $message[] = 'Payment status updated successfully!';
}


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   $delete_orders = $conn->prepare(
      "DELETE FROM `orders` WHERE id = ?"
   );
   $delete_orders->execute([$delete_id]);

   header('location:admin_orders.php');
   exit;
}
?>
