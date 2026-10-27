<?php
require_once("../config/db.php");

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if(empty($fullname) || empty($email) || empty($phone) || empty($password)){
    echo "<p style='color:red'>Please fill in all required fields.</p>";
    exit();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<p style='color:red'>Please provide a valid email address.</p>";
    exit();
}

if($password !== $confirm){
    echo "<p style='color:red'>Passwords do not match.</p>";
    exit();
}

if(strlen($password) < 6){
    echo "<p style='color:red'>Password must be at least 6 characters long.</p>";
    exit();
}

$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->execute([$email]);

if($check->rowCount() > 0){
    echo "<p style='color:red'>An account with this email already exists.</p>";
    exit();
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users(fullname, email, phone, password) VALUES(?, ?, ?, ?)");
$stmt->execute([
    $fullname,
    $email,
    $phone,
    $hashed
]);

echo "success";
