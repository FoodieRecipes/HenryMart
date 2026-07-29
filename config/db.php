<?php

$host="localhost";

$dbname="henrymart";

$user="root";

$password="";

try{

$conn=new PDO(

"mysql:host=$host;dbname=$dbname;charset=utf8",

$user,

$password

);

$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

die("Database Connection Failed : ".$e->getMessage());

}

?>