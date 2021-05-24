<?php
function outArt($artName){
    echo '$artName';
}
$servername = "localhost";
$username = "root";
$password = "123456";
$num=3;
$q=$_GET["q"];

// 创建连接
$conn = new mysqli($servername, $username, $password);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
//echo "连接成功";
mysqli_select_db($conn,"artworks");
$art_result = mysqli_query($conn,"SELECT * FROM artworks ORDER BY `artworks`.`view` DESC");
//echo "<br />";

while($row = mysqli_fetch_array($art_result))
{
    echo $row['title'] . "--" . $row['artist']."--".$row['view'];
    echo "<br />";
    $num--;
    if(!$num)break;
}
mysqli_free_result($art_result);


?>
