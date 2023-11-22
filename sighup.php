<?php
//start the sesion
require_once ('startsession.php');

//插入header
$page_title = '注册';
require_once ('header.php');

require_once ('connectvars.php');
?>

    <div class="column is-offset-0">
        <p>据小道消息透露，使用2-3字的中文汉字作为用户名可以更牛逼一些。</p>
<?php
    //链接数据库
    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
    or die('连接数据库错误');

    if(isset($_POST['submit'])){
        //从post取得用户资料
        $username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc,trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc,trim($_POST['password2']));

        if (!empty($username) && !empty($password1) && !empty($password2) && $password1==$password2) {
            //检查用户名是否重复
            $query = "SELECT * FROM user WHERE username = '$username'";

            $data = mysqli_query($dbc, $query);
            if (mysqli_num_rows($data) == 0) {
                //用户资料写入数据库

                $query = "INSERT INTO user (username,password) VALUES ('$username',SHA('$password2'))";
                mysqli_query($dbc,$query);


                $query = "SELECT id FROM user WHERE username = '$username'";
                $data = mysqli_query($dbc, $query);
                $data_row = mysqli_fetch_array($data);
                $_SESSION['id'] = $data_row['id'];
                $_SESSION['username'] = $username;

                //用户确认信息
                echo '<p>你成功注册了我们的网站，现在可以开始<a href="addnbc.php">申请证书了</a>。</p>';

                mysqli_close($dbc);
                exit(); //为啥？

            }
            else {
                //用户名重复时
                echo '<p class="notification is-danger">这个名字有人用了，换一个吧。</p>';
                $username = "";
            }
        }

        else{
            echo '<p class="notification is-danger">所有信息都要填写，而且两次密码要一样才行。</p>';

        }

    }
    mysqli_close($dbc); //为什么又关闭一次数据库？ 20210814（收到一束花），如果没有点提交也关闭数据库
    ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="field">
                <p class="control has-icons-left ">
                    <input class="input" type="text" id="username" name="username" placeholder="用户名"
                           value="<?php if(!empty($username))echo $username; ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                     </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password" id="password1" name="password1" placeholder="密码"
                           value="<?php if(!empty($password1))echo $password1; ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password" id="password2" name="password2" placeholder="确认密码"
                           value="<?php if(!empty($password2))echo $password2; ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <input type="submit" name="submit" value="注册" class="button" >
                </p>
            </div>


        </form>
    </div>

<?php
//插入页脚
require_once ('footer.php');
?>