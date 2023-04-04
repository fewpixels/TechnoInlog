<?php

// Connect to the database
$conn = mysqli_connect("localhost","root", '', 'inlogtechnolab'); //het moest dus zo zijn: servernaam, username, wachtwoord, database naam


// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Execute a SQL query to retrieve the data
$sql = "SELECT scan.userID,scan.inlogTijd,scan.uitlogTijd,scan.totaalTijd, CONCAT(users.voornaam,' ',users.tussenvoegsel,' ',users.achternaam) AS naam
From users
INNER JOIN scan ON users.id = scan.userID"; //verander tabel naam naar scan, loopt hier vast
$result = mysqli_query($conn, $sql);// SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate

?>
<head>
  <link rel="stylesheet" href="ms.css">
</head>
<body>
    <img src="../image/Technolab Logo.png" alt="" id='logo'>


    
<article id='container'>
<h1>welcome </h1>
<table class = "sheet">
  <tr>
    <th>UserID</th>
    <th>Naam</th>
    <th>InlogTijd</th>
    <th>Uitlogtijd</th>
	  <th>TotaalTijd</th>
    <th>aantall checkins</th>
    <th>aanpassen</th>
  </tr>
  
  <?php
  while ($row = mysqli_fetch_assoc($result)){


   




    echo "<tr>";
    echo "<td>" . $row["userID"] . "</td>";

    echo "<td>" . $row["naam"] . "</td>"; //hier moet een join komen met daar in de naam 

    echo "<td>" . $row["inlogTijd"] . "</td>"; //en dit ook
    echo "<td>" . $row["uitlogTijd"] . "</td>";
    echo "<td>" . $row["totaalTijd"] . "</td>";
    
    echo "</tr>";
  }
  ?>
 </table>
 </article>
 <div id="tri">

    </div>
</body>

