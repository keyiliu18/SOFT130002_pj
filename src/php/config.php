<?php
$con = mysqli_connect('localhost', 'root', '123456');
if ($con->connect_error) {
    die("连接失败: " . $con->connect_error);
}
mysqli_select_db($con,"artworks");
mysqli_set_charset($con, "utf8");
?>
