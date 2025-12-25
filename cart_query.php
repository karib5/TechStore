<?php
@include 'config.php';

function deleteCartItem($id){
    global $conn;
    $sql = "DELETE FROM cart WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}

function deleteAllCartItems($user_id){
    global $conn;
    $sql = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$user_id]);
}

function updateCartQuantity($cart_id, $qty){
    global $conn;
    $sql = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$qty, $cart_id]);
}

function getCartByUser($user_id){
    global $conn;
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt;
}
?>
