<?php
declare (strict_types=1);
//1. Set Up & Start

$host="localhost";
$dbname="connection_test";
$user ="root";
$pass ="";

$dsn="mysql:host=$host;dbname=$dbname";

try{
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO ::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}