<?php
require_once __DIR__ . '/../config/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

$total_pendings = 0;
$select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
$select_pendings->execute(['pending']);
while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
   $total_pendings += $fetch_pendings['total_price'];
}


$total_completed = 0;
$select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
$select_completed->execute(['completed']);
while ($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)) {
   $total_completed += $fetch_completed['total_price'];
}

$select_orders = $conn->prepare("SELECT * FROM `orders`");
$select_orders->execute();
$number_of_orders = $select_orders->rowCount();

$select_products = $conn->prepare("SELECT * FROM `products`");
$select_products->execute();
$number_of_products = $select_products->rowCount();

$select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
$select_users->execute(['user']);
$number_of_users = $select_users->rowCount();

$select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
$select_admins->execute(['admin']);
$number_of_admins = $select_admins->rowCount();

$select_accounts = $conn->prepare("SELECT * FROM `users`");
$select_accounts->execute();
$number_of_accounts = $select_accounts->rowCount();

$select_messages = $conn->prepare("SELECT * FROM `message`");
$select_messages->execute();
$number_of_messages = $select_messages->rowCount();
?>
