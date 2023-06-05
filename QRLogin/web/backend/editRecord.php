<?php
require_once '../../backend/classes/dashboard.php';

$record = new Dashboard();
$recordData = $record->getScan();

if(isset($_POST['edit'])){
	$record->updateRecord($_POST);
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
            <section class="form">
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
                    <input type="submit" name="edit" value="aanpassen">
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
            <img src="../image/Capture.PNG" alt="" id="otherimg">
            <div id="tri">
            </div>
</body>