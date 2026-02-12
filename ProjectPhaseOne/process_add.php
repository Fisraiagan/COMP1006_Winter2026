<?php
require "db.php";

$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS); 
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS); 
$position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$teamName = filter_input(INPUT_POST, 'team_name', FILTER_SANITIZE_SPECIAL_CHARS);

//validation time - serverside
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
// require email and validate proper format
if ($email === null || $email === '') {
    $errors[] = "Email is Required."; 
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email must be a valid email."; 
}
if ($teamName === null || $teamName === '') {
    $errors[] = "Team Name is Required."; 
}
//if there are errors, display to user and exit the script
if(!empty($errors)) {
    foreach ($errors as $error) : ?>
        <li><?php echo $error; ?> </li>
    <?php endforeach;
    //stop the script from executing  
    exit; 
}
//insert into database
$sql = "INSERT INTO team_members (first_name, last_name, position, phone, email, team_name) 
VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$firstName, $lastName, $position, $phone, $email, $teamName]);
//redirect back to index.php
header("Location: index.php");  