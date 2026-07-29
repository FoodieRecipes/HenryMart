<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: interests.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>HenryMart Login</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

body{

background:#f4f4f4;

font-family:Arial;

}

.login-box{

width:420px;

margin:80px auto;

background:white;

padding:40px;

border-radius:15px;

box-shadow:0 0 20px rgba(0,0,0,.15);

}

.login-box h2{

text-align:center;

margin-bottom:30px;

color:#28a745;

}

input{

width:100%;

padding:14px;

margin:10px 0;

border-radius:8px;

border:1px solid #ddd;

font-size:16px;

}

button{

width:100%;

padding:15px;

background:#28a745;

border:none;

color:white;

font-size:17px;

border-radius:8px;

cursor:pointer;

}

button:hover{

background:#218838;

}

.links{

margin-top:20px;

text-align:center;

}

</style>

</head>

<body>

<div class="login-box">

<h2>HenryMart Login</h2>

<form id="loginForm">

<input

type="email"

name="email"

placeholder="Email Address"

required>

<input

type="password"

name="password"

placeholder="Password"

required>

<label>

<input

type="checkbox"

name="remember">

Remember Me

</label>

<br><br>

<button>

Login

</button>

</form>

<div id="response"></div>

<div class="links">

<a href="signup.php">

Create Account

</a>

|

<a href="#">

Forgot Password?</a>

</div>

</div>

<script>

document.getElementById("loginForm")

.addEventListener("submit",function(e){

e.preventDefault();

let formData=new FormData(this);

fetch("ajax/login.php",{

method:"POST",

body:formData

})

.then(res=>res.text())

.then(data=>{

if(data=="interests"){

window.location="interests.php";

}
else if(data=="products"){

window.location="products.php";

}
else{

document.getElementById("response").innerHTML=data;

}else{

document.getElementById("response").innerHTML=

"<p style='color:red;'>"+data+"</p>";

}

});

});

</script>

</body>

</html>