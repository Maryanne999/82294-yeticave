<?php
require_once('functions.php');

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

//Валидация полей формы и проверка полей с цифрами
$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
$num_fields = ['lot-step', 'lot-rate'];
$errors = [];
$err_message = [];
$invalid_message = "Заполните это поле, пожалуйста";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
      if (in_array($key, $required) && $value === '') {
        $errors[] = $key;
        $err_messages[$key] = 'Обязательное поле';
      }
	  if(in_array($key, $num_fields) == true && is_numeric($value) == false) {
		  $errors[$key] = "Значение должно быть целым положительным числом";
	  }
   }
}

//Загрузка и сохранение фото
if (isset($_FILES['avatar'])) {
	$file_name = $_FILES['avatar'] ['name'];
	$file_path = __DIR__ . '/img/';
	$file_url = '/img/' . $file_name;

	move_uploaded_file($_FILES['avatar'] ['tmp_name'], $file_path . $file_name);
	print("<a href='$file_url'>$file_name</a>");
}

//Dfkblfwbz ajhvs
$content = renderTemplate(
    'add-lot',
    [
        'categories' => $categories
    ]
);
$layout_content = renderTemplate(
    'layout',
    [
        'title' => 'Yeti Cave — Добавление лота',
		'content' => $content,
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name' => $user_name
    ]
);
print($layout_content);
?>