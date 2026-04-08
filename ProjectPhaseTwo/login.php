<?php 
require "db.php";
require "includes/header.php";  
    //start a new session
    session_start(); 
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
   function enableSubmit() {
            document.getElementById("submitBtn").disabled = false;
        }
</script>


<main class="container mt-4">
    <h2>Login</h2>
    <form method="post" class=mt-4> 
        <label for="usernameOrEmail" class="form-label">Enter username or your userEmail</label>
    
    <input
    type="text"
    id="usernameOrEmail"
    name="usernameOrEmail"
    class="form-control mb-3"
    required>

        <label for="password" class="form-label"> Password </label>
    <input 
    type="password"
    id="password"
    name="password"
    class="form-control mb-3"
    required>


    <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="6Lf426EsAAAAAFB7bIbAmOlyFg6EnGb_fy9UxTBo" data-callback="enableSubmit"></div>
    </div>

    <button type ="submit" class="btn btn-primary" id="submitBtn" disabled="disabled"> Login</button>
    <a href=" register.php" class="btn btn-secondary">Create Account</a>
</form>
</main>
<?php 
require "includes/footer.php";
$errors = [];
//if statement that runs only 
//when form has been submitted by Post method 
if($_SERVER['REQUEST_METHOD']=== 'POST'){

$usernameOrEmail = trim($_POST['usernameOrEmail']);
$password = $_POST['password'] ?? '';

//Recaptcha php API
$secretKey = "6Lf426EsAAAAAG9Egc_uk40aX29-d83Eqcp0QgCM";

//token returned by recaptcha on cclient side
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

if(empty($usernameOrEmail)|| empty($password)){
    $errors[] ="please enter both username/email and password ";

}else{
    //prepare a query to find a user by username or email
    $sql = "SELECT id,username,email,password FROM users WHERE username = ? OR email = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usernameOrEmail,$usernameOrEmail]);
    $user =$stmt ->fetch(PDO::FETCH_ASSOC);   

    //if the user was found and the password matches the hashed password in the database
    if($user && password_verify($password, $user['password'])){
    //Rengerate session ID to prevent session fixation   
    session_regenerate_id(true);
       
        //sstore user info in the Session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        header("Location: fileUpload.php");
        exit();
    }
    else{
        $errors[] = "Invalid username/email or invalid password";
    }
    
    }
    if($errors !== ""):?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($errors as $error):?>
                <li><?php echo htmlspecialchars($error)?></li>
                <?php endforeach?>
        </ul>
    </div>
    <?php endif;
    
}
