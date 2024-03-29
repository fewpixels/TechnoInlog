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

    public function getUserData(){
        try{
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id = $id";
            $exec = $this->connect()->prepare($sql);
            $exec->execute();
            return $exec->fetch(PDO::FETCH_OBJ);
            $exec->close(); //verbinding sluiten
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function createUser($data, $page){
        try{
            if($this->checkIfUserExists($data)){
                throw new Exception("Gebruiker bestaat al!");
            }
            else{
                if($page == "scan"){
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
                            header("Location: generateQR.php?id=$id&name=$name&page=scan");
                        }
                    }
                }if($page == "userManage"){
                    $sql = "INSERT INTO users (voornaam, tussenvoegsel, achternaam, isAdmin, isSuperAdmin) VALUES (:voornaam, :tussenvoegsel, :achternaam, :isAdmin, :isSuperAdmin)";
                    $exec = $this->connect()->prepare($sql);
                    $exec->bindParam(":voornaam", $data['voornaam']);
                    $exec->bindParam(":tussenvoegsel", $data['tussenvoegsel']);
                    $exec->bindParam(":achternaam", $data['achternaam']);
                    $exec->bindParam(":isAdmin", $data['isAdmin']);
                    $exec->bindParam(":isSuperAdmin", $data['isSuperAdmin']);
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
                            header("Location: generateQR.php?id=$id&name=$name&page=userManage");
                        }
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

    public function updateUser($data, $page, $id){ //gebruiker bijwerken
        try{
            if($_SESSION['superAdmin'] == 1){
                $sql = "UPDATE users SET 
                        voornaam = :voornaam, 
                        tussenvoegsel = :tussenvoegsel, 
                        achternaam = :achternaam,
                        isAdmin = :isAdmin,
                        isSuperAdmin = :isSuperAdmin
                        WHERE id = :id";
                $exec = $this->connect()->prepare($sql);
                $exec->bindParam(":voornaam", $data['voornaam']);
                $exec->bindParam(":tussenvoegsel", $data['tussenvoegsel']);
                $exec->bindParam(":achternaam", $data['achternaam']);
                $exec->bindParam(":isAdmin", $data['isAdmin']);
                $exec->bindParam(":isSuperAdmin", $data['isSuperAdmin']);
                $exec->bindParam(":id", $id, PDO::PARAM_INT);
                if($exec->execute()){
                    header("Location:userPanel.php?pageno=".$page);
                }
            }else{
                $sql = "UPDATE users SET 
                        voornaam = :voornaam, 
                        tussenvoegsel = :tussenvoegsel, 
                        achternaam = :achternaam,
                        isAdmin = :isAdmin
                        WHERE id = :id";
                $exec = $this->connect()->prepare($sql);
                $exec->bindParam(":voornaam", $data['voornaam']);
                $exec->bindParam(":tussenvoegsel", $data['tussenvoegsel']);
                $exec->bindParam(":achternaam", $data['achternaam']);
                $exec->bindParam(":isAdmin", $data['isAdmin']);
                $exec->bindParam(":id", $id, PDO::PARAM_INT);
                if($exec->execute()){
                    header("Location:userPanel.php?pageno=".$page);
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function countUserRecords($id){
        $sql = "SELECT COUNT(uitlogTijd) as total FROM scan WHERE userID = $id";
        $exec = $this->connect()->prepare($sql);
        if($exec->execute()){
            return $exec->fetch(PDO::FETCH_OBJ);
            $exec->close(); //verbinding sluiten
        }
    }

    public function deleteUser($id){
        try{
            $sql = "DELETE FROM scan WHERE userID = :id";
            $exec = $this->connect()->prepare($sql);
            $exec->bindParam(":id", $id);
            if($exec->execute()){
                $sql = "DELETE FROM users WHERE id = :id";
                $exec = $this->connect()->prepare($sql);
                $exec->bindParam(":id", $id);
                if($exec->execute()){
                    header("Location: userPanel.php?pageno=0");
                    exit(); // Script afsluiten
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
            $exec->close(); //verbinding sluiten
        }
    }
}
    

?>