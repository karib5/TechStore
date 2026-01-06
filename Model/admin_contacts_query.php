<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit;
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   $conn->prepare("DELETE FROM `message` WHERE id = ?")->execute([$delete_id]);

   $_SESSION['message'] = 'Message deleted!';

   header('location:admin_contacts.php');
   exit;
}

?>
