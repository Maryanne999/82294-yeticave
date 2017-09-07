<?php
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

require_once('functions.php');


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
$ads = [
	[
		'name' => '2014 Rossignol District Snowboard',
		'categories' => 'Доски и лыжи',
		'price' => '10999',
		'url' => 'img/lot-1.jpg'
	],
	[
		'name' => 'DC Ply Mens 2016/2017 Snowboard',
		'categories' => 'Доски и лыжи',
		'price' => '159999',
		'url' => 'img/lot-2.jpg'
	],
	[
		'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
		'categories' => 'Крепления',
		'price' => '8000',
		'url' => 'img/lot-3.jpg'
	],
	[
		'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
		'categories' => 'Ботинки',
		'price' => '10999',
		'url' => 'img/lot-4.jpg'
	],
	[
		'name' => 'Куртка для сноуборда DC Mutiny Charocal',
		'categories' => 'Одежда',
		'price' => '7500',
		'url' => 'img/lot-5.jpg'
	],
	[
		'name' => 'Маска Oakley Canopy',
		'categories' => 'Разное',
		'price' => '5400',
		'url' => 'img/lot-6.jpg'
	]
];

$content = renderTemplate(
    'templates/index.php',
    [
        'categories' => $categories,
        'ads' => $ads,
        'lot_time_remaining' => $lot_time_remaining
    ]
);
$layout_content = renderTemplate(
    'templates/layout.php',
    [
        'title' => 'Yeti Cave — Главная',
		'content' => '$content',
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name' => $user_name,
        'content' => $content
    ]
);
print($layout_content);
?>