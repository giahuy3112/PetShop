<?php
session_start();
include "includes/header.php";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$total = 0;
?>

<h2>Giỏ hàng</h2>

<?php foreach ($_SESSION['cart'] as $id => $item): 
    $subtotal = $item['gia'] * $item['soluong'];
    $total += $subtotal;
?>
    <div>
        <?= $item['ten'] ?> - <?= $item['gia'] ?> x <?= $item['soluong'] ?>
        <a href="cart.php?remove=<?= $id ?>">Xóa</a>
    </div>
<?php endforeach; ?>

<h3>Tổng: <?= $total ?> VND</h3>

<a href="checkout.php">
    <button>Mua hàng</button>
</a>

<?php include "includes/footer.php"; ?>

<?php
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header("Location: cart.php");
}
?>