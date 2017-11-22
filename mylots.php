<?php
require_once('functions.php');
session_start ();



$content = renderTemplate(
    'mylots',
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
        'title' => 'Yeti Cave — Мои ставки',
        'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    )
);
print($layout_content);
?>
