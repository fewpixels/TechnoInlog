<?php

// Connect to the database
$conn = mysqli_connect("localhost","root", '', 'inlogtechnolab'); //het moest dus zo zijn: servernaam, username, wachtwoord, database naam


// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Execute a SQL query to retrieve the data
$sql = "SELECT * FROM my_table"; //verander tabel naam naar scan, loopt hier vast
$result = mysqli_query($conn, $sql);

?>
<head>
  <link rel="stylesheet" href="ms.css">
</head>
<body>
    <img src="hoooo.png" alt="">


<h1>welcome slavemaster</h1>
<table class = "sheet">
  <tr>
    <th>UserID</th>
    <th>Naam</th>
    <th>InlogTijd</th>
	<th>UitlogTijd</th>
	<th>TotaalTijd</th>
  </tr>
  
  <?php
  while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["naam"] . "</td>"; //dit ook veranderen
    echo "<td>" . $row["email"] . "</td>"; //en dit ook
    echo "</tr>";
  }
  ?>
 </table>
</body>

