<?php
require_once "config/auth.php";
require_once "config/db.php";

$userId = $_SESSION['user_id'];

// Get all orders for this user
$stmt = $conn->prepare("
SELECT *
FROM orders
WHERE user_id = ?
ORDER BY created_at DESC
");

$stmt->execute([$userId]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

function badgeColor($status)
{
    switch(strtolower($status))
    {
        case 'pending':
            return '#ffc107';

        case 'processing':
            return '#17a2b8';

        case 'delivered':
            return '#28a745';

        case 'cancelled':
            return '#dc3545';

        default:
            return '#6c757d';
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Orders | HenryMart</title>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">

<style>

body{

background:#f5f5f5;

font-family:Arial;

}

.container{

width:1150px;

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

padding:30px;

border-radius:12px;

box-shadow:0 0 10px rgba(0,0,0,.08);

}

.order-card{

border:1px solid #eee;

padding:20px;

border-radius:12px;

margin-bottom:20px;

}

.status{

padding:8px 16px;

border-radius:50px;

color:#fff;

display:inline-block;

font-size:14px;

}

table{

width:100%;

margin-top:15px;

border-collapse:collapse;

}

table td{

padding:10px;

border-bottom:1px solid #eee;

}

button{

background:#28a745;

color:white;

padding:12px 22px;

border:none;

border-radius:8px;

cursor:pointer;

margin-top:15px;

}

.empty{

text-align:center;

padding:80px;

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

<a href="profile.php">👤 My Profile</a>

<a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

<h2>My Orders</h2>

<?php

if(count($orders)==0){

?>

<div class="empty">

<h3>No Orders Yet</h3>

<p>

You haven't placed any orders yet.

</p>

<br>

<a href="products.php">

<button>

Start Shopping

</button>

</a>

</div>

<?php

}else{

foreach($orders as $order){

?>

<div class="order-card">

<h3>

Order #<?= $order['id']; ?>

</h3>

<table>

<tr>

<td>

<strong>Date</strong>

</td>

<td>

<?= date("d M Y h:i A",strtotime($order['created_at'])) ?>

</td>

</tr>

<tr>

<td>

<strong>Total</strong>

</td>

<td>

₦<?= number_format($order['total'],2) ?>

</td>

</tr>

<tr>

<td>

<strong>Payment</strong>

</td>

<td>

<?= htmlspecialchars($order['payment_method']) ?>

</td>

</tr>

<tr>

<td>

<strong>Status</strong>

</td>

<td>

<span

class="status"

style="background:<?= badgeColor($order['status']); ?>">

<?= htmlspecialchars($order['status']) ?>

</span>

</td>

</tr>

</table>

<a

href="order_details.php?id=<?= $order['id']; ?>">

<button>

View Order

</button>

</a>

</div>

<?php

}

}

?>

</div>

</div>

</body>

</html>