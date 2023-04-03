<?php 
    require_once "../../vendor/autoload.php";
    require_once "../functions/config.php";

    use App\models\Database;

    $database = new Database();
    $pdo = Database::connexion($host, $user, $password, $dbname);
    
    $sportList = $database->getSportData($pdo);
    $studentListJoined = $database->getSchoolDataJoin($pdo, 2);
?>

<?php include("header.php") ?>
<main>
    <section>
        <h1>Ecole B</h1>
        <div>
            <p>Effectif total</p>
            <p><?php echo count($studentListJoined) ?></p>
        </div>
    </section>
    <section>
        <h2>Sports proposés par cet établissement</h2>
        <?php foreach($sportList as $value):?>
            <div class="card">
                <?php if($value->getSportName() == "Boxe"):?>
                    <img src="../images/boxe.jpg" alt="image de la boxe" width="250" height="250">
                    <h3>Boxe</h3>
                <?php endif ?>
                <?php if($value->getSportName() == "Judo"):?>
                    <img src="../images/judo.jpg" alt="image de la boxe"  width="250" height="250">
                    <h3>Judo</h3>
                <?php endif ?>
                <?php if($value->getSportName() == "Cyclisme"):?>
                    <img src="../images/cyclisme.jpg" alt="image de la boxe"  width="250" height="250">
                    <h3>Cyclisme</h3>
                <?php endif ?>
                <?php if($value->getSportName() == "Football"):?>
                    <img src="../images/football.jpg" alt="image de la boxe"  width="250" height="250">
                    <h3>Football</h3>
                <?php endif ?>
                <?php if($value->getSportName() == "Natation"):?>
                    <img src="../images/natation.jpg" alt="image de la boxe"  width="250" height="250">
                    <h3>Natation</h3>
                <?php endif ?>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum laborum non laboriosam hic distinctio commodi?</p>
            </div>
        <?php endforeach;?>
    </section>
</main>

<?php include("footer.php") ?>