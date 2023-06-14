<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = [];
    header("refresh:0.5; url=../index.php")
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../style/style.css">
    </head>
    <body onload="webScan()">
        <img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
            <article id="mainmain">
                
                <article id="main">
                    <h1 id="qrText">Uitloggen...</h1>
                </article>
            
            </article>
        <img src="../../image/Capture.PNG" alt="" id="otherimg">
        <div id="tri">

        </div>
    </body>
</html>
