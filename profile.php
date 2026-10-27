<?php
require_once "config/auth.php";
require_once "config/db.php";

$userId = $_SESSION['user_id'];

// Fetch user details
$userStmt = $conn->prepare("
SELECT fullname,email,phone
FROM users
WHERE id=?
");
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// Fetch delivery address
$deliveryStmt = $conn->prepare("
SELECT *
FROM delivery_addresses
WHERE user_id=?
LIMIT 1
");
$deliveryStmt->execute([$userId]);
$delivery = $deliveryStmt->fetch(PDO::FETCH_ASSOC);

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullname = trim($_POST['fullname']);
    $phone = trim($_POST['phone']);

    $update = $conn->prepare("
    UPDATE users
    SET fullname=?, phone=?
    WHERE id=?
    ");

    $update->execute([
        $fullname,
        $phone,
        $userId
    ]);

    $_SESSION['fullname'] = $fullname;

    header("Location: profile.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Profile | HenryMart</title>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">

<style>

body{
    background:#f7f7f7;
    font-family:Arial,Helvetica,sans-serif;
}

.container{

width:1100px;
max-width:95%;
margin:40px auto;

display:grid;
grid-template-columns:250px 1fr;
gap:30px;

}

.sidebar{

background:#fff;

padding:25px;

border-radius:12px;

box-shadow:0 0 10px rgba(0,0,0,.08);

}

.sidebar a{

display:block;

padding:14px;

margin-bottom:10px;

text-decoration:none;

color:#333;

border-radius:8px;

transition:.3s;

}

.sidebar a:hover{

background:#28a745;

color:#fff;

}

.content{

background:#fff;

padding:35px;

border-radius:12px;

box-shadow:0 0 10px rgba(0,0,0,.08);

}

input{

width:100%;

padding:14px;

margin:12px 0;

border-radius:8px;

border:1px solid #ddd;

}

button{

padding:14px 30px;

background:#28a745;

color:white;

border:none;

border-radius:8px;

cursor:pointer;

}

button:hover{

background:#218838;

}

table{

width:100%;

margin-top:20px;

border-collapse:collapse;

}

table td{

padding:12px;

border-bottom:1px solid #eee;

}

.success{

padding:12px;

background:#d4edda;

color:#155724;

border-radius:8px;

margin-bottom:20px;

}

</style>

</head>

<body>

<div class="container">

<div class="sidebar">

<h2>HenryMart</h2>

<hr>

<a href="index.php">🏠 Home</a>

<a href="products.php">🛒 Products</a>

<a href="wishlist.php">❤️ Wishlist</a>

<a href="orders.php">📦 Orders</a>

<a href="delivery.php">🚚 Delivery Address</a>

<a href="profile.php">👤 My Profile</a>

<a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

<h2>My Profile</h2>

<?php if(isset($_GET['success'])): ?>

<div class="success">

Profile updated successfully.

</div>

<?php endif; ?>

<form method="POST">

<label>Full Name</label>

<input
type="text"
name="fullname"
value="<?= htmlspecialchars($user['fullname']) ?>"
required>

<label>Email Address</label>

<input
type="email"
value="<?= htmlspecialchars($user['email']) ?>"
disabled>

<label>Phone Number</label>

<input
type="text"
name="phone"
value="<?= htmlspecialchars($user['phone']) ?>">

<button>

Save Changes

</button>

</form>

<hr style="margin:40px 0;">

<h3>Delivery Information</h3>

<?php if($delivery): ?>

<table>

<tr>

<td><strong>Address</strong></td>

<td><?= htmlspecialchars($delivery['address']) ?></td>

</tr>

<tr>

<td><strong>Landmark</strong></td>

<td><?= htmlspecialchars($delivery['landmark']) ?></td>

</tr>

<tr>

<td><strong>City</strong></td>

<td><?= htmlspecialchars($delivery['city']) ?></td>

</tr>

<tr>

<td><strong>State</strong></td>

<td><?= htmlspecialchars($delivery['state']) ?></td>

</tr>

<tr>

<td><strong>Preferred Delivery</strong></td>

<td><?= htmlspecialchars($delivery['delivery_time']) ?></td>

</tr>

<tr>

<td><strong>Notes</strong></td>

<td><?= htmlspecialchars($delivery['notes']) ?></td>

</tr>

</table>

<?php else: ?>

<p>

No delivery address found.

</p>

<a href="delivery.php">

<button>

Add Delivery Address

</button>

</a>

<?php endif; ?>

</div>

</div>

</body>

</html>