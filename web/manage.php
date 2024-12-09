<?php
session_start();
require_once 'db.php';
require_once "header.php";

// 確認用戶是否登入
if (!isset($_SESSION['account'])) {
    header("Location: login.php");
    exit();
}

$account = $_SESSION['account'];
$role = $_SESSION['role'];
$name = $_SESSION['name'] ?? '未設定名稱'; // 如果 'name' 沒有設置，則使用 '未設定名稱'


// 如果為管理者，顯示選單
if ($role === 'M' && !isset($_GET['action'])) {
    ?>
    <link rel="stylesheet" href="php.css">
<div class="centered-container">
    <h2>歡迎管理者: <?= htmlspecialchars($name) ?></h2>
    <h4>請選擇功能：</h4>
    <ul>
        <li><a href="manage.php?action=manage">查看用戶管理頁面</a></li>
        <li><a href="manage.php?action=edit">更改個人資料</a></li>
    </ul>
</div>
    <?php
    exit();
}

// **用戶管理頁面功能**
if ($role === 'M' && $_GET['action'] === 'manage') {
    if (isset($_GET['account'])) {
        $accountToEdit = $_GET['account'];

        // 查詢用戶資料
        $sql = "SELECT account, role FROM user WHERE account = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $accountToEdit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            echo "用戶不存在";
            exit();
        }

        // 處理角色更新
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newRole = $_POST['role'] ?? $user['role'];

            $updateSql = "UPDATE user SET role = ? WHERE account = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $updateSql);
            mysqli_stmt_bind_param($stmt, "ss", $newRole, $accountToEdit);

            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>角色更新成功！</div>";
                header("Refresh: 2; url=manage.php?action=manage");
                exit();
            } else {
                echo "<div class='alert alert-danger'>角色更新失敗！</div>";
            }
        }

        ?>
        <h3>更改用戶角色：<?= htmlspecialchars($user['account']) ?></h3>
        <form method="POST">
            <label for="role">角色:</label>
            <select name="role" class="form-select">
                <option value="U" <?= $user['role'] == 'U' ? 'selected' : '' ?>>使用者</option>
                <option value="M" <?= $user['role'] == 'M' ? 'selected' : '' ?>>管理員</option>
            </select><br>
            <button class="btn btn-primary" type="submit">更改角色</button>
        </form>
        <?php
        exit();
    }

    // 顯示所有用戶資料
    $sql = "SELECT account, role FROM user";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    ?>
    <h3>用戶管理頁面</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>帳號</th>
            <th>角色</th>
            <th>操作</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= htmlspecialchars($row['account']) ?></td>
            <td><?= htmlspecialchars($row['role'] ?: '空') ?></td>
            <td>
                <a href="manage.php?action=manage&account=<?= urlencode($row['account']) ?>" class="btn btn-primary">更改角色</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php
    exit();
}

// **更改個人資料功能**
// 查詢用戶現有資料
$sql = "SELECT account, password, name FROM user WHERE account = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $account);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // 如果 `name` 不存在，设置默认值
    if (!isset($user['name'])) {
        $user['name'] = '未設定名稱';  // 或者你可以给一个默认值
    }
} else {
    echo "查詢失敗";
    exit();
}

// 初始化成功訊息
$successMessage = "";

// 處理資料更新邏輯
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newAccount = $_POST['account'] ?? $user['account'];
    $newPassword = $_POST['password'];
    $newName = $_POST['name'] ?? $user['name']; // 如果没有 `name` 提交，则使用现有值

    $updateSql = "UPDATE user SET account = ?, password = ?, name = ? WHERE account = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $updateSql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $newAccount, $newPassword, $newName, $account);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['account'] = $newAccount; // 更新 session
            $_SESSION['name'] = $newName; // 更新 session 中的 name

            // 重新查询最新资料
            $sql = "SELECT account, password, name FROM user WHERE account = ?";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $newAccount);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_assoc($result);
            }

            $successMessage = "資料更新成功！";
        } else {
            echo "資料更新失敗";
        }
    } else {
        echo "SQL 執行失敗";
    }
}
?>

<h3>更改個人資料</h3>
<form method="POST">
    <label for="account">帳號:</label>
    <input type="text" class="form-control" name="account" 
           value="<?= htmlspecialchars($user['account']) ?>" required><br>

    <label for="password">密碼:</label>
    <input type="password" class="form-control" name="password" required><br>

    <label for="name">名稱:</label>
    <input type="text" class="form-control" name="name" 
           value="<?= htmlspecialchars($user['name']) ?>" required><br>

    <button type="submit" class="btn btn-primary">更新資料</button>
</form>

<?php if (!empty($successMessage)): ?>
    <div class="alert alert-success" role="alert">
        <?= htmlspecialchars($successMessage) ?>
    </div>
<?php endif; ?>