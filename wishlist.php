<?php
require_once "config/auth.php";
require_once "config/db.php";
$userId = $_SESSION['user_id'];

if(isset($_GET['remove'])){
    $d = $conn->prepare("DELETE FROM wishlist WHERE id=? AND user_id=?");
    $d->execute([(int)$_GET['remove'], $userId]);
    header("Location: wishlist.php");
    exit();
}

$s = $conn->prepare("SELECT * FROM wishlist WHERE user_id=? ORDER BY id DESC");
$s->execute([$userId]);
$items = $s->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - HenryMart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; }
        .wrap { max-width: 1100px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 10px; }
        .card { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding: 15px 0; }
        img { width: 90px; height: 90px; object-fit: cover; border-radius: 8px; }
        .btn { padding: 9px 15px; text-decoration: none; border-radius: 6px; color: #fff; background: #28a745; }
        .del { background: #dc3545; }
    </style>
</head>
<body>
<div class="wrap">
    <h2>My Wishlist</h2>
    <?php if(!$items): ?>
        <p>No wishlist items.</p>
        <a class="btn" href="products.php">Browse Products</a>
    <?php else: foreach($items as $i): ?>
        <div class="card">
            <div style="display:flex; gap:15px; align-items:center;">
                <img src="<?=htmlspecialchars($i['image'])?>" alt="<?=htmlspecialchars($i['product_name'])?>">
                <div>
                    <h3><?=htmlspecialchars($i['product_name'])?></h3>
                    <p>₦<?=number_format($i['price'],2)?></p>
                </div>
            </div>
            <div>
                <a class="btn" href="product.php?id=<?=$i['product_id']?>">View</a>
                <a class="btn del" href="?remove=<?=$i['id']?>" onclick="return confirm('Remove item?')">Remove</a>
            </div>
        </div>
    <?php endforeach; endif; ?>
</div>
</body>
</html>

