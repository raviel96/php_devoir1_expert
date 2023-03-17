CREATE DATABASE IF NOT EXISTS gestion_sport;

CREATE TABLE IF NOT EXISTS gestion_sport.ecole(
    id INT NOT NULL AUTO_INCREMENT,
    ecole_nom VARCHAR(20) NOT NULL UNIQUE,
    PRIMARY KEY(id)    
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS gestion_sport.sport(
    id INT NOT NULL AUTO_INCREMENT,
    sport_nom VARCHAR(20) UNIQUE,
    PRIMARY KEY(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS gestion_sport.eleve(
   id INT NOT NULL AUTO_INCREMENT,
   eleve_nom VARCHAR(20) NOT NULL,
   ecole_id INT NOT NULL,
   sport_id INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(ecole_id) REFERENCES ecole(id),
   FOREIGN KEY(sport_id) REFERENCES sport(id)
)Engine=InnoDB;