<?php
include '../Model/admin_update_profile_query.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>update admin profile</title>
 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="../View/components.css">
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
 
<section class="update-profile">
 
   <h1 class="title">update profile</h1>
 
   <form action="" method="POST" enctype="multipart/form-data">
 
      <!-- FIXED IMAGE PATH -->
<img src="../Assets/uploaded_img/<?= htmlspecialchars($fetch_profile['image']); ?>" alt="admin image">
 
      <div class="flex">
<div class="inputBox">
<span>username :</span>
<input type="text" name="name"
                   value="<?= htmlspecialchars($fetch_profile['name']); ?>"
                   required class="box">
 
            <span>email :</span>
<input type="email" name="email"
                   value="<?= htmlspecialchars($fetch_profile['email']); ?>"
                   required class="box">
 
            <span>update pic :</span>
<input type="file" name="image"
                   accept="image/jpg, image/jpeg, image/png"
                   class="box">
 
            <input type="hidden" name="old_image"
                   value="<?= htmlspecialchars($fetch_profile['image']); ?>">
</div>
 
         <div class="inputBox">
<input type="hidden" name="old_pass"
                   value="<?= htmlspecialchars($fetch_profile['password']); ?>">
 
            <span>old password :</span>
<input type="password" name="update_pass" class="box">
 
            <span>new password :</span>
<input type="password" name="new_pass" class="box">
 
            <span>confirm password :</span>
<input type="password" name="confirm_pass" class="box">
</div>
</div>
 
      <div class="flex-btn">
<input type="submit" class="btn" value="update profile" name="update_profile">
<a href="admin_page.php" class="option-btn">go back</a>
</div>
 
   </form>
 
</section>
 

<script src="../Controller/js/script.js"></script>
 
</body>
</html>