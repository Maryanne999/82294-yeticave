<?php
require_once('functions.php');

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

$content = renderTemplate(
    'add',
    [
        'categories' => $categories,
        'errors' => $errors,
        'lot_time_remaining' => $lot_time_remaining
		'Заполните это поле' => $default_error_text;
        'Введите число' => $num_error_text;
        'form__item--invalid' => $default_error_class;
		'Пожалуйста, исправьте ошибки в форме' => $form__error;
		'Шаг ставки' => $step_rate;
		'Начальная цена' => $starting_price
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

//Проверка отправки формы и значений
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	foreach ($_POST as $key => $value) {
		print("Поле $key со значением $value")
	}
}
//Сохранение переданной фотографии
if (isset($_FILES['avatar'])) {
	$file_name = $_FILES ['avatar'] ['name'];
	$file_path = _DIR_ . '/img/' ;
	$file_url = 'img' $file_name;

	move_uploaded_file($_FILES['avatar'] ['tmp_name'], $file_path . $file_name);
	print("<a href='$file_url'>$file_name</a>");}
<?php
