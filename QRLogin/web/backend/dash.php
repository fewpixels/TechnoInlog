<?php
require './sessionCheck.php';
require_once '../../backend/classes/dashboard.php';

$scans = new Dashboard();

$scanList = $scans->getScans();
$count = count($scanList);
$removeResults = $_GET['pageno'] * 5;
if($_GET['pageno'] > 0){
   $scanList = array_splice($scanList,$removeResults, 5 );
   $count = $count - ($_GET['pageno'] * 5);
}else{
    $scanList = array_splice($scanList,0,5);
}
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>  
<article id='container'>
  <h1>Scanlijst</h1>
  <table>
    <tr>
      <td><a href="../index.php"><button type="button">Terug</button></a>
      <a href="./createRecord.php?page=dash&prev=<?php echo $_GET['pageno']; ?>"><button type="button">Scan aanmaken</button></a>
      <a href="./userPanel.php?pageno=0"><button type="button">Gebruikers beheren</button></a>
      </td>
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
      echo "<td> <a id='dashName' href='dashUser.php?user=" . $singleScan->userID . "&name=". $singleScan->naam . "&prev=".$_GET['pageno']."&page=dash&pageno=0'>" . $singleScan->naam . "</a> </td>"; 
      echo "<td>" . $singleScan->inlogTijd . "</td>"; //en dit ook
      echo "<td>" . $singleScan->uitlogTijd . "</td>";
      echo "<td>" .$singleScan->totaalTijd . "</td>"; 
      echo "<td>" . "<a href='editRecord.php?prev=".$_GET['pageno']."&record=".$singleScan->id."&page=dash'><button type='button'>Bewerken</button></a>";
      echo "<a href='confirmRecordDelete.php?prev=".$_GET['pageno']."&id=".$singleScan->id."&page=dash'><button type='button'>Verwijderen</button></a>"; 
      echo "</tr>";
    }
    ?>
  </table>
  <table>
    <tr>
        <td>
            <a href=<?php
              if($_GET['pageno'] <= 0){ 
                echo "?pageno=".($_GET['pageno'] = 0); 
                }else{ 
                  echo "?pageno=".($_GET['pageno'] - 1); 
                } ?>><button type="button">Terug</button></a>
            <a href=<?php 
              if($_GET['pageno'] <= 0 && $count >= 5){ 
                echo "?pageno=".($_GET['pageno'] = 1); 
                }elseif($count < 5){
                  echo "?pageno=".$_GET['pageno'];
                  }else{ 
                    echo "?pageno=".($_GET['pageno'] + 1); 
                    } ?>><button type="button">Volgende</button></a>
        </td>
    </tr>
  </table>
 </article>
 <div id="tri">

    </div>
</body>

