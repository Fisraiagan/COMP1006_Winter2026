<?php
include "includes/header.php";
?>  
<div class="container2">
    <h1 class="heading">Add New Team Member</h1>
    <form action="process_add.php" method="post" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="team_name" class="form-label">Team Name</label>
            <input type="text" class="form-control" id="team_name" name="team_name" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label"> team image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
       
        <button type="submit" class="btn btn-primary">Add Member</button>
        <a href="fileUpload.php" class="btn btn-secondary mt-3">View image</a>
        <?php include "includes/footer.php"; ?>
    </form>
</div>
</body>
</html>