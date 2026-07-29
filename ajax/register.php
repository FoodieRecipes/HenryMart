<?php

require("../config/db.php");

$fullname=trim($_POST['fullname']);

$email=trim($_POST['email']);

$phone=trim($_POST['phone']);

$password=$_POST['password'];

$confirm=$_POST['confirm_password'];

if($password!=$confirm){

echo "<p style='color:red'>Passwords do not match.</p>";

exit();

}

$check=$conn->prepare("SELECT id FROM users WHERE email=?");

$check->execute([$email]);

if($check->rowCount()>0){

echo "<p style='color:red'>Email already exists.</p>";

exit();

}

$hashed=password_hash($password,PASSWORD_DEFAULT);

$stmt=$conn->prepare("INSERT INTO users(fullname,email,phone,password)

VALUES(?,?,?,?)");

$stmt->execute([

$fullname,

$email,

$phone,

$hashed

]);

echo "success";