<?php

// Connect to the database
$conn = mysqli_connect("localhost","root", '', 'inlogtechnolab'); //het moest dus zo zijn: servernaam, username, wachtwoord, database naam


// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Execute a SQL query to retrieve the data
$sql = "SELECT scan.user_id,scan.inlog_tijd,scan.uitlog_tijd,scan.verschil_in_uur, CONCAT(users.voornaam,' ',users.tussenvoegsel,' ',users.achternaam) AS naam
From users
INNER JOIN scan ON users.id = scan.user_id"; //verander tabel naam naar scan, loopt hier vast
$result = mysqli_query($conn, $sql);// SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate



function differenceInHours($startdate,$enddate){
	$starttimestamp = strtotime($startdate);
	$endtimestamp = strtotime($enddate);
	$difference = abs($endtimestamp - $starttimestamp)/3600;
	return $difference;
}

?>
<head>
  <link rel="stylesheet" href="ms.css">
</head>
<body>
    <img src="hoooo.png" alt="">


<h1>welcome </h1>
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
  while ($row = mysqli_fetch_assoc($result)){


   




    echo "<tr>";
    echo "<td>" . $row["user_id"] . "</td>";

    echo "<td>" . $row["naam"] . "</td>"; //hier moet een join komen met daar in de naam 

    echo "<td>" . $row["inlog_tijd"] . "</td>"; //en dit ook

    echo "<td>" . $row["uitlog_tijd"] . "</td>";

    echo "<td>" .round(differenceInHours($row["inlog_tijd"], $row["uitlog_tijd"]))  . "</td>";
    
    echo "</tr>";
  }
  ?>
 </table>
</body>

