<?php

session_start();
require_once("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized";
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_POST['interests'])) {
    echo "Please select your interests.";
    exit();
}

$interests = $_POST['interests'];

if (count($interests) < 6) {
    echo "Please select at least 6 categories.";
    exit();
}

// Remove previous interests
$delete = $conn->prepare("DELETE FROM user_interests WHERE user_id = ?");
$delete->execute([$user_id]);

// Save new interests
$insert = $conn->prepare("
INSERT INTO user_interests(user_id, category_id)
VALUES(?,?)
");

foreach ($interests as $category) {
    $insert->execute([$user_id, $category]);
}

echo "success";
?>