<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>首页</title>-->
<!--    <link href="../css/mystyle.css" rel="stylesheet">-->
<!--    <link href="../css/guide_style.css" rel="stylesheet">-->
<!--</head>-->
<?php
echo  <<<EOT
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
             <a href='../register.html'><span>Register</span></a>
             <a href='../login.html'><span>Login</span></a>
             <a id='collect' onclick="jump('Usercollect.php')"><span style="color: white">Collect</span></a>
        </div>
    </div>
</div>
<div id="breadcrumb"></div>
<hr/>
EOT
?>
