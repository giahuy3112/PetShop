<?php
<<<<<<< HEAD
require_once __DIR__ . '/classes/Database.php';
include __DIR__ . '/includes/product_helpers.php';

$db = (new Database())->getConnection();
$products = [];

$stmt = $db->query("SELECT * FROM Products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$productCount = count($products);
$featuredProducts = array_slice($products, 0, 4);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop | Trang chủ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="/PetShop/assets/styles.css">
</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>

<main>

    <section class="hero">

        <div class="hero-main">
            <span class="eyebrow">Chăm sóc thú cưng yêu thương</span>
            <h1>Nơi gửi trọn yêu thương<br>cho người bạn nhỏ của bạn.</h1>
            <p>
                PetShop cung cấp thức ăn, phụ kiện và sản phẩm chăm sóc chất lượng cao
                cho chó, mèo và nhiều thú cưng khác — giao hàng tận nơi, đặt hàng dễ dàng 24/7.
            </p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="/PetShop/products.php">🛍 Xem tất cả sản phẩm</a>
                <a class="btn btn-secondary" href="/PetShop/auth/register.php">Tạo tài khoản miễn phí</a>
            </div>
            <div class="stats">
                <div class="panel">
                    <strong><?php echo $productCount; ?>+</strong>
                    <span>Sản phẩm</span>
                </div>
                <div class="panel">
                    <strong>24/7</strong>
                    <span>Đặt hàng online</span>
                </div>
                <div class="panel">
                    <strong>100%</strong>
                    <span>Tập trung thú cưng</span>
=======
include __DIR__ . '/config/db.php';
include __DIR__ . '/includes/product_helpers.php';

$products = [];
$productCount = 0;

$sql = "SELECT * FROM Products";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    $productCount = count($products);
}

