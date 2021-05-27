<?php
//header('Content-type:text/json;charset=utf-8');
$q = $_POST['registration'];
$search_type=$_POST['type'];
//$length = $search_type ? count($search_type):0;
//$show=array();
//
//$list = "SELECT * FROM artworks";
//for($i=0;$i<$length;$i++){
//    $lists[] = "($search_type[$i] LIKE '%".$search_req."%')";
//}
//if($length>0) {
//    $list_type = implode(" OR ", $lists);
//    $list = "SELECT * FROM artworks WHERE " . $list_type;
//}else{
//    $list = "SELECT * FROM artworks  WHERE (title LIKE '%".$search_req."%') OR (artist LIKE '%".$search_req."%')OR (description LIKE '%".$search_req."%') ORDER BY `artworks`.`view` DESC";
//}
//$list=$list."ORDER BY `artworks`.`view` DESC";
echo $q;
echo $search_type;
