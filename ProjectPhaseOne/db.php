<?php  
$host = "localhost:3309"; //hostname
$dbname = "teamsapp";
$user = "root"; //username
$password = "MsDCAN33**"; //password

//points to the database
$dsn = "mysql:host=$host;dbname=$dbname";

//try to connect, if connected echo a yay!
try {
   $pdo = new PDO ($dsn, $user, $password); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   //$sql = "CREATE DATABASE myDB";
// use exec() because no results are returned
    //$pdo->exec($sql);
   echo "<p> YAY CONNECTED! </p>"; 
}
//what happens if there is an error connecting 
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}

// $stmt =$pdo-> prepare("SELECT * FROM team_members");
// $stmt-> execute();

// $rows = $stmt-> fetchAll(PDO::FETCH_ASSOC);

// print_r($rows);
