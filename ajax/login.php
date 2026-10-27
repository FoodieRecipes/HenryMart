<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once("../config/db.php");

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if(empty($email) || empty($password)){
    echo "Please provide both email and password.";
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    echo "Invalid Email Address.";
    exit();
}

if(password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['fullname'] = $user['fullname'];

    // Check if user has already added delivery address (completed onboarding)
    $check = $conn->prepare("SELECT id FROM delivery_addresses WHERE user_id = ?");
    $check->execute([$user['id']]);

    if($check->rowCount() > 0){
        echo "products";
    }else{
        echo "interests";
    }
}else{
    echo "Incorrect Password.";
}
