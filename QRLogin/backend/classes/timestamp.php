<?php
require_once 'backend/classes/DBConfig.php';
Class timeStamp extends DBConfig{

    public function checkIn($userId){
        try{
        
            $sql = "SELECT CONCAT(voornaam, tussenvoegsel, achternaam) as naam FROM USERS WHERE id = :userid";
            $exec = $this->connect()->prepare($sql);
            $exec->bindparam(":userid", $userId); 
            $exec->execute();
            $name = $exec->fetch(PDO::FETCH_OBJ); //naam gebruiker opslaan

            
            $sql = "SELECT uitlogTijd FROM scan WHERE userID = :userid ORDER BY uitlogTijd DESC LIMIT 1";
            $exec = $this->connect()->prepare($sql);
            $exec->bindparam(":userid", $userId); 
            $exec->execute();

            if($exec->rowCount() >= 0){
                $singOffStamp = $exec->fetch(PDO::FETCH_ASSOC); //haal resultaat op
                $oldTime = strtotime($singOffStamp['uitlogTijd']); //converteer datum in leesbaar tijd voor php
                $time1 = new DateTime(); //nieuwe date time variabele om te vergelijken
                $time1->setTimestamp(date('Y-m-d H:i:s')); //schrijf huidige datum en tijd weg in de time variable
                $time2 = new DateTime();
                $time2->setTimestamp($oldTime); //schrijf datum van database weg in de tweede time variable om te checken

                
                $signOff = null;
                $totalTime = null;
                $forgotCheckOut = 8;

                if($time2->format('Y-m-d') != $time1->format('Y-m-d')){ //controle of het een nieuwe dag is of niet
                    $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                    VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                    $exec = $this->connect()->prepare($sql);
                    $exec->bindparam(":userID", $userId);
                    $exec->bindparam(":inlogTijd", $time1);
                    $exec->bindparam(":uitlogTijd", $signOff);
                    $exec->bindparam(":totaalTijd", $totalTime);
                    if($exec->execute()){
                        echo "yay!";
                    }
                }

                if($time2->format('H') === 0 || $time2->format('H') == null){ //als diegene vergeten is om uit te checken gisteren
                    $sql = "UPDATE scan SET totaalTijd = :totaalTijd WHERE userID = :userID ORDER BY uitlogTijd DESC LIMIT 1";
                    $exec = $this->connect()->prepare($sql);
                    $exec->bindparam(":totaalTijd", $forgotCheckOut);
                    $exec->bindparam(":userID", $userId);
                    if($exec->execute()){
                        echo "yay!";
                    }
                }
            }else{
                $time1 = new DateTime(); //nieuwe date time variabele om te vergelijken
                $time1->setTimestamp(date('Y-m-d H:i:s')); //schrijf huidige datum en tijd weg in de time variable

                $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                $exec = $this->connect()->prepare($sql);
                $exec->bindparam(":userID", $userId);
                $exec->bindparam(":inlogTijd", $time1);
                $exec->bindparam(":uitlogTijd", $signOff);
                $exec->bindparam(":totaalTijd", $totalTime);
                if($exec->execute()){
                    echo "yay!";
                }

            }
        } catch(Exception $e){
            echo 'yo mum';
        }
    }
}
?>