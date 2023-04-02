<?php 
require_once "../vendor/autoload.php";
require_once "functions/config.php";

use Twig\Environment;
use App\models\Database;
use Twig\Loader\FilesystemLoader;

// Connexion
$database = new Database();
$pdo = Database::connexion($host, $user, $password, $dbname);

$database->insertSchoolData($pdo);
$database->insertSportData($pdo);
if(count($database->getStudentData($pdo)) < 100 ) $database->insertStudentData($pdo);

$schoolList = $database->getSchoolData($pdo);
$sportList = $database->getSportData($pdo);

$studentListAJoined = $database->getSchoolDataJoin($pdo, 1);
$studentListBJoined = $database->getSchoolDataJoin($pdo, 2);
$studentListCJoined = $database->getSchoolDataJoin($pdo, 3);

$studentACount = count($studentListAJoined);
$studentBCount = count($studentListBJoined);
$studentCCount = count($studentListCJoined);

// Twig
$loader = new FilesystemLoader('views/');
$twig = new Environment($loader, [
    'cache' => false,
]);

echo $twig->render('index.html.twig', 
['schoolList' => $schoolList, 'sportList' => $sportList, 'studentACount' => $studentACount, 'studentBCount' => $studentBCount, 'studentCCount' => $studentCCount]);