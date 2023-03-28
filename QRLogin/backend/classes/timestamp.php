<?php
require_once 'backend/classes/DBConfig.php';
Class timeStamp extends DBConfig{

    public function checkIn($userId){
        try{
        
            //naam van gebruiker ophalen
            $sql = "SELECT CONCAT(voornaam, tussenvoegsel, achternaam) as naam FROM USERS WHERE id = :userid";
            $exec = $this->connect()->prepare($sql);
            $exec->bindparam(":userid", $userId); 
            $exec->execute();
            $name = $exec->fetch(PDO::FETCH_OBJ); //naam gebruiker opslaan

            
            //laatste uitlogtijd ophalen van gebruiker
            $sql = "SELECT uitlogTijd FROM scan WHERE userID = :userid ORDER BY uitlogTijd DESC LIMIT 1";
            $exec = $this->connect()->prepare($sql);
            $exec->bindparam(":userid", $userId); 
            $exec->execute();

            //controleren of er een uitlogtijd bestaat van gebruiker
            if($exec->rowCount() > 0){
                $signOffStamp = $exec->fetch(PDO::FETCH_ASSOC); //haal resultaat op
                $oldTime = strtotime($signOffStamp['uitlogTijd']); //converteer datum in leesbaar tijd voor php
                $time1 = new DateTime(); //nieuwe date time variabele om te vergelijken
                $time1Str = $time1->format('Y-m-d H:i:s'); //schrijf huidige datum en tijd weg in de time variable
                $time2 = new DateTime();
                $time2->setTimestamp($oldTime); //schrijf datum van database weg in de tweede time variable om te checken

                
                $signOff = null; //zodat ze gebruiker niet onmiddelijk uitlogd
                $totalTime = null; //omdat diegene incheckt, hoeft er natuurlijk nog niet onmiddelijk een totaaltijd te staan
                $forgotCheckOut = 8;

                //controle of het een nieuwe dag is of niet
                if($time2->format('Y-m-d') != $time1->format('Y-m-d')){ 
                    $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                    VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                    $exec = $this->connect()->prepare($sql);
                    $exec->bindparam(":userID", $userId);
                    $exec->bindparam(":inlogTijd", $time1Str);
                    $exec->bindparam(":uitlogTijd", $signOff);
                    $exec->bindparam(":totaalTijd", $totalTime);
                    if($exec->execute()){
                        echo "yay! scenario 1";
                    }
                }

                //als diegene vergeten is om uit te checken gisteren
                if($time2->format('H') === '00:00:00' || $time2->format('H') == null){ 
                    $sql = "UPDATE scan SET totaalTijd = :totaalTijd WHERE userID = :userID ORDER BY uitlogTijd DESC LIMIT 1";
                    $exec = $this->connect()->prepare($sql);
                    $exec->bindparam(":totaalTijd", $forgotCheckOut, PDO::PARAM_INT);
                    $exec->bindparam(":userID", $userId, PDO::PARAM_INT);
                    if($exec->execute()){
                        echo "yay! scenario 2";
                    }
                }
            }else{ //als er geen tijd bestaat van gebruiker
                $time1 = new DateTime(); //nieuwe date time variabele om te vergelijken
                $time1Str = $time1->format('Y-m-d H:i:s'); //schrijf huidige datum en tijd weg in de time variable

                $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                $exec = $this->connect()->prepare($sql);
                $exec->bindparam(":userID", $userId);
                $exec->bindparam(":inlogTijd", $time1Str);
                $exec->bindparam(":uitlogTijd", $signOff);
                $exec->bindparam(":totaalTijd", $totalTime);
                if($exec->execute()){
                    echo "yay! scenario 3";
                }

            }
        } catch(Exception $e){
            return 'yo mum';
        }
    }
}
?>