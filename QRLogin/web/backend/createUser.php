<?php
require_once '../../backend/classes/user.php';
$user = new User();

if($_GET['page'] == "scan"){
    if(isset($_POST['register'])){
	    $user->createUser($_POST, $_GET['page']);
    }
}

if($_GET['page'] == "userManage" ){
    session_start();
    if(isset($_POST['register'])){
	    $user->createUser($_POST, $_GET['page']);
    }
}

if(isset($_POST['scanBack'])){
	header("Location: ../index.php");
}

if(isset($_POST['panelBack'])){
	header("Location: ./userPanel.php?pageno=0");
}
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>
    <main id="mainmain">
        <article id="main">
        <h2>Nieuwe gebruiker aanmaken</h2>
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
                    <?php if($_GET['page'] == "userManage"){
                            if($_SESSION['admin'] == 1){                  
                    ?>
                            <label for="isAdmin" id="isAdmin" title="mag scans en gebruikers beheren">Admin rechten (?)</label>
                            <input type="checkbox" name="isAdmin" value=1>    
                            <br>
                    <?php 
                            }
                            if($_SESSION['superAdmin'] == 1){
                    ?>
                            <label for="isSuperAdmin" id="isSuperAdmin" title="mag scans, gebruikers beheren en heeft toegang tot phpMyAdmin">Super admin rechten (?)</label>
                            <input type="checkbox" name="isSuperAdmin" value=1> 
                            <br>
                    <?php
                            }
                        }
                    ?>

                    <input type="submit" name="register" value="Maak gebruiker aan">
                    <?php
                    if($_GET['page'] == "userManage"){
                    ?>
                        <input type="submit" name="panelBack" value="Terug">
                    <?php
                    }else{
                    ?>
                        <input type="submit" name="scanBack" value="Terug">
                    <?php
                    }
                    ?>
                </form>
            </section>
    </main>
            <img src="../image/Capture.PNG" alt="" id="otherimg">
            <div id="tri">
            </div>
</body>