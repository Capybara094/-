<?php
session_start();

require_once "header.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'M') {
  echo "您沒有權限進行此操作";
  exit(); // 如果不是管理員，終止執行
}

try {

  require_once 'db.php';
  $sql = "INSERT INTO people (company, content, pdate) VALUES (?, ?, NOW())";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);

  $msg="";

  if ($_POST) {

    // insert data

    $company = $_POST["company"];
    $content = $_POST["content"];

    $sql = "INSERT INTO job (company, content, pdate) VALUES (?, ?, NOW())";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $company, $content);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
      header('location:query.php');
    } else {
      $msg = "無法新增資料";
    }

  }

?>
<div class="container">
  <link rel="stylesheet" href="php.css">

  <!-- Form within a table for better structure -->
  <form action="insert.php" method="post">
    <table class="table table-bordered table-striped" style="width:700px;height:700px;">
      <thead>
        <tr>
          <th colspan="2" class="text-center">新增求才資料</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><label for="_company" class="col-form-label">求才廠商</label></td>
          <td><input type="text" class="form-control" name="company" id="_company" placeholder="公司名稱" required></td>
        </tr>
        <tr>
          <td><label for="_content" class="form-label">求才內容</label></td>
          <td><textarea class="form-control" name="content" id="_content" rows="10" required></textarea></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">
            <input class="btn btn-primary btn-1" type="submit" value="送出">
          </td>
        </tr>
      </tbody>
    </table>
  </form>

  <?php if ($msg): ?>
    <div class="alert alert-danger" role="alert">
      <?= htmlspecialchars($msg) ?>
    </div>
  <?php endif; ?>
</div>

<?php
  mysqli_close($conn);
} catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

require_once "footer.php";
?>
