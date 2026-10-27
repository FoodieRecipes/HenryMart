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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HenryMart Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .login-box {
            width: 420px;
            max-width: 90%;
            margin: 80px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            box-sizing: border-box;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #28a745;
        }
        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            box-sizing: border-box;
        }
        .login-box button {
            width: 100%;
            padding: 15px;
            background: #28a745;
            border: none;
            color: white;
            font-size: 17px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .login-box button:hover {
            background: #218838;
        }
        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 10px 0 20px 0;
            font-size: 14px;
            color: #555;
            cursor: pointer;
        }
        .remember-label input {
            cursor: pointer;
        }
        .links {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
        .links a {
            color: #28a745;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
        #response {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>🍔 HenryMart Login</h2>
    <form id="loginForm" method="POST" action="ajax/login.php">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <label class="remember-label">
            <input type="checkbox" name="remember"> Remember Me
        </label>
        <button type="submit">Login</button>
    </form>
    <div id="response"></div>
    <div class="links">
        <a href="signup.php">Create Account</a> | <a href="#">Forgot Password?</a>
    </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const responseEl = document.getElementById("response");
    responseEl.innerHTML = "<p style='color:#555;'>Logging in...</p>";

    const formData = new FormData(this);
    fetch("ajax/login.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        data = data.trim();
        if (data === "interests") {
            window.location.href = "interest.php";
        } else if (data === "products") {
            window.location.href = "products.php";
        } else {
            responseEl.innerHTML = "<p style='color:#dc3545; font-weight:bold;'>" + data + "</p>";
        }
    })
    .catch(err => {
        responseEl.innerHTML = "<p style='color:#dc3545;'>Network error. Please try again.</p>";
    });
});
</script>

</body>
</html>
