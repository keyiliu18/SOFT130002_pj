<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>collect</title>
    <link href="./css/guide_style.css" rel="stylesheet">
    <link href="./css/user_collect.css" rel="stylesheet">
</head>
<body>
<div><?php include './components/header.php'?></div>
<?php
include('php/config.php');
if (isset($_SESSION["userName"])){
    $user =$_SESSION["userName"];
}else{
    $user ="";
    header("Location: login.html");
}

mysqli_select_db($con,"artworks");
$user_msg="SELECT * FROM users WHERE name = '$user'";
$user_result = mysqli_query($con,$user_msg);
$user_row = mysqli_fetch_array($user_result);
$user_ID=$user_row['userID'];
$username = $user_row['name'];
$email = $user_row['email'];
$tel = $user_row['tel']?$user_row['tel']:'——';
$address = $user_row['address'];
$balance=$user_row['balance'];
$list="SELECT * FROM wishlist WHERE userID = '$user_ID'";
$result = mysqli_query($con,$list);
echo '<div class="back">';
echo '    <div class="containerLeft">';
while($row = mysqli_fetch_array($result))
{
    $art_id=$row['artworkID'];
    $list_id=$row['listID'];
    $collection="SELECT * FROM artworks WHERE artworkID = '".$art_id."'";
    $result2 = mysqli_query($con,$collection);
    while($wish_row = mysqli_fetch_array($result2)) {
        $title = $wish_row['title'];
        $author = $wish_row['artist'];
        $text = $wish_row['description'];
        $img_id = $wish_row['artworkID'];
        $timeReleased =$wish_row['timeReleased'];
        echo <<<EOF

        <div class="introduce_item" id="intro$list_id">      
           <a href="show.php?q=$title"><img class="introduce_item_imgtest" src="./img/$art_id.jpg" alt=""></a>
            <span class="introduce_item_title">
                <span class="introduce_item_name">$title</span>
                <span class="introduce_item_author">$author</span>
                   <span style="text-align: right;padding-right: 20px">Released time:$timeReleased</span>
                <span class="introduce_item_text">
                   $text
               </span>
                <div style="display: flex">
                    <span class="introduce_item_more"> <a href="show.php?q=$title">Details</a></span>
                        <span class="introduce_item_delete">
                         <form action="" method="post" onsubmit="return comf('$title')">             
                        <input type="hidden" name='listID' value=$list_id>    
                        <input type="hidden" name='showID' value='intro$list_id'>        
                        <input type="hidden" name='userID' value=$user_ID>                            
                        <input type="submit" value="DELETE" onclick="myFunction('$title')">
                    </form>                   
                    </span>
                </div>
            </span>
        </div>
      
EOF;
        require('php/collection_delete.php');
    }
}
echo'</div>';
mysqli_free_result($result);



echo<<<EOF
    <div class="containerRight">
        <div style="margin-top: 50px;position: fixed">
            <div class="introduce_page">
                <a><img class="userImg" src="./imgElements/userImg.jpg" alt=""></a>
                <span class="userInfo"><b>name: </b>$username</span>
                <hr/>
                <span class="userInfo"><b>id: </b>$user_ID</span>
                <hr/>
                <span class="userInfo"><b>email: </b>$email</span>
                <hr/>
                 <span class="userInfo"><b>tel: </b>$tel</span>
                <hr/>
                  <span class="userInfo"><b>balance: </b>$balance</span>
                <hr/>
<!--                <div style="text-align: center;padding-top: 10px;padding-bottom: 10px">-->
<!--                    <input type="button" value=" more information " class="button" ></div>-->
            </div>
        </div>
    </div>
</div>

</body>
EOF;

?>

</html>
<script type="text/javascript"  src="js/crumb.js"></script>
<script>
    function comf(name){
        var person=confirm("是否删除 "+name +"的收藏？");
        return person === true;
    }
    function  myFunction(val){
        console.log(val);
    }
</script>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
