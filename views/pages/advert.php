<?php

global $conn;
require(dirname(__DIR__).'/utils/db_connection.php');
session_start();

if (!isset($_GET["aid"])) {
    header("Location: /otiva");
    exit();
}

$stmt = $conn->prepare("CALL get_advert(".$_GET["aid"].")");
$stmt->execute();

$advert = $stmt->fetch();
$isMy = isset($_SESSION["user_uid"]) && $_SESSION["user_uid"] == $advert["uid"];

$chats = [];
if ($isMy) {
    $stmt = $conn->prepare("call get_chats({$_GET["aid"]}, {$_SESSION["user_uid"]});");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        array_push($chats, $row);
    }
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo($advert["img"])?>" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-6">

                <h1><?php echo($advert["title"])?></h1>
                <p><?php echo($advert["description"])?></p>
                <p>Цена: <?php echo($advert["price"])?></p>

                <?php if (!$isMy): ?>
                <a href="/otiva/chat?aid=<?php echo($advert["aid"])?>&u=<?php echo($advert["uid"])?>"
                   type="button"
                   class="btn btn-lg btn-primary"
                >Связаться с продавцом</a></br>
                <?php else: ?>
                <button
                        type="button"
                        class="btn btn-lg btn-secondary"
                        onclick="deleteAdvert(<?php echo($_GET["aid"])?>)"
                >
                    Товар продан
                </button>
                <?php endif; ?>

                <?php if ($isMy): ?>
                    <h1 class="mt-5">Чаты</h1>
                    <ul class="list-group col-4">
                        <?php if (count($chats) == 0) echo("Вам пока еще никто не написал")?>
                        <?php foreach ($chats as $chat): ?>
                            <li class="list-group-item">
                                <a href="/otiva/chat?aid=<?php echo($advert["aid"])?>&u=<?php echo($advert["uid"])?>">
                                    <?php echo($chat["name"]) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include(dirname(__DIR__).'\components\editAdvert.php');?>


    <script>
        function deleteAdvert(aid) {
            fetch('/otiva/delete-advert', {
                method: 'post',
                body: "aid="+aid,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            })
                .then(() => {
                    window.location.replace("/otiva/");
                })
        }
    </script>
</div>
</body>
</html>
