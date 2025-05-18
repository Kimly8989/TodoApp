<?php
include 'db.php';

// Check if table is empty first
//Run this file to reset list ID
//Hidden from User Tho
$result = $conn->query("SELECT COUNT(*) as total FROM tasks");
$row = $result->fetch_assoc();

if ($row['total'] == 0) {
    $conn->query("ALTER TABLE tasks AUTO_INCREMENT = 1");
    echo "Auto-increment ID has been reset to 1.";
} else {
    echo "Table is not empty. ID reset skipped for safety.";
}

$conn->close();
?>