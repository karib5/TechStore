<?php

@include 'config.php';
require_once 'category_query.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="products">

   <h1 class="title">products categories</h1>

   <div class="box-container">

   <?php
      $category_name = $_GET['category'];
      $select_products = getProductsByCategory($category_name);

      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>

      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>

      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">

      <input type="number" min="1" value="1" name="p_qty" class="qty">

      <input type="button" value="add to wishlist" class="option-btn" name="add_to_wishlist" onclick="ajax_wishlist(this)">
      <input type="button" value="add to cart" class="btn" onclick="ajax_cart(this)">

   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products available!</p>';
      }
   ?>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script>
function ajax_cart(btn){

    let form = btn.closest('.box');

    let pid     = form.querySelector('input[name="pid"]').value;
    let p_name  = form.querySelector('input[name="p_name"]').value;
    let p_price = form.querySelector('input[name="p_price"]').value;
    let p_image = form.querySelector('input[name="p_image"]').value;
    let p_qty   = form.querySelector('input[name="p_qty"]').value;

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'cart_wishlist_query.php', true);
    xhttp.setRequestHeader(
        'Content-type',
        'application/x-www-form-urlencoded'
    );

    xhttp.send('add_to_cart=1' + '&pid=' + pid + '&p_name=' + p_name  + '&p_price=' + p_price + '&p_image=' + p_image + '&p_qty=' + p_qty);

    xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

        let box = document.getElementById('ajax-message');
        box.innerHTML = `
            <div class="message">
                <span>${this.responseText}</span>
            </div>
        `;

        setTimeout(() => { box.innerHTML = '';}, 3000);
    }
}
}



function ajax_wishlist(btn){

    let form = btn.closest('.box');

    let pid     = form.querySelector('input[name="pid"]').value;
    let p_name  = form.querySelector('input[name="p_name"]').value;
    let p_price = form.querySelector('input[name="p_price"]').value;
    let p_image = form.querySelector('input[name="p_image"]').value;

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'cart_wishlist_query.php', true);
    xhttp.setRequestHeader(
        'Content-type',
        'application/x-www-form-urlencoded'
    );

    xhttp.send(
        'add_to_wishlist=1'
        + '&pid=' + pid
        + '&p_name=' + p_name
        + '&p_price=' + p_price
        + '&p_image=' + p_image
    );

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            let box = document.getElementById('ajax-message');
            box.innerHTML = `
                <div class="message">
                    <span>${this.responseText}</span>
                </div>
            `;

            setTimeout(() => {
                box.innerHTML = '';
            }, 3000);
        }
    }
}
</script>


</body>
</html>