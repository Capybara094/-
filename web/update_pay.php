<?php
session_start();

require_once "header.php";


try {
  // 預設空值
  $Stu_id = "";
  $name = "";
  $pay_date= "";
  $status= "";


  // 如果有傳遞參數
  if ($_GET) {

    require_once 'db.php';

    $action = $_GET["action"] ?? "";

    if ($action == "confirmed") {
      // 如果是確認更新，執行更新操作

      $Stu_id = $_GET["Stu_id"];
      $name = $_POST["name"];
      $pay_date = date('Y-m-d H:i:s');
      $status = $_POST["status"]; 
  

      // 更新資料庫中的資料
      $sql = "UPDATE fee_manage SET `name`=?, `pay_date`=?, `status`=? WHERE Stu_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "ssss", $name, $pay_date, $status, $Stu_id);

      $result = mysqli_stmt_execute($stmt);

      if ($result) {
        // 更新成功後，跳轉回查詢頁面
        header('Location: fee.php');  
      } else {
        echo "更新失敗";
      }

    } else {
      // 如果是普通顯示，從資料庫中查詢這筆資料

      $Stu_id = $_GET["Stu_id"];
      $sql = "SELECT Stu_id, `name`, `pay_date`, `status` FROM fee_manage WHERE Stu_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "i", $Stu_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        // 如果查詢到資料，將結果儲存至變數中
        $Stu_id = $row['Stu_id'];
        $name = $row['name'];
        $pay_date = $row['pay_date'];
        $status = $row['status'];
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
  <form action="update_pay.php?Stu_id=<?=$Stu_id?>&action=confirmed" method="post">
    

  <div class="mb-3 row">
      <label for="Stu_id" class="col-sm-2 col-form-label">學號</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Stu_id" value="<?=$Stu_id?>" readonly>
      </div>
    </div>

    <div class="mb-3 row">
      <label for="name" class="col-sm-2 col-form-label">姓名</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" value="<?=$name?>" readonly>
      </div>
    </div>


    <div class="mb-3 row">
      <label for="_pay_date" class="col-sm-2 col-form-label">付款日期</label>
      <div class="col-sm-10">
        <!-- 自動填入當前時間並設為 readonly -->
        <input type="text" class="form-control" name="pay_date" id="_pay_date" placeholder="pay_date" value="<?=$pay_date?>" readonly>
      </div>
    </div>

    <div class="mb-3 row">
      <label for="_status" class="col-sm-2 col-form-label">繳費狀態</label>
      <div class="col-sm-10">
        <!-- 輸入框會顯示原來的公司名稱 -->
        <input type="text" class="form-control" name="status" id="_status" placeholder="status" value="<?=$status?>">
      </div>
    </div>

    <input class="btn btn-primary" type="submit" value="送出">
  </form>
</div>

<!-- 返回操作的按鈕 -->
<button class="btn btn-secondary" onclick="history.back();">返回</button>

<?php
require_once "footer.php";
?>
