<?php
include './components/header.php'?>
<?php
if(isset($_GET["q"])){
    $_SESSION['art'] = $_GET["q"];
    $q = $_GET["q"];
}else{
    $q = $_SESSION['art'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>display</title>
    <link href="css/mystyle.css" rel="stylesheet">
    <link href="css/guide_style.css" rel="stylesheet">
    <link href="css/show.css" rel="stylesheet">
</head>
<body>
<div>
</div>
<?php
include('php/config.php');
error_reporting(E_ALL & ~E_NOTICE);
//$q = $_GET["q"];
$sql="SELECT * FROM artworks WHERE title = '".$q."'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$title = $row['title'];
$author = $row['artist'];
$text = $row['description'];
$img_id=$row['artworkID'];
$description=$row['description'];
$genre=$row['genre'];
$yearOfWork=$row['yearOfWork'];
$art_id=$row['artworkID'];
$view=$row['view'];
mysqli_query($con,"UPDATE artworks SET view = $view+1 WHERE title= '".$q."'");
    //查找收藏清单
$wish="SELECT * FROM wishlist WHERE artworkID = '".$art_id."'";
$result2 = mysqli_query($con,$wish);
$collect_mag="COLLECT";
$success=false;
if (isset($_SESSION["userName"])) {
    $user = $_SESSION["userName"];
    $user_msg="SELECT * FROM users WHERE name = '$user'";
    $user_result = mysqli_query($con,$user_msg);
    $user_row = mysqli_fetch_array($user_result);
    $user_ID=$user_row['userID'];
}else{
    $user = "";
    $user_ID = -1;
}

while($wish_row = mysqli_fetch_array($result2)){
if($wish_row) {
    if($user_ID>0 && $wish_row['userID'] == $user_ID){//如果是当前登录用户
    $collect_mag="COLLECTED";
    break;
    }
}
}

echo <<<EOT
<div class="back">
    <div class="blockLeft">
         <div style="background: #e3e3e3">
        
             <span style="position: center;font-size: 25px;word-spacing:6px;padding-top: 20px;padding-bottom: 20px">
                $title
             </span>
            <span style="position: center;font-size: 20px; padding-top: 10px;padding-bottom: 20px;font-family:'cursive',serif;">$author</span>
             <span style="padding-top: 15px;padding-bottom:20px;color: #767676">view:$view</span>
        </div>
        <img src="./img/$img_id.jpg" alt="" style="text-align: center; padding-top: 60px" >
    </div>
    <div class="blockRight">
            <div style="justify-content: center;margin-top: 100px">
                <div class="introduce_page">
                    <div style="padding-bottom:20px;font-size:30px;letter-spacing: 10px;text-align: center">$genre</div>
                    <hr/>
                    <span style="padding-top: 15px;padding-bottom:15px;font-size: 16px ">
                     $description</span>
                    <hr/>
                    <span style="padding-top: 15px;padding-bottom:20px ">$yearOfWork</span>
                    <hr/>
                    <div style="text-align: center;padding-top: 10px">
                    <div style="text-align: center;padding-top: 10px;padding-bottom: 10px">
                    <form action="" method="post">
                        <input type="hidden" name='user' value=$user_ID>
                        <input type="hidden" name='artwork_id' value=$art_id>
                        <input type="submit" value=$collect_mag class="button" id="cButton">
                        <div id="NotLogin" style="color: #970800"></div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
EOT;
if($collect_mag==="COLLECT") {
    require_once('php/collect.php');
}
mysqli_close($con);
?>
</body>
</html>
<script type="text/javascript"  src="js/crumb.js"></script>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>

