<?php
require "db.php";
require "includes/header.php";
require "includes/auth.php";

$sql = "SELECT image_path FROM image_upload ORDER By photo_id ";
$stmt =$pdo -> prepare($sql);
$stmt-> execute();
$images= $stmt ->fetchAll(PDO::FETCH_ASSOC);
?>

<main class= "container mt-4">
<h1 class="mb-4">Team images</h1>
    <?php if (empty($images)): ?>
        <p>No image available yet.</p>
    <?php else: ?>
    <div class="row">
        <?php foreach ($images as $image): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if(!empty($image['image_path'])): ?>
                        <img
                        src="<?= htmlspecialchars($image['image_path']); ?>"
                        class="card-img-top"
                        alt="Product Image">
                    <?php endif;?>
                </div>
            </div>        
        <?php endforeach;?>
    </div>
    <?php  endif;?>    

   <a href="add_upload.php" class="btn btn-primary mt-3">Add New Image</a>
   <a href="index.php"  class="btn btn-primary mt-3"> Go to team table</a>
   <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>                    
    </main>