<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


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
  <tr>
    <td>01</td>
    <td>Wim van der Linden</td>
    <td>08:30</td>
	<td>16:30</td>
	<td>7.5</td>
  </tr>
  <tr>
    <td>01</td>
    <td>Wim van der Linden</td>
    <td>08:30</td>
	<td>16:30</td>
	<td>7.5</td>
  </tr>
 </table>
</body>

php>
