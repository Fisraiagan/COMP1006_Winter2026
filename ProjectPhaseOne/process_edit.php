<?php
require "db.php";

//validation time - serverside
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS); 
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS); 
$position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);    
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);    
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);    
$teamName = filter_input(INPUT_POST, 'team_name', FILTER_SANITIZE_SPECIAL_CHARS);    
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

$errors = [];
//require text fields
if ($firstName === null || $firstName === '') {
    $errors[] = "First Name is Required."; 
}   
if ($lastName === null || $lastName === '') {
    $errors[] = "Last Name is Required."; 
}   
if ($position === null || $position === '') {
    $errors[] = "Position is Required."; 
}   
if ($phone === null || $phone === '') {
    $errors[] = "Phone is Required."; 
}   
if ($email === null || $email === '') {
    $errors[] = "Email is Required."; 
}
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email must be a valid email."; 
}   
if ($teamName === null || $teamName === '') {
    $errors[] = "Team Name is Required."; 
}   
if ($id === false || $id <= 0) {
    $errors[] = "Invalid Member ID."; 
}   

//if there are errors, display to user and exit the script
if(!empty($errors)) {
    echo "<h2>Errors Found:</h2>";
    foreach($errors as $error) {
        echo "<p>$error</p>";
    }
    exit(); //stop processing form
}
//update database
$sql = "UPDATE team_members SET first_name = ?, last_name = ?, position = ?, phone = ?, email = ?, team_name = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$firstName, $lastName, $position, $phone, $email, $teamName, $id]);
//redirect back to index.php    
header("Location: index.php");
?>