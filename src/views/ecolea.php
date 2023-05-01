<?php 
    require_once "../../vendor/autoload.php";
    require_once "../functions/config.php";

    use App\models\Database;

    $database = new Database();
    $pdo = Database::connexion($host, $user, $password, $dbname);
    
    $schoolNumber = 1;

    $sportList = $database->getSportData($pdo);
    $studentListJoined = $database->getSchoolDataJoin($pdo, $schoolNumber);

    $boxList = $database->getSports($pdo, 1,$schoolNumber);
    $judoList = $database->getSports($pdo, 2,$schoolNumber);
    $footballList = $database->getSports($pdo, 3,$schoolNumber);
    $natationList = $database->getSports($pdo, 4,$schoolNumber);
    $cyclismeList = $database->getSports($pdo, 5,$schoolNumber);

    $sortListA = [
        count($boxList),
        count($judoList),
        count($footballList),
        count($natationList),
        count($cyclismeList)
    ];

    sort($sortListA);
?>

<?php include("header.php") ?>
<main>
    <section class="presentation">
        <h1>Ecole A</h1>
        <div class="details">
            <div class="details-info">
                <p>Effectif total</p>
                <p><?php echo count($studentListJoined) ?></p>
            </div>
            <div class="details-info">
                <p>Activités pratiquées</p>
                <p><?php echo count($sportList) ?></p>
            </div>
        </div>
    </section>
    <section class="">
        <h2>Sports proposés par cet établissement</h2>
        <div class="sport-box">
            <?php for($i = 0; $i < count($sortListA); $i++):?>
                <div class="card">
                    <?php switch($i): case 0: ?>
                            <div class="card-content">
                                <h3>Boxe</h3>
                                <p>Pratiquants : <?php echo $sortListA[$i];?></p>
                            </div>
                        <?php break; case 1:?>
                            <div class="card-content">
                                <h3>Judo</h3>
                                <p>Pratiquants : <?php echo $sortListA[$i];?></p>
                            </div>
                        <?php break; case 2:?>
                            <div class="card-content">
                                <h3>Football</h3>
                                <p>Pratiquants : <?php echo $sortListA[$i];?></p>
                            </div>
                        <?php break; case 3:?>
                            <div class="card-content">
                                <h3>Natation</h3>
                                <p>Pratiquants : <?php echo $sortListA[$i];?></p>
                            </div>
                        <?php break; case 4:?>
                            <div class="card-content">
                                <h3>Cyclisme</h3>
                                <p>Pratiquants : <?php echo $sortListA[$i];?></p>
                            </div>
                        <?php break;?>
                    <?php endswitch;?>
                </div>
            <?php endfor;?>
        </div>
    </section>
</main>

<?php include("footer.php") ?>

