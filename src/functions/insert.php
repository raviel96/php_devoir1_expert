<?php 

use Faker\Factory;


function insertForSchool(PDO $pdo) {
    $faker = Factory::create();

    for($i = 0 ; $i < 3; $i++) {
        $randoms[$i] = $faker->numberBetween(15, 100);
    }

    try {
        $sql = "INSERT IGNORE INTO ecole(ecole_nom, nombre_eleve, nombre_sport) VALUES ('Ecole A', '$randoms[0]', 5),
        ('Ecole B', '$randoms[1]', 5),
        ('Ecole C', '$randoms[2]', 5)";

        $statement = $pdo->prepare($sql);
        $statement->execute();
    } catch (\PDOException $e) {
        die($e->getMessage());
    }
}
function insertForSport(PDO $pdo) {

}