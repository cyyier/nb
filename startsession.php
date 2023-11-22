<?php
session_start();

//如果没有设置会话，尝试使用cookie
if(!isset($_SESSION['id'])) {
    if(isset($_COOKIE['id']) && isset($_COOKIE['username'])) {
        $_SESSION['id'] = $_COOKIE['id'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}


?>