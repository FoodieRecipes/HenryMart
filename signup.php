<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['user_id'])){
    header("Location: products.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account - HenryMart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .signup-box {
            width: 450px;
            max-width: 90%;
            margin: 40px auto;
            background: #fff;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
            box-sizing: border-box;
        }
        h2 {
            color: #28a745;
            text-align: center;
            margin-bottom: 25px;
        }
        input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 15px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s ease;
        }
        button:hover {
            background: #218838;
        }
        #response {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .login-link a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="signup-box">
    <h2>🍔 Create HenryMart Account</h2>
    <form id="registerForm" method="POST" action="ajax/register.php">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="tel" name="phone" placeholder="Phone Number" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Create Account</button>
    </form>
    <div id="response"></div>
    <p class="login-link">
        Already have an account? <a href="login.php">Login</a>
    </p>
</div>

<script>
document.getElementById("registerForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const responseEl = document.getElementById("response");
    responseEl.innerHTML = "<p style='color:#555;'>Creating account...</p>";

    const form = new FormData(this);
    fetch("ajax/register.php", {
        method: "POST",
        body: form
    })
    .then(res => res.text())
    .then(data => {
        data = data.trim();
        if (data === "success") {
            alert("Registration Successful! Please login.");
            window.location.href = "login.php";
        } else {
            responseEl.innerHTML = "<div style='color:#dc3545;'>" + data + "</div>";
        }
    })
    .catch(err => {
        responseEl.innerHTML = "<p style='color:#dc3545;'>Network error. Please try again.</p>";
    });
});
</script>

</body>
</html>
