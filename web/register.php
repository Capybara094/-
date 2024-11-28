<?php require_once "header.php"; ?>

<?php
require_once 'db.php';

$msg = $_GET["msg"] ?? "";

// 初始化變數，避免未定義的警告
$account = $_POST['account'] ?? "";
$password = $_POST['password'] ?? "";
$confirmPassword = $_POST['confirm_password'] ?? "";
$name = $_POST['name'] ?? "";  // 新增名稱欄位處理
$role = 'U';  // 預設角色為使用者

if ($_POST) {
    // 基本的表單驗證
    if (empty($account) || empty($password) || empty($confirmPassword) || empty($name)) {
        $msg = "所有欄位都必須填寫";
    } elseif ($password !== $confirmPassword) {
        $msg = "密碼和確認密碼不一致";
    } else {
        try {
            // 檢查帳號是否已經存在
            $sql = "SELECT * FROM user WHERE account = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "s", $account);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_fetch_assoc($result)) {
                $msg = "帳號已經被註冊，請選擇其他帳號";
            } else {
                // 將新的用戶資料插入資料庫，包括 role 預設為 "U"
                $sql = "INSERT INTO user (account, password, name, role) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "ssss", $account, $password, $name, $role); // role 為 "U"
                mysqli_stmt_execute($stmt);

                // 註冊成功後重定向到登入頁面
                header("Location: login.php?msg=註冊成功，請登入");
                exit;
            }
        } catch (Exception $e) {
            $msg = 'Error: ' . $e->getMessage();
        }
    }
}
?>

<div class="container">
    <h2>註冊</h2>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="account">帳號</label>
            <input type="text" id="account" name="account" class="form-control" placeholder="請輸入帳號" value="<?= htmlspecialchars($account) ?>"><br>
        </div>

        <div class="form-group">
            <label for="password">密碼</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="請輸入密碼"><br>
        </div>

        <div class="form-group">
            <label for="confirm_password">確認密碼</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="請確認密碼"><br>
        </div>

        <div class="form-group">
            <label for="name">名稱</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="請輸入名稱" value="<?= htmlspecialchars($name) ?>"><br>
        </div>

        <input type="submit" class="btn btn-primary" value="註冊">
        
        <p class="text-danger"><?= $msg ?></p>
    </form>

    <div class="mt-2">
        <a href="login.php" class="btn btn-secondary">已有帳號? 登入</a>
    </div>
</div>

<?php require_once "footer.php"; ?>
