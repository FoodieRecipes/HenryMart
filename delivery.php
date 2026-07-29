<?php
require_once "config/auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Delivery Details</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

body{

font-family:Arial;
background:#f5f5f5;

}

.container{

width:600px;

margin:50px auto;

background:white;

padding:40px;

border-radius:15px;

box-shadow:0 0 20px rgba(0,0,0,.1);

}

input,
textarea,
select{

width:100%;

padding:15px;

margin:12px 0;

border:1px solid #ddd;

border-radius:8px;

}

button{

width:100%;

padding:15px;

background:#28a745;

color:white;

border:none;

border-radius:8px;

cursor:pointer;

font-size:17px;

}

button:hover{

background:#218838;

}

</style>

</head>

<body>

<div class="container">

<h2 align="center">

Delivery Information

</h2>

<form id="deliveryForm">

<input
type="text"
name="address"
placeholder="Delivery Address"
required>

<input
type="text"
name="landmark"
placeholder="Nearest Landmark">

<input
type="text"
name="city"
placeholder="City"
required>

<input
type="text"
name="state"
placeholder="State"
required>

<select name="delivery_time">

<option value="Morning">

Morning

</option>

<option value="Afternoon">

Afternoon

</option>

<option value="Evening">

Evening

</option>

</select>

<textarea

name="notes"

placeholder="Delivery Instructions"

rows="4">

</textarea>

<button>

Save & Continue

</button>

</form>

</div>

<script>

document

.getElementById("deliveryForm")

.addEventListener("submit",function(e){

e.preventDefault();

let form=new FormData(this);

fetch("ajax/save_delivery.php",{

method:"POST",

body:form

})

.then(res=>res.text())

.then(data=>{

if(data=="success"){

window.location="products.php";

}else{

alert(data);

}

});

});

</script>

</body>

</html>