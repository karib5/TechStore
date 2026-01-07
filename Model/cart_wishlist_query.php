<?php

@include '../Controller/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   echo 'login_required';
   exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {

   $pid     = $_POST['pid'];
   $p_name  = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_POST['p_image'];
   $p_qty   = $_POST['p_qty'];

   $check_cart_numbers = $conn->prepare(
      "SELECT * FROM cart WHERE name = ? AND user_id = ?"
   );
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_cart_numbers->rowCount() > 0) {
      echo "already added to cart!";
      exit;
   }

   
   $check_wishlist_numbers = $conn->prepare(
      "SELECT * FROM wishlist WHERE name = ? AND user_id = ?"
   );
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   if ($check_wishlist_numbers->rowCount() > 0) {
      $delete_wishlist = $conn->prepare(
         "DELETE FROM wishlist WHERE name = ? AND user_id = ?"
      );
      $delete_wishlist->execute([$p_name, $user_id]);
   }

   $insert_cart = $conn->prepare(
      "INSERT INTO cart (user_id, pid, name, price, quantity, image)
       VALUES (?, ?, ?, ?, ?, ?)"
   );

   $insert_cart->execute([$user_id,$pid,$p_name,$p_price,$p_qty,$p_image]);

   echo "added to cart!";
   exit;
}
if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_POST['p_image'];

   $check_wishlist_numbers = $conn->prepare(
      "SELECT * FROM wishlist WHERE name = ? AND user_id = ?"
   );
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare(
      "SELECT * FROM cart WHERE name = ? AND user_id = ?"
   );
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_wishlist_numbers->rowCount() > 0) {
      echo 'already added to wishlist!';
      exit;
   } 
   elseif ($check_cart_numbers->rowCount() > 0) {
      echo 'already added to cart!';
      exit;
   } 
   else {
      $insert_wishlist = $conn->prepare(
         "INSERT INTO wishlist (user_id, pid, name, price, image)
          VALUES (?, ?, ?, ?, ?)"
      );
      $insert_wishlist->execute([
         $user_id,
         $pid,
         $p_name,
         $p_price,
         $p_image
      ]);

      echo 'added to wishlist!';
      exit;
   }
}


echo "invalid_request";
exit;
