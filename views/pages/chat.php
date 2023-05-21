<?php

global $conn;
require(dirname(__DIR__).'/utils/db_connection.php');
session_start();

$messages = [];

if (!isset($_GET["aid"]) || !isset($_GET["u"]) || !isset($_SESSION["user_uid"])) {
    header("Location: /otiva");
    exit();
}

$stmt = $conn->prepare("CALL messages_by_aid(".$_GET["aid"].")");
$stmt->execute();

while ($row = $stmt->fetch()) {
    array_push($messages, [
        "author" => $row["name"],
        "text" => $row["text"]
    ]);
}

$stmt = $conn->prepare("CALL get_advert(".$_GET["aid"].")");
$stmt->execute();

$advert = $stmt->fetch();

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style><?php include(dirname(__DIR__).'\css\common.css');?></style>
    <title>Чат</title>
</head>
<body>
    <?php include(dirname(__DIR__).'\components\header.php');?>
    <div class="page-wrapper">
        <div class="row">
            <div class="col-md-6 align-center">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex position-relative">
                            <?php if ($advert["img"] != ""): ?>
                            <div class="card-img-small">
                                <img src="<?php echo($advert["img"])?>" class="flex-shrink-0 me-1" alt="Товар">
                            </div>
                            <?php endif;?>
                            <div>
                                <a href="/otiva/advert?aid=<?php echo($_GET["aid"])?>" class="stretched-link"><h5 class="mt-0"><?php echo($advert["title"])?></h5></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-auto" style="height: 500px;">
                        <?php foreach ($messages as $message): ?>
                            <div class="message">
                                <div class="user">
                                    <b><?php echo($message['author'])?></b>
                                </div>
                                <div class="text">
                                    <?php echo($message['text'])?>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer">
                        <form id="message-form">
                            <div class="form-group">
                                <label for="message">Сообщение:</label>
                                <input type="text" class="form-control" id="message">
                            </div>
                            <hr/>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendMessage(e) {
            e.preventDefault();
            const t = document.querySelector("#message").value;

            fetch('/otiva/send-message', {
                method: 'post',
                body: new URLSearchParams({
                    aid: <?php echo($_GET["aid"])?>,
                    sender: <?php echo($_SESSION["user_uid"])?>,
                    receiver: <?php echo($_GET['u'])?>,
                    text: t
                }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            })
                .then(() => {
                    const container = document.querySelector('.card-body')
                    const newMessage = document.createElement('div');
                    newMessage.classList.add('message');
                    newMessage.innerHTML = `<div class="user"><b><?php echo($_SESSION["user_name"])?></b></div>
                                            <div class="text">${t}</div>`
                    container.appendChild(newMessage)
                    container.appendChild(document.createElement('hr'))
                    document.querySelector("#message").value = ""
                })
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('#message-form').addEventListener('submit', sendMessage)
        })
    </script>
</body>
</html>