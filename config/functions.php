<?php

function clean($data){

$data=trim($data);

$data=stripslashes($data);

$data=htmlspecialchars($data);

return $data;

}

function redirect($page){

header("Location: ".$page);

exit();

}

function loggedIn(){

return isset($_SESSION['user_id']);

}

?>