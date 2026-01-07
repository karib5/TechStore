<?php
@include '../Controller/config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(isset($_POST['update_qty'])){

   $cart_id = $_POST['cart_id'];
   $p_qty   = $_POST['p_qty'];

   $update = $conn->prepare(
      "UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?"
   );
   $update->execute([$p_qty, $cart_id, $user_id]);

   $item = $conn->prepare(
      "SELECT price, quantity FROM cart WHERE id = ? AND user_id = ?"
   );
   $item->execute([$cart_id, $user_id]);
   $row = $item->fetch(PDO::FETCH_ASSOC);

   $sub_total = $row['price'] * $row['quantity'];

   $total = 0;
   $all = $conn->prepare("SELECT price, quantity FROM cart WHERE user_id = ?");
   $all->execute([$user_id]);
   while($r = $all->fetch(PDO::FETCH_ASSOC)){
      $total += $r['price'] * $r['quantity'];
   }

   echo "Cart updated!"
        . "|" . $sub_total
        . "|" . $total;
   exit;
}


echo "invalid_request|0|0";
exit;
