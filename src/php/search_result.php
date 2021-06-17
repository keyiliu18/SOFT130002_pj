<?php
//header('Content-type:text/json;charset=utf-8');
include('config.php');
include('search_sort.php');
$search_req =isset($_POST['search_req'])?$_POST['search_req']:'';
$order=isset($_POST['order'])?$_POST['order']:'';
$success = $_POST['registration'];
$search_type=isset($_POST['type'])?$_POST['type']:[];
$current_page=isset($_POST['page'])?$_POST['page']:1;
$length = $search_type ? count($search_type):0;
$show=array();
$pagesize=5;
$page_right=$current_page + $pagesize;
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
$total_result = mysqli_query($con,$list);
if(!mysqli_fetch_row($total_result)){
    echo 'no result';
    $list = "SELECT * FROM artworks";
    $total_result = mysqli_query($con,$list);
}
switch ($order){
    case 'view,desc':$list=$list." ORDER BY artworks.view DESC";break;
    case 'price,desc':$list=$list." ORDER BY artworks.price DESC";break;
    case 'view,asc':$list=$list." ORDER BY artworks.view ASC";break;
    case 'price,asc':$list=$list." ORDER BY artworks.price ASC";break;
    default:break;
}
$total_num=mysqli_num_rows($total_result);
$max_page=ceil($total_num/$pagesize);
if($current_page <1) {
    $page=1;
}
if($current_page>$max_page) {
    $page=$max_page;
}
$limit=" LIMIT ".($current_page-1)*$pagesize.",".$pagesize;
$list=$list.$limit;
echo $list."</br>";
$result = mysqli_query($con,$list);

    while ($row = mysqli_fetch_array($result)) {
        $price = $row['price'];
        $view = $row['view'];
        $show[] = $row;
    }
    if (count($show)==0) {
        echo 'no result';
        require_once('all_artwork.php');
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
echo <<<EOT
  <li > TOTAL:$total_num PAGE NUM:$max_page CURRENT PAGE:$current_page </li >
<div>
<ul class="pagination" id="pagination">
<input type="hidden" id="order" value=$order>
<input type="hidden" id="currentPage" value=$current_page>
EOT;
if($current_page === 1){
    echo "<li><a style='opacity: 50%;pointer-events: none'>&laquo;</a></li>";
}else {
    echo "<li><a onclick=changePage(-2)>&laquo;</a></li>";
}
if($current_page <=$pagesize){
    for($i = 1;$i <= $pagesize && $i<=$max_page;$i++) {
        echo "<li><a onclick=changePage($i) >$i</a></li >";
    }
}else if($max_page-$current_page<=5) {
    for ($i = $max_page-$pagesize; $i <= $max_page;$i++) {
        echo "<li><a onclick=changePage($i) >$i</a></li >";
    }
}else{
    for($i = $current_page;$i <= $page_right && $i<=$max_page;$i++) {
        echo "<li><a onclick=changePage($i) >$i</a></li >";
    }
}
if($current_page >= $max_page) {
    echo "  <li ><a style='opacity: 50%;pointer-events: none'>&raquo;</a ></li >";
}else{
    echo "  <li ><a onclick=changePage(-1)>&raquo;</a ></li >";
}
echo "</ul><br>";

