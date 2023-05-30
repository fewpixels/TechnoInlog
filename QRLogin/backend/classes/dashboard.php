<?php
require_once 'DBConfig.php';

class Dashboard extends DBConfig{
    public function getScans(){
        $sql = "SELECT scan.userID,
               scan.inlogTijd,
               scan.uitlogTijd,
               scan.totaalTijd,
               CONCAT(users.voornaam,' ',users.tussenvoegsel,' ',users.achternaam) AS naam -- naamdelen samenvoegen
               FROM users
               INNER JOIN scan ON users.id = scan.userID";
        $exec = $this->connect()->prepare($sql);
        $exec->execute();
        return $exec->fetchAll(PDO::FETCH_OBJ);
    }

    public function getScansById($id){
        $sql = "SELECT scan.userID,
                scan.inlogTijd,
                scan.uitlogTijd,
                scan.totaalTijd,
                CONCAT(users.voornaam,' ',users.tussenvoegsel,' ',users.achternaam) AS naam -- naamdelen samenvoegen
                FROM users
                INNER JOIN scan ON users.id = scan.userID
                WHERE users.Id = :id";
        $exec = $this->connect()->prepare($sql);
        $exec->bindParam(":id", $id);
        $exec->execute();
        return $exec->fetchAll(PDO::FETCH_OBJ);
    }

    // public function getUserScans($data){
    //     $name = $_GET['name'];
    //     $id = $_GET['id'];
    //     $sql = "SELECT userID,
    //             inlogTijd,
    //             uitlogTijd,
    //             totaalTijd, 
    //             FROM scan
    //             WHERE userID = $id";
    //     $exec = $this->connect()->prepare($sql);
    //     $exec->execute();
    //     return $exec->fetchAll(PDO::FETCH_OBJ);
    // }
}


?>