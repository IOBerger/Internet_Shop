<?php 
include 'config.php';
session_start();

function FormGoods($link,$userID){
    $query = "SELECT * FROM bucket, goods WHERE bucket.user_id=$userID AND goods.id=bucket.item_id ORDER BY goods.id";
    $result=mysqli_query($link, $query);
    if (!$result) {
        echo $query . '<br>';
        echo 'Ошибка доставания гудсов из базы данных!<br>';
        die();
    }
    $goods=[];
    while ($row = mysqli_fetch_assoc($result)){
        $goods[] = $row;
    }
//    print_r($goods);
    return $goods;
}
$goods=FormGoods($link,(int)$_SESSION['id']);

$goodsNumber = count($goods);
$tplSingle = file_get_contents('bucket_single.tpl');
for ($i = 0; $i < $goodsNumber; $i++) {
    $patterns = ['/{count}/','/{title}/', '/{price}/','/{img}/','/{id}/'];
    $replace = [$goods[$i]['count'],$goods[$i]['title'],$goods[$i]['price'],PATH_THUMB.$goods[$i]['image'],$goods[$i]['id']];
    $textBlockGoods .= preg_replace($patterns, $replace, $tplSingle);
}

$tpl = file_get_contents('bucket.tpl');
$menu = file_get_contents('menu.tpl');
$patterns = ['/{goods}/', '/{menu}/'];
$replace = [$textBlockGoods, $menu];
echo preg_replace($patterns, $replace, $tpl);


mysqli_close($link);