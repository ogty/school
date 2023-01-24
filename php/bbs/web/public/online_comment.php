<?php
require_once(__DIR__ . '/../app/src/libs/Db.php'); //
require_once(__DIR__ . '/../app/src/libs/Bbs.php');

ob_start();
session_start();

$bbs_id = intval($_POST['bbs_id'] ?? 0);
$comment = strval($_POST['comment'] ?? '');
$now_page = intval($_POST['now_page'] ?? 1);

$errors = [];
if ('' === $comment) {
    $errors['is_comment_empty'] = true;
}

$bbs = Bbs::find($bbs_id);
if ($bbs === false) {
    $errors['is_bbs_id_invalid'] = true;
    header('Location: /?page=' . rawurldecode($now_page) . '#id_' . $bbs_id);
    exit;
}

if ([] !== $errors) {
    $_SESSION['flash']['errors'] = $errors;
    header('Location: /?page=' . rawurldecode($now_page) . '#id_' . $bbs_id);
    exit;
}

$data = [
    'bbs_id' => $bbs_id,
    'comment' => $comment,
    'from_ip' => $_SERVER['REMOTE_ADDR'],
    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
];

try {
    $dbh = Db::getHandle();
    $sql = '
        INSERT INTO online_comments
                    (bbs_id,
                    comment_body,
                    user_agent,
                    from_ip,
                    created_at)
        VALUES     (:bbs_id,
                    :comment,
                    :user_agent,
                    :from_ip,
                    :created_at);
    ';

    $stmt = $dbh -> prepare($sql);

    foreach ($data as $k => $v) {
        $stmt -> bindValue(":{$k}", $v);
    }
    $stmt -> bindValue(':created_at', date(DATE_ATOM), PDO::PARAM_STR);
    $stmt -> execute();
    $stmt -> closeCursor();
} catch (Throwable $e) {
    echo $e -> getMessage();
    $_SESSION['flash']['message']['is_comment_failed'] = true;
    header('Location: /?page=' . rawurldecode($now_page) . '#id_' . $bbs_id);
    exit;
}

$_SESSION['flash']['message']['is_comment_success'] = true;
header('Location: /?page=' . rawurldecode($now_page) . '#id_' . $bbs_id);
