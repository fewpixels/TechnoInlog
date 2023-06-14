<?php
if(isset($_GET['data'])){
    require_once '../../backend/classes/DBConfig.php';
    $check = new DBConfig();
    $check->checkAdmin($_GET['data']);
}
if(isset($_GET['status'])){
    if($_GET['status'] == "denied"){
        $message = "<h2>helaas, u heeft geen administratie rechten om verder te gaan</h2>";
        session_destroy();
        header( "refresh:5; url=../index.php" ); 
    }if($_GET['status'] != "denied"){
        $message = "<h2>leuk geprobeerd! je komt er niet in!</h2>";
        session_destroy();
        header( "refresh:5; url=../index.php" ); 
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/verify.js"></script>
        <link rel="stylesheet" href="../../style/style.css">
    </head>
    <body onload="webScan()">
        <img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
            <article id="mainmain"> 
                <article id="main">
                <?php if(!isset($_GET['status'])){ ?>
                    <video id="scanner" ></video>
                    <h1 id="qrText">Scan uw pas om admin status te verifiëren...</h1>
                <?php }else{ echo $message; }?>
                    <a href="../index.php"><button type="button">Terug</button></a>
                </article>
            </article>
        <img src="../../image/Capture.PNG" alt="" id="otherimg">
        <div id="tri">

        </div>
    </body>
</html>
