<?php
require_once '../../backend/classes/dashboard.php';
require './sessionCheck.php';
$scans = new Dashboard();

$scanList = $scans->getScansById($_GET['user']);
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
    <h1>Scanlijst van <?php echo $_GET['name'] ?>  </h1>
    <table>
      <tr>
        <td>
        <?php if (isset($_GET['prev']) && isset($_GET['page']) && $_GET['page'] == "dash"): ?>
            <a href="./dash.php?pageno=<?php echo $_GET['prev']; ?>"><button type="button">Terug</button></a>
        <?php elseif (isset($_GET['page']) && $_GET['page'] == "userManage"): ?>
            <a href="./userPanel.php?pageno=<?php echo $_GET['prev']; ?>"><button type="button">Terug</button></a>
        <?php else: ?>
            <a href="./dash.php?pageno=0"><button type="button">Terug</button></a>
        <?php endif; ?>
       
        <?php
          echo "<a href='./createRecord.php?page=user&user=".$_GET['user']."&name=".$_GET['name']."&prev=".$_GET['pageno']."'><button type='button'>Scan aanmaken</button></a>";
          echo "<a href='./generateQR.php?page=user&id=".$_GET['user']."&name=".$_GET['name']."&prev=".$_GET['pageno']."'><button type='button'>QR code opnieuw genereren</button></a>";
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
        echo "<td>" . "<a href='editRecord.php?record=".$singleScan->id."&page=user&user=".$singleScan->userID."&name=".$_GET['name']."&prev=".$_GET['pageno']."'><button type='button'>Bewerken</a></button>";
        echo "<a href='confirmRecordDelete.php?id=".$singleScan->id."&page=user&user=".$singleScan->userID."&name=".$_GET['name']."&prev=".$_GET['pageno']."'><button type='button'>Verwijderen</a></button></td>"; 
        echo "</tr>";
      }
      ?>
    </table>
    <table>
    <tr>
        <td>
        <a href="<?php 
          if($_GET['pageno'] <= 0){ 
              echo "?page=user&user=".$_GET['user']."&name=".$_GET['name']."&pageno=0"; 
          } else { 
              echo "?page=user&user=".$_GET['user']."&name=".$_GET['name']."&pageno=".($_GET['pageno'] - 1); 
          } ?>"><button type="button">Terug</button></a>

      <a href="<?php 
          if($_GET['pageno'] <= 0 && $count >= 5){
              echo "?page=user&user=".$_GET['user']."&name=".$_GET['name']."&pageno=1"; 
          }elseif($count < 5) {
              echo "?page=user&user=".$_GET['user']."&name=".$_GET['name']."&pageno=".$_GET['pageno'];
          }elseif($count > 5){ 
              echo "?page=user&user=".$_GET['user']."&name=".$_GET['name']."&pageno=".($_GET['pageno'] + 1); 
          } ?>"><button type="button">Volgende</button></a>
        </td>
    </tr>
  </table>
  </article>
 <div id="tri">

    </div>
</body>

