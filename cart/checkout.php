<?php
session_start();
include "includes/header.php";

if (empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h3>Đặt hàng thành công!</h3>";
    
    unset($_SESSION['cart']);
    exit;
}
?>

<h2>Thanh toán</h2>

<form method="POST">
    Tên: <input type="text" name="ten" required><br>
    Địa chỉ: <input type="text" name="diachi" required><br>
    <button type="submit">Xác nhận</button>
</form>

<?php include "includes/footer.php"; ?>