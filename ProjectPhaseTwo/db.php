<?php  
// $host = "localhost:3309"; //hostname
// $dbname = "teamsapp";
// $user = "root"; //username
// $password = "MsDCAN33**"; //password

$host = "172.31.22.43"; //hostname
$dbname = "Chris200344355"; //database name
$user = "Chris200344355"; //username
$password = "QVQWcn24nJ"; //password


//points to the database
$dsn = "mysql:host=$host;dbname=$dbname";

//try to connect, if connected echo a yay!
try {
   $pdo = new PDO ($dsn, $user, $password); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
// use exec() because no results are returned
    //$pdo->exec($sql);
///echo "<p> YAY CONNECTED! </p>"; 
}
//what happens if there is an error connecting 
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}

?>  
