<?php
require "db.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id == false || $id <= 0) {
    echo "Invalid Member ID.";
    exit();
}

$sql = "DELETE FROM team_members WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
?>