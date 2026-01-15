<?php
declare (strict_types=1);


/* Database connection details */
$host="localhost";
$dbname="connection_test";
$user ="root";
$pass ="";

/* Data Source Name */
$dsn="mysql:host=$host;dbname=$dbname";

/* Create PDO instance */
try{
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
