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
    if ($order) {
        // 根據選擇的排序欄位進行具體欄位的查詢
        $conditions[] = "`$order` LIKE '%$searchtxt%'";
    } else {
        // 若未指定排序，則在所有欄位中查詢
        $conditions[] = "(Stu_id LIKE '%$searchtxt%' 
                         OR `name` LIKE '%$searchtxt%' 
                         OR `contact` LIKE '%$searchtxt%' 
                         OR `time` LIKE '%$searchtxt%' )";
    }
}
  // // Add date range condition
  // if ($start_date) {
  //   $conditions[] = "pdate >= '$start_date'";
  // }
  // if ($end_date) {
  //   $conditions[] = "pdate <= '$end_date'";
  // }

  // Construct the final SQL query
  $sql = "SELECT * FROM  people";
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
  // $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'M';

?>

<form action="people.php" method="post">
  <input placeholder="輸入學號" class="form-control" type="text" name="searchtxt" value="<?=$searchtxt?>">

  <div class="row g-time align-items-center">
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
  <!-- <?php?>
  <a href="insert.php" class="btn btn-primary position-fixed bottom-0 end-0" style="font-size: 30px; width: 60px; height: 60px; margin: 20px;">+</a>
  <?php?> -->
</form>

<div class="container">
  <table class="table table-bordered table-striped">
    <tr>
      <td>學號</td>
      <td>姓名</td>
      <td>聯絡電話</td>
      <td>入學時間</td>
      <!-- <?php?>
        <td>操作</td> 
      <?php?> -->
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {?>
    <tr>
      <td><?=$row["Stu_id"]?></td>
      <td><?=$row["name"]?></td>
      <td><?=$row["contact"]?></td>
      <td><?=$row["time"]?></td>
      <!-- <?php?>
        <td>
          <a href="update.php?Stu_id=<?=$row["Stu_id"]?>" class="btn btn-primary">修改</a>
          <a href="delete.php?Stu_id=<?=$row["Stu_id"]?>" class="btn btn-danger">刪除</a>
        </td>
      <?php?> -->
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
