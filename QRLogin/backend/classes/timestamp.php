<?php
require_once 'backend/classes/DBConfig.php';
Class timeStamp extends DBConfig{

    public function checkIn($userId){
        try{
        
            //naam van gebruiker ophalen
            $sql = "SELECT CONCAT(voornaam, ' ', tussenvoegsel, ' ', achternaam) as naam FROM users WHERE id = :userid";
            $exec = $this->connect()->prepare($sql);
            $exec->bindparam(":userid", $userId); 
            $exec->execute();
            $name = $exec->fetchColumn(); //naam gebruiker opslaan
            sleep(0.5); //vertraging omdat de database niet snel genoeg is om de aanvraag op tijd af te handelen

            
            //laatste uitlogtijd ophalen van gebruiker
            $sql = "SELECT inlogTijd, uitlogTijd, totaalTijd FROM scan WHERE userID = :userid ORDER BY id DESC LIMIT 1";
            $exec = $this->connect()->prepare($sql);
            $exec->bindparam(":userid", $userId); 
            $exec->execute();

            //controleren of er een uitlogtijd bestaat van gebruiker
            if($exec->rowCount() > 0){
                $signOff = null; //zodat ze gebruiker niet onmiddelijk word uitlogd
                $totalTime = null; //omdat diegene incheckt, hoeft er natuurlijk nog niet onmiddelijk een totaaltijd te staan
                $forgotCheckOut = 1;

                $lastRec = $exec->fetch(PDO::FETCH_ASSOC); //haal resultaat op
                $oldSignOffTime = strtotime($lastRec['uitlogTijd']); //converteer datum in leesbaar tijd voor php
                $time1 = new DateTime(); //nieuwe date time variabele om te vergelijken
                $time1Str = $time1->format('Y-m-d H:i:s'); //schrijf huidige datum en tijd weg in de time variable
                
                $time2 = new DateTime();
                $time2->setTimestamp($oldSignOffTime); //schrijf datum van database weg in de tweede time variable om te checken
                
                $time3 = new DateTime();
                $oldSignInTime = strtotime($lastRec['inlogTijd']);
                $time3->setTimestamp($oldSignInTime);

                if($lastRec['totaalTijd'] == null){ //controleren of er een eerdere record is met null totaaltijd
                    if($time1->format('Y-m-d') === $time3->format('Y-m-d') && $lastRec['totaalTijd'] == null) { //als hij al in is gecheckt
                       return $this->checkOut($userId, $name);
                    }elseif($time2->format('Y-m-d') != $time1->format('Y-m-d') && $lastRec['totaalTijd'] == null){ //als hij is vergeten uit te checken
                            $sql = "UPDATE scan SET totaalTijd = :totaalTijd WHERE userID = :userID ORDER BY id DESC LIMIT 1";
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
                                return "goedemorgen " . $name . "!<br>het lijkt erop dat je gisteren was vergeten uit te checken!<br> VERGEET DUS NIET UIT TE CHECKEN!" ;
                            }

                        }
                    }elseif($time1->format('Y-m-d') === $time3->format('Y-m-d') && $lastRec['totaalTijd'] != null){ // als het dezelfde dag is en hij wilt weer inchecken
                        $time1 = new DateTime(); //nieuwe date time variabele
                        $time1Str = $time1->format('Y-m-d H:i:s'); //schrijf huidige datum en tijd weg in de time variable
        
                        $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                        VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                        $exec = $this->connect()->prepare($sql);
                        $exec->bindparam(":userID", $userId);
                        $exec->bindparam(":inlogTijd", $time1Str);
                        $exec->bindparam(":uitlogTijd", $signOff);
                        $exec->bindparam(":totaalTijd", $totalTime);
                        if($exec->execute()){
                            return "Welkom terug! " . $name ."!";
                        }
                    }elseif($time2->format('Y-m-d') != $time1->format('Y-m-d')){ //gewone check in scenario
                        $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                        VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                        $exec = $this->connect()->prepare($sql);
                        $exec->bindparam(":userID", $userId);
                        $exec->bindparam(":inlogTijd", $time1Str);
                        $exec->bindparam(":uitlogTijd", $signOff);
                        $exec->bindparam(":totaalTijd", $totalTime);
                        if($exec->execute()){
                            return "goedemorgen " . $name ."!" ;
                        }
                    }                          
            }else{//als er geen tijd bestaat van gebruiker
                $time1 = new DateTime(); //nieuwe date time variabele
                $time1Str = $time1->format('Y-m-d H:i:s'); //schrijf huidige datum en tijd weg in de time variable

                $sql = "INSERT INTO scan (userID, inlogTijd, uitlogTijd, totaalTijd) 
                VALUES (:userID, :inlogTijd, :uitlogTijd, :totaalTijd)";
                $exec = $this->connect()->prepare($sql);
                $exec->bindparam(":userID", $userId);
                $exec->bindparam(":inlogTijd", $time1Str);
                $exec->bindparam(":uitlogTijd", $signOff);
                $exec->bindparam(":totaalTijd", $totalTime);
                if($exec->execute()){
                    return "welkom bij technolab " . $name ."!";
                }
            }
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    // WIM STUKJE 3UITLOG TIME STAMP
    Public function CheckOut($userID, $name){
    try{
        $sql = "SELECT inlogTijd, uitlogTijd, totaalTijd FROM scan WHERE userID = :userID ORDER BY id DESC LIMIT 1";
        $exec = $this->connect()->prepare($sql);
        $exec->bindparam(":userID",$userID);
        $exec->execute();
        
        $time1 = new DateTime();
        $lastRec = $exec->fetch(PDO::FETCH_ASSOC);//HAALT DE RESULTATEN MET BEHULPT VAN FETS EEN ARRAY OP
        $oldSignInTime = strtotime($lastRec["inlogTijd"]);

        $time1->setTimestamp($oldSignInTime);
        $time1str = $time1->format('Y-m-d H:i:s');

        $time2 = new DateTime();
        $time2str = $time2->format('Y-m-d H:i:s');

        $interval = $time1->diff($time2);
        $hours = $interval->h + ($interval->i / 60) + ($interval->s / 3600);
        if($hours == 0){
            $hours = $hours + 1;
        }
        // else{
        //     $hour_diff = $interval->h;
        // }


        $sql = "UPDATE scan SET uitlogTijd = :uitlogTijd, totaalTijd = :totaalTijd WHERE userID = :userID ORDER BY id DESC LIMIT 1";
        $exec = $this->connect()->prepare($sql);
        $exec->bindparam(":uitlogTijd", $time2str);
        $exec->bindparam("totaalTijd",$hours);
        $exec->bindparam(":userID",$userID);
        $exec->execute();
        if($exec->execute()){       
            return "Tot ziens " .$name . "! ";
            //. "<br>totaal uren gewerkt: " . $hour_diff;
        }

    }catch(Exception $e){
        echo $e->getMessage();

    }

    
    }
}
?>