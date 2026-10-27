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
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    return isset($_SESSION['user_id']);
}
?>