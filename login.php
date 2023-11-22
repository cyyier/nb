<?php
require_once ('connectvars.php');



//清除错误消息变量
$error_msg = "";
session_start();
//判断用户是否登录
if (!isset($_SESSION['id'])) {
    //查看是否已经登录，没有登录时检查是否已提交登陆数据
    if (isset($_POST['submit'])) {

        //连接数据库
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('连接数据库失败');

        //取得用户登陆数据
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

        if (!empty($username) && !empty($password)) {
            //取得数据库中的用户名和密码
            $query = "SELECT id,username FROM user WHERE username = '$username' AND password = SHA('$password') ";
            $data = mysqli_query($dbc, $query) or die('数据库查询失败');

            if (mysqli_num_rows($data) == 1) {
                //登录OK设置用户id等信息
                $row = mysqli_fetch_array($data);
                //会话信息
                $_SESSION['id'] =  $row['id'];
                $_SESSION['username'] =  $row['username'];
                //cookie信息
                setcookie('id', $row['id'],time() + (60*60*24*30)); //30天
                setcookie('username',$row['username'],time() + (60*60*24*30)); //30天

                //自动跳转至主页
                $home_url =  'http://' .  $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
                header('Location:' . $home_url);
            }
            else {
                //用户名或密码错误设置错误信息
                $error_msg = '用户名或密码错误。';
            }

        }
        else{
            //没有输入用户名和密码
            $error_msg = '必须要输入用户名和密码。';
        }

    }
}
?>

<?php

//插入header
$page_title = '登录';
require_once ('header.php');

?>
<?php
//如果cookie为空，提示错误信息
if (!isset($_SESSION['id'])) { //这里可能不对
    echo '<p>' . $error_msg . '</p>';
    //这里的大括号在下一个php语句里
    ?>
    <div class="column is-offset-0">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="field">
                <p class="control has-icons-left ">
                    <input class="input" type="text" id="username" name="username" placeholder="用户名"
                           value="<?php if (!empty($username)) echo $username; ?>">
                    <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
             </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password" id="password" name="password" placeholder="密码"
                           value="<?php if (!empty($password)) echo $password; ?>">
                    <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <input type="submit" name="submit" value="登录" class="button">
                </p>
            </div>
        </form>
    </div>

    <?php
}
else {


//跳转回主页

    $home_url =  'http://' .  $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
    header('Location:' . $home_url);

}

?>


<?php
//插入页脚
require_once ('footer.php');
?>


