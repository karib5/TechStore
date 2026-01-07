<?php
@include '../Controller/config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:../Controller/login.php');
   exit;
}



if (isset($_GET['update'])) {
   $update_id = $_GET['update'];
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $select_products->execute([$update_id]);
}

if (isset($_POST['update_product'])) {
   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $price = $_POST['price'];
   $category = $_POST['category'];
   $details = $_POST['details'];
   $old_image = $_POST['old_image'];

   $image = $_FILES['image']['name'];
   $image_tmp = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   if (!empty($image)) {
      move_uploaded_file($image_tmp, $image_folder);
      $update_product = $conn->prepare(
         "UPDATE `products` SET name=?, price=?, category=?, details=?, image=? WHERE id=?"
      );
      $update_product->execute([$name, $price, $category, $details, $image, $pid]);
   } else {
      $update_product = $conn->prepare(
         "UPDATE `products` SET name=?, price=?, category=?, details=? WHERE id=?"
      );
      $update_product->execute([$name, $price, $category, $details, $pid]);
   }

   $_SESSION['message'] = 'Product updated successfully!';
   header('location:../Controller/admin_products.php');
   exit;
}
?>
