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

$error = "";

if (isset($_POST['register'])) {
    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = $_POST['password'];

    if ($userObj->register($u, $e, $p)) {
        header("Location: login.php?success=1");
        exit();
    } else {
        $error = "Đăng ký thất bại! Username hoặc Email có thể đã tồn tại.";
    }
}

include '../includes/header.php';
?>

<main class="auth-wrapper">
    <div class="auth-card">
        <span class="eyebrow">Đăng ký</span>
        <h1>Tạo tài khoản</h1>
        <p>Tham gia cộng đồng yêu thú cưng ngay hôm nay.</p>

        <?php if($error): ?>
            <div class="message" style="background: #fee2e2; color: #dc2626; border: 1px solid #fecaca;">
                <?=  $error ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit" name="register" class="btn btn-primary">Đăng ký tài khoản</button>
        </form>

        <div style="margin-top: 24px; text-align: center;">
            <p>Đã có tài khoản? <a href="login.php" style="color: var(--brand); font-weight: 700;">Đăng nhập</a></p>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
