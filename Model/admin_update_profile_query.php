<?php
 
@include '../Controller/config.php';
session_start();
 
$admin_id = $_SESSION['admin_id'];
 
if (!isset($admin_id)) {
   header('location:../Controller/login.php');
   exit;
}
 

$select_profile = $conn->prepare(
   "SELECT * FROM `users` WHERE id = ? AND user_type = 'admin'"
);
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
 
 

if (isset($_POST['update_profile'])) {
 
   $name  = $_POST['name'];
   $email = $_POST['email'];
 
   $old_pass     = $_POST['old_pass'];       
   $update_pass  = $_POST['update_pass'];     
   $new_pass     = $_POST['new_pass'];         
   $confirm_pass = $_POST['confirm_pass'];     
 
   $old_image = $_POST['old_image'];
 
   $image = $_FILES['image']['name'];
   $image_tmp = $_FILES['image']['tmp_name'];
 
   
   $conn->prepare(
      "UPDATE `users` SET name = ?, email = ? WHERE id = ? AND user_type = 'admin'"
   )->execute([$name, $email, $admin_id]);

   if (!empty($image)) {
      $image_folder = '../Assets/uploaded_img/' . $image;
      move_uploaded_file($image_tmp, $image_folder);
 
      $conn->prepare(
         "UPDATE `users` SET image = ? WHERE id = ? AND user_type = 'admin'"
      )->execute([$image, $admin_id]);
 
      if (!empty($old_image)) {
         @unlink('../Assets/uploaded_img/' . $old_image);
      }
   }
 
   
   if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
 
      if (md5($update_pass) != $old_pass) {
         $_SESSION['message'] = 'Old password not matched!';
      }
      elseif ($new_pass != $confirm_pass) {
         $_SESSION['message'] = 'Confirm password not matched!';
      }
      else {
         $conn->prepare(
            "UPDATE `users` SET password = ? WHERE id = ? AND user_type = 'admin'"
         )->execute([md5($new_pass), $admin_id]);
 
         $_SESSION['message'] = 'Profile & password updated successfully!';
      }
   } else {
      $_SESSION['message'] = 'Profile updated successfully!';
   }
 
   header('location:../Controller/admin_update_profile.php');
   exit;
}
 
?>