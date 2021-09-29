<?php 
include 'config.php';

function FormGoods($link){
    $query = 'SELECT * FROM goods ORDER BY id';
    $result=mysqli_query($link, $query);
    if (!$result) {
        echo $query . '<br>';
        echo 'Ошибка доставания гудсов из базы данных!<br>';
    }
    $goods=[];
    while ($row = mysqli_fetch_assoc($result)){
        $goods[] = $row;
    }
    return $goods;
}

$goods=FormGoods($link);

$goodsNumber = count($goods);
$tplSingle = file_get_contents('goods_single.tpl');
for ($i = 0; $i < $goodsNumber; $i++) {
    $patterns = ['/{title}/', '/{price}/','/{img}/','/{id}/'];
    $replace = [$goods[$i]['title'],$goods[$i]['price'],PATH_THUMB.$goods[$i]['image'],$goods[$i]['id']];
    $textBlockGoods .= preg_replace($patterns, $replace, $tplSingle);
}

$tpl = file_get_contents('goods.tpl');
$menu = file_get_contents('menu.tpl');
if(isset($_GET['result']))
    $result = ($_GET['result']) ? file_get_contents('result_success.tpl') : file_get_contents('result_fail.tpl');
$patterns = ['/{result}/','/{goods}/', '/{menu}/'];
$replace = [$result,$textBlockGoods, $menu];
echo preg_replace($patterns, $replace, $tpl);


mysqli_close($link);