<?php
require_once '../../backend/classes/dashboard.php';

$record = new Dashboard();

if(isset($_POST['confirm'])){
	$record->deleteRecord($_GET['id']);
}

if(isset($_POST['back'])){
	header("Location: dash.php");
}
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>
    <main id="mainmain">
        <article id="main">
        <h2>Weet u zeker dat u dit wilt verwijderen? Dit kan niet meer worden herstelt</h2>
            <section class="form">
                <form method="post" enctype="application/x-www-form-urlencoded"> <!-- deze enctype gebruiken om basis encoding te gebruiken voor formulieren -->
                    <input type="submit" name="confirm" value="ja, verwijderen!">
                    <input type="submit" name="back" value="terug">
                </form>
            </section>
    </main>
            <img src="../image/Capture.PNG" alt="" id="otherimg">
            <div id="tri">
            </div>
</body>