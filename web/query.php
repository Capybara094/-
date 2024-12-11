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
                         OR `1` LIKE '%$searchtxt%' 
                         OR `2` LIKE '%$searchtxt%' 
                         OR `3` LIKE '%$searchtxt%' 
                         OR `4` LIKE '%$searchtxt%')";
    }
  }

  // Construct the final SQL query
  $sql = "SELECT * FROM job";
  if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
  }

  // Add order by clause if specified
  if ($order) {
    $sql .= " ORDER BY " . mysqli_real_escape_string($conn, $order);
  }

  // Execute the query
  $result = mysqli_query($conn, $sql);

?>
</br>
<form action="query.php" method="post">
  <div class="d-flex justify-content-center">
  <input placeholder="輸入學號" class="form-control me-3" style="width: 20%;" type="text" name="searchtxt" value="<?=$searchtxt?>">
  <!-- <select name="order" class="form-select" aria-label="選擇排序欄位">
    <option selected value="" <?=($order == '') ? 'selected' : ''?>>選擇排序欄位</option>
    <option value="1" <?=($order == "1") ? 'selected' : ""?>>大一</option>
    <option value="2" <?=($order == "2") ? 'selected' : ""?>>大二</option>
    <option value="3" <?=($order == "3") ? 'selected' : ""?>>大三</option>
    <option value="4" <?=($order == "4") ? 'selected' : ""?>>大四</option>
  </select> -->
  <input class="btn door" type="submit" value="搜尋">
</div>
  
  <a href="insert.php" class="btn btn-primary position-fixed bottom-0 end-0" style="font-size: 30px; width: 60px; height: 60px; margin: 20px;">+</a>
</form>

<div class="container">
  <table class="table table-bordered table-striped">
    <tr>
      <td>學號</td>
      <td>大一</td>
      <td>大二</td>
      <td>大三</td>
      <td>大四</td>
      <td>操作</td> <!-- Only show the "操作" column for admins -->
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {?>
    <tr>
      <td><?=$row["Stu_id"]?></td>
      <td><?=$row["1"]?></td>
      <td><?=$row["2"]?></td>
      <td><?=$row["3"]?></td>
      <td><?=$row["4"]?></td>
      <td>
        <a href="update.php?Stu_id=<?=$row["Stu_id"]?>" class="btn btn-primary">修改</a>
        <a href="delete.php?Stu_id=<?=$row["Stu_id"]?>" class="btn btn-danger">刪除</a>
      </td>
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
