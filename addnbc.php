<?php
//start the sesion
require_once ('startsession.php');

//插入header
$page_title = '申请证书';
require_once ('header.php');


require_once ('connectvars.php');

$id = $_SESSION['id'];
$force = $_GET['force'];

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //取得现有enddate
    $query1 = "SELECT enddate , startdate FROM user WHERE  id = '$id'";
    $data = mysqli_query($dbc, $query1);
    $data_row = mysqli_fetch_array($data);
    $enddate = $data_row['enddate'];
    $startdate = $data_row['startdate'];


    //如果当天已经申请过则不能再申请

if($id){
    if (!$force && strtotime($startdate) == strtotime(date("Y-m-d"))){
    echo '<div class="notification is-warning">';
    echo '<p>每日只能申请一次新证书。</p></div>';
    echo '<p><a href="index.php" class="button ">返回</a>';
    echo '     <a href="addnbc.php?force=true" class="button is-warning">强行申请</a></p>';
        } else if ($enddate > "2100-1-1"){
        //如果已经有终身证书不能再申请
            echo '<div class="notification is-warning">';
            echo '<p>您已经有了终身证书，不需要再申请证书了。</p></div>';
            echo '<a href="checknbc.php" class="button is-black">返回</a>';
        } else{
        if($force){
            echo '<div class="notification is-warning">';
        echo '<p>请注意！强行一日申请多次可能会导致大量脱发！</p></div>';}

    ?>
        
        <div class="columns">
            <div class="column is-two-thirds">
                <div class="content">
                <h4 class="title is-4">请确保您已经向社交牛逼协会进行过捐赠，否则可能会变秃。</h4>
                <table>
                    <thead>
                    <tr>
                        <th>时长</th>
                        <th>捐赠要求</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1天</td>
                        <td>一个鸡蛋</td>
                    </tr>
                    <tr>
                        <td>1个月</td>
                        <td>一筐鸡蛋</td>
                    </tr>
                    <tr>
                        <td>3个月</td>
                        <td>1只鸡</td>
                    </tr>
                    <tr>
                        <td>1年</td>
                        <td>3只鸡</td>
                    </tr>
                    <tr>
                        <td>10年</td>
                        <td>1头牛</td>
                    </tr>
                    <tr>
                        <td>终身</td>
                        <td>5头牛</td>
                    </tr>
                    </tbody>
                </table>
                </div>

            </div>
            <div class="column">
                <form enctype="multipart/form-data" method="post" action="nbcsuccess.php">

                    <label class="label" for="duration">申请时长：</label>
                    <div class="select ">
                        <select id="duration" name="duration">
                            <option value=1>1天</option>
                            <option value=30>1个月</option>
                            <option value=90>3个月</option>
                            <option value=365>1年</option>
                            <option value=3650>10年</option>
                            <option value=36500>终身</option>

                        </select>
                    </div>
                    <hr/>
                    <div>
                    <label class="checkbox">
                        <input type="checkbox" name="agree">
                        我已经捐赠了相应的农作物。
                    </label>
                    </div>

            <input class="button is-black" type="submit" value="申请" name="submit"/>
            <a href="index.php" class="button">返回</a></p>

            </form>
            </div>

        </div>


    <?php


}
}else{
    echo '<div class="notification is-warning">';
    echo '<p>请先登录。</p></div>';
    echo '<p><a href="index.php" class="button ">返回</a>';
}
//插入页脚
require_once ('footer.php');
?>