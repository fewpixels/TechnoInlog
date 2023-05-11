<?php
require_once 'backend/classes/user.php';

$user = new User();

if(isset($_POST['register'])){
	$user->createUser($_POST);
}

if(isset($_POST['back'])){
	header("Location: index.html");
}
?>
<head>
    <link rel="stylesheet" href="style/style.css">
</head>
<img src="image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>
    <main id="mainmain">
        <article id="main">
            <section class="form">
                <form method="post" enctype="application/x-www-form-urlencoded"> <!-- deze enctype gebruiken om basis encoding te gebruiken voor formulieren -->
                    <label for="voornaam" id="voornaam">Voornaam: </label>
                    <input type="text" name="voornaam">
                    <br>
                    <label for="tussenvoegsel" id="tussenvoegsel">Tussenvoegsel: </label>
                    <input type="text" name="tussenvoegsel">
                    <br>
                    <label for="achternaam" id="achternaam">Achternaam: </label>
                    <input type="text" name="achternaam">
                    <br>
                    <input type="submit" name="register" value="Maak gebruiker aan">
                    <input type="submit" name="back" value="terug">
                </form>
            </section>
    </main>
            <img src="image/Capture.PNG" alt="" id="otherimg">
            <div id="tri">
            </div>
</body>