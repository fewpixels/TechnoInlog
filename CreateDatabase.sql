DROP DATABASE IF EXISTS inlogTechnolab;
CREATE DATABASE inlogTechnolab;
USE inlogTechnolab;

CREATE TABLE users(
    id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    voornaam VARCHAR(100) NOT NULL,
    tussenvoegsel VARCHAR(20),
    achternaam VARCHAR(100) NOT NULL
);

CREATE TABLE scan(
    id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    userID INT(10) NOT NULL,
    inlogTijd DATETIME,
    uitlogTijd DATETIME,
    totaalTijd INT
);

ALTER TABLE scan
ADD FOREIGN KEY (userID) REFERENCES users(id);

INSERT INTO users (voornaam, tussenvoegsel, achternaam)
VALUES ('Piet', 'van der', 'test');