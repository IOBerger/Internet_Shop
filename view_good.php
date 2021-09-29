<?php
include 'config.php';

function SelectGood($link, $id)
{
    $query = 'SELECT * FROM goods WHERE id=' . $id;
    $result = mysqli_query($link, $query);
    if (!$result) {
        echo $query . '<br>';
        echo 'Ошибка доставания гудса из базы данных!<br>';
    }
    $good = mysqli_fetch_assoc($result);
    return $good;
}

$good = SelectGood($link, (int) $_GET['id']);

$menu = file_get_contents('menu.tpl');

$tpl = file_get_contents('view_good.tpl');
$menu = file_get_contents('menu.tpl');
if(isset($_GET['result']))
    $result = ($_GET['result']) ? file_get_contents('result_success.tpl') : file_get_contents('result_fail.tpl');
$patterns = ['/{result}/', '/{menu}/', '/{id}/', '/{img}/', '/{title}/', '/{price}/', '/{info}/'];
$replace = [$result, $menu, $good['id'], PATH . $good['image'], $good['title'], $good['price'], $good['info']];
echo preg_replace($patterns, $replace, $tpl);


mysqli_close($link);
