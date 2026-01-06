
<?php @include 'config.php'; ?>
<?php
require_once __DIR__ . '/../Model/admin_contacts_query.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Messages</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
   
<?php
if (isset($_SESSION['message'])) {
   echo '<div class="message">
            <span>'.$_SESSION['message'].'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>';
   unset($_SESSION['message']);
}
?>


<?php include 'admin_header.php'; ?>

<section class="messages">

<h1 class="title">Messages</h1>

<div class="box-container">

<?php
$select_message = $conn->prepare("SELECT * FROM `message`");
$select_message->execute();

if ($select_message->rowCount() > 0) {
   while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="box">
<p> user id : <span><?= $fetch_message['user_id']; ?></span> </p>
<p> name : <span><?= $fetch_message['name']; ?></span> </p>
<p> number : <span><?= $fetch_message['number']; ?></span> </p>
<p> email : <span><?= $fetch_message['email']; ?></span> </p>
<p> message : <span><?= $fetch_message['message']; ?></span> </p>

<a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>"
   class="delete-btn"
   onclick="return confirm('Delete this message?');">
   delete
</a>
</div>

<?php
   }
} else {
   echo '<p class="empty">You have no messages!</p>';
}
?>

</div>
</section>

<script src="js/script.js"></script>
</body>
</html>
