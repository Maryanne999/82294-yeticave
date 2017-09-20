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

//Сохранение значений формы
$lot-name = $_POST['lot-name'] ?? '';
$avatar = $_POST['avatar'] ?? '';
$message = $_POST['message'] ?? '';
$lot-rate = $_POST['lot-rate'] ?? '';
$lot-step = $_POST['lot-step'] ?? '';
$lotDate = $_POST['lot-date'] ?? '';

//Вывод ошибок
$rules = [
	'category' => 'valid_category',
	'lot-rate' => 'valid_number',
	'lot-step' => 'valid_number',
	'lot-date' => 'valid_date',
	'message' => 'valid_message',
	'avatar' => 'valid_avatar'
];

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
	  if (in_array($key, array_keys($rules))) {
        $result = $rules[$key];

        if (!$result) {
          $errors[] = $key;

          switch ($rules[$key]) {
            case 'valid_category':
              $err_message[$key] = 'Выберите категорию';
              break;
            case 'valid_number':
              $err_message[$key] = 'Введите целое положительное число';
              break;
            case 'valid_date':
              $err_message[$key] = 'Формат даты: дд.мм.гггг.';
              break;
			case 'valid_message':
              $err_message[$key] = 'Введите описание лота';
              break;
			case 'valid_avatar':
              $err_message[$key] = 'Загрузите фото. Размер не должен превышать 2мб';
              break;
          }
        }
   }
}
}

//Загрузка и сохранение фото
if (isset($_FILES['avatar'])) {
	$file_name = $_FILES['avatar'] ['name'];
	$file_path = __DIR__ . '/img/';
	$file_url = '/img/' . $file_name;

	move_uploaded_file($_FILES['avatar'] ['tmp_name'], $file_path . $file_name);
}

//Dfkblfwbz ajhvs
$content = renderTemplate(
    'add-lot',
    [
        'categories' => $categories,
		'errors' => $errors,
		'err-messages' => $err-messages
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