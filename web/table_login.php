<?php
session_start();
require_once "header.php";  // 引入頁面頭部

try {
  require_once 'db.php';  // 引入資料庫連接

  $searchtxt = $_POST["searchtxt"] ?? "";
  $start_date = $_POST["start_date"] ?? "";
  $end_date = $_POST["end_date"] ?? "";
  $order = $_POST["order"] ?? "";

  // 檢查並對換 $start_date 和 $end_date（防呆處理）
  if ($start_date && $end_date && $start_date > $end_date) {
    // 如果開始日期晚於結束日期，對換兩者的值
    list($start_date, $end_date) = [$end_date, $start_date];
  }

  // Initialize an array to hold conditions
  $conditions = [];

  // Add search text condition
  if ($searchtxt) {
    $conditions[] = "(company LIKE '%$searchtxt%' OR content LIKE '%$searchtxt%')";
  }

  // Add date range condition
  if ($start_date) {
    $conditions[] = "pdate >= '$start_date'";
  }
  if ($end_date) {
    $conditions[] = "pdate <= '$end_date'";
  }

  // Construct the final SQL query
  $sql = "SELECT * FROM ";
  if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
  }

  // Add order by clause if specified
  if ($order) {
    $sql .= " ORDER BY " . mysqli_real_escape_string($conn, $order);
  }

  // Execute the query
  $result = mysqli_query($conn, $sql);

  // Check if user is logged in and is an admin (role 'M')
  $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'M';

?>

<form action="query.php" method="post">
  <select name="order" class="form-select" aria-label="選擇排序欄位">
    <option selected value="" <?=($order == '') ? 'selected' : ''?>>選擇排序欄位</option>
    <option value="company" <?=($order == "company") ? 'selected' : ""?>>求才廠商</option>
    <option value="content" <?=($order == "content") ? 'selected' : ""?>>求才內容</option>
    <option value="pdate" <?=($order == "pdate") ? 'selected' : ""?>>刊登日期</option>
  </select>
  <input placeholder="搜尋廠商及內容" class="form-control" type="text" name="searchtxt" value="<?=$searchtxt?>">
  <div class="row g-3 align-items-center">
    <div class="col-auto">
      <label for="start_date" class="col-form-label">開始日期</label>
    </div>
    <div class="col-auto">
      <input id="start_date" class="form-control" type="date" name="start_date" value="<?=$start_date?>">
    </div>
    <div class="col-auto">
      <label for="end_date" class="col-form-label">結束日期</label>
    </div>
    <div class="col-auto">
      <input id="end_date" class="form-control" type="date" name="end_date" value="<?=$end_date?>">
    </div>
  </div>
  <input class="btn btn-primary" type="submit" value="搜尋">
  <!-- Only show the '+' button for admins -->
  <?php if ($isAdmin): ?>
    <a href="insert.php" class="btn btn-primary position-fixed bottom-0 end-0" style="font-size: 30px;width: 70px ;height: 70px">+</a>
  <?php endif; ?>
</form>

<div class="container">
  <table class="table table-bordered table-striped">
    <tr>
      <td>求才廠商</td>
      <td>求才內容</td>
      <td>日期</td>
      <?php if ($isAdmin): ?>
        <td>操作</td> <!-- Only show the "操作" column for admins -->
      <?php endif; ?>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {?>
    <tr>
      <td><?=$row["company"]?></td>
      <td><?=$row["content"]?></td>
      <td><?=$row["pdate"]?></td>
      <?php if ($isAdmin): ?>
        <td>
          <a href="update.php?postid=<?=$row["postid"]?>" class="btn btn-primary">修改</a>
          <a href="delete.php?postid=<?=$row["postid"]?>" class="btn btn-danger">刪除</a>
        </td>
      <?php endif; ?>
    </tr>
    <?php } ?>
  </table>
</div>

<?php
  $conn = null;
} catch (Exception $e) {
  echo 'Message: ' . $e->getMessage();
}

require_once "footer.php";  // 引入頁面尾部
?>
