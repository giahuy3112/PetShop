<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = (new Database())->getConnection();
$userObj = new User($db);
$message = '';

if (isset($_POST['register'])) {
    if ($userObj->register($_POST['username'], $_POST['email'], $_POST['password'])) {
        header('Location: login.php?success=1');
        exit();
    }
    $message = 'Đăng ký thất bại!';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop | Dang ky</title>
    <link rel="stylesheet" href="/PetShop/assets/styles.css">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/PetShop/includes/header.php'; ?>
    <main class="container page-section">
        <section class="auth-layout">
            <article class="auth-card auth-card-accent">
                <span class="eyebrow">Bắt đầu cùng Petshop</span>
                <h1>Tạo tài khoản mới</h1>
            </article>
            <article class="auth-card">
                <div class="form-heading">
                    <h2>Tạo tài khoản</h2>
                    <p>Điền đầy đủ thông tin</p>
                </div>
                <?php if ($message !== '') : ?>
                    <div class="<?php echo htmlspecialchars($messageClass); ?>"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
                <form method="POST" class="stack-form">
                    <label class="field-group">
                        <span class="field-label">Username</span>
                        <input class="field-input" type="text" name="username" placeholder="Nhap username" required>
                    </label>
                    <label class="field-group">
                        <span class="field-label">Email</span>
                        <input class="field-input" type="email" name="email" placeholder="Nhap email" required>
                    </label>
                    <label class="field-group">
                        <span class="field-label">Password</span>
                        <input class="field-input" type="password" name="password" placeholder="Tao mat khau" required>
                    </label>
                    <button class="btn btn-primary btn-block" name="register">Dang ky</button>
                </form>
                <p class="auth-note">Đã có tài khoản? <a href="/PetShop/auth/login.php"><strong>Đăng nhập</strong></a></p>
            </article>
        </section>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/PetShop/includes/footer.php'; ?>
</body>
</html>