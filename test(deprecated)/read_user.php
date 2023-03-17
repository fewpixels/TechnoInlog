<?php
// Retrieve tag ID from HTTP POST request
$tag_id = $_POST['tag_id'];

// Query the MySQL database to check if the user is already registered
// $query = "SELECT * FROM users WHERE tag_id = '$tag_id'";
// $result = mysqli_query($connection, $query);

// if (mysqli_num_rows($result) == 0) {
//     // User is not registered, prompt to register
//     echo "User not registered, please enter your information";
//     // Display registration form
// } else {
//     // User is registered, retrieve user information
//     $user = mysqli_fetch_assoc($result);
//     // Authenticate user
//     if ($user['tag_id'] == $tag_id) {
//         echo "Welcome, ".$user['name']."!";
//     } else {
//         echo "Authentication failed!";
//     }
// }

echo $tag_id;
?>
