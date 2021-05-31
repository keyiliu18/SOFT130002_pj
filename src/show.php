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
<?php
include './components/header.php'?>
</div>
<?php
error_reporting(E_ALL & ~E_NOTICE);
$con = mysqli_connect('localhost', 'root', '123456');
$q = $_GET["q"];
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con, "artworks");
mysqli_set_charset($con, "utf8");
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
$user='1';
while($wish_row = mysqli_fetch_array($result2)){
if($wish_row) {
    if($wish_row['userID'] ==='1'){//如果是当前登录用户
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
                        <input type="hidden" name='user' value=$user>
                        <input type="hidden" name='artwork_id' value=$art_id>
                        <input type="submit" value=$collect_mag class="button" id="cButton">
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
</script>
<script type="text/javascript" >
    // collected=function (s){
    //     document.getElementById('cButton').className="collected";
    //     document.getElementById('cButton').value= "COLLECTED";
    //     console.log(s);
    // }
</script>
<script type="text/javascript" src="js/crumb.js"></script>



