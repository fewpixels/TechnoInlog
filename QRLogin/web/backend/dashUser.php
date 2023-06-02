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
<h1>Scanlijst</h1>
<a href="../dash.php"><button type="button">Terug</a></button>
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
    echo "<td>" . $singleScan->naam . "</td>"; 
    echo "<td>" . $singleScan->inlogTijd . "</td>"; //en dit ook
    echo "<td>" . $singleScan->uitlogTijd . "</td>";
    echo "<td>" .$singleScan->totaalTijd . "</td>";  
    echo "<td>" . "<a href='editUser.php?user=".$singleScan->userID."'><button type='button'>Bewerken</a></button>";
    echo "<td>" . "<a href=''><button type='button'>Verwijderen</a></button>"; 
    echo "</tr>";
  }
  ?>
 </table>
 </article>
 <div id="tri">

    </div>
</body>

