<?php
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('连接数据库失败');
$query = "SELECT id FROM user WHERE duration != 0  ";
$data = mysqli_query($dbc, $query) or die('数据库查询失败');

$member_number = mysqli_num_rows($data);
?>


