<?php
//搜索结果排序
function my_sort_view($oba, $obb){

        return ($oba['view'] <= $obb['view']) ? 1 : -1;

}
function my_sort_price($oba, $obb){

    return ($oba['price'] <= $obb['price']) ? 1 : -1;

}
function my_sort_view_asc($oba, $obb){

    return ($oba['view'] >= $obb['view']) ? 1 : -1;

}
function my_sort_price_asc($oba, $obb){

    return ($oba['view'] >= $obb['view']) ? 1 : -1;

}
//echo $order;
