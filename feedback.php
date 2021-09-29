<?php

include 'config.php';

function AddFeedback($link,$row)
{
    $name=htmlspecialchars($row['name']);
    $text=htmlspecialchars($row['text']);
    $text=nl2br($text);
    $query = 'INSERT INTO feedback (name,text) 
    VALUES ("' . $name . '","' . $text.'")';
    if (!mysqli_query($link, $query)) {
        echo $query . '<br>';
        echo 'Ошибка добавления отзыва в базу данных!<br>';
    }
}

function FormFeedback($link){
    $query = 'SELECT * FROM feedback ORDER BY id';
    $result=mysqli_query($link, $query);
    if (!$result) {
        echo $query . '<br>';
        echo 'Ошибка доставания отзывов из базы данных!<br>';
    }
    $feedback=[];
    while ($row = mysqli_fetch_assoc($result)){
        $feedback[] = $row;
    }
    return $feedback;
}

if (!empty($_POST)) {
    AddFeedback($link,$_POST);
}

$feedback=FormFeedback($link);


$postsNumber = count($feedback);

$tplSingle = file_get_contents('feedback_single.tpl');

for ($i = 0; $i < $postsNumber; $i++) {
    $name = $feedback[$i]['name'];
    $text = $feedback[$i]['text'];
    $patterns = ['/{name}/', '/{text}/'];
    $replace = [$name, $text];
    $textBlockFeedback .= preg_replace($patterns, $replace, $tplSingle);
}

$tpl = file_get_contents('feedback.tpl');
$menu = file_get_contents('menu.tpl');
$patterns = ['/{feedback}/', '/{menu}/'];
$replace = [$textBlockFeedback, $menu];
echo preg_replace($patterns, $replace, $tpl);


mysqli_close($link);
