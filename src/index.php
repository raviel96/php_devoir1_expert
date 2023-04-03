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

$studentListAJoined = $database->getSchoolDataJoin($pdo, 1);
$studentListBJoined = $database->getSchoolDataJoin($pdo, 2);
$studentListCJoined = $database->getSchoolDataJoin($pdo, 3);

$studentACount = count($studentListAJoined);
$studentBCount = count($studentListBJoined);
$studentCCount = count($studentListCJoined);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestion Sport</title>
</head>
<body>
    <div class="container">
         <header class="header py-4 d-md-flex justify-content-md-between">
            <h1 id="home" class="text-center">Gestion Sport</h1>
            <nav>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#home" class="nav-link active">Accueil</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section id="schools">
                    <h2>Nos écoles</h2>
                    <div class="school-box">
                        <?php foreach($schoolList as $value) : ?>
                            <div class="card">
                                <?php if($value->getSchoolName() == "Ecole A"):?>
                                    <img src="images/ecole-a.jpg" alt="image d'une école">
                                    <div class="card-content">
                                        <h3>Ecole A</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis est atque rem blanditiis inventore eligendi.</p>        
                                        <a href="views/ecolea.php" class="btn btn-primary">Plus d'infos</a>
                                    </div>
                                <?php endif ?>
                                <?php if($value->getSchoolName() == "Ecole B"):?>
                                    <img src="images/ecole-b.jpg" alt="image d'une école">
                                    <div class="card-content">
                                        <h3>Ecole B</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore minima, voluptatum itaque laboriosam atque neque!</p>        
                                        <a href="views/ecoleB.php" class="btn btn-primary">Plus d'infos</a>
                                    </div>
                                <?php endif ?>
                                <?php if($value->getSchoolName() == "Ecole C"):?>
                                    <img src="images/ecole-c.jpg" alt="image d'une école">
                                    <div class="card-content">
                                        <h3>Ecole C</h3>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae quidem corporis omnis qui fugiat pariatur?</p>        
                                        <a href="views/ecoleC.php" class="btn btn-primary">Plus d'infos</a>
                                    </div>
                                <?php endif ?>   
                            </div>
                        <?php endforeach; ?>
                    </div>
            </section>
        </main>
<?php include("views/footer.php") ?>
    