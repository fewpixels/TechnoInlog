DROP DATABASE IF EXISTS inlogTechnolab;
CREATE DATABASE inlogTechnolab;
USE inlogTechnolab;

CREATE TABLE users(
    id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    voornaam VARCHAR(100) NOT NULL,
    tussenvoegsel VARCHAR(20),
    achternaam VARCHAR(100) NOT NULL,
    isAdmin BOOLEAN,
    isSuperAdmin BOOLEAN
);

CREATE TABLE scan(
    id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    userID INT(10) NOT NULL,
    inlogTijd DATETIME,
    uitlogTijd DATETIME,
    totaalTijd DECIMAL(5,2)
);

ALTER TABLE scan
ADD FOREIGN KEY (userID) REFERENCES users(id);
