<?php

global $conn;
require(dirname(__DIR__).'/utils/db_connection.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("call crate_message (:aid, :sender, :receiver, :text)");
    $stmt->bindParam(':aid', $_POST["aid"]);
    $stmt->bindParam(':sender', $_POST["sender"]);
    $stmt->bindParam(':receiver', $_POST["receiver"]);
    $stmt->bindParam(':text', $_POST["text"]);

    if ($stmt->execute()) {
        echo "Сообщение отправилось";
    } else {
        echo "Произошла ошибка при выполнении запроса!";
    }
}