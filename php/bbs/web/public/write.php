<?php
require_once(__DIR__ . '/../app/src/libs/Db.php');

ob_start();
session_start();

$params = ['title', 'body', 'name', 'delete_password'];
$form_data = [];
foreach ($params as $param) {
    $form_data[$param] = strval($_POST[$param] ?? '');
}
$form_data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
$form_data['from_ip'] = $_SERVER['REMOTE_ADDR'];

$error = [];
if ('' === $form_data['body']) {
    $error["is_content_empty"] = true;
}

if ([] !== $error) {
    $_SESSION['flash']['error'] = $error;
    $_SESSION['flash']['form_data'] = $form_data;
    header('Location: /');
    exit;
}

try {
    $dbh = Db::getHandle();
    $sql = '
        INSERT INTO bbses
                    (name,
                    title,
                    body,
                    user_agent,
                    from_ip,
                    delete_password,
                    created_at)
        VALUES     (:name,
                    :title,
                    :body,
                    :user_agent,
                    :from_ip,
                    :delete_password,
                    :created_at);
    ';

    $stmt = $dbh -> prepare($sql);

    foreach ($form_data as $k => $v) {
        $stmt -> bindValue(":{$k}", $v);
    }
    $stmt -> bindValue(':created_at', date(DATE_ATOM), PDO::PARAM_STR);
    $stmt -> execute();
    $stmt -> closeCursor();
} catch (Throwable $e) {
    echo $e -> getMessage();
    $_SESSION['flash']['message']['is_failed'] = true;
    $_SESSION['flash']['form_data'] = $form_data;
    header('Location: /');
    exit;
}

$_SESSION['flash']['message']['is_success'] = true;
header('Location: /');
