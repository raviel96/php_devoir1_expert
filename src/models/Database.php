<?php
namespace App\models;

use PDO;
use Faker\Factory;
use App\models\Ecole;
use App\models\Sport;
use PDOException;

class Database {
    
    public function __construct() {
        
    }

    /**
     * Connect to the database and create tables
     * @param $host
     * @param $user 
     * @param $password
     * @param $dbname
     * 
     * @return PDO
     */
    public static function connexion(string $host, string $user, string $password, string $dbname): PDO {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            $pdo = new PDO($dsn, $user, $password, $options);

            return $pdo;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function insertSchoolData(PDO $pdo) {
        $schoolList = [
            "Ecole A",
            "Ecole B",
            "Ecole C"
        ];

        try {
            foreach ($schoolList as $school) {
                $sql = "INSERT IGNORE INTO ecole(ecole_nom) VALUES ('$school')";
                $statement = $pdo->prepare($sql);
                $statement->execute();
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function insertSportData(PDO $pdo) {
        $sportList = [
            "Boxe",
            "Judo",
            "Football",
            "Natation",
            "Cyclisme"
        ];

        try {
            foreach($sportList as $sport) {
                $sql = "INSERT IGNORE INTO sport(sport_nom) VALUES ('$sport')";
    
                $statement = $pdo->prepare($sql);
                $statement->execute();
            } 
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
        
    }

    public function insertStudentData(PDO $pdo) {
        
        
        try {
            $faker = Factory::create();

            for($i = 0; $i < 10; $i++) {
                $randomStudent = $faker->name();
                $randomSchool = $faker->numberBetween(1, 3);
                $randomSport = $faker->numberBetween(1, 5);

                $sql = "INSERT INTO eleve(eleve_nom, ecole_id, sport_id) VALUES ('$randomStudent', '$randomSchool', '$randomSport')";

                $statement = $pdo->prepare($sql);
                $statement->execute();
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getSchoolData(PDO $pdo){

        try {
            $sql = "SELECT ecole_nom FROM ecole";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll();

        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        if(isset($result)) {
            foreach($result as $row) {
                $schoolName = $row[0];

                $ecole = new Ecole($schoolName);

                $schoolList[] = $ecole;
            }
        }

        return $schoolList;
    }

    public function getSportData(PDO $pdo):array{

        try {
            $sql = "SELECT sport_nom FROM sport";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll();

        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        if(isset($result) && count($result) > 0) {
            foreach($result as $row) {
                $sportNom = $row[0];

                $sport = new Sport($sportNom);

                $sportList[] = $sport;
            }
        }

        return $sportList;
    }

    public function getStudentData(PDO $pdo): array {
        try {
            $sql = "SELECT * FROM eleve";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getSchoolDataJoin(PDO $pdo, int $schoolId):array {
        try {
            $sql = "SELECT * FROM ecole AS E
                    INNER JOIN eleve AS V
                    ON E.id = V.ecole_id
                    WHERE E.id = $schoolId";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getSports(PDO $pdo, int $sportId, int $schoolId):array {
        try {
            $sql = "SELECT sport_id FROM eleve WHERE sport_id= $sportId AND ecole_id=$schoolId";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            return $statement->fetchAll();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}
