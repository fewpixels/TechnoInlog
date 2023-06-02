<?php
require_once 'DBConfig.php';

class Dashboard extends DBConfig{
    public function getScans(){
        $sql = "SELECT 
               scan.id,
               scan.userID,
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

    public function deleteRecord($id){
        $sql = "DELETE FROM scan WHERE id = $id";
        $exec = $this->connect()->prepare($sql);
        if($exec->execute()){
            header("Location:dash.php");
        }
    }
}


?>