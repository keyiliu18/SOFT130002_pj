<?php
    $art = $_POST["artwork_id"];
    $u = $_POST["user"];
    if ($art && $u && $u>0) {
        $sql = "INSERT INTO `wishlist` (`listID`, `userID`, `artworkID`) VALUES (NULL, $u ,$art)";
        if ($con->query($sql) === TRUE) {
            $success=true;
            echo '<script>alert(\'collect success\');</script>';
            echo '<script>document.getElementById(\'cButton\').value= "COLLECTED";</script>';
            echo '<script>document.getElementById(\'cButton\').className= "collected";</script>';
        } else {
            $success=false;
        }
    }else if($u && $u <0){
//        echo '<script>alert(\'please login!\');</script>';
        echo '<script>document.getElementById("NotLogin").innerText=\'please login!\';</script>';
    }
    else{$success=false;}


//$con->close();

