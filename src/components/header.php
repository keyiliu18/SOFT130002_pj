<?php
//  防止全局变量造成安全隐患
$admin = false;
//  启动会话，这步必不可少
session_start();
$meg='Login';
$login_fuc="<a href='./login.html'><span>$meg</span></a>";
//  判断是否登陆
if (isset($_SESSION["userLogin"]) && $_SESSION["userLogin"] === true){
    $meg ='LogOut';
    $login_fuc="<a href='' onclick='logout()'><span>$meg</span></a>";
}else{
    $meg='Login';
}
    echo <<<EOT
<!--<div class="home_header">-->
<div class="home_header">
    <div class="home_left">
        <div style="font-size: 35px;color: whitesmoke;letter-spacing: 10px;text-align: left">Art Store</div>
        <div style="font-family:'Copperplate Gothic Light',serif;letter-spacing: 5px;font-size: 16px;color: whitesmoke;text-align: left">Great art has always been the most decorative value.</div>
    </div>
    <div class="home_right">
         <div class="ribbon">
             <a id='homepage' onclick="jump('homepage.php')"><span style="color: white">Home</span></a>
             <a id='search' onclick="jump('search.html')"><span style="color: white">Search</span></a>
             <a href='./register.html'><span>Register</span></a>
                $login_fuc
<!--             <a href='./login.html'><span>$meg</span></a>-->
             <a id='collect' onclick="jump('Usercollect.php')"><span style="color: white">Collect</span></a>
        </div>
    </div>
</div>
<div id="breadcrumb"></div>
<hr/>
EOT;

?>
