<?php
session_start();

require_once "header.php";

// 確保用戶為管理員
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'M') {
  echo "您沒有權限進行此操作";
  exit(); // 如果不是管理員，終止執行
}

try {
  // 預設空值
  $postid = "";
  $company = "";
  $content = "";
  $pdate = "";

  // 如果有傳遞參數
  if ($_GET) {

    require_once 'db.php';

    $action = $_GET["action"] ?? "";

    if ($action == "confirmed") {
      // 如果是確認更新，執行更新操作

      $postid = $_GET["postid"]; // 獲取文章ID
      $company = $_POST["company"]; // 獲取更新的公司名稱
      $content = $_POST["content"]; // 獲取更新的求才內容

      // 更新資料庫中的資料
      $sql = "UPDATE job SET company=?, content=? WHERE postid=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "ssi", $company, $content, $postid);

      $result = mysqli_stmt_execute($stmt);

      if ($result) {
        // 更新成功後，跳轉回查詢頁面
        header('Location: query.php');  
      } else {
        echo "更新失敗";
      }

    } else {
      // 如果是普通顯示，從資料庫中查詢這筆資料

      $postid = $_GET["postid"];
      $sql = "SELECT postid, company, content, pdate FROM job WHERE postid=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "i", $postid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        // 如果查詢到資料，將結果儲存至變數中
        $company = $row['company'];
        $content = $row['content'];
        $pdate = $row['pdate'];
      }
    }
  } else {
    echo "沒有傳遞必要的參數。";
    exit();
  }

} catch (Exception $e) {
  echo '錯誤訊息: ' . $e->getMessage();
}

?>

<div class="container">
  <!-- 表單：顯示文章原本的資料 -->
  <form action="update.php?postid=<?=$postid?>&action=confirmed" method="post">

    <div class="mb-3 row">
      <label for="_company" class="col-sm-2 col-form-label">求才廠商</label>
      <div class="col-sm-10">
        <!-- 輸入框會顯示原來的公司名稱 -->
        <input type="text" class="form-control" name="company" id="_company" placeholder="公司名稱" value="<?=$company?>" required>
      </div>
    </div>

    <div class="mb-3">
      <label for="_content" class="form-label">求才內容</label>
      <!-- 輸入框會顯示原來的求才內容 -->
      <textarea class="form-control" id="_content" name="content" rows="10" required><?=$content?></textarea>
    </div>

    <input class="btn btn-primary" type="submit" value="送出">
  </form>
</div>

<!-- 返回操作的按鈕 -->
<button class="btn btn-secondary" onclick="history.back();">返回</button>

<?php
require_once "footer.php";
?>
