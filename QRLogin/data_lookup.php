<?php

require_once 'backend/classes/DBConfig.php';

if(isset($_GET['data'])) {
    echo 'beste <b>' . $_GET['data'] . '</b> je bent ingelogd!'; 
    //nu dus ervoor zorgen dat het de gebruiker ophaalt en hier weergeeft ipv echo lol

    header( "refresh:2; url=http://localhost/github/TechnoInlog/QRLogin/" ); 
}

?>