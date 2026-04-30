<?php
include '../database/config/db.php';

if(isset($_GET['update'])){
   $update_id = $_GET['update'];
   $edit_query = mysqli_query($conn, "SELECT * FROM `Products` WHERE product_id = $update_id");
   $fetch_edit = mysqli_fetch_assoc($edit_query);
}

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   
   mysqli_query($conn, "UPDATE `Products` SET product_name = '$update_p_name', price_new = '$update_p_price' WHERE product_id = '$update_p_id'");

   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = '../uploaded_img/'.$update_p_image;

   if(!empty($update_p_image)){
      mysqli_query($conn, "UPDATE `Products` SET image_url = '$update_p_image' WHERE product_id = '$update_p_id'");
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
   }
   
   header('location:admin_products.php');
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Sửa sản phẩm</title>
   <link rel="stylesheet" href="admin_style.css">
</head>
<body>
<section class="edit-form-container">
    <?php
    if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $edit_query = mysqli_query($conn, "SELECT * FROM `Products` WHERE product_id = '$update_id'");
        
        if (mysqli_num_rows($edit_query) > 0) {
            $fetch_edit = mysqli_fetch_assoc($edit_query);
    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <img src="../uploaded_img/<?php echo $fetch_edit['image_url']; ?>" height="200">
                <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['product_id']; ?>">
                <input type="text" name="update_p_name" value="<?php echo $fetch_edit['product_name']; ?>" class="box" required>
                <input type="number" name="update_p_price" value="<?php echo $fetch_edit['price_new']; ?>" class="box" required>
                <input type="file" name="update_p_image" accept="image/png, image/jpg, image/jpeg" class="box">
                <input type="submit" value="Cập nhật sản phẩm" name="update_product" class="btn btn-success-add">
                <a href="admin_products.php" class="btn" style="background: gray;">Hủy bỏ</a>
            </form>

    <?php
        } else {
            echo '<p style="text-align: center; padding: 20px;">Không tìm thấy sản phẩm này!</p>';
            echo '<a href="admin_products.php" class="btn">Quay lại</a>';
        }
    } else {
        echo '<p style="text-align: center; padding: 20px;">Vui lòng chọn một sản phẩm để sửa.</p>';
        echo '<a href="admin_products.php" class="btn">Quay lại</a>';
    }
    ?>
</section>
</body>
</html>