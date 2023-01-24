<?php
declare(strict_types=1);

require_once(__DIR__ . '/../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv -> load();

class Db {

    public static function getHandle() {
        $user = $_ENV['MYSQL_USER'];
        $pass = $_ENV['MYSQL_PASSWORD'];
        $host = $_ENV['MYSQL_HOST'];
        $dbname = $_ENV['MYSQL_DATABASE'];
        $charset = $_ENV['MYSQL_CHARSET'];

        static $dbh = null;
        if (null === $dbh) {
            try {
                $data_source_name = "mysql:host=$host;dbname=$dbname;charset=$charset";
                $option = [
                    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ];
                $dbh = new PDO($data_source_name, $user, $pass, $option);
            } catch(Throwable $e) {
                echo $e -> getMessage();
                exit;
            }
        }
        return $dbh;
    }
}
