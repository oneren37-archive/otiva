<?php

global $conn;
require(dirname(__DIR__).'/utils/db_connection.php');
session_start();

$cats = [];
$stmt = $conn->prepare("SELECT * FROM category");
$stmt->execute();

while ($row = $stmt->fetch()) {
    array_push($cats, $row);
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/otiva">Отива</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    По категориям
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach ($cats as $cat): ?>
                        <li>
                            <a class="dropdown-item" href="/otiva/?cid=<?php echo($cat["cid"])?>">
                                <?php echo($cat["name"])?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                </li>
                <li class="nav-item">
                
                </li>
            </ul>
            <div class="user-nav">
                <?php if (isset($_SESSION['user_login'])):?>
                    <a href="./profile" class="nav-link"><?php echo($_SESSION["user_name"])?></a>
                    <a href="./logout" class="nav-link">Выйти</a>
                <?php else:?>
                    <a href="./auth" class="nav-link">Войти</a>
                <?php endif?>
            </div>

        </div>
    </div>
</nav>