<?php
    if(session_status() == 2){
        session_destroy();
    }  
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/scanner.js"></script>
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body onload="webScan()">
        <img src="../image/Technolab Logo.png" alt="logo van technolab" id="logo">
            <article id="mainmain">
                
                <article id="main">
                    <video id="scanner" ></video>
                    <h1 id="qrText">Scan uw pas om in te loggen</h1>
                    <section id="item">
                    <a href="backend/createUser.php?page=scan"><button type="button">Gebruiker toevoegen</button></a>
                    <a href="backend/verify.php"><button type="button">Scans bekijken</button></a>
                    </section>
                </article>
            
            </article>
        <img src="../image/Capture.PNG" alt="" id="otherimg">
        <div id="tri">

        </div>
    </body>
</html>
