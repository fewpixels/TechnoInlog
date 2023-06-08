<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<?php

    include('../../backend/phpqrcode/qrlib.php');
    $tempDir = '../../generated/';
    $showDir = 'generated/';
    //het pad waarin de qr-code word opgeslagen, opslaan
    $codeContents = $_GET['id'];
    //inhoud van de qr-code

    $fileName = $_GET['name'].$_GET['id'].'.png'; //naam van het bestand
    $pngAbsoluteFilePath = $tempDir.$fileName;

    // aanmaken!
    QRcode::png($codeContents, $pngAbsoluteFilePath);

    echo '<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
          <body>
          <main id="mainmain">
          <article id="main">';

    if($_GET['page'] == "scan"){
        echo '<h1> Gebruiker en QR-code aangemaakt! </h1>';
        echo '<br> <p>'.$_GET['name'].' in de database te vinden onder ID: '.$_GET['id'].'</p>';
        echo '<br>';
    }if($_GET['page'] == "userManage"){
        echo '<h1> Gebruiker en QR-code aangemaakt! </h1>';
        echo '<br> <p>'.$_GET['name'].' in de database te vinden onder ID: '.$_GET['id'].'</p>';
        echo '<br>';
    }if($_GET['page'] == "user" || $_GET['page'] == "userManageBtn"){
        echo '<h1> QR-code opnieuw aangemaakt! </h1>';
        echo '<br>';
    }
    
    echo '<p>bestand te vinden in: '.$showDir.$fileName.'</p>';
    echo '<br>';
    
    // weergeven!
    echo '<img id="qrimage" src="'.$pngAbsoluteFilePath.'" width="128px"/>';
    if($_GET['page'] == "scan"){
        echo '<a href="./createUser.php"><button type="button">Nog een gebruiker aanmaken</button></a>';
        echo '<a href="../index.html"><button type="button">Terug naar de scanner pagina</button></a>'; 
    }else{
        if(isset($_GET['prev']) && $_GET['page'] == "user"){
            echo "<a href='./dashUser.php?page=user&user=".$_GET['id']."&name=".$_GET['name']."&pageno=".$_GET['prev']."'><button type='button'>terug naar vorige pagina</button></a>";
            echo '<a href="../index.html"><button type="button">Terug naar de scanner pagina</button></a>'; 
        }if(!isset($_GET['prev']) && $_GET['page'] == "user"){
            echo "<a href='./dashUser.php?page=user&user=".$_GET['id']."&name=".$_GET['name']."&pageno=0'><button type='button'>terug naar vorige pagina</button></a>";
            echo '<a href="../index.html"><button type="button">Terug naar de scanner pagina</button></a>'; 
        }if(isset($_GET['prev']) && $_GET['page'] == "userManageBtn"){
            echo "<a href='./userPanel.php?pageno=".$_GET['prev']."'><button type='button'>Terug naar de vorige pagina</button></a>";
            echo '<a href="../index.html"><button type="button">Terug naar de scanner pagina</button></a>'; 
        }if(!isset($_GET['prev']) && $_GET['page'] == "userManage"){
            echo "<a href='./userPanel.php?pageno=0'><button type='button'>Terug naar gebruikersbeheer</button></a>";
            echo '<a href="../index.html"><button type="button">Terug naar de scanner pagina</button></a>'; 
        }
    }

    echo '</main>
          <img src="../image/Capture.PNG" alt="" id="otherimg">
          <div id="tri">
          </div>
          </body>';