<?php
@include '../Controller/config.php';

function sendContactMessage($user_id, $name, $email, $number, $msg){
    global $conn;

    $select_message = $conn->prepare(
        "SELECT * FROM message WHERE name = ? AND email = ? AND number = ? AND message = ?"
    );
    $select_message->execute([$name, $email, $number, $msg]);

    $insert_message = $conn->prepare(
        "INSERT INTO message (user_id, name, email, number, message) VALUES (?,?,?,?,?)"
    );
    $insert_message->execute([$user_id, $name, $email, $number, $msg]);

    return 'sent message successfully!';
}
?>
