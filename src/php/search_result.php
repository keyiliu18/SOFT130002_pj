<?php
//header('Content-type:text/json;charset=utf-8');
include('config.php');
include('search_sort.php');
$search_req =isset($_POST['search_req'])?$_POST['search_req']:'';
$order=isset($_POST['order'])?$_POST['order']:'';
$success = $_POST['registration'];
$search_type=isset($_POST['type'])?$_POST['type']:[];
$length = $search_type ? count($search_type):0;
$show=array();

$list = "SELECT * FROM artworks";
for($i=0;$i<$length;$i++){
    $lists[] = "($search_type[$i] LIKE '%".$search_req."%')";
}
if($length>0) {
    $list_type = implode(" OR ", $lists);
    $list = "SELECT * FROM artworks WHERE " . $list_type;
}else{
    $list = "SELECT * FROM artworks  WHERE (title LIKE '%".$search_req."%') OR (artist LIKE '%".$search_req."%')OR (description LIKE '%".$search_req."%') ORDER BY `artworks`.`view` DESC";
}
$list=$list."ORDER BY `artworks`.`view` DESC";
$result = mysqli_query($con,$list);
if(!$result){
    echo 'no result';
    require_once('all_artwork.php');
}
    while ($row = mysqli_fetch_array($result)) {
        $price = $row['price'];
        $view = $row['view'];
        $show[] = $row;
    }
    if (count($show)==0) {
        echo 'no result';
        require_once('all_artwork.php');
    }
    //对结果排序
    switch ($order){
        case 'view,desc':usort($show,'my_sort_view');break;
        case 'price,desc':usort($show,'my_sort_price');break;
        case 'view,asc':usort($show,'my_sort_view_asc');break;
        case 'price,asc':usort($show,'my_sort_price_asc');break;
        default:break;
    }
    for ($i = 0; $i < count($show); $i++) {
        $row = $show[$i];
        $title = $row['title'];
        $author = $row['artist'];
        $text = $row['description'];
        $img_id = $row['artworkID'];
        $view = $row['view'];
        $price = $row['price'];
        echo <<<EOT
    <div class="introduce">
        <div class="introduce_item">
            <a href="show.php?q=$title"><img class="introduce_item_imgtest" src="./img/$img_id.jpg" alt=""></a>
            <span class="introduce_item_title">
                <span class="introduce_item_name">$title</span>
                <span class="introduce_item_author">$author</span>
                 <span style="padding-top: 10px;padding-bottom:10px;color: #767676;word-spacing: 12px">view:$view  price:$price$</span>
                <span class="introduce_item_text">$text</span>
                 <span class="introduce_item_more" style="text-align: left" ><a href="show.php?q=$title">LEARN MORE</a></span>
            </span>
    </div><hr/>
EOT;
    };


