<?php
include 'db.php';
include 'includes/header.php';
$sql = "SELECT * FROM team_members ORDER BY id DESC";
$stmt = $pdo->query($sql);
$stmt->execute();
$team_members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>  
<main class="container mt-4">
<h2 class="heading">Team Members</h2>
<a href="add.php" class="btn btn-primary mb-3">Add New Member</a>
<?php if (count($team_members) === 0): ?>
    <p>No team members found.</p>   
<?php else: ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($team_members as $member): ?>
                <tr>
                    <td><?= htmlspecialchars($member['first_name'] . " " . $member['last_name']) ?></td>
                    <td><?= htmlspecialchars($member['position']) ?></td>
                    <td><?= htmlspecialchars($member['phone']) ?></td>
                    <td><?= htmlspecialchars($member['email']) ?></td>
                    <td><?= htmlspecialchars($member['team_name']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $member['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?= $member['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif;?>
<?php include "includes/footer.php"; ?>
</main> 