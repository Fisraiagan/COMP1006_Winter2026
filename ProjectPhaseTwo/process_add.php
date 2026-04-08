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

$imgPath =null;



//check if a file was uploaded without errors
if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE){
if($_FILES['image']['error'] !== UPLOAD_ERR_OK){
    $errors[] = "Error uploading file.";

}else if ($_FILES['image']['size'] > 5 * 1024 * 1024) { // Limit file size to 5MB
    $errors[] = "File size must be less than 5MB.";

}
else{
//only allow certain file types for security
$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
//get the actual MIME type of the uploaded file
$detectedType = mime_content_type($_FILES['image']['tmp_name']);
//validate the MIME type against allowed types
if(!in_array($detectedType, $allowedTypes)){
    $errors[] = "Only JPEG, JPG, PNG and WebP images are allowed.";
}else{
    //get the file extension based on the MIME type
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    //generate a unique file name to prevent overwriting existing files
    $newFileName = uniqid('image_', true) . '.' . strtolower($extension);
    //set the destination path for the uploaded file
    $destination = 'uploads/' . $newFileName;

    //move the uploaded file to the destination directory
    if(move_uploaded_file($_FILES['image']['tmp_name'], $destination)){
        $imgPath = "uploads/" . $newFileName; //store the relative path to save in the database

}else{
    $errors[] = "Failed to save uploaded file.";
}

    }

       }

        }   
if(empty($errors)){
//insert into database
$sql = "INSERT INTO team_members (first_name, last_name, position, phone, email, team_name,image_path) 
VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$firstName, $lastName, $position, $phone, $email, $teamName,$imgPath]);
//redirect back to index.php
header("Location: index.php");  
exit();
    }

        
//if there are errors, display to user and exit the script
if(!empty($errors)) {
    foreach ($errors as $error) : ?>
        <li><?php echo $error; ?> </li>
    <?php endforeach;
    //stop the script from executing  
    exit; 
}
        
    