<?php
<<<<<<< HEAD
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

if (!User::isLoggedIn() || !User::isAdmin()) {
    header('Location: ../auth/login.php');
    exit();
}

$db = (new Database())->getConnection();

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM `Products` WHERE id = ?");
    $stmt->execute([$delete_id]);
    header('location:admin_products.php');
}
?>
=======
include '../config/db.php';

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'");
   header('location:admin_products.php');
}
?>

>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="admin_style.css">
    <title>Admin - Quản lý sản phẩm</title>
</head>
<body>
<<<<<<< HEAD
    <header class="header">
        <nav class="navbar">
            <a href="admin_products.php" class="btn">Quản lý Sản phẩm</a>
            <a href="admin_orders.php" class="btn">Quản lý Đơn hàng</a>
            <a href="../index.php" class="btn btn-secondary-admin">Trở về</a>
        </nav>
    </header>
    <div class="container">
        <h2>Danh sách sản phẩm</h2>
        <a href="add_product.php" class="btn btn-success-add">+ Thêm sản phẩm mới</a>
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select_products = $db->query("SELECT * FROM `Products`") or die('Query failed');
                while($row = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><img src="../uploaded_img/<?php echo $row['image']; ?>" width="50" height="50" style="object-fit: cover;"></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>

                    <td>
                    <?php
                        if($row['category_id'] == 1) echo 'Thú cưng';
                        elseif($row['category_id'] == 2) echo 'Thức ăn';
                        elseif($row['category_id'] == 3) echo 'Phụ kiện';
                        else echo 'Chưa phân loại';
                    ?>
                    </td>

                    <td><?php echo number_format($row['price']); ?>đ</td>
                <td>
                    <a href="edit_product.php?update=<?php echo $row['id']; ?>" class="btn btn-edit">Sửa</a>
                    <a href="admin_products.php?delete=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
=======
<header class="header">
   <nav class="navbar">
      <a href="admin_products.php" class="btn btn-edit">Quản lý Sản phẩm</a>
      <a href="admin_orders.php" class="btn btn-add">Quản lý Đơn hàng</a>
   </nav>
</header>
<div class="container">
    <h2>Danh sách sản phẩm</h2>
    <a href="add_product.php" class="btn btn-success-add">+ Thêm sản phẩm mới</a>

    <table>
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            while($row = mysqli_fetch_assoc($select_products)){
            ?>
            <tr>
                <td><img src="../uploaded_img/<?php echo $row['image']; ?>" width="50" height="50" style="object-fit: cover; border-radius: 5px;" alt="Hình ảnh"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo number_format($row['price']); ?>đ</td>
                <td>
                    <a href="edit_product.php?update=<?php echo $row['id']; ?>" class="btn btn-edit">Sửa</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-delete">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete(id) {
    if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
        window.location.href = 'admin_products.php?delete=' + id;
    }
}
</script>
>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
</body>
</html>