<?php

require_once 'DBConfig.php';


class User extends DBConfig{

    public function getUsers(){ //haal ALLES van ALLE gebruikers op
        try{
            $sql = "SELECT id, CONCAT(voornaam,' ',tussenvoegsel,' ',achternaam) AS naam FROM users";
            $exec = $this->connect()->prepare($sql);
            $exec->execute();
            return $exec->fetchAll(PDO::FETCH_OBJ);
            $exec->close(); //verbinding sluiten
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function getUserData($data){
        try{
            $id = $data['userID'];
            $sql = "SELECT * FROM users WHERE id = $id";
            $exec = $this->connect()->prepare($sql);
            $exec->execute();
            return $exec->fetchAll(PDO::FETCH_OBJ);
            $exec->close(); //verbinding sluiten
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function createUser($data){
        try{
            if($this->checkIfUserExists($data)){
                throw new Exception("Gebruiker bestaat al!");
            }
            else{
                $sql = "INSERT INTO users (voornaam, tussenvoegsel, achternaam) VALUES (:voornaam, :tussenvoegsel, :achternaam)";
                $exec = $this->connect()->prepare($sql);
                $exec->bindParam(":voornaam", $data['voornaam']);
                $exec->bindParam(":tussenvoegsel", $data['tussenvoegsel']);
                $exec->bindParam(":achternaam", $data['achternaam']);
                if($exec->execute()){
                    sleep(0.5);
                    $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
                    $exec = $this->connect()->prepare($sql);
                    if($exec->execute()){
                        $id = $exec->fetchColumn();
                        if($data['tussenvoegsel'] == null || $data['tussenvoegsel'] == ""){
                            $name = $data['voornaam'] . " " . $data['achternaam'];
                        }else{
                            $name = $data['voornaam'] . " ". $data['tussenvoegsel'] . " " . $data['achternaam'];
                        }
                        header("Location: generateQR.php?id=$id&name=$name&page=create");
                        $exec->close();
                    }
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function checkIfUserExists($data){
        try{
            $voornaam = '%'.$data['voornaam'].'%';
            $tussenvoegsel = '%'.$data['tussenvoegsel'].'%';
            $achternaam = '%'.$data['achternaam'].'%';
            
            $sql = "SELECT voornaam, tussenvoegsel, achternaam 
                    FROM users 
                    WHERE voornaam LIKE :voornaam 
                    AND tussenvoegsel LIKE :tussenvoegsel 
                    AND achternaam LIKE :achternaam";
            
            $exec = $this->connect()->prepare($sql);
            $exec->bindParam(":voornaam", $voornaam);
            $exec->bindParam(":tussenvoegsel", $tussenvoegsel);
            $exec->bindParam(":achternaam", $achternaam);
            
            if($exec->execute()){
                if($exec->rowCount() > 0){ //controleren of query een hit heeft
                    return true;
                    $exec->close(); //verbinding sluiten
                }else{
                    return false;
                    $exec->close(); //verbinding sluiten
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
            $exec->close(); //verbinding sluiten
        }
    }

    public function updateUser($data){ //alles bijwerken
        $userid = $_GET['userID'];
        try{
            $sql = "UPDATE users SET 
                    voornaam = :voornaam, 
                    tussenvoegsel = :tussenvoegsel, 
                    achternaam = :achternaam, 
                    WHERE id = $userid";
            $exec = $this->connect()->prepare($sql);
            $exec->bindParam(":voornaam", $data['voornaam']);
            $exec->bindParam(":tussenvoegsel", $data['tussenvoegsel']);
            $exec->bindParam(":achternaam", $data['achternaam']);

            if($exec->execute()){
                header("Location:showUsers.php");
                $exec->close(); //verbinding sluiten
            }
        }catch(Exception $e){
            echo $e->getMessage();
            $exec->close(); //verbinding sluiten
        }
    }

    public function deleteUser($id){
        $sql = "DELETE FROM users WHERE id = $id";
        $exec = $this->connect()->prepare($sql);
        if($exec->execute()){
            header("Location:showUsers.php");
            $exec->close(); //verbinding sluiten
        }
    }
}

?>