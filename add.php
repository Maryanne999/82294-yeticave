<?php
require_once('functions.php');

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

//Валидация полей формы и проверка полей с цифрами
$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
$num_fields = ['lot-step', 'lot-rate'];
$errors = [];
$err_messages = [];
$file_url;

//Сохранение значений формы
$lot_name = $_POST['lot-name'] ?? '';
$avatar = $_POST['avatar'] ?? '';
$message = $_POST['message'] ?? '';
$lot_rate = $_POST['lot-rate'] ?? '';
$lot_step = $_POST['lot-step'] ?? '';
$lotDate = $_POST['lot-date'] ?? '';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
      if (in_array($key, $required) && $value === '') {
        $errors[] = $key;
        $err_messages[$key] = 'Обязательное поле';
		  continue;
      }
	  if(in_array($key, $num_fields) == true && is_numeric($value) == false) {
		  $errors[] = $key;
		  $err_messages[$key] = 'Введите целое положительное число';
	  }

   }
    //Загрузка и сохранение фото
    if (isset($_FILES['avatar'])) {
        $file_name = $_FILES['avatar'] ['name'];
        $file_path = __DIR__ . '/img/';
        $file_url = '/img/' . $file_name;

        move_uploaded_file($_FILES['avatar'] ['tmp_name'], $file_path . $file_name);
    }
    if (count($errors) == 0) {
        $content = renderTemplate(
            'lot',
            [
                'lot_name' => $lot_name,
                'avatar' => $avatar,
                'message' => $message,
                'lot_rate' => $lot_rate,
                'lot_step' => $lot_step,
                'lotDate' => $lotDate,
            ]
        );
    } else{
        $content = renderTemplate(
            'add-lot',
            [
                'categories' => $categories,
                'errors' => $errors,
                'err-messages' => $err_messages,
                'file_url' => $file_url
            ]
        );
    }
}
else {
    $content = renderTemplate(
        'add-lot',
        [
            'categories' => $categories,
            'errors' => $errors,
            'err_messages' => $err_messages,
            'file_url' => $file_url

        ]
    );
}

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