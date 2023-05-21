<?php

global $conn;
require(dirname(__DIR__).'/utils/db_connection.php');
session_start();

$adverts = [];

if (isset($_GET["cid"])) {
    $stmt = $conn->prepare("CALL adverts_by_cat(".$_GET["cid"].")");
} else {
    $stmt = $conn->prepare("SELECT * FROM home_view");
}
$stmt->execute();

while ($row = $stmt->fetch()) {
    array_push($adverts, $row);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style><?php include(dirname(__DIR__).'\css\common.css');?></style>
    <title>Otiva</title>
</head>
<body>
    <?php include(dirname(__DIR__).'\components\header.php');?>
    <div class="page-wrapper">
        <?php
            if (count($adverts) == 0) echo ("Тут пока ничего нет");
            include(dirname(__DIR__).'\components\layout\cards.php');
        ?>

    </div>
</body>
</html>
