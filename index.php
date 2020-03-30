<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
    case 'login.php':
        require 'login.php';
        break;
    case '/main.php':
        require 'main.php';
        break;
    case '/name.php':
        require 'name.php';
        break;
    case '/password.php':
        require 'password.php';
        break;
    default:
        require 'login.php';
        break;
        //exit('Not Found');
}

?>