<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

if (!User::isLoggedIn() || !User::isAdmin()) { 
    header('Location: ../auth/login.php'); 
    exit(); 
}

$db = (new Database())->getConnection();
include '../config/db.php';

if(isset($_POST['add_product'])){
   $name = $_POST['name'];
   $price = $_POST['price'];
   $category_id = $_POST['category_id']; 
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $stmt = $db->prepare("INSERT INTO `Products`(name, price, image, category_id) VALUES(?, ?, ?, ?)");
   if($stmt->execute([$name, $price, $image, $category_id])){

   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $insert = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$name', '$price', '$image')");
   if($insert){
      move_uploaded_file($image_tmp_name, $image_folder);
      echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href='admin_products.php';</script>";
      }
   }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="admin_style.css">
    <title>Thêm sản phẩm</title>
</head>
<body>
<div class="container">
   <h2>Thêm sản phẩm mới</h2>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="Tên sản phẩm" required>
      <input type="number" name="price" placeholder="Giá bán" required>
      <select name="category_id" required>
         <option value="" disabled selected>Chọn danh mục</option>
         <option value="1">Thú cưng</option>
         <option value="2">Thức ăn</option>
         <option value="3">Phụ kiện</option>
      </select>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" required>
      <input type="submit" name="add_product" value="Lưu sản phẩm" class="btn btn-success-add">
      <a href="admin_products.php" class="btn" style="background: gray; display:block; text-align:center; margin-top:10px;">Quay lại</a>
   </form>
</div>
</body>
</html>