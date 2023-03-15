<?php 
require_once "../vendor/autoload.php";
require_once "functions/config.php";

use Twig\Environment;
use App\classes\Database;
use Twig\Loader\FilesystemLoader;

// Connexion
$database = new Database($host, $user, $password, $dbname);
$pdo = Database::connexion($host, $user, $password, $dbname);


$database->insertDataIntoSchool($pdo);
$schoolList = $database->getSchoolData($pdo);

// All School objects
$ecoleA = $schoolList[0];
$ecoleB = $schoolList[1];
$ecoleC = $schoolList[2];

// Insert data to the sport table based on the school


// Twig
$loader = new FilesystemLoader('templates/');
$twig = new Environment($loader, [
    'cache' => false,
]);

echo $twig->render('index.html.twig', ['name' => 'Fabien']);