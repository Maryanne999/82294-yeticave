<?php
require_once('functions.php');
session_start ();

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];


if (!isset($_SESSION['user'])) {
	//header('HTTP/1.1 403 incorrect user');
   // echo 'Incorrect user';
	header(http_response_code(403));
}
else {

$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

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
$category = $_POST['category'] ?? '';




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
                'file_url' => $file_url,
                'required' => $required,
                'category' => $category,
                'bets' => $bets


            ]
        );
    } else{
        $content = renderTemplate(
            'add-lot',
            [
                'categories' => $categories,
                'errors' => $errors,
                'err_messages' => $err_messages,
                'lot_name' => $lot_name,
                'avatar' => $avatar,
                'message' => $message,
                'lot_rate' => $lot_rate,
                'lot_step' => $lot_step,
                'lotDate' => $lotDate,
                'file_url' => $file_url,
                'category' => $category
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
            'lot_name' => $lot_name,
            'avatar' => $avatar,
            'message' => $message,
            'lot_rate' => $lot_rate,
            'lot_step' => $lot_step,
            'lotDate' => $lotDate,
            'file_url' => $file_url,
            'category' => $category

        ]
    );
}

$layout_content = renderTemplate(
    'layout',
    [
        'title' => 'Yeti Cave — Добавление лота',
		'content' => $content,
        'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
        //'is_auth' => $is_auth,
        //'user_avatar' => $user_avatar,
        //'user_name' => $user_name
    ]
);
print($layout_content);
}
?>