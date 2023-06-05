<?php
require_once '../../backend/classes/dashboard.php';

if($_GET['page'] == "dash"){ //optimalisatie, alleen inladen als je vanuit een gebruikers pagina komt
    require_once '../../backend/classes/user.php';
    $users = new User();
    $usersData = $users->getUsers();
}

$record = new Dashboard();

if(isset($_POST['create'])){
	$record->createRecord($_POST);
}

if(isset($_POST['dashBack'])){
	header("Location: dash.php");
}

if(isset($_POST['userBack'])){
	header("Location: dashUser.php?user=".$_GET['user']."&name=".$_GET['name']);
}
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>
    <main id="mainmain">
        <article id="main">
        <?php 
            if($_GET['page'] == "dash"){
                echo "<h2>scan aanmaken</h2>";
            }else{
                echo "<h2>scan aanmaken voor ".$_GET['name']."</h2>";
            }
        ?>
            <section class="form">
                <form method="post" enctype="application/x-www-form-urlencoded"> <!-- deze enctype gebruiken om basis encoding te gebruiken voor formulieren -->
                    <label for="inlogTijd" id="inlogTijd">inlog tijd: </label>
                    <input type="datetime-local" step="1" name="inlogTijd">
                    <br>
                    <label for="uitlogTijd" id="uitlogTijd">uitlog tijd: </label>
                    <input type="datetime-local" step="1" name="uitlogTijd">
                    <br>
                    <label for="userID" id="userID">voor wie? </label>

                    <?php if($_GET['page'] == "dash"){ ?>
                        <select id="userID" name="userID">
                            <?php
                                foreach($usersData as $user){
                                    if($user->tussenvoegsel != "" || $user->tussenvoegsel != null ){
                                        echo "<option value ='".$user->id."'>".$user->id." - ".$user->voornaam." ".$user->tussenvoegsel." ".$user->achternaam."</option>";

                                    }else{
                                        echo "<option value ='".$user->id."'>".$user->id." - ".$user->voornaam." ".$user->achternaam."</option>";
                                    }
                                }
                                echo "</select>"
                            ?>
                        
                    <?php }else{
                            echo "<select id='userID' name='userID'>";
                            echo "<option value='".$_GET['user']."'>".$_GET['user']." - ".$_GET['name']."</option>";
                            echo "</select>";
                      }
                    ?>
                    
                    <br>
                    <label> totaal tijd wordt automatisch berekend na het opslaan! </label>
                    <br><br>
                    <input type="submit" name="create" value="aanmaken">
                    <?php
                    if($_GET['page'] == "dash"){
                    ?>
                        <input type="submit" name="dashBack" value="terug">
                    <?php
                    }else{
                    ?>
                        <input type="submit" name="userBack" value="terug">
                    <?php
                    }
                    ?>
                </form>
            </section>
    </main>
            <div id="tri">
            </div>
</body>