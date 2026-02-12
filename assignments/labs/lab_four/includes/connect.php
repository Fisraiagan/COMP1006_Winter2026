<?php 
$host = "localhost:3309"; //hostname
$db = "phpmyadmin"; //database name
$user = "root"; //username
$password = "MsDCAN33**"; //password

//points to the database
$dsn = "mysql:host=$host;dbname=$db";

//try to connect, if connected echo a yay!
try {
   $pdo = new PDO ($dsn, $user, $password); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   echo "<p> YAY CONNECTED! </p>";
}
//what happens if there is an error connecting 
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}
