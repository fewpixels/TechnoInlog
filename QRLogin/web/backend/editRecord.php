<?php
require './sessionCheck.php';
if($_GET['page'] == "dash" || $_GET['page'] == "user"){
    require_once '../../backend/classes/dashboard.php';

    $record = new Dashboard();
    $recordData = $record->getScan();

    if(isset($_POST['edit'])){
        $record->updateRecord($_POST);
    }

    if(isset($_POST['dashBack'])){
        header("Location: dash.php?pageno=".$_GET['prev']);
    }

    if(isset($_POST['userBack'])){
        header("Location: dashUser.php?pageno=".$_GET['prev']."&user=".$_GET['user']."&name=".$_GET['name']);
    }
}

if($_GET['page'] == "userManage"){
    require_once '../../backend/classes/user.php';
    
    $user = new User();
    $userData = $user->getUserData($_GET['id']);

    if(isset($_POST['edit'])){
        $user->updateUser($_POST, $_GET['prev'], $userData->id);
    }

    if(isset($_POST['panelBack'])){
        header("Location: userPanel.php?pageno=".$_GET['prev']);
    }
}
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>
    <main id="mainmain">
        <article id="main">
            <section class="form">
                <?php if($_GET['page'] == "dash" || $_GET['page'] == "user"){ ?>
                    <h2>Scan aanpassen</h2>
                    <form method="post" enctype="application/x-www-form-urlencoded"> <!-- deze enctype gebruiken om basis encoding te gebruiken voor formulieren -->
                        <label for="inlogTijd" id="inlogTijd">inlog tijd: </label>
                        <input type="datetime-local" step="1" name="inlogTijd" value="<?php echo $recordData->inlogTijd ?>">
                        <br>
                        <label for="uitlogTijd" id="uitlogTijd">uitlog tijd: </label>
                        <input type="datetime-local" step="1" name="uitlogTijd" value="<?php echo $recordData->uitlogTijd ?>">
                        <br><br>
                        <label> totaal tijd wordt automatisch berekend na het opslaan! </label>
                        <br>
                        <label>op dit moment: <?php echo $recordData->totaalTijd ?> uur/uren </label>

                        <br><br>
                        <input type="submit" name="edit" value="Aanpassen">
                        <?php
                        if($_GET['page'] == "dash"){
                        ?>
                            <input type="submit" name="dashBack" value="Terug">
                        <?php
                        }else{
                        ?>
                            <input type="submit" name="userBack" value="Terug">
                        <?php
                        }
                        ?>
                    </form>
                <?php }if($_GET['page'] == "userManage"){ ?>
                    <h2>Gebruiker aanpassen</h2> 
                    <form method="post" enctype="application/x-www-form-urlencoded">
                    <label for="voornaam" id="voornaam">Voornaam: </label>
                    <input type="text" name="voornaam" value="<?php echo $userData->voornaam ?>">
                    <br>
                    <label for="tussenvoegsel" id="tussenvoegsel">Tussenvoegsel: </label>
                    <input type="text" name="tussenvoegsel" value="<?php echo $userData->tussenvoegsel ?>">
                    <br>
                    <label for="achternaam" id="achternaam">Achternaam: </label>
                    <input type="text" name="achternaam" value="<?php echo $userData->achternaam ?>">
                    <br>
                    <input type="submit" name="edit" value="Aanpassen">
                    <input type="submit" name="panelBack" value="Terug">
                </form>
                <?php } ?>
            </section>
    </main>
            <img src="../image/Capture.PNG" alt="" id="otherimg">
            <div id="tri">
            </div>
</body>