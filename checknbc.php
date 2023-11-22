<?php

require_once ('connectvars.php');

//start the session
require_once ('startsession.php');

//插入header
$page_title = '查看我的证书';
require_once ('header.php');
require_once ('membernumber.php');



if (isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    //链接数据库
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //取得现有enddate
    $query1 = "SELECT enddate  FROM user WHERE  id = '$id'";
    $data = mysqli_query($dbc, $query1);
    $data_row = mysqli_fetch_array($data);
    $enddate = $data_row['enddate'];
    if (!$enddate) {
        echo '<div class="notification is-warning">';
        echo '<p>您还没有申请过证书，请<a href="addnbc.php">申请证书</a>。</p>';
    }else if (strtotime($enddate) < strtotime(date("Y-m-d"))) {
        echo '<div class="notification is-warning">';
        echo '<p>您的证书已经过期，请重新申请新证书。</p>';

    }else{

    echo '<img src="certificates/certificate'. $id .'.png">';}
}else {
    echo '<div class="notification is-warning">';
    echo '<p>必须要先<a href="sighup.php" >登录</a>才能查看证书。</p>';
}









//插入页脚
require_once ('footer.php');
