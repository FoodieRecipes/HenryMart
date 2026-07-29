<?php
require_once "config/auth.php";
require_once "config/db.php";

$userId=$_SESSION['user_id'];
$orderId=isset($_GET['id'])?(int)$_GET['id']:0;

$stmt=$conn->prepare("SELECT * FROM orders WHERE id=? AND user_id=? LIMIT 1");
$stmt->execute([$orderId,$userId]);
$order=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$order){
    die("Order not found.");
}

$itemStmt=$conn->prepare("SELECT * FROM order_items WHERE order_id=?");
$itemStmt->execute([$orderId]);
$items=$itemStmt->fetchAll(PDO::FETCH_ASSOC);

$addrStmt=$conn->prepare("SELECT * FROM delivery_addresses WHERE user_id=? LIMIT 1");
$addrStmt->execute([$userId]);
$address=$addrStmt->fetch(PDO::FETCH_ASSOC);

function badgeColor($s){
 $s=strtolower($s);
 return match($s){
   "pending"=>"#ffc107",
   "processing"=>"#17a2b8",
   "delivered"=>"#28a745",
   "cancelled"=>"#dc3545",
   default=>"#6c757d"
 };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Order Details</title>
<link rel="stylesheet" href="assets/css/style.css">
<style>
body{font-family:Arial;background:#f5f5f5;margin:0}
.container{max-width:1100px;margin:30px auto;background:#fff;padding:30px;border-radius:10px}
table{width:100%;border-collapse:collapse}
th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left}
.badge{padding:8px 14px;color:#fff;border-radius:20px}
.top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}
.btn{display:inline-block;padding:10px 18px;background:#28a745;color:#fff;text-decoration:none;border-radius:6px}
@media print {.btn{display:none}}
</style>
</head>
<body>
<div class="container">
<div class="top">
<div>
<h2>HenryMart Invoice</h2>
<p><strong>Order #<?=htmlspecialchars($order["id"])?></strong></p>
<p><?=date("d M Y h:i A",strtotime($order["created_at"]))?></p>
</div>
<div>
<span class="badge" style="background:<?=badgeColor($order["status"])?>">
<?=htmlspecialchars($order["status"])?>
</span>
</div>
</div>

<h3>Delivery Address</h3>
<?php if($address): ?>
<p>
<?=htmlspecialchars($address["address"])?><br>
<?=htmlspecialchars($address["city"])?>,
<?=htmlspecialchars($address["state"])?><br>
<?=htmlspecialchars($address["landmark"])?>
</p>
<?php else: ?>
<p>No delivery address available.</p>
<?php endif; ?>

<h3>Order Items</h3>
<table>
<thead>
<tr>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<?php
$grand=0;
foreach($items as $item):
$total=$item["price"]*$item["quantity"];
$grand+=$total;
?>
<tr>
<td><?=htmlspecialchars($item["product_name"])?></td>
<td>₦<?=number_format($item["price"],2)?></td>
<td><?=htmlspecialchars($item["quantity"])?></td>
<td>₦<?=number_format($total,2)?></td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
<th colspan="3">Grand Total</th>
<th>₦<?=number_format($grand,2)?></th>
</tr>
</tfoot>
</table>

<h3>Payment</h3>
<p><strong>Method:</strong> <?=htmlspecialchars($order["payment_method"])?></p>

<div style="margin-top:30px">
<a class="btn" href="orders.php">← Back to Orders</a>
<a class="btn" href="#" onclick="window.print();return false;">Print Invoice</a>
</div>
</div>
</body>
</html>
