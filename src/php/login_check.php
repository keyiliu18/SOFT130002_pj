<?php
include('config.php');
$username=isset($_POST['username'])?$_POST['username']:'';
$password=isset($_POST['password'])?$_POST['password']:'';
$list = "SELECT * FROM users WHERE name = '".$username."' AND password = '".$password."'";

$result = mysqli_query($con,$list);

$row = mysqli_fetch_array($result);
if($row !==null){
    //  当验证通过后，启动 Session
    session_start();
    //  注册登陆成功的user信息
    $_SESSION["userLogin"] = true;
    $_SESSION["userName"] ="$username";
        echo "success";
    } else {
        echo "wrong username or password";
    }
