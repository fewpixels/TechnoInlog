<?php

// Connect to the database
//$conn = mysqli_connect("mysql:host=localhost;dbname=inlogtechnolab", 'root', '',);
try{
  $conn = new PDO("mysql:host=localhost;dbname=inlogtechnolab", 'root', '',);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $conn;
}catch(PDOException $e){
  echo $e->getMessage();
  
}

// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Execute a SQL query to retrieve the data
$sql = "SELECT * FROM my_table";
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
    echo "<td>" . $row["naam"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "</tr>";
  }
  ?>
 </table>
</body>

