<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = [];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="refresh" content="6; url='./web/index.php'" />
    <link rel="stylesheet" href="./style/style.css">
  </head>
  <body>
    <img src="./image/Technolab Logo.png" alt="logo van technolab" id="logo">
    <article id="mainmain">
        <h2>Systeem is aan het opstarten! zometeen word je doorgestuurd naar de scan pagina</h2>
    </article>
    <div id="tri">

    </div>
  </body>
</html>