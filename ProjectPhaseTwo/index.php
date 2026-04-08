<?php
include 'db.php';
include 'includes/header.php';
require 'includes/auth.php';
$result = $pdo->query("SELECT * FROM team_members");
?>
<div class="container2">
    <h1 class="heading">Team Members</h1>
    <a href="add.php" class="btn btn-primary mb-3">Add New Member</a>
    <a href="fileUpload.php" class="btn btn-primary mb-3">team photo</a>
    <?php if ($result && $result->rowCount() > 0): ?>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Team</th>
                <th>image</th>
                <th>Actions</th>
            </tr>
            <tbody>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
                        <td><?= $row['position'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['team_name'] ?></td>
                        <td><img
                        src="<?= htmlspecialchars($row['image_path']); ?>"
                        class="card-img-top"
                        alt="Team member Image"
                        width="100" height="100">
                        
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No team members found.</p>
    <?php endif; ?>
    <?php include "includes/footer.php"; ?>
</div>
</body>
</html>