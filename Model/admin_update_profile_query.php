<?php
@include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
   exit;
}


$select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['update_profile'])) {

   $name = $_POST['name'];
   $email = $_POST['email'];
   $old_pass = $_POST['old_pass'];
   $update_pass = $_POST['update_pass'];
   $new_pass = $_POST['new_pass'];
   $confirm_pass = $_POST['confirm_pass'];
   $old_image = $_POST['old_image'];

   $image = $_FILES['image']['name'];
   $image_tmp = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   
   $conn->prepare(
      "UPDATE `admin` SET name=?, email=? WHERE id=?"
   )->execute([$name, $email, $admin_id]);

 
   if (!empty($image)) {
      move_uploaded_file($image_tmp, $image_folder);
      $conn->prepare(
         "UPDATE `admin` SET image=? WHERE id=?"
      )->execute([$image, $admin_id]);
   }

 
   if (!empty($update_pass) && !empty($new_pass) && !empty($confirm_pass)) {
      if (md5($update_pass) == $old_pass && $new_pass == $confirm_pass) {
         $conn->prepare(
            "UPDATE `admin` SET password=? WHERE id=?"
         )->execute([md5($new_pass), $admin_id]);

         $_SESSION['message'] = 'Profile & password updated successfully!';
      } else {
         $_SESSION['message'] = 'Password not matched!';
         header('location:admin_update_profile.php');
         exit;
      }
   } else {
      $_SESSION['message'] = 'Profile updated successfully!';
   }

   header('location:admin_update_profile.php');
   exit;
}
?>
