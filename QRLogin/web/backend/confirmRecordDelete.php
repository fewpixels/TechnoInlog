<?php
require './sessionCheck.php';
if($_GET['page'] == "dash" || $_GET['page'] == "user"){
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
}

if($_GET['page'] == "userManage"){
    require_once '../../backend/classes/user.php';
    $user = new User();

    $totalRecords = $user->countUserRecords($_GET['id']);

    if(isset($_POST['confirm'])){
        $user->deleteUser($_GET['id']);
    }

    if(isset($_POST['userBack'])){
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
    <?php
    if($_GET['page'] == "dash" || $_GET['page'] == "user"){
    ?>
        <article id="main">
        <h2>Weet u zeker dat u dit wilt verwijderen? Dit kan niet meer worden hersteld</h2>
    <?php
    }if($_GET['page'] == "userManage"){
    ?>
        <article id="dangerMain">
        <h2>Weet u zeker dat u deze gebruiker wilt verwijderen?<br>
            Als u deze gebruiker verwijderd, dan verwijderd u ook al zijn/haar scans.<br><br>
            <u>U staat op het punt <?php echo $_GET['name'] ?> met <?php echo $totalRecords->total ?> scan(s) te verwijderen!</u>
        </h2>
    <?php
    }
    ?>
            <section class="form">
                <form method="post" enctype="application/x-www-form-urlencoded"> <!-- deze enctype gebruiken om basis encoding te gebruiken voor formulieren -->
                    <input type="submit" name="confirm" value="ja, verwijderen!">
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
            </section>
    </main>
            <img src="../image/Capture.PNG" alt="" id="otherimg">
            <div id="tri">
            </div>
</body>