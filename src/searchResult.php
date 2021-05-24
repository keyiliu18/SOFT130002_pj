<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link href="css/mystyle.css" rel="stylesheet">
    <link href="css/guide_style.css" rel="stylesheet">
    <link href="./css/search.css" rel="stylesheet">
</head>
<body>
<?php
echo <<<EOF
<div class="home_header">
    <div class="home_left">
        <div style="font-size: 35px;color: whitesmoke;letter-spacing: 10px;text-align: left">Art Store</div>
        <div style="font-family: 'Copperplate Gothic Light',serif;letter-spacing: 5px;font-size: 16px;color: whitesmoke;text-align: left">Great art has always been the most decorative value.</div>
    </div>
    <div class="home_right">
        <div class='ribbon'>
            <a id='homepage' onclick="jump('homepage.php')"><span style="color: white">Home</span></a>
<!--            <a id='search' onclick="jump('search.html')"><span style="color: white">Search</span></a>-->
            <a href='./register.html'><span>Register</span></a>
            <a href='login.html'><span>Login</span></a>
            <a id='collect' onclick="jump('Usercollect.php')"><span style="color: white">Collect</span></a>
        </div>
    </div>
</div>
<div id="breadcrumb"></div>
<hr/>
EOF;

?>
<?php
include('php/config.php');

@$search_req =$_POST['search_req'];
@$search_type=$_POST['type'];
$length=$search_type?count($search_type):0;
$list = "SELECT * FROM artworks";
for($i=0;$i<$length;$i++){
    $lists[] = "($search_type[$i] LIKE '%".$search_req."%')";
//    echo $search_type[$i];
//    echo '</br>';
}
if($length>0) {
    $list_type = implode(" OR ", $lists);
    $list = "SELECT * FROM artworks WHERE " . $list_type;
}else{
    $list = "SELECT * FROM artworks  WHERE (title LIKE '%".$search_req."%') OR (artist LIKE '%".$search_req."%')OR (description LIKE '%".$search_req."%') ORDER BY `artworks`.`view` DESC";
}
$list=$list."ORDER BY `artworks`.`view` DESC";
echo $list.'</br>';
//$list = "SELECT * FROM artworks  WHERE (title LIKE '%".$search_req."%') OR (artist LIKE '%".$search_req."%') ORDER BY `artworks`.`view` DESC";
$result = mysqli_query($con,$list);
echo <<<EOF
<div class="container">
    <form action="" class="parent" method="post">
        <div class="searchTable" >
            <!--            <label><input type="radio" checked="checked"  name="item"/> Artist</label><br>-->
            <!--            <label><input type="radio" name="item" /> Art work</label><br>-->
          <label><input type="checkbox" name="type[]" value="artist" checked="checked"/>Artist</label><br>
            <label><input type="checkbox"name="type[]" value="title">Art work</label><br>
            <label> <input type="checkbox" name="type[]" value="description"/>Description</label>
        </div>

        <input type="text" name="search_req" class="search" autocomplete="off"
               placeholder="search..." id="myInput" onkeyup="filterFunction()"  onclick="myFunction()">
        <input type="submit" class="btn" value="search" >

    </form>
</div>
EOF;
//usort($domain_arr, function($a, $b) {
//    return $a->attribute< $b->attribute? 1 : -1;
//});
while ($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $author = $row['artist'];
    $text = $row['description'];
    $img_id = $row['artworkID'];
    $view = $row['view'];
    $price=$row['price'];
    echo <<<EOT
    <div class="introduce">
        <div class="introduce_item">
            <a href="show.php?q=$title"><img class="introduce_item_imgtest" src="./img/$img_id.jpg" alt=""></a>
            <span class="introduce_item_title">         
                <span class="introduce_item_name">$title</span>
                <span class="introduce_item_author">$author</span>
                 <span style="padding-top: 10px;padding-bottom:10px;color: #767676;word-spacing: 12px">view:$view  price:$price$</span>
                <span class="introduce_item_text">$text</span>            
                 <span class="introduce_item_more" style="text-align: left" ><a href="show.php?q=$title">LEARN MORE</a></span>
            </span>
    </div><hr/>
EOT;
}
echo <<<EOT
<div>
<div class="pagination">
    <span class="disabled" title="First">First</span>
    <span class="disabled" title="Prev"><</span>
    <span class="currentPage">1</span>
    <span>2</span>
    <span>3</span>
    <span>4</span>
    <span>5</span>
    <span>></span>
    <span title="Last">Last</span>
</div>
</div>
EOT;
mysqli_free_result($result);
?>
</body>
<script type="text/javascript"  src="js/crumb.js"></script>
