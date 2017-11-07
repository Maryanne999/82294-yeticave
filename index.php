<?php
$is_auth = (bool) rand(0, 1);


$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

require_once('functions.php');
require_once('lots_array.php');

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
$lot_time_remaining = $tomorrow - $now;
// задание 5
$lot_time_remaining = date("H:i", $lot_time_remaining);

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

$content = renderTemplate(
    'index',
    [
        'categories' => $categories,
        'ads' => $ads,
        'lot_time_remaining' => $lot_time_remaining
    ]
);
$layout_content = renderTemplate(
    'layout',
    [
        'title' => 'Yeti Cave — Главная',
		'content' => $content,
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name' => $user_name
    ]
);
print($layout_content);
?>