<?php
require "includes/header.php";
// require 'index.php';
//accessing the form data
// sending it to the client via email
// echoing out a confirmation message


$firstName = $_POST['first_name'];
$lastName =$_POST['last_name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$email = $_POST['email'];

    $items = $_POST['items'];
    foreach($items as $item => $quantity){

    }


?>
<main>
<p> thank you for submitting your order!</p>
 <p> First Name: <?php echo $firstName; ?></p>
 <p> Last Name: <?php echo $lastName; ?></p>
 <p> Phone: <?php echo $phone; ?></p>
 <p> Address: <?php echo $address; ?></p>
 <p> Email: <?php echo $email; ?></p>;   
</main>


<?php require "includes/footer.php"; ?>

