<?php
require_once '../../backend/classes/user.php';

$users = new User();

$usersData = $users->getUsers();
$count = count($usersData);
$removeResults = $_GET['pageno'] * 5;
if($_GET['pageno'] > 0){
   $usersData = array_splice($usersData,$removeResults, 5 );
   $count = $count - ($_GET['pageno'] * 5);
}else{
    $usersData = array_splice($usersData,0,5);
}
?>
<head>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<img src="../../image/Technolab Logo.png" alt="logo van technolab" id="logo">
<body>  
<article id='container'>
  <h1>Gebruikersbeheer</h1>
  <table>
    <tr>
      <td><a href="./dash.php?pageno=0"><button type="button">Terug</button></a>
      </td>
    </tr>
  </table>

  <table class = "sheet">
    <tr>
      <th>UserID</th>
      <th>Naam</th>
      <th>Opties</th>
    </tr>
    
    <?php
    foreach($usersData as $user){
      echo "<tr>";
      echo "<td>" . $user->id . "</td>";
      echo "<td> <a id='dashName' href='dashUser.php?user=" . $user->id . "&name=". $user->naam . "&prev=".$_GET['pageno']."&page=userManage&pageno=0'>" . $user->naam . "</a> </td>";  
      echo "<td>" . "<a href='editRecord.php?record=".$user->id."&page=userManage'><button type='button'>Bewerken</button></a>";
      echo "<a href='confirmRecordDelete.php?id=".$user->id."&page=userManage'><button type='button'>Verwijderen</button></a>"; 
      echo "<a href='./generateQR.php?page=userManage&id=".$user->id."&name=".$user->naam."&prev=".$_GET['pageno']."'><button type='button'>QR code opnieuw genereren</button></a>";
      echo "</td>";
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

