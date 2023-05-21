<?php

global $conn;
require(dirname(__DIR__).'/utils/db_connection.php');
session_start();

$loginError = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $stored_password = $row ? $row['password'] : "";

    if($password == $stored_password) {
        $_SESSION['user_login'] = $row["login"];
        $_SESSION['user_name'] = $row["name"];
        $_SESSION['user_uid'] = $row["uid"];
        $_SESSION['user_role'] = $row["role"];

        header("Location: /otiva");
        exit();
    } else {
        $loginError = "Неверные учетные данные";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./auth.css">
    <title>Авторизация</title>
    <style>
        .form-container {
            width: 200px;
            padding-top: 100px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Логин</label>
                <input type="text" class="form-control" name="login">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input  name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button><br/>
            <?php if ($loginError) echo $loginError?>
            <a href="/otiva/reg">Зарегистрироваться</a>
        </form>
    </div>
</body>
</html>