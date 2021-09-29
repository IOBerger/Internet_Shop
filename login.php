<?php

include 'config.php';

session_start();
$salt = "gu4lbg3";

if(!empty($_POST)){

$login = (!empty($_POST['login'])) ? strip_tags($_POST['login']) :"";
$pass = (!empty($_POST['pass'])) ? $salt.md5(strip_tags($_POST['pass'])).$salt :"";

$sql = "select id from users where login = '$login' and password = '$pass'";

$res = mysqli_query($link,$sql) or die("Error: ".mysqli_error($link));


if(mysqli_num_rows($res) == 1){
    $row = mysqli_fetch_assoc($res);

    $_SESSION['login'] = $login;
    $_SESSION['pass'] = $pass;
    $_SESSION['id'] = $row['id'];
    echo 'Вход успешно выполнен, id установлен'.$_SESSION['id'];
}else{
    echo 'Ошибка входа';
}
}
include 'menu.tpl';

?>

<form action="#" method="post">
    <p>Введите логин</p>
    <input type="text" name="login" value="<?=$_SESSION['login']?>">
    <p>Введите пароль</p>
    <input type="password" name="pass" value="<?=$_SESSION['pass']?>"><br><br>
    <input type="submit" value="Войти">
</form>