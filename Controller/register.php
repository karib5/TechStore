<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name  = $_POST['name'];
   $email = $_POST['email'];

   $pass  = $_POST['pass'];
   $cpass = $_POST['cpass'];

   $image = $_FILES['image']['name']; 
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_error = $_FILES['image']['error'];

   $allowed_extensions = ['jpg', 'jpeg', 'png'];
   $image_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

   $allowed_mime = ['image/jpeg', 'image/png'];
   $image_mime = mime_content_type($image_tmp_name);

   $image_folder = '../Assets/uploaded_img/' . uniqid() . '_' . $image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'User email already exists!';
   }
   else{
      $password_error = '';

      if(strlen($pass) < 5 || !preg_match('/[0-9]/', $pass) || !preg_match('/[\W]/', $pass)){
         $password_error = 'Password must be at least 5 characters and contain at least 1 number and 1 special character!';
      }

      if(!empty($password_error)){
         $message[] = $password_error;
      }
      elseif($pass !== $cpass){
         $message[] = 'Confirm password does not match!';
      }
      elseif($image_error !== 0){
         $message[] = 'File upload error!';
      }
      elseif(!in_array($image_extension, $allowed_extensions) || !in_array($image_mime, $allowed_mime)){
         $message[] = 'Only JPG, JPEG, and PNG files are allowed!';
      }
      else {

         $insert = $conn->prepare(
            "INSERT INTO `users` (name, email, password, image)
             VALUES (?, ?, ?, ?)"
         );
         $insert->execute([$name, $email, $pass, $image_folder]);

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Registered successfully!';
            header('location:login.php');
            exit();
         } else {
            $message[] = 'Registration failed, please try again!';
         }
      }
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../View/components.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<section class="form-container">

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>register now</h3>

      <input type="text" name="name" class="box" placeholder="enter your name" required>
      <input type="email" name="email" class="box" placeholder="enter your email" required>

      <input type="password" name="pass" class="box"
             placeholder="min 5 chars + number + special char" required>

      <input type="password" name="cpass" class="box"
             placeholder="confirm your password" required>

      <input type="file" name="image" class="box" required
             accept="image/jpg, image/jpeg, image/png">

      <input type="submit" value="register now" class="btn" name="submit">

      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>

</body>
</html>