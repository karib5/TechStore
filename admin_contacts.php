<?php

@include 'config.php';
@include 'admin_contacts_query.php';

session_start();

checkAdminSession();
deleteMessage($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="messages">
   <h1 class="title">messages</h1>

   <div class="box-container">
      <p class="empty">you have no messages!</p>
   </div>
</section>

<script src="js/script.js"></script>
</body>
</html>
