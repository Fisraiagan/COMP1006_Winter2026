<?php

//  TODO: connect to the database 
    require "includes/connect.php";
//   TODO: Grab form data (no validation or sanitization for this lab)
    $firstName = $_POST['first_name']; 
    $lastName = $_POST['last_name']; 
    $email = $_POST['email'];

/*
  1. Write an INSERT statement with named placeholders
  2. Prepare the statement
  3. Execute the statement with an array of values
  4.
 
*/
$sql= "INSERT INTO subscribers (first_name, last_name, email) 
        VALUES (:first_name, :last_name, :email)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':first_name', $firstName);
$stmt->bindParam(':last_name', $lastName);
$stmt->bindParam(':email', $email);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">

<?php require "includes/header.php"; ?>
<body>

    <main class="container mt-4">
        <h2>Thank You for Subscribing</h2>

        <!-- TODO: Display a confirmation message -->
        <!-- Example: "Thanks, Name! You have been added to our mailing list." -->
        <p>Thanks, <?php echo htmlspecialchars($firstName); ?>! You have been added to our mailing list.</p>

        <p class="mt-3">
            <a href="subscribers.php">View Subscribers</a>
        </p>
    </main>
</body>

</html>