<?php
require_once '../../backend/classes/dashboard.php';

$scans = new Dashboard();

$scanList = $scans->getScansById($_GET['user']);
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>    
  <article id='container'>
    <h1>Scanlijst van <?php echo $_GET['name'] ?> </h1>
    <table>
      <tr>
        <td><a href="./dash.php"><button type="button">Terug</a></button>
        <?php 
          echo "<a href='./createRecord.php?page=user&user=".$_GET['user']."&name=".$_GET['name']."'><button type='button'>Scan aanmaken</a></button>";
          echo "<a href='./generateQR.php?page=user&id=".$_GET['user']."&name=".$_GET['name']."'><button type='button'>QR code opnieuw genereren</a></button>";
        ?>
        <!-- was eventjes het snelste manier om dat boven werkend te krijgen -->
      </tr>
    </table>
    <table class = "sheet">
      <tr>
        <th>Inlog tijd</th>
        <th>Uitlog tijd</th>
        <th>Totaal tijd</th>
        <th>Opties</th>
      </tr>
      
      <?php
      foreach($scanList as $singleScan){
        echo "<tr>";
        echo "<td>" . $singleScan->inlogTijd . "</td>";
        echo "<td>" . $singleScan->uitlogTijd . "</td>";
        echo "<td>" .$singleScan->totaalTijd . "</td>";  
        echo "<td>" . "<a href='editRecord.php?record=".$singleScan->id."&page=user&user=".$singleScan->userID."&name=".$_GET['name']."'><button type='button'>Bewerken</a></button>";
        echo "<td>" . "<a href='confirmRecordDelete.php?id=".$singleScan->id."&page=user&user=".$singleScan->userID."&name=".$_GET['name']."'><button type='button'>Verwijderen</a></button>"; 
        echo "</tr>";
      }
      ?>
    </table>
  </article>
 <div id="tri">

    </div>
</body>

