<?
require_once('functions.php');

session_start();


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
        'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka',
    ],
    [
        'email' => 'kitty_93@li.ru',
        'name' => 'Леночка',
        'password' => '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa',
    ],
    [
        'email' => 'warrior07@mail.ru',
        'name' => 'Руслан',
        'password' => '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW',
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

	if(!empty($_POST)) {
		$email = $_POST['email'];
	    $password = $_POST['password'];
		if ($user = searchUserByEmail($email, $users)) {
	if (password_verify($password, $user['password'])) {
		$_SESSION['user'] = $user;
		header("Location: /index.php");
		 	}
		}
	}
}

//echo $_SESSION['user'];


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
        'email' => $email,
        'password' => $password,
        'users' => $users
        //'is_auth' => $is_auth,
        //'user_avatar' => $user_avatar,
        //'user_name' => $user_name
    )
);
print($layout_content);
?>