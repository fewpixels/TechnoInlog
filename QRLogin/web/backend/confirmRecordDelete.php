<?php
require_once '../../backend/classes/dashboard.php';

$record = new Dashboard();

if(isset($_POST['confirm'])){
	$record->deleteRecord($_GET['id'], $_GET['page']);
}

if(isset($_POST['dashBack'])){
	header("Location: dash.php?pageno=".$_GET['prev']);
}

if(isset($_POST['userBack'])){
	header("Location: dashUser.php?pageno=".$_GET['prev']."&user=".$_GET['user']."&name=".$_GET['name']);
}
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>
    <main id="mainmain">
        <article id="main">
        <h2>Weet u zeker dat u dit wilt verwijderen? Dit kan niet meer worden hersteld</h2>
            <section class="form">
                <form method="post" enctype="application/x-www-form-urlencoded"> <!-- deze enctype gebruiken om basis encoding te gebruiken voor formulieren -->
                    <input type="submit" name="confirm" value="ja, verwijderen!">

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