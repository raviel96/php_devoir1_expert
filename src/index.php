<?php 
require_once "../vendor/autoload.php";
require_once "functions/config.php";

use Twig\Environment;
use App\classes\Database;
use Twig\Loader\FilesystemLoader;

$database = new Database($host, $user, $password, $dbname);
$pdo = Database::connexion($host, $user, $password, $dbname);

$database->insertData($pdo);

$loader = new FilesystemLoader('templates/');
$twig = new Environment($loader, [
    'cache' => false,
]);

echo $twig->render('index.html.twig', ['name' => 'Fabien']);