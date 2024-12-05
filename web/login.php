<?php require_once "header.php" ?>

<?php
session_start(); //靠這個去記住登入時的資料，LOGIN記得也要
require_once 'db.php';

$msg = $_GET["msg"] ?? "";

if ($_POST) {
    $account = $_POST['account'] ?? "N/A";
    $password = $_POST['password'] ?? "N/A";

    try {
        $sql = "select * from login where account = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $account);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['account'] == $account && $row['password'] == $password) {
                echo "登入成功";
                $_SESSION["account"] = $account;//靠這個去記住登入時的資料
                $_SESSION["role"] = $row['role'];//記錄用戶角色（從資料庫讀取）

                header("Location: query.php");
            } else {
                echo "登入失敗";
                header("Location: login.php?msg=帳密錯誤");
            }
        } else {
            echo "登入失敗";
            header("Location: login.php?msg=帳密錯誤");
        }

        $conn = null;
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
?>
<link rel="stylesheet" href="php.css">
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title text-center">登入</h3>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="account">帳號</label>
                    <input placeholder="帳號" class="form-control" type="text" name="account" required><br>
                </div>
                <div class="form-group">
                    <label for="password">密碼</label>
                    <input placeholder="密碼" class="form-control" type="password" name="password" required><br>
                </div>
                <button class="btn btn-primary btn-block" type="submit">登入</button>
            </form>
            <?php if ($msg): ?>
                <div class="alert alert-danger mt-2"><?= htmlspecialchars($msg) ?></div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="register.php" class="btn btn-secondary">註冊</a>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php" ?>
