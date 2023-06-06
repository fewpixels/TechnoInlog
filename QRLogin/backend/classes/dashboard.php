<?php
require_once 'DBConfig.php';

class Dashboard extends DBConfig{
    public function getScans(){
        try{
            $sql = "SELECT 
                scan.id,
                scan.userID,
                scan.inlogTijd,
                scan.uitlogTijd,
                scan.totaalTijd,
                CONCAT(users.voornaam,' ',users.tussenvoegsel,' ',users.achternaam) AS naam -- naamdelen samenvoegen
                FROM users
                INNER JOIN scan ON users.id = scan.userID
                ORDER BY scan.uitlogTijd DESC";
            $exec = $this->connect()->prepare($sql);
            $exec->execute();
            return $exec->fetchAll(PDO::FETCH_OBJ);
            $exec->close();
        }catch(Exception $e){
            echo $e->getMessage();
            $exec->close(); //verbinding sluiten
        }

    }

    public function getScansById($id){
        try{
            $sql = "SELECT 
                    scan.id,
                    scan.userID,
                    scan.inlogTijd,
                    scan.uitlogTijd,
                    scan.totaalTijd,
                    CONCAT(users.voornaam,' ',users.tussenvoegsel,' ',users.achternaam) AS naam -- naamdelen samenvoegen
                    FROM users
                    INNER JOIN scan ON users.id = scan.userID
                    WHERE users.Id = :id
                    ORDER BY scan.uitlogTijd DESC";
            $exec = $this->connect()->prepare($sql);
            $exec->bindParam(":id", $id);
            $exec->execute();
            return $exec->fetchAll(PDO::FETCH_OBJ);
            $exec->close(); //verbinding sluiten
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function getScan(){
        try{
            $sql = "SELECT * FROM scan WHERE id = ".$_GET['record'];
            $exec = $this->connect()->prepare($sql);
            $exec->execute();
            return $exec->fetch(PDO::FETCH_OBJ);
            $exec->close(); //verbinding sluiten
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function createRecord($data){
        
        $newSignIn = strtotime($data['inlogTijd']);
        $newSignOut = strtotime($data['uitlogTijd']);

        $newTime1 = new DateTime();
        $newTime2 = new DateTime();

        $newTime1->setTimestamp($newSignIn);
        $newTime2->setTimestamp($newSignOut);

        $newTimeFormat1 = $newTime1->format('Y-m-d H:i:s');
        $newTimeFormat2 = $newTime2->format('Y-m-d H:i:s');

        $difference = $newTime1->diff($newTime2);
        $hours = $difference->h + ($difference->i / 60) + ($difference->s / 3600); 

        try{
            $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
            VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
            $exec = $this->connect()->prepare($sql);
            $exec->bindParam(":userID", $data['userID']);
            $exec->bindParam(":inlogTijd", $newTimeFormat1);
            $exec->bindParam(":uitlogTijd", $newTimeFormat2);
            $exec->bindParam(":totaalTijd", $hours);
            if($exec->execute() && $_GET['page'] == 'dash'){
                header("Location:dash.php?pageno=0");
                $exec->close();
            }else{
                header("Location: dashUser.php?pageno=0&user=".$_GET['user']."&name=".$_GET['name']);
                $exec->close(); //verbinding sluiten
            }
        }catch(Exception $e){
            echo $e->getMessage();
            $exec->close(); //verbinding sluiten
        }
    }

    public function updateRecord($data){
        $recordID = $_GET['record'];
        
        $newSignIn = strtotime($data['inlogTijd']);
        $newSignOut = strtotime($data['uitlogTijd']);

        $newTime1 = new DateTime();
        $newTime2 = new DateTime();

        $newTime1->setTimestamp($newSignIn);
        $newTime2->setTimestamp($newSignOut);

        $newTimeFormat1 = $newTime1->format('Y-m-d H:i:s');
        $newTimeFormat2 = $newTime2->format('Y-m-d H:i:s');

        $difference = $newTime1->diff($newTime2);
        $hours = $difference->h + ($difference->i / 60) + ($difference->s / 3600); 

        try{
            $sql = "UPDATE scan SET 
                    inlogTijd = :inlogTijd,
                    uitlogTijd = :uitlogTijd,
                    totaalTijd = :totaalTijd
                    WHERE id = $recordID";
            $exec = $this->connect()->prepare($sql);
            $exec->bindParam(":inlogTijd", $newTimeFormat1);
            $exec->bindParam(":uitlogTijd", $newTimeFormat2);
            $exec->bindParam(":totaalTijd", $hours);
            if($exec->execute() && $_GET['page'] == 'dash'){
                header("Location:dash.php?pageno=0");
                $exec->close();
            }else{
                header("Location: dashUser.php?pageno=0&user=".$_GET['user']."&name=".$_GET['name']);
                $exec->close(); //verbinding sluiten
            }
        }catch(Exception $e){
            echo $e->getMessage();
            $exec->close(); //verbinding sluiten
        }

    }

    public function deleteRecord($id, $page){
        try{
            $sql = "DELETE FROM scan WHERE id = $id";
            $exec = $this->connect()->prepare($sql);
            if($exec->execute() && $page == 'dash'){
                header("Location:dash.php");
                $exec->close();
            }else{
                header("Location: dashUser.php?pageno=0&user=".$_GET['user']."&name=".$_GET['name']);
                $exec->close(); //verbinding sluiten
            }
        }catch(Exception $e){
            echo $e->getMessage();
            $exec->close(); //verbinding sluiten
        }
    }
}


?>