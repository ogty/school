<?php
require_once(__DIR__ . '/../app/src/libs/Bbs.php');

ob_start();
session_start();

$bbs_id = @strval($_POST['bbs_id'] ?? '');
$delete_password = @strval($_POST['delete_password'] ?? '');
if (($bbs_id === '') || ($delete_password === '')) {
    header('Location: ./');
    exit;
}

$comment = Bbs::find($bbs_id);
if ($comment === false) {
    header('Location: /');
    exit;
}

if ($comment['delete_password'] !== $delete_password) {
    $_SESSION['flash']['message']['is_delete_failed'] = true;
    header('Location: /');
    exit;
}

Bbs::delete($bbs_id);

$_SESSION['flash']['message']['is_delete_success'] = true;
header('Location: /');
