<?php
require_once '../backend/classes/dashboard.php';

$scans = new Dashboard();

$scanList = $scans->getScansById($_GET['user']);
?>
<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<img src="../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>


    
<article id='container'>
<h1>Scanlijst</h1>
<a href="ms.php"><button type="button">Terug</a></button>
<table class = "sheet">
  <tr>
    <th>UserID</th>
    <th>Naam</th>
    <th>InlogTijd</th>
    <th>UitlogTijd</th>
	  <th>tijd verschil</th>
    <th>aantal checkins</th>
    <th>aantal checkouts</th>
    <th>checkin indicator</th>
  </tr>
  
  <?php
  foreach($scanList as $singleScan){
    echo "<tr>";
    echo "<td>" . $singleScan->userID . "</td>";
    echo "<td>" . $singleScan->naam . "</td>"; 
    echo "<td>" . $singleScan->inlogTijd . "</td>"; //en dit ook
    echo "<td>" . $singleScan->uitlogTijd . "</td>";
    echo "<td>" .$singleScan->totaalTijd . "</td>";  
    echo "</tr>";
  }
  ?>
 </table>
 </article>
 <div id="tri">

    </div>
</body>

