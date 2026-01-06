<?php
require_once __DIR__ . '/../config/config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit;
}


$select_users = $conn->prepare("SELECT * FROM `users`");
$select_users->execute();


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   if ($delete_id != $admin_id) {
      $conn->prepare("DELETE FROM `users` WHERE id = ?")->execute([$delete_id]);
      $_SESSION['message'] = 'User deleted successfully!';
   } else {
      $_SESSION['message'] = 'You cannot delete your own account!';
   }

   header('location:admin_users.php');
   exit;
}
?>
