<?
require_once('add-form.php');
require_once('functions.php');

//Функция для проверки e-mail
function validateEmail($value) {
	return filter_var($value, FILTER_VALIDATE_EMAIL);
}

//Функция поиска пользователя по email
function searchUserByEmail($email, $users) {
	$result = null;
	foreach ($users as $user) {
		if ($user['email'] == $email) {
			$result = $user;
			break;
		}
	}
	return $result;
}


//Получает хэш пароля
$passwordHash = password_hash('password', PASSWORD_DEFAULT);

$required = ['email', 'password'];
$rules = ['email' => 'validateEmail'];
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];
$err_messages = [];


// Пользователи для аутентификации
$users = [
    [
        'email' => 'ignat.v@gmail.com',
        'name' => 'Игнат',
        'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
    ],
    [
        'email' => 'kitty_93@li.ru',
        'name' => 'Леночка',
        'password' => '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'
    ],
    [
        'email' => 'warrior07@mail.ru',
        'name' => 'Руслан',
        'password' => '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW'
    ]
];

//Валидация полей формы

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if (in_array($key, $required) && $value === '') {
            $errors[] = $key;
            $err_messages[$key] = 'Обязательное поле';
            continue;
        }
		if (in_array($key, $rules)) {
			$result= call_user_func('validateEmail', $value);
			if (!result) {
				$eerrors[] = $key;
			}
		}
    }
	session_start();

	if(!empty($_POST)) {
		$email = $_POST['email'];
	    $password = $_POST['password'];
		}
	if (password_verify($password, $users['password'])) {
		$_SESSION['user'] = $user;
		header("Location: index.php");
	}

}

echo $_SESSION['user'];


$content = renderTemplate(
        'add-form',
        [
        'email' => $email,
		'password' => $password,
		'users' => $users,
		'required' => $required,
		'rules' => $rules,
        'errors' => $errors,
        'err_messages' => $err_messages
        ]
    );

$layout_content = renderTemplate(
    'layout',
    array(
        'title' => 'Yeti Cave — Форма входа',
		'content' => $content,
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name' => $user_name
    )
);
print($layout_content);
?>