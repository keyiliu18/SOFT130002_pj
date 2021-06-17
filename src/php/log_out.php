<?php
header('Content-Type: application/json;charset=utf-8');
//$out =json_decode(file_get_contents('php://input'));
//$result=array();
session_start();
//  这种方法是将原来注册的某个变量销毁

 unset($_SESSION['userLogin']);
 unset($_SESSION['userName']);
 echo 'success';


