<?php

@include 'config.php';
require_once '../Model/cart_query.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


if(isset($_GET['delete'])){
   deleteCartItem($_GET['delete']);
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   deleteAllCartItems($user_id);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $p_qty   = $_POST['p_qty'];
   updateCartQuantity($cart_id, $p_qty);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../View/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = getCartByUser(user_id: $user_id);

      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="POST" class="box">
      <a href="cart.php?delete=<?= $fetch_cart['id']; ?>" 
         class="fas fa-times" 
         onclick="return confirm('delete this from cart?');"></a>


      <img src="../Assets/uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
      <div class="name"><?= $fetch_cart['name']; ?></div>
      <div class="price">$<?= $fetch_cart['price']; ?>/-</div>

      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">

      <div class="flex-btn">
         <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" name="p_qty" class="qty">
         <input type="button" value="update" name="update_qty" class="option-btn" onclick="ajax_update_qty(this)">
      </div>

      <div class="sub-total">
         sub total :
         <span>
            $<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-
         </span>
      </div>
   </form>
   <?php
            $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">your cart is empty</p>';
      }
   ?>

   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?= $grand_total; ?>/-</span></p>
      <a href="shop.php" class="option-btn">continue shopping</a>
      <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
<script>
function ajax_update_qty(btn){

    let form = btn.closest('.box');

    let cart_id = form.querySelector('input[name="cart_id"]').value;
    let p_qty   = form.querySelector('input[name="p_qty"]').value;

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../Model/cart_update_query.php', true);
    xhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    xhttp.send('update_qty=1'+ '&cart_id=' + cart_id+ '&p_qty=' + p_qty);

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            let res = this.responseText.split('|');

            let message     = res[0];
            let sub_total   = res[1];
            let grand_total = res[2];

            let box = document.getElementById('ajax-message');
            box.innerHTML = `
                <div class="message">
                    <span>${message}</span>
                </div>
            `;

            form.querySelector('.sub-total span').innerText =
                '$' + sub_total + '/-';

            document.querySelector('.cart-total span').innerText =
                '$' + grand_total + '/-';

            setTimeout(() => {
                box.innerHTML = '';
            }, 3000);
        }
    }
}
</script>

</body>
</html>
