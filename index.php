<?php
require_once ('connectvars.php');

//start the session
require_once ('startsession.php');

//插入header
$page_title = '主页';
require_once ('header.php');
require_once ('membernumber.php');

?>
<div class="columns">


    <div class="column is-one-third">
    <div class="content is-medium">
        <?php
        //如果已经登陆，显示登录成功信息
        if (isset($_SESSION['id'])) {
            echo('<p class="notification is-black">欢迎牛逼的' . $_SESSION['username'] . '回来！</p>');
        }
        ?>
        <figure class="image">
            <img  src="nb.jpeg">
        </figure>
        <p>目前已经有<strong><?php echo $member_number; ?>名</strong>同志获得了社交牛逼证。</p>
        <?php
        if (!isset($_SESSION['id'])) {
            echo('<p>快点<a href="sighup.php">加入</a>我们吧。</p>');
        }
        ?>

    </div>
    </div>

    <div class="column is-offset-2">
        <div class="content is-medium">
            <h2>为什么你需要社交牛逼证？</h2>
            <ul>
                <li> 你还在为社交自闭而烦恼吗?</li>
                <li>你还在为在海里捞过生日感到尴尬吗？</li>
                <li>你还在为没有要到漂亮小姐姐的微信而叹息吗？</li>
            </ul>
            <p>欢迎来报考社交牛逼证。</p>

            <p>本证书由官方认证，让你处处都牛逼。</p>

        </div>
    </div>


</div>





<?php

require_once ('footer.php')
?>
