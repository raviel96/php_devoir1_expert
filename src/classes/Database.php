<?php
namespace App\classes;

use PDO;
use Faker\Factory;
use App\classes\Ecole;

class Database {
    
    public function __construct(string $host, string $user, string $password, string $dbname) {
        $this->createDatabase($host, $user, $password, $dbname);
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
            //Connection
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            $pdo = new PDO($dsn, $user, $password, $options);

            //Create tables
            $sql1 = "CREATE TABLE IF NOT EXISTS ecole (
                id INT NOT NULL AUTO_INCREMENT,
                ecole_nom VARCHAR(20) NOT NULL UNIQUE,
                nombre_eleve INT NOT NULL,
                nombre_sport INT NOT NULL,
                PRIMARY KEY(id)    
            )Engine=InnoDB";

            $sql2 = "CREATE TABLE IF NOT EXISTS sport(
                id INT NOT NULL AUTO_INCREMENT,
                sport_nom VARCHAR(20) UNIQUE,
                nombre_eleve INT NOT NULL,
                PRIMARY KEY(id)
                )Engine=InnoDB";

            $sqlList = [$sql1, $sql2];

            foreach($sqlList as $sql) {
                $statement = $pdo->prepare($sql);
                $statement->execute();
            }

            return $pdo;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Create the dabatase if its not exists
     * @param string $host
     * @param string $user
     * @param string $password 
     * @param string $dbname
     */
    private function createDatabase(string $host, string $user, string $password, string $dbname) {
        try {
            $dsn = "mysql:host=$host;charset=utf8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            $pdo = new PDO($dsn, $user, $password, $options);

            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

            $statement = $pdo->prepare($sql);
            $statement->execute();
        } catch (\PDOException $e) {
        die($e->getMessage());
        }
    }

    public function insertDataIntoSchool(PDO $pdo) {
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

    /**
     * Generate random number of students
     * @param PDO $pdo
     * @param Ecole $ecole
     */
    public function insertRandomStudentInSchool(PDO $pdo, Ecole $ecole) {
        $faker = Factory::create();

        $randNumber = $faker->numberBetween(15, 100);
        $schooName = $ecole->getSchoolName();

        try {
            $sql = "UPDATE ecole SET nombre_eleve=$randNumber WHERE ecole_nom='$schooName'";

            $statement = $pdo->prepare($sql);
            $statement->execute();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function insertDataIntoSport(PDO $pdo, Ecole $ecole) {
        try {
            // $sql = "INSERT IGNORE INTO sport(sport_nom, nombre_eleve) VALUES ('Boxe', '$randoms[0]'),
            // ('Judo', '$randoms[1]', 5),
            // ('Football, '$randoms[2]', 5),
            // ('Natation, '$randoms[2]', 5),
            // ('Cyclysme', '$randoms[2]', 5)";
    
            // $statement = $pdo->prepare($sql);
            // $statement->execute();
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getSchoolData(PDO $pdo){

        try {
            $sql = "SELECT ecole_nom, nombre_eleve, nombre_sport FROM ecole";

            $statement = $pdo->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll();

        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        if(isset($result)) {
            foreach($result as $row) {
                $schoolName = $row[0];
                $studentsNumber = $row[1];
                $sportNumber = $row[2];

                $ecole = new Ecole($schoolName, $studentsNumber, $sportNumber);

                $schoolList[] = $ecole;
            }
        }

        return $schoolList;
    }
}
