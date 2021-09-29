<img src="{img}" alt="">
<br>
<h3><a href="view_good.php?id={id}">{title}</a></h3>
Стоит {price} рублей
<br>
Количество в корзине: {count}
<br>
<form action="buy.php?id={id}&from=goods" method="POST">
    <input type="submit" value="Купить" name="buy">
</form>
<hr>