<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';
include "includes/header.php";

if (!User::isLoggedIn()) {
    header('Location: auth/login.php');
    exit();
}

if (empty($_SESSION['cart'])) {
    echo "<div class='container'><h3>Giỏ hàng trống!</h3></div>";
    exit;
}

$db = (new Database())->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $address = $_POST['diachi'];
    $total_amount = 0;

    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price_new'] * $item['quantity'];
    }

    try {
        $db->beginTransaction();

        // 1. Lưu vào bảng Orders
        $stmt = $db->prepare("INSERT INTO Orders (total_amount, shipping_address, user_id, order_status) VALUES (?, ?, ?, 'PENDING')");
        $stmt->execute([$total_amount, $address, $user_id]);
        $order_id = $db->lastInsertId();

        // 2. Lưu chi tiết vào bảng Order_Details
        $stmt_detail = $db->prepare("INSERT INTO Order_Details (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $product_id => $item) {
            $stmt_detail->execute([$order_id, $product_id, $item['quantity'], $item['price_new']]);
        }

        $db->commit();
        unset($_SESSION['cart']);
        echo "<div class='container'><h3>Đặt hàng thành công! Mã đơn hàng của bạn là #$order_id</h3><a href='index.php'>Quay lại trang chủ</a></div>";
        exit;

    } catch (Exception $e) {
        $db->rollBack();
        echo "Lỗi khi đặt hàng: " . $e->getMessage();
    }
}
?>
<div class="container" style="padding: 20px;">
    <h2>Thông tin thanh toán</h2>
    <form method="POST" class="stack-form">
        <label>Địa chỉ giao hàng:</label>
        <input type="text" name="diachi" placeholder="Nhập địa chỉ nhận hàng" required style="width:100%; padding:10px; margin:10px 0;">
        <button type="submit" class="btn btn-primary">Xác nhận đặt hàng</button>
    </form>
</div>
=======
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

>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
<?php include "includes/footer.php"; ?>