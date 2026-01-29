<?php
require "includes/header.php";



// filter and sanitize input data
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

//Required fields check
$errors = []; 
if (empty($firstName)) {
    $errors[] = "First name is required.";
}
if (empty($lastName)) {
    $errors[] = "Last name is required.";
}
if (empty($email)) {
    $errors[] = "Email is required.";
}
if (empty($message)) {
    $errors[] = "Message is required.";
}
// If there are errors, display them and stop processing
if (!empty($errors)) {
    echo "<main>";
    echo "<h2>Request Submission Errors</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
    echo "<p><a href='index.php'>Go back to the order form</a></p>";
    echo "</main>";
    
    exit;
}
?>
<h1>Information received</h1>
<main>
  <h2>Information Confirmation</h2>
  <p>
      Thanks <strong><?= $firstName ?></strong>!
      Your Information has been received and sent to the bakery.
    </p>
  <p>info details:</p>
  <ul>
    <li>First Name: <?php echo $_POST['first_name']; ?></li>
    <li>Last Name: <?php echo $_POST['last_name']; ?></li>
    <li>Email: <?php echo $_POST['email']; ?></li>
    <li>Message: <?php echo $_POST['message']; ?></li>
  </ul>
</main>
<?php
require "includes/footer.php";