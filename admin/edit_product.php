<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

// Kiểm tra quyền Admin
if (!User::isLoggedIn() || !User::isAdmin()) { 
    header('Location: ../auth/login.php'); 
    exit(); 
}

$db = (new Database())->getConnection();

if(isset($_GET['update'])){
    $update_id = $_GET['update'];
    $stmt = $db->prepare("SELECT * FROM `Products` WHERE id = ?");
    $stmt->execute([$update_id]);
    $fetch_edit = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$fetch_edit){
        die("Sản phẩm không tồn tại!");
    }
}

if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_category = $_POST['update_p_category'];

    $update_query = $db->prepare("UPDATE `Products` SET name = ?, price = ?, category_id = ? WHERE id = ?");
    $update_query->execute([$update_p_name, $update_p_price, $update_p_category, $update_p_id]);

    $update_p_image = $_FILES['update_p_image']['name'];
    if(!empty($update_p_image)){
        $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
        $update_p_image_folder = '../uploaded_img/'.$update_p_image;

        $img_query = $db->prepare("UPDATE `Products` SET image_url = ? WHERE product_id = ?");
        $img_query->execute([$update_p_image, $update_p_id]);
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
    }

    header('location:admin_products.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
<section class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Cập nhật sản phẩm</h3>
        
        <div style="text-align: center; margin-bottom: 15px;">
            <p>Ảnh hiện tại:</p>
            <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_edit['image_url'] ?? 'default.jpg'); ?>" height="150" style="border-radius: 8px;">
        </div>

        <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
        
        <label>Tên sản phẩm:</label>
        <input type="text" name="update_p_name" value="<?php echo htmlspecialchars($fetch_edit['name']); ?>" class="box" required>
        
        <label>Giá mới (VND):</label>
        <input type="number" name="update_p_price" value="<?php echo $fetch_edit['price']; ?>" class="box" required>

        <label>Danh mục:</label>
        <select name="update_p_category" class="box" required>
            <option value="1" <?php if($fetch_edit['category_id'] == 1) echo 'selected'; ?>>Thú cưng</option>
            <option value="2" <?php if($fetch_edit['category_id'] == 2) echo 'selected'; ?>>Thức ăn</option>
            <option value="3" <?php if($fetch_edit['category_id'] == 3) echo 'selected'; ?>>Phụ kiện</option>
        </select>

        <label>Thay đổi ảnh (không chọn nếu muốn giữ nguyên):</label>
        <input type="file" name="update_p_image" accept="image/png, image/jpg, image/jpeg" class="box">
        
        <input type="submit" value="Lưu thay đổi" name="update_product" class="btn btn-success-add">
        <a href="admin_products.php" class="btn" style="background: gray; display:block; text-align:center; margin-top: 10px;">Hủy bỏ</a>
    </form>
</section>
</body>
</html>