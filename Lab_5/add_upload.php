<?php
require "includes/connect.php";
require "includes/header.php";

$errors =[];
$success = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

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
if(empty($errors)){
    $sql ="INSERT INTO products (image_path) VALUES (:image)";
    $stmt =$pdo ->prepare($sql);
    $stmt->bindParam(':image', $imgPath);
    $stmt->execute();

    $success = "Image added successfully!";

    }

}

}   ?>

<main class="container mt-5">
    <h2>Add image file</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <form action="add_upload.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label"> Profile image</label>
            <input type="file" class="form-control" id="image" name="image" required>

            <button type="submit" class="btn btn-primary mt-3">Upload Image</button>
            <a href="upload.php" class="btn btn-secondary mt-3">View image</a>
        </div>
    </form>
</main>
<?php require "includes/footer.php"; ?>    