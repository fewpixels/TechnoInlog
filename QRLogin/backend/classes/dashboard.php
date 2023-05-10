<?php
require_once 'DBConfig.php';

class Dashboard extends DBConfig{
    public function getScans(){
        $sql = "SELECT scan.userID,
               scan.inlogTijd,
               scan.uitlogTijd,
               scan.totaalTijd, 
               CONCAT(users.voornaam,' ',users.tussenvoegsel,' ',users.achternaam) AS naam -- naamdelen samenvoegen
               From users
               INNER JOIN scan ON users.id = scan.userID";
        $exec = $this->connect()->prepare($sql);
        $exec->execute();
        return $exec->fetchAll(PDO::FETCH_OBJ);
    }
}


?>