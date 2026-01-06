<?php include 'admin_update_product_query.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
<?php
if (isset($_SESSION['message'])) {
   echo '
   <div class="message">
      <span>'.$_SESSION['message'].'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
   unset($_SESSION['message']);
}
?>

<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title">update product</h1>

   <?php
      if ($select_products->rowCount() > 0) {
         while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <input type="text" name="name" required class="box" value="<?= $fetch_products['name']; ?>">
      <input type="number" name="price" min="0" required class="box" value="<?= $fetch_products['price']; ?>">
      <select name="category" class="box" required>
   <option selected value="<?= $fetch_products['category']; ?>">
      <?= $fetch_products['category']; ?>
   </option>
   <option value="Casing">Casing</option>
   <option value="GPU">GPU</option>
   <option value="Processor">Processor</option>
   <option value="RAM">RAM</option>
</select>
      <textarea name="details" required class="box" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <div class="flex-btn">
         <input type="submit" class="btn" value="update product" name="update_product">
         <a href="admin_products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      } else {
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>

<script src="js/script.js"></script>

</body>
</html>
