<?php
require_once '../../backend/classes/dashboard.php';

$scans = new Dashboard();

$scanList = $scans->getScans();
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>  
<article id='container'>
  <h1>Scanlijst </h1>
  <table>
    <tr>
      <td><a href="../index.html"><button type="button">Terug</a></button>
      <a href="./createRecord.php?page=dash"><button type="button">Scan aanmaken</a></button>
    </tr>
  </table>

  <table class = "sheet">
    <tr>
      <th>UserID</th>
      <th>Naam</th>
      <th>Inlog tijd</th>
      <th>Uitlog tijd</th>
      <th>Totaal tijd</th>
      <th>Opties</th>
    </tr>
    
    <?php
    foreach($scanList as $singleScan){
      echo "<tr>";
      echo "<td>" . $singleScan->userID . "</td>";
      echo "<td> <a id='dashName' href='dashUser.php?user=" . $singleScan->userID . "&name=". $singleScan->naam . "'>" . $singleScan->naam . "</a> </td>"; 
      echo "<td>" . $singleScan->inlogTijd . "</td>"; //en dit ook
      echo "<td>" . $singleScan->uitlogTijd . "</td>";
      echo "<td>" .$singleScan->totaalTijd . "</td>"; 
      echo "<td>" . "<a href='editRecord.php?record=".$singleScan->id."&page=dash'><button type='button'>Bewerken</a></button>";
      echo "<a href='confirmRecordDelete.php?id=".$singleScan->id."&page=dash'><button type='button'>Verwijderen</a></button>"; 
      echo "</tr>";
    }
    ?>
  </table>
 </article>
 <div id="tri">

    </div>
</body>

