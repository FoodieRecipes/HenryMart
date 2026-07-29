<?php

include("config/auth.php");

include("config/db.php");

$cats=$conn->query("SELECT * FROM categories");

?>

<!DOCTYPE html>

<html>

<head>

<title>Select Interests</title>

<style>

body{

font-family:Arial;
background:#f5f5f5;

}

.container{

width:90%;
margin:auto;
margin-top:40px;

}

h2{

text-align:center;
color:#28a745;

}

.grid{

display:flex;

flex-wrap:wrap;

justify-content:center;

}

.card{

margin:10px;

}

.card input{

display:none;

}

.card span{

display:inline-block;

padding:18px 28px;

border-radius:40px;

background:#fff;

cursor:pointer;

border:2px solid #ddd;

transition:.3s;

}

.card input:checked+span{

background:#28a745;

color:#fff;

border-color:#28a745;

transform:scale(1.05);

}

button{

display:block;

margin:30px auto;

padding:15px 50px;

background:#28a745;

color:#fff;

border:none;

border-radius:8px;

cursor:pointer;

}

</style>

</head>

<body>

<div class="container">

<h2>

Choose At Least 6 Grocery Categories

</h2>

<form id="interestForm">

<div class="grid">

<?php

while($row=$cats->fetch(PDO::FETCH_ASSOC)){

?>

<label class="card">

<input

type="checkbox"

name="interests[]"

value="<?= $row['id']; ?>">

<span>

<?= htmlspecialchars($row['category_name']); ?>

</span>

</label>

<?php

}

?>

</div>

<button>

Continue

</button>

</form>

</div>

<script>

document.getElementById("interestForm")

.addEventListener("submit",function(e){

e.preventDefault();

let checked=document.querySelectorAll(

'input[name="interests[]"]:checked'

);

if(checked.length<6){

alert("Please select at least 6 categories.");

return;

}

let form=new FormData(this);

fetch("ajax/save_interests.php",{

method:"POST",

body:form

})

.then(res=>res.text())

.then(data=>{

if(data=="success"){

window.location="delivery.php";

}else{

alert(data);

}

});

});

</script>

</body>

</html>