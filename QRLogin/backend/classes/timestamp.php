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
            $sql = "SELECT inlogTijd, uitlogTijd, totaalTijd FROM scan WHERE userID = :userid ORDER BY inlogTijd DESC LIMIT 1";
            $exec = $this->connect()->prepare($sql);
            $exec->bindparam(":userid", $userId); 
            $exec->execute();

            //controleren of er een uitlogtijd bestaat van gebruiker
            if($exec->rowCount() > 0){

                $signOff = null; //zodat ze gebruiker niet onmiddelijk uitlogd
                $totalTime = null; //omdat diegene incheckt, hoeft er natuurlijk nog niet onmiddelijk een totaaltijd te staan
                $forgotCheckOut = 8;

                $lastRec = $exec->fetch(PDO::FETCH_ASSOC); //haal resultaat op
                $oldSignOffTime = strtotime($lastRec['uitlogTijd']); //converteer datum in leesbaar tijd voor php
                $time1 = new DateTime(); //nieuwe date time variabele om te vergelijken
                $time1Str = $time1->format('Y-m-d H:i:s'); //schrijf huidige datum en tijd weg in de time variable
                
                $time2 = new DateTime();
                $time2->setTimestamp($oldSignOffTime); //schrijf datum van database weg in de tweede time variable om te checken
                
                $time3 = new DateTime();
                $oldSignInTime = strtotime($lastRec['inlogTijd']);
                $time3->setTimestamp($oldSignInTime);

                //echo $time2->format('Y-m-d') . " " . $time3->format('Y-m-d') . " " . $lastRec['totaalTijd'];


                if($lastRec['totaalTijd'] == null){ //controleren of er een eerdere record is met null totaaltijd
                    if($time1->format('Y-m-d') === $time3->format('Y-m-d')) { //als hij al in is gecheckt
                        $this->checkOut($userId);
                    }elseif($time2->format('Y-m-d') != $time1->format('Y-m-d') && $lastRec['totaalTijd'] == 0){ 
                            $sql = "UPDATE scan SET totaalTijd = :totaalTijd WHERE userID = :userID ORDER BY inlogTijd DESC LIMIT 1";
                            $exec = $this->connect()->prepare($sql);
                            $exec->bindparam(":totaalTijd", $forgotCheckOut, PDO::PARAM_INT);
                            $exec->bindparam(":userID", $userId, PDO::PARAM_INT);
                            $exec->execute();

                            $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                            VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                            $exec = $this->connect()->prepare($sql);
                            $exec->bindparam(":userID", $userId);
                            $exec->bindparam(":inlogTijd", $time1Str);
                            $exec->bindparam(":uitlogTijd", $signOff);
                            $exec->bindparam(":totaalTijd", $totalTime);
                            if($exec->execute()){
                                return "yay! scenario 1 " . $time2->format('Y-m-d') . " " . $time3->format('Y-m-d') . " " . $exec->rowCount() ;
                            }

                        }
                    }elseif($time2->format('Y-m-d') != $time1->format('Y-m-d')){
                        $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                        VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                        $exec = $this->connect()->prepare($sql);
                        $exec->bindparam(":userID", $userId);
                        $exec->bindparam(":inlogTijd", $time1Str);
                        $exec->bindparam(":uitlogTijd", $signOff);
                        $exec->bindparam(":totaalTijd", $totalTime);
                        if($exec->execute()){
                            return "yay! scenario 4 ";
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
                    return "yay! scenario 2";
                }

            }
        } catch(Exception $e){
            return 'yo mum';
        }
    }

}
?>