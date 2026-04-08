<?php
require "db.php";

$id = $_GET['id'] ?? null;
if(!$id || !is_numeric($id)) {
    echo "Invalid ID.";
    exit;
}
$sql = "SELECT * FROM team_members WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$member) {
    echo "Member not found.";
    exit;
}
include "includes/header.php";
?>
<h1 class="heading">Edit Team Member</h1>
<form action="process_edit.php" method="post" enctype="multipart/form-data" class="mt-3">
    <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo ($member['first_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo ($member['last_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="position" class="form-label">Position</label>
        <input type="text" class="form-control" id="position" name="position" value="<?php echo ($member['position']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo ($member['phone']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo ($member['email']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="team_name" class="form-label">Team Name</label>
        <input type="text" class="form-control" id="team_name" name="team_name" value="<?php echo($member['team_name']); ?>" required>
    </div>
     <div class="mb-3">
            <label for="name" class="form-label"> team image</label>
            <input type="file" class="form-control" id="image" name="image">
            <!-- Keep old image path -->
            <input type="hidden" name="existing_image" 
            value="<?= htmlspecialchars($member['image_path']); ?>">
        </div>
    <button type="submit" class="btn btn-primary">Update Member</button>
</form>
</body>
</html>