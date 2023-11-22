<?php
//start the sesion
require_once ('startsession.php');

//插入header
$page_title = '申请成功';
require_once ('header.php');

require_once ('connectvars.php');


$id = $_SESSION['id'];
$duration = $_POST['duration'];
$agree = $_POST['agree'];


//如果duration不为空查询现有duration


if ($agree) {

    if (!empty($duration)) {

                //链接数据库
                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                //取得现有enddate
                $query1 = "SELECT enddate , startdate FROM user WHERE  id = '$id'";
                $data = mysqli_query($dbc, $query1);
                $data_row = mysqli_fetch_array($data);
                $enddate = $data_row['enddate'];
                $startdate = $data_row['startdate'];


                $query1 = "UPDATE user SET startdate =  NOW(), enddate =IF(ISNULL(enddate),DATE_ADD(NOW(), INTERVAL '$duration' DAY),DATE_ADD(enddate , INTERVAL '$duration' DAY)), duration = duration + '$duration'  WHERE id = '$id' ";
                mysqli_query($dbc, $query1)  or die('连接数据库错误1');



        //查找该用户的添加时间
        $query2 = "SELECT username, startdate, enddate FROM user WHERE id= '$id'";
        $data = mysqli_query($dbc,$query2)or die('连接数据库错误2');
        $data_row = mysqli_fetch_array($data);

        $startdate = $data_row['startdate'];
        $enddate = $data_row['enddate'];
        $username = $data_row['username'];


       // ob_clean();

        $image = imagecreatefrompng('certificate.png');         // 证书模版图片文件的路径
        $black = imagecolorallocate($image,0,0,0);     // 字体颜色
        // GD 用の環境変数を設定します
        putenv('GDFONTPATH=' . realpath('.'));

        // 使用するフォント名を指定します (拡張子 .ttf がないことに注目しましょう)
        $font_kanji = 'kanji';
        $font_alphabet = 'alphabet';

// imageTTFText("Image", "Font Size", "Rotate Text", "Left Position","Top Position", "Font Color", "Font Name", "Text To Print");
        imageTTFText($image, 190, 0, 900, 1700, $black, $font_kanji,$username);
        if ($enddate > "2100-1-1") {
            imageTTFText($image, 70, 0, 1100, 2200, $black, $font_kanji,"终身");
        }else{
        imageTTFText($image, 70, 0, 980, 2200, $black, $font_alphabet,$enddate);}
        imageTTFText($image, 50, 0, 530, 2950, $black, $font_alphabet,$startdate);



        /* If you want to display the file in browser */
        //header('Content-type: image/png');
       // imagepng($image);


        /* if you want to save the file in the web server */
        $filename = 'certificates/certificate' . $id . '.png';
        chmod($filename,0777);
        imagepng($image, $filename);
        imagedestroy($image);




        //提示用户添加成功
        echo '<div class="notification is-black">';
        switch ($duration) {
            case 1:
                $show_duration = "1天";
                break;
            case 30:
                $show_duration = "1个月";
                break;
            case 90:
                $show_duration = "3个月";
                break;
            case 365:
                $show_duration = "1年";
                break;
            case 3650:
                $show_duration = "10年";
                break;
            case 36500:
                $show_duration = "终身";
                break;

        }



                echo '<p>成功申请了有效期限为<strong>'. $show_duration .'</strong>的社交牛逼证</p></div>';
                echo '<p><a href="checknbc.php">查看我的证书</a></p>';



                //清除数据清除表单
                $duration = "";


                mysqli_close($dbc);


    }
    else{
        echo '<p class="notification is-warning">请选择申请时长</p>';


}} else {
    echo '<p class="notification is-warning">必须要确认已经捐赠了相应的农作物</p>';
    echo '<a href="addnbc.php" class="button">返回</a></p>';
}


//插入页脚
require_once ('footer.php');
