<?php
phpinfo();
//
//require_once realpath(__DIR__ . '/vendor/autoload.php');
//
//// Looing for .env at the root directory
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
//$dotenv->load();
//
//
//if(isset($_GET['url'])) {
//    $url = $_GET['url'];
//} else {
//    $url = 'home';
//}
//
//switch ($url) {
//    case 'home':
//        include './views/pages/home.php';
//        break;
//    case 'auth':
//        include './views/pages/auth.php';
//        break;
//    case 'reg':
//        include './views/pages/reg.php';
//        break;
//    case 'advert':
//        include './views/pages/advert.php';
//        break;
//    case 'chat':
//        include './views/pages/chat.php';
//        break;
//    case 'logout':
//        include './views/pages/logout.php';
//        break;
//    case 'profile':
//        include './views/pages/profile.php';
//        break;
//    case 'delete-advert':
//        include './views/pages/deleteAdvert.php';
//        break;
//    case 'send-message':
//        include './views/pages/sendMessage.php';
//        break;
//    default:
//        include './views/pages/404.php';
//        break;
//}