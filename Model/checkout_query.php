<?php
@include '../Controller/config.php';

function getCartItemsByUser($user_id){
    global $conn;
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt;
}

function placeOrder($user_id, $data){
    global $conn;

    $name       = $data['name'];
    $number     = $data['number'];
    $email      = $data['email'];
    $method     = $data['method'];
    $address    = $data['address'];
    $placed_on  = date('d-M-Y');

    $cart_total = 0;
    $cart_products = [];

    $cart_query = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $cart_query->execute([$user_id]);

    if($cart_query->rowCount() > 0){
        while($item = $cart_query->fetch(PDO::FETCH_ASSOC)){
            $cart_products[] = $item['name'].' ( '.$item['quantity'].' )';
            $cart_total += ($item['price'] * $item['quantity']);
        }
    }

    if($cart_total == 0){
        return 'your cart is empty';
    }

    $total_products = implode(', ', $cart_products);

    $check_order = $conn->prepare(
        "SELECT * FROM orders 
         WHERE name = ? AND number = ? AND email = ? AND method = ? 
         AND address = ? AND total_products = ? AND total_price = ?"
    );
    $check_order->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

    if($check_order->rowCount() > 0){
        return 'order placed already!';
    }

    $insert_order = $conn->prepare(
        "INSERT INTO orders 
        (user_id, name, number, email, method, address, total_products, total_price, placed_on)
        VALUES (?,?,?,?,?,?,?,?,?)"
    );
    $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);

    $delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $delete_cart->execute([$user_id]);

    return 'order placed successfully!';
}
?>
