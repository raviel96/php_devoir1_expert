<?php 
require_once "../vendor/autoload.php";
require_once "functions/config.php";

use Twig\Environment;
use App\Model\Database;
use Twig\Loader\FilesystemLoader;

// Connexion
$database = new Database();
$pdo = Database::connexion($host, $user, $password, $dbname);


$database->insertSchoolData($pdo);
$database->insertSportData($pdo);
$database->insertStudentData($pdo);

$schoolList = $database->getSchoolData($pdo);
$sportList = $database->getSportData($pdo);


// Twig
$loader = new FilesystemLoader('View/');
$twig = new Environment($loader, [
    'cache' => false,
]);

echo $twig->render('index.html.twig', ['name' => 'Fabien']);