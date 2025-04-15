<?php
session_start();

require_once __DIR__ . '../../../config/DatabaseConnection.php';
require_once __DIR__ . '../../../models/Account.php';
require_once __DIR__ . '../../../controllers/AccountController.php';

$accountController = new AccountController();

// Xử lý form khi submit
$message = '';
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($action === 'register') {
        if (empty($username) || empty($password) || empty($confirm_password)) {
            $message = "Vui lòng điền đầy đủ thông tin!";
        } elseif ($password !== $confirm_password) {
            $message = "Mật khẩu không khớp!";
        } else {
            $result = $accountController->register($username, $password);
            if ($result === true) {
                $success = true;
                $message =  "Đăng ký thành công! Vui lòng đăng nhập.";
            }
        }
    } elseif ($action === 'login') {
        if (empty($username) || empty($password)) {
            $message = "Vui lòng điền tên tài khoản và mật khẩu!";
        } else {
            $account = $accountController->login($username, $password);
            if ($account) {
                $_SESSION['user'] = $account->getUsername();
                $_SESSION['role'] = $account->getRole();

                if ($account->getRole() === 'admin') {
                    $message = "Đăng nhập thành công! Chào mừng " . htmlspecialchars($account->getUsername());
                    $success = true;
                } else {
                    $message = "Đăng nhập thành công! Chào mừng " . htmlspecialchars($account->getUsername());
                    $success = true;
                }
            } else {
                $message = "Tên tài khoản hoặc mật khẩu không đúng!";
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../layout/assets/css/login.css">
    <link rel="stylesheet" href="../layout/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php require_once '../../views/layout/includes/Header.php'; ?>
    <div class="qwix-container">
        <div class="qwix-box" id="qwix-box">
            <!-- Form Đăng ký -->
            <div class="vorn-form mith-signup">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h1 class="login-title">Tạo tài Khoản</h1>
                    <div class="jynx-social">
                        <a href="#" class="social"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-tiktok"></i></a>
                    </div>
                    <input type="text" name="username" placeholder="Tên tài khoản của bạn" required />
                    <div class="zylith-pass-wrapper">
                        <input type="password" name="password" placeholder="Nhập mật khẩu của bạn" class="password-input" required />
                        <i class="fas fa-eye kwez-eye toggle-password"></i>
                    </div>
                    <div class="zylith-pass-wrapper">
                        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" class="password-input" required />
                        <i class="fas fa-eye kwez-eye toggle-password"></i>
                    </div>
                    <input type="hidden" name="action" value="register">
                    <button type="submit">Đăng ký</button>
                </form>
            </div>

            <!-- Form Đăng nhập -->
            <div class="vorn-form lyth-login">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h1 class="login-title">Đăng nhập</h1>
                    <div class="jynx-social">
                        <a href="#" class="social"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-tiktok"></i></a>
                    </div>
                    <input type="text" name="username" placeholder="Tên tài khoản của bạn" required />
                    <div class="zylith-pass-wrapper">
                        <input type="password" name="password" placeholder="Nhập mật khẩu của bạn" class="password-input" required />
                        <i class="fas fa-eye kwez-eye toggle-password"></i>
                    </div>
                    <a href="#">Quên mật khẩu?</a>
                    <input type="hidden" name="action" value="login">
                    <button type="submit">Đăng nhập</button>
                </form>
            </div>

            <!-- Overlay -->
            <div class="zeth-overlay">
                <div class="klyth-slide">
                    <div class="plyth-panel xorn-left">
                        <h1>Chào mừng bạn trở lại!!</h1>
                        <p>Đã có tài khoản vui lòng bấm đăng nhập</p>
                        <button class="xyth-ghost" id="lyth-login-btn">Đăng nhập</button>
                    </div>
                    <div class="plyth-panel yith-right">
                        <h1>Chào mừng bạn trở lại!!</h1>
                        <p>Nếu chưa có tài khoản vui lòng bấm vào đăng ký</p>
                        <button class="xyth-ghost" id="mith-signup-btn">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (!empty($message)) : ?>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "<?php echo $success ? 'Thành công!' : 'Lỗi!'; ?>",
                    text: "<?php echo addslashes($message); ?>",
                    icon: "<?php echo $success ? 'success' : 'error'; ?>",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed && <?php echo $success ? 'true' : 'false'; ?>) {
                        <?php if ($action === 'login' && isset($account)) : ?>
                            <?php if ($account->getRole() === 'admin') : ?>
                                window.location.href = "../Admin/index.php";
                            <?php else : ?>
                                window.location.href = "../Pages/Home.php";
                            <?php endif; ?>
                        <?php elseif ($action === 'register') : ?>
                            location.reload();
                        <?php endif; ?>
                    }
                });
            });
        <?php endif; ?>
    </script>

    </script>
    <script>
        const mithSignupButton = document.getElementById('mith-signup-btn');
        const lythLoginButton = document.getElementById('lyth-login-btn');
        const qwixBox = document.getElementById('qwix-box');

        mithSignupButton.addEventListener('click', () => {
            qwixBox.classList.add("vorn-right-active");
        });

        lythLoginButton.addEventListener('click', () => {
            qwixBox.classList.remove("vorn-right-active");
        });

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(eye => {
            eye.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>