<?php

session_start();

require_once("../config/db.php");

if(!isset($_SESSION['user_id'])){

echo "Unauthorized";

exit();

}

$user=$_SESSION['user_id'];

$address=trim($_POST['address']);

$landmark=trim($_POST['landmark']);

$city=trim($_POST['city']);

$state=trim($_POST['state']);

$delivery=$_POST['delivery_time'];

$notes=trim($_POST['notes']);

// Remove previous delivery address

$conn

->prepare("DELETE FROM delivery_addresses WHERE user_id=?")

->execute([$user]);

// Save new delivery information

$sql=$conn->prepare(

"INSERT INTO delivery_addresses

(user_id,address,landmark,city,state,delivery_time,notes)

VALUES(?,?,?,?,?,?,?)"

);

$sql->execute([

$user,

$address,

$landmark,

$city,

$state,

$delivery,

$notes

]);

echo "success";
?>