<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
</head>

<body>
    {menu}
    Мы рады вашим отзывам!<br><br>
    <form action="feedback.php" method="POST">
        <input type="text" placeholder="Введите имя" name="name">
        <br>
        <br>
        <textarea name="text" cols="30" rows="10" placeholder="Введите отзыв"></textarea>
        <br>
        <br>
        <input type="submit" value="Оставить отзыв!">
    </form>
    <hr>
    {feedback}
</body>

</html>