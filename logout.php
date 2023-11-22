<?php

//如果用户登陆了，删除会话
//进入会话
session_start();

if (isset($_SESSION['id'])) {
    //通过清除session array内容清除会话变量
    $_SESSION = array();

    //清除会话cookie
    if (isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-3600);
    }
    //结束会话
    session_destroy();
}

//清除cookies
setcookie('id', '' ,time()-3600);
setcookie('username','',time()-3600);

//跳转回主页

$home_url =  'http://' .  $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
header('Location:' . $home_url);

?>