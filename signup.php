<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: interests.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Create Account</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

body{
    font-family:Arial, Helvetica, sans-serif;
    background:#f5f5f5;
}

.signup-box{

    width:450px;
    margin:40px auto;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,.15);

}

h2{
    color:#28a745;
    text-align:center;
}

input{

width:100%;
padding:14px;
margin:10px 0;
border-radius:8px;
border:1px solid #ddd;

}

button{

width:100%;
padding:15px;
background:#28a745;
color:white;
border:none;
border-radius:8px;
cursor:pointer;

}

button:hover{

background:#218838;

}

#response{

margin-top:15px;
text-align:center;

}

</style>

</head>

<body>

<div class="signup-box">

<h2>Create HenryMart Account</h2>

<form id="registerForm">

<input
type="text"
name="fullname"
placeholder="Full Name"
required>

<input
type="email"
name="email"
placeholder="Email Address"
required>

<input
type="text"
name="phone"
placeholder="Phone Number"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<input
type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button>Create Account</button>

</form>

<div id="response"></div>

<p align="center">

Already have an account?

<a href="login.php">Login</a>

</p>

</div>

<script>

document.getElementById("registerForm")

.addEventListener("submit",function(e){

e.preventDefault();

let form=new FormData(this);

fetch("ajax/register.php",{

method:"POST",

body:form

})

.then(res=>res.text())

.then(data=>{

if(data=="success"){

alert("Registration Successful");

window.location="login.php";

}else{

document.getElementById("response").innerHTML=data;

}

});

});

</script>

</body>
</html>