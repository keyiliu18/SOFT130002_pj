<?php
    $art = $_POST["artwork_id"];
    $u = $_POST["user"];
    if ($art && $u) {
        $sql = "INSERT INTO `wishlist` (`listID`, `userID`, `artworkID`) VALUES (NULL, $u ,$art)";
        if ($con->query($sql) === TRUE) {
            $success=true;
            echo '<script>alert(\'收藏成功\');</script>';
            echo '<script>document.getElementById(\'cButton\').value= "COLLECTED";</script>';
            echo '<script>document.getElementById(\'cButton\').className= "collected";</script>';
        } else {
            $success=false;
        }
    }else{$success=false;}


//$con->close();

