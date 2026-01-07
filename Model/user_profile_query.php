<?php
@include '../Controller/config.php';

function getUserProfile($user_id){
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUserProfile($user_id, $name, $email){
    global $conn;
    $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$name, $email, $user_id]);
}

function updateUserImage($user_id, $image){
    global $conn;
    $sql = "UPDATE users SET image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$image, $user_id]);
}

function updateUserPassword($user_id, $password){
    global $conn;
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$password, $user_id]);
}
?>
