<?php
@include '../Controller/config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:../Controller/login.php');
   exit;
}


$show_products = $conn->prepare("SELECT * FROM `products`");
$show_products->execute();


if (isset($_POST['add_product'])) {
   $name = $_POST['name'];
   $category = $_POST['category'];
   $price = $_POST['price'];
   $details = $_POST['details'];

   $image = $_FILES['image']['name'];
   $image_tmp = $_FILES['image']['tmp_name'];
   $image_folder = '../Assets/uploaded_img/' . $image;

   $insert_product = $conn->prepare(
      "INSERT INTO `products` (name, category, price, image, details)
       VALUES (?, ?, ?, ?, ?)"
   );

   if ($insert_product->execute([$name, $category, $price, $image, $details])) {
      move_uploaded_file($image_tmp, $image_folder);
      $_SESSION['message'] = 'Product added successfully!';
   } else {
      $_SESSION['message'] = 'Something went wrong!';
   }

   header('location:../Controller/admin_products.php');
   exit;
}


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   $delete_product = $conn->prepare(
      "DELETE FROM `products` WHERE id = ?"
   );

   if ($delete_product->execute([$delete_id])) {
      $_SESSION['message'] = 'Product deleted successfully!';
   } else {
      $_SESSION['message'] = 'Failed to delete product!';
   }

   header('location:../Controller/admin_products.php');
   exit;
}
?>
