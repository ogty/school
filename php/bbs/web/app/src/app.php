<?php
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/libs/Bbs.php');

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

ob_start();
session_start();

$page = @intval($_GET['page'] ?? 1);
if (0 >= $page) {
    $page = 1;
}

$bbses = Bbs::getList($page);
foreach ($bbses as &$bbs) {
    $bbs['created_at'] = date('Y/m/d H:i:s', strtotime($bbs['created_at']));
}

$number_of_bbses = count($bbses);
if ($number_of_bbses === (Bbs::NUMBER_OF_DISPLAYS + 1)) {
    array_pop($bbses);
    $is_next_page = true;
} else {
    $is_next_page = false;
}

$previous_page = $page - 1;
$next_page = $page + 1;

$error = $_SESSION['flash']['error'] ?? [];
$form_data = $_SESSION['flash']['form_data'] ?? [];
$message = $_SESSION['flash']['message'] ?? [];

unset($_SESSION['flash']);
$context = [
    'bbses' => $bbses,
    'error' => $error,
    'message' => $message,
    'now_page' => $page,
    'next_page' => $next_page,
    'form_data' => $form_data,
    'is_next_page' => $is_next_page,
    'previous_page' => $previous_page,
    'number_of_bbses' => $number_of_bbses,
];

echo $twig -> render('index.twig', $context);
