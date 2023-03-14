<?php
namespace App\classes;

require_once "functions/insert.php";

use PDO;

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
            )";

            $sql2 = "CREATE TABLE IF NOT EXISTS sport(
                id INT NOT NULL AUTO_INCREMENT,
                sport_nom VARCHAR(20),
                nombre_eleve INT NOT NULL,
                PRIMARY KEY(id)
                )";

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

    public function insertData(PDO $pdo) {
        insertForSchool($pdo);
    }

    public function getData(PDO $pdo) {

        try {
            $sql = "SELECT ";
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}
