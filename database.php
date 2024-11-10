<?php
$servername = "localhost";  
$username = "root";         
$password = ""; 
$dbname ="sushi_restaurant";            

$conn = mysqli_connect($servername, $username, $password ,$dbname);

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";

//  $sql = "CREATE DATABASE sushi_restaurant";
//  if (mysqli_query($conn, $sql)) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . mysqli_error($conn);
// }
mysqli_select_db($conn,'sushi_restaurant');
//   $sql = "CREATE TABLE users (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     hpassword VARCHAR(255) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//  )";


//  if (mysqli_query($conn, $sql)) {
//      echo "Table 'users' created successfully!";
//  } else {
//      echo "Error creating table: " . mysqli_error($conn);
//  }

?>
