<?php require "includes/header.php"; 
      require "db.php";    
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
   function enableSubmit() {
            document.getElementById("submitBtn").disabled = false;
        }
</script>
<main class="container mt-4">
    <h2> Sign Up</h2>
    <form method="post" class="mt-3">
        <label for="username" class="form-label">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            class="form-control mb-3"
            value="<?= htmlspecialchars($username ?? ''); ?>"
            required
        >

        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-control mb-3"
            value="<?= htmlspecialchars($email ?? ''); ?>"
            required
        >

        <label for="password" class="form-label">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            class="form-control mb-3"
            required
        >

        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input
            type="password"
            id="confirm_password"
            name="confirm_password"
            class="form-control mb-4"
            required
        >
        <div class="mb-3">
            <div class="g-recaptcha" data-sitekey="6Lf426EsAAAAAFB7bIbAmOlyFg6EnGb_fy9UxTBo" data-callback="enableSubmit"></div>
        </div>
        <button type="submit" class="btn btn-primary" id="submitBtn" disabled="disabled">Create Account</button>
        <a href="login.php" class="btn btn-secondary">Login Instead</a>
    </form>
<?php require "includes/footer.php";
$errors =[];
$success = "";

//if statement that runs only 
//when form has been submitted by Post method 
if($_SERVER['REQUEST_METHOD'] === 'POST') {

$username= trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? ''; 
 
//require text fields
if($username== null ||$username === ''){
    $errors[] = "Username is required.";

}

if($email == null || $email === ''){
    $errors[] = "Email is required.";
    
}

if($password == null || $password === ''){
    $errors[] = "Password is required.";
    }

if($confirm_password == null || $confirm_password === ''){
    $errors[] = "Confirm Password is required.";
}


// Check if password includes one letter one number one special character and is 8 characters long
if(!preg_match('/[A-Za-z]/', $password)||
   !preg_match('/[0-9]/', $password)||
   strlen($password) < 8 ||
   !preg_match('/[^A-Za-z0-9]/', $password)){
    $errors[] = "Password must be at least 8 characters long and include at least one letter, one number, and one special character.";

}

if($password !== $confirm_password){
    $errors[] = " Password must match confirm password";
}

//Recaptcha php API 
//recsources
//https://developers.google.com/recaptcha/old/docs/php
//copilot search recaptcha php documentation

$secretKey = "6Lf426EsAAAAAG9Egc_uk40aX29-d83Eqcp0QgCM";

//token returned by recaptcha on client side
$token = $_POST['g-recaptcha-response'];

// Ip address
$ip =$_SERVER['REMOTE_ADDR'];

//google API URL
$url = "https://www.google.com/recaptcha/api/siteverify";

//data that will be sent to google for verification
$data = [
    'secret'=> $secretKey,
    'response'=> $token,
    'remoteip' => $ip
];
//Http request options for file_get_contents()
$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    ]
];

//create a stream context using the above http options
$context = stream_context_create($options);

// send the post request to google and get the response
$response = file_get_contents($url, false,$context);

//decode the JSON response into an associative array
$result = json_decode($response, true);

//check to see if google say's the verification succeeded
if(empty($result['success']) || $result['success'] !== true){
    $errors[] = "reCaptcha failed. please try again.";

}



if(empty($errors)){
    //prepare a query to find a user by username or email
    $sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();
    //if username or email id is found
    if($user){
        $errors[] = "Username or email already exists.";
    }
    // store user password in a encrypted format
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // insert clause that stores user info in users table
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email, $hashed_password]);
    $success = "Account created successfully.";
}   

if(!empty($errors)): ?>
    <div class="alert alert-danger mt-3">
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif($success): ?>
    <div class="alert alert-success mt-3">
        <?= htmlspecialchars($success) ?>
        <br>
        <a href="login.php" class="btn btn-primary mt-3"> Go to Login </a>

</div>
<?php endif;
}?>