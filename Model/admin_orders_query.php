<?php
@include '../Controller/config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:../Controller/login.php');
   exit;
}


if (isset($_POST['update_order'])) {
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];

   $conn->prepare(
      "UPDATE `orders` SET payment_status = ? WHERE id = ?"
   )->execute([$update_payment, $order_id]);

   $_SESSION['message'] = "Order status updated to '{$update_payment}' successfully!";
   header('location:../Controller/admin_orders.php');
   exit;
}


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   $conn->prepare(
      "DELETE FROM `orders` WHERE id = ?"
   )->execute([$delete_id]);

   $_SESSION['message'] = "Order deleted successfully!";
   header('location:../Controller/admin_orders.php');
   exit;
}
?>
