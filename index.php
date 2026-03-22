<?php

function fib($n) {
    if ($n == 0 || $n == 1) {
        return 1;
    }

    return fib($n - 1) + fib($n - 2);
}

$origPrice = 100;
$price = $origPrice * 1.3;
$stock = 100000;

$initDate = '2021-01-13';

$startDate = DateTime::createFromFormat('Y-m-d', $initDate);

$date = $_GET['date'] ?? $initDate;
$date = DateTime::createFromFormat('Y-m-d', $date);

if (!$date) {
    exit('Неверный формат даты');
}

if ($date < $startDate) {
    exit("Дата не может быть раньше, чем $initDate");
}

$days = $date->diff($startDate)->days;

$left = $stock;
for ($day = 0; $day <= $days; $day++) {
    $left -= fib($day);
}

if ($left <= 0) {
    exit('Недостаточно товаров на складе');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="GET">
    <input type="date" name="date">
    <button type="submit">Применить</button>
</form>

<div>
    Остаток на складе: <?php echo $left ?>
    <br>
    Текущая цена товара: <?php echo $price ?>
</div>

</body>
</html>
