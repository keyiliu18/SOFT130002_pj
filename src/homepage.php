<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link href="css/mystyle.css" rel="stylesheet">
    <link href="css/guide_style.css" rel="stylesheet">
</head>
<body>
<div>
<?php include './components/header.php'?></div>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $num=3;$num_h=3;
    // 创建连接
    $conn = new mysqli($servername, $username, $password);
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    mysqli_select_db($conn,"artworks");
    $art_result = mysqli_query($conn,"SELECT * FROM artworks ORDER BY `artworks`.`timeReleased` DESC");
    $hot_art=mysqli_query($conn,"SELECT * FROM artworks ORDER BY `artworks`.`view` DESC");

    echo <<<EOT
<div class="home">
    <div class="content">
EOT;
while($row_h = mysqli_fetch_array($hot_art)) {
    $title_h = $row_h['title'];
    $author_h = $row_h['artist'];
    $text_h = $row_h['description'];
    $img_id_h = $row_h['artworkID'];
    writeName($title_h,$img_id_h, $text_h);
    $num_h--;
    if($num_h<=0)break;
    }
    echo <<<EOT
        <div class="left"> < </div>
        <div class="right"> > </div>
    </div>
EOT;
    while($row = mysqli_fetch_array($art_result)){
        $title = $row['title'];
        $author = $row['artist'];
        $text = $row['description'];
        $img_id=$row['artworkID'];
        $left_or_right=($num%2)?1:2;
        if($left_or_right == 1){
        echo <<<EOT
    <div class="introduce">
        <div class="introduce_item">
            <a href="show.php?q=$title"><img class="introduce_item_imgtest" src="./img/$img_id.jpg" alt=""></a>
            <span class="introduce_item_title_$left_or_right">
                <span class="introduce_item_name">$title</span>
                <span class="introduce_item_author">$author</span>
                <span class="introduce_item_text">$text</span>            
                 <span class="introduce_item_more" ><a href="show.php?q=$title">LEARN MORE</a></span>
            </span>
    </div>
EOT;
        }else{
            echo <<<EOT
    <div class="introduce">
        <div class="introduce_item">      
            <span class="introduce_item_title_$left_or_right">
                <span class="introduce_item_name">$title</span>
                <span class="introduce_item_author">$author</span>
                <span class="introduce_item_text">$text</span>
                <span class="introduce_item_more" ><a href="show.php?q=$title">LEARN MORE</a></span>
            </span>
             <a href="show.php?q=$title"><img class="introduce_item_imgtest" src="./img/$img_id.jpg" alt=""></a>
        </div>
EOT;
        }
        $num--;
        if($num<=0)break;
}
mysqli_free_result($art_result);
    ?>
<?php
function writeName($title_h,$img_h,$text_h)
{
    echo <<<EO
    
    <div class="introduce_hot">
    <a href="show.php?q=$title_h"><img src="img/$img_h.jpg" class="on" alt=""onclick="chosen('$title_h')"></a>
            <span class="introduce_item_title_hot">
            <span class="introduce_item_name">$title_h</span>
                <span class="introduce_item_text_hot">$text_h</span>            
            </span>
    </div>
EO;
}
?>
</div>
<footer style="font-size: 20px;text-align: center;padding-top: 20px">
    <div style="background-color: #708090;height: 60px">
        <p style="padding-top: 15px">Contact information:<a href="https://www.fudan.edu.cn/" style="text-decoration:none;
    color: #000000;">18307110471@fudan.edu.cn</a>.</p>
    </div>
</footer>
</body>
</html>
<script type="text/javascript"  src="js/crumb.js"></script>
<script type="text/javascript" src="js/homepage.js"></script>


