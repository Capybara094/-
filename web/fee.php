<?php
session_start();
require_once "header.php";  // 引入頁面頭部

try {
  require_once 'db.php';  // 引入資料庫連接

  $searchtxt = $_POST["searchtxt"] ?? "";
  $start_date = $_POST["start_date"] ?? "";
  $end_date = $_POST["end_date"] ?? "";
  $order = $_POST["order"] ?? "";
  $status = $_POST["status"] ?? "";

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
                         OR `pay_date` LIKE '%$searchtxt%' 
                         OR `status` LIKE '%$searchtxt%' )";
    }
}
if ($status) {
  // 根據 status 篩選資料
  $conditions[] = "`status` = '$status'";
}

// Construct the final SQL query
$sql = "SELECT * FROM fee_manage";
if (!empty($conditions)) {
  $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Add order by clause if specified
if ($order) {
  $sql .= " ORDER BY " . mysqli_real_escape_string($conn, $order);
}

// Execute the query
$result = mysqli_query($conn, $sql);

 // Get the total count of the results
 $totalRecords = mysqli_num_rows($result);

?>
  <!-- 繳費狀態篩選 -->
<form action="fee.php" method="post">
  <select name="status" class="form-select" aria-label="繳費狀態">
    <option selected value="" <?=($status == '') ? 'selected' : ''?>>選擇繳費狀態</option>
    <option value="Y" <?=($status == 'Y') ? 'selected' : ''?>>已繳費</option>
    <option value="N" <?=($status == 'N') ? 'selected' : ''?>>未繳費</option>
  </select>

  <input placeholder="輸入學號" class="form-control" type="text" name="searchtxt" value="<?=$searchtxt?>">

  <input class="btn btn-primary" type="submit" value="搜尋">  
  <a href="insert_pay.php" class="btn btn-primary position-fixed bottom-0 end-0" style="font-size: 30px; width: 70px; height: 70px; margin: 20px;">+</a>
</form>

<div class="container mt-3">
  <p>共找到 <?=$totalRecords?> 筆資料</p>
</div>


<div class="container">
  <table class="table table-bordered table-striped">
    <tr>
      <td>學號</td>
      <td>姓名</td>
      <td>付款時間</td>
      <td>付款狀態</td>
      <?php?>
        <td>操作</td> <!-- Only show the "操作" column for admins -->
      <?php?>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) {?>
    <tr>
      <td><?=$row["Stu_id"]?></td>
      <td><?=$row["name"]?></td>
      <td><?=$row["pay_date"]?></td>
      <td><?=$row["status"] == 'Y' ? '已繳費' : '未繳費'?></td>  <!-- 判斷繳費狀態 -->
      <?php?>
        <td>
          <a href="update_pay.php?Stu_id=<?=$row["Stu_id"]?>" class="btn btn-primary">修改</a>
          <a href="delete_pay.php?Stu_id=<?=$row["Stu_id"]?>" class="btn btn-danger">刪除</a>
        </td>
      <?php?>
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
