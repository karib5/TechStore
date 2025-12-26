<?php


function checkAdminSession() {
    if (!isset($_SESSION['admin_id'])) {
        header('location:login.php');
        exit();
    }
}


function deleteMessage($conn) {
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM `message` WHERE id = ?");
        $stmt->execute([$delete_id]);
        header('location:admin_contacts.php');
        exit();
    }
}
?>