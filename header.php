<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        echo '<title>社交牛逼证书网 -' . $page_title . '</title>';
    ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script>
        //导航菜单
        document.addEventListener('DOMContentLoaded', () => {

            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Check if there are any navbar burgers
            if ($navbarBurgers.length > 0) {

                // Add a click event on each of them
                $navbarBurgers.forEach( el => {
                    el.addEventListener('click', () => {

                        // Get the target from the "data-target" attribute
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);

                        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');

                    });
                });
            }

        });
        //点击关闭提示信息
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                $notification = $delete.parentNode;

                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
</head>
<body>

<nav class="container">

    <nav class="navbar is-black" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
                <?php
                echo '<p>社交牛逼证书网-</p>';
                echo '<p>' . $page_title . '</p>';
                ?>
            </a>


            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>



        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <?php
                //生成菜单
                if (isset($_SESSION['id'])) {
                    echo '<a class="navbar-item" href="checknbc.php">查看我的证书</a>';
                    echo '<a class="navbar-item" href="addnbc.php">申请新证书</a>';
                    //echo '<a class="navbar-item" href="logout.php">登出</a>';
                }



                ?>

            </div>
            <div class="navbar-end">
                <?php
                //生成菜单
                if (isset($_SESSION['id'])) {

                    echo '<a class="navbar-item" href="logout.php">登出</a>';
                }
                else {
                    echo '<a class="navbar-item" href="sighup.php">注册</a>';
                    echo '<a class="navbar-item" href="login.php">登录</a>';
                }




                ?>
            </div>

    </nav>





    <section class="section">

        <div class="container">
