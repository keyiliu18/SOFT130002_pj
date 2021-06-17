<?php
include('config.php');
$list = "SELECT * FROM `artworks` ORDER BY `artworks`.`view` DESC".$limit;
$result = mysqli_query($con, $list);
while ($row = mysqli_fetch_array($result)) {
    $price = $row['price'];
    $view = $row['view'];
    $show[] = $row;
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

