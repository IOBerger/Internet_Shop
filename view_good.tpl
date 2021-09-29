<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр товара</title>
</head>

<body>
    {menu}
    {result}
    <img src="{img}" alt="">
    <br>
    <h1>{title}</h1>
    <b>Стоит {price} рублей</b>
    <br>
    {info}
    <form action="buy.php?id={id}&from=view_good" method="POST">
        <input type="submit" value="Купить" name="buy">
    </form>


</body>

</html>