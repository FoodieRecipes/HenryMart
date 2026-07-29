<?php

session_start();

require("../config/db.php");

$email=$_POST['email'];

$password=$_POST['password'];

$stmt=$conn->prepare("SELECT * FROM users WHERE email=?");

$stmt->execute([$email]);

$user=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){

echo "Invalid Email";

exit();

}

if(password_verify($password,$user['password'])){

$_SESSION['user_id']=$user['id'];

$_SESSION['fullname']=$user['fullname'];

// Check if the user has already completed onboarding
$check = $conn->prepare(
"SELECT id FROM delivery_addresses WHERE user_id=?"
);

$check->execute([$user['id']]);

if($check->rowCount() > 0){

echo "products";

}else{

echo "interests";

}

}else{

echo "Incorrect Password";

}