<?php
include 'db.php';
$result = $pdo->query("SELECT * FROM team_members");
?>

<table border="1">
<tr>
    <th>Name</th><th>Position</th><th>Phone</th><th>Email</th><th>Team</th><th>Actions</th>
</tr>

<?php while($rows = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
    <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
    <td><?= $row['position'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['team_name'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
