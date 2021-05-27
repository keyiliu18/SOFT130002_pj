<?php
include('config.php');
$username=isset($_POST['username'])?$_POST['username']:'';
$password=isset($_POST['password'])?$_POST['password']:'';
$email=isset($_POST['email'])?$_POST['email']:'';
$list = "SELECT * FROM users WHERE name = '".$username."'";

$result = mysqli_query($con,$list);

$row = mysqli_fetch_array($result);
if($row ==null){
    $new_user = "INSERT INTO users (`userID`, `name`,  `password`,`email`, `tel`, `address`, `balance`)
 VALUES (NULL ,'".$username."', '".$password."', '".$email."','','','0')";

    if ($con->query($new_user) === TRUE) {
        echo "success register";
    } else {
        echo "Error: " . $new_user . "<br>" . $con->error;
    }
}else {
    echo 'exist';
}
//echo $username.','.$password.','.$email;
