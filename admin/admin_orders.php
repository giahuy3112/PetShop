<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

if (!User::isLoggedIn() || !User::isAdmin()) {
    header('Location: ../auth/login.php');
    exit();
}

$db = (new Database())->getConnection();

if(isset($_POST['update_order'])){
    $order_id = $_POST['order_id'];
    $update_status = $_POST['update_status'];
    $stmt = $db->prepare("UPDATE `Orders` SET order_status = ? WHERE order_id = ?");
    $stmt->execute([$update_status, $order_id]);
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM `Orders` WHERE order_id = ?");
    $stmt->execute([$delete_id]);
    header('location:admin_orders.php');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="admin_products.php" class="btn">Quản lý Sản phẩm</a>
            <a href="admin_orders.php" class="btn">Quản lý Đơn hàng</a>
        </nav>
    </header>
    <section class="container">
        <h1 class="heading">Danh sách đơn hàng</h1>
        <table>
            <thead>
                <th>Mã đơn</th>
                <th>Tên người đặt</th>
                <th>Ngày đặt hàng</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </thead>
            <tbody>
                <?php
                $select_orders = $db->query("SELECT * FROM `orders` ORDER BY order_date DESC");
                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td>#<?php echo $fetch_orders['order_id']; ?></td>
                    <td><?php echo htmlspecialchars($fetch_orders['user_name']); ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($fetch_orders['order_date'])); ?></td>
                    <td><?php echo number_format($fetch_orders['total_amount']); ?>đ</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['order_id']; ?>">
                            <select name="update_status">
                                <option value="" selected disabled><?php echo $fetch_orders['order_status']; ?></option>
                                <option value="PENDING">PENDING</option>
                                <option value="SHIPPING">SHIPPING</option>
                                <option value="DELIVERED">DELIVERED</option>
                                <option value="CANCELED">CANCELED</option>
                            </select>
                            <input type="submit" name="update_order" value="Cập nhật" class="btn btn-add">
                        </form>
                    </td>
                    <td>
                        <a href="admin_orders.php?delete=<?php echo $fetch_orders['order_id']; ?>" class="btn btn-delete" onclick="return confirm('Xóa đơn hàng này?');">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>