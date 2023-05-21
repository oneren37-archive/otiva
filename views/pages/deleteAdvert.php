<?php

global $conn;
require(dirname(__DIR__) . '/utils/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("DELETE FROM advert WHERE aid=:aid");
    $stmt->bindParam(':aid', $_POST["aid"]);
    $stmt->execute();
    echo($_POST["aid"]);
}