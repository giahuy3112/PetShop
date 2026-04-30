<?php
session_start();
include "includes/header.php";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$total = 0;
?>

<div class="container" style="padding: 20px;">
    <h2>Giỏ hàng của bạn</h2>
    <?php if(empty($_SESSION['cart'])): ?>
        <p>Giỏ hàng đang trống. <a href="products.php">Tiếp tục mua sắm</a></p>
    <?php else: ?>
        <?php foreach ($_SESSION['cart'] as $id => $item): 
            // Sửa key thành tên cột trong Database
            $subtotal = $item['price_new'] * $item['quantity'];
            $total += $subtotal;
        ?>
        <div style="border-bottom: 1px solid #ddd; padding: 10px 0;">
            <strong><?= htmlspecialchars($item['product_name']) ?></strong> - 
            <?= number_format($item['price_new']) ?>đ x <?= $item['quantity'] ?> 
            = <?= number_format($subtotal) ?>đ
            <a href="cart.php?remove=<?= $id ?>" style="color: red; margin-left: 10px;">[Xóa]</a>
        </div>
        <?php endforeach; ?>
        <h3>Tổng cộng: <?= number_format($total) ?> VND</h3>
        <a href="checkout.php" class="btn btn-primary" style="display:inline-block; margin-top:10px;">Tiến hành thanh toán</a>
    <?php endif; ?>
</div>
<?php include "includes/footer.php"; ?>