$featuredProducts = array_slice($products, 0, 4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop | Trang chu</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/PetShop/includes/header.php'; ?>

<main class="container page-section">
    <section class="hero">
        <div class="hero-card">
            <span class="eyebrow">Cham soc thu cung moi ngay</span>
            <h1>Khong gian mua sam danh cho boss va sen.</h1>
            <p>
                PetShop mang den thuc an, phu kien va vat dung can thiet cho thu cung.
                Giao dien moi giup nguoi dung xem san pham nhanh hon va di chuyen de dang hon.
            </p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="/PetShop/products.php">Xem tat ca san pham</a>
                <a class="btn btn-secondary" href="/PetShop/auth/register.php">Tao tai khoan</a>
            </div>
            <div class="stats">
                <div class="panel">
                    <strong><?php echo $productCount; ?></strong>
                    <span>San pham dang co</span>
                </div>
                <div class="panel">
                    <strong>24/7</strong>
                    <span>Ho tro dat hang</span>
                </div>
                <div class="panel">
                    <strong>100%</strong>
                    <span>Tap trung vao thu cung</span>
>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
                </div>
            </div>
        </div>

<<<<<<< HEAD
        <aside class="hero-aside">
            <h2>Tại sao chọn PetShop?</h2>
            <ul class="aside-list">
                <li>Sản phẩm được kiểm định chất lượng, an toàn cho thú cưng</li>
                <li>Giao hàng nhanh trong ngày tại TP.HCM và các tỉnh lân cận</li>
                <li>Tư vấn chăm sóc thú cưng miễn phí qua chat hoặc hotline</li>
                <li>Đổi trả dễ dàng trong vòng 7 ngày nếu sản phẩm lỗi</li>
            </ul>
            <div class="aside-cta">
                <a class="btn btn-green" href="/PetShop/auth/register.php">Đăng ký nhận ưu đãi</a>
            </div>
        </aside>

    </section>
    <div class="section-wrap">
        <div class="section-heading">
            <div>
                <span class="eyebrow">Sản phẩm nổi bật</span>
                <h2>Gợi ý cho lần mua sắm đầu tiên</h2>
                <p>Những sản phẩm được yêu thích nhất tại PetShop.</p>
            </div>
            <a class="btn btn-secondary" href="/PetShop/products.php">Xem toàn bộ danh mục →</a>
=======
        <aside class="hero-card hero-aside">
            <h2>Ly do nguoi dung se thay de dung hon</h2>
            <ul>
                <li>Trang chu co khu vuc gioi thieu ro rang va nut dieu huong noi bat.</li>
                <li>Danh sach san pham duoc hien thi dang the, de xem tren dien thoai va may tinh.</li>
                <li>Thanh menu da bo sung trang san pham rieng de truy cap nhanh.</li>
            </ul>
        </aside>
    </section>

    <section>
        <div class="section-heading">
            <div>
                <span class="eyebrow">San pham noi bat</span>
                <h2>Goi y cho lan mua sam dau tien</h2>
                <p>Mot vai san pham dau tien duoc lay tu co so du lieu de nguoi dung xem nhanh.</p>
            </div>
            <a class="btn btn-secondary" href="/PetShop/products.php">Mo danh sach day du</a>
>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
        </div>

        <?php if (!empty($featuredProducts)) : ?>
            <div class="product-grid">
                <?php foreach ($featuredProducts as $product) : ?>
                    <?php
<<<<<<< HEAD
                    $productName        = $product['product_name'] ?? 'Sản phẩm đang cập nhật';
                    $productPrice       = isset($product['price_new']) ? number_format((float) $product['price_new']) . ' ₫' : 'Liên hệ';
                    $productDescription = $product['description'] ?? 'Sản phẩm chất lượng cao dành cho thú cưng của bạn.';
                    $category           = $product['category'] ?? 'Pet care';
                    $productImage       = petshop_product_image($product);
                    $productAlt         = petshop_product_alt($product);
                    $productId          = $product['product_id'] ?? '#';
                    ?>
                    <article class="product-card">
                        <div class="product-image-shell">
                            <img class="product-image"
                                 src="<?php echo htmlspecialchars($productImage); ?>"
                                 alt="<?php echo htmlspecialchars($productAlt); ?>"
                                 loading="lazy">
                        </div>
                        <div class="product-body">
                            <span class="product-badge"><?php echo htmlspecialchars($category); ?></span>
                            <h3><?php echo htmlspecialchars($productName); ?></h3>
                            <p><?php echo htmlspecialchars($productDescription); ?></p>
                            <div class="product-footer">
                                <span class="price"><?php echo htmlspecialchars($productPrice); ?></span>
                                <a class="btn-cart" href="/PetShop/products.php?id=<?php echo htmlspecialchars($productId); ?>">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
=======
                    $productName = $product['product_name'] ?? 'San pham dang cap nhat';
                    $productPrice = isset($product['price_new']) ? number_format((float) $product['price_new']) . ' VND' : 'Lien he';
                    $productDescription = $product['description'] ?? 'San pham danh cho thu cung, thong tin chi tiet se duoc bo sung som.';
                    $category = $product['category'] ?? 'Pet care';
                    $productImage = petshop_product_image($product);
                    $productAlt = petshop_product_alt($product);
                    ?>
                    <article class="product-card">
                        <div class="product-image-shell">
                            <img class="product-image" src="<?php echo htmlspecialchars($productImage); ?>" alt="<?php echo htmlspecialchars($productAlt); ?>">
                        </div>
                        <span class="product-badge"><?php echo htmlspecialchars($category); ?></span>
                        <h3><?php echo htmlspecialchars($productName); ?></h3>
                        <p><?php echo htmlspecialchars($productDescription); ?></p>
                        <p class="price"><?php echo htmlspecialchars($productPrice); ?></p>
>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="empty-state">
<<<<<<< HEAD
                <h3>Chưa có sản phẩm nào trong hệ thống</h3>
                <p>Hãy kiểm tra bảng <code>Products</code> trong database <code>petshop_db</code> để hiển thị dữ liệu tại đây.</p>
            </div>
        <?php endif; ?>
    </div>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
=======
                <h3>Chua co san pham nao trong he thong</h3>
                <p>Hay kiem tra bang Products trong database petshop_db de hien thi du lieu tai day.</p>
            </div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
