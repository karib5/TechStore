<?php
    require_once('config.php');

    function getProductsByCategory($category_name){
        global $conn;

        $sql = "SELECT * FROM products WHERE category = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$category_name]);

        return $stmt;
    }
?>
