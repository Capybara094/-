<?php
session_start();

require_once "header.php";


try {
  // 預設空值
  $Stu_id = "";
  $one = "";
  $two = "";
  $three = "";
  $four = "";


  // 如果有傳遞參數
  if ($_GET) {

    require_once 'db.php';

    $action = $_GET["action"] ?? "";

    if ($action == "confirmed") {
      // 如果是確認更新，執行更新操作

      $Stu_id = $_GET["Stu_id"]; // 獲取文章ID
      $one = $_POST["1"]; // 獲取更新的公司名稱
      $two = $_POST["2"]; // 獲取更新的求才內容
      $three = $_POST["3"]; // 獲取更新的公司名稱
      $four = $_POST["4"]; // 獲取更新的求才內容

      // 更新資料庫中的資料
      $sql = "UPDATE job SET `1`=?, `2`=?, `3`=?, `4`=? WHERE Stu_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "sssss", $one, $two, $three, $four, $Stu_id);

      $result = mysqli_stmt_execute($stmt);

      if ($result) {
        // 更新成功後，跳轉回查詢頁面
        header('Location: query.php');  
      } else {
        echo "更新失敗";
      }

    } else {
      // 如果是普通顯示，從資料庫中查詢這筆資料

      $Stu_id = $_GET["Stu_id"];
      $sql = "SELECT Stu_id, `1`, `2`, `3`, `4` FROM job WHERE Stu_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "i", $Stu_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        // 如果查詢到資料，將結果儲存至變數中
        $Stu_id = $row['Stu_id'];
        $one = $row['1'];
        $two = $row['2'];
        $three = $row['3'];
        $four = $row['4'];
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

<div class="container mt-5" align=center>
<div class="card" style="width: 80%; max-width: 600px;">
  <!-- 表單：顯示文章原本的資料 -->
  <form action="update.php?Stu_id=<?=$Stu_id?>&action=confirmed" method="post">
    

  <div class="my-3 row justify-content-center align-items-center">
      <label for="Stu_id" class="col-sm-1 col-form-label">學號</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="Stu_id" value="<?=$Stu_id?>" readonly>
      </div>
    </div>

    <div class="mb-3 row justify-content-center align-items-center">
      <label for="_1" class="col-sm-1 col-form-label">大一</label>
      <div class="col-sm-6">
        <!-- 輸入框會顯示原來的公司名稱 -->
        <input type="text" class="form-control" name="1" id="_1" placeholder="職位" value="<?=$one?>">
      </div>
    </div>

    <div class="mb-3 row justify-content-center align-items-center">
      <label for="_2" class="col-sm-1 col-form-label">大二</label>
      <div class="col-sm-6">
        <!-- 輸入框會顯示原來的公司名稱 -->
        <input type="text" class="form-control" name="2" id="_2" placeholder="職位" value="<?=$two?>">
      </div>
    </div>

    <div class="mb-3 row justify-content-center align-items-center">
      <label for="_3" class="col-sm-1 col-form-label">大三</label>
      <div class="col-sm-6">
        <!-- 輸入框會顯示原來的公司名稱 -->
        <input type="text" class="form-control" name="3" id="_3" placeholder="職位" value="<?=$three?>">
      </div>
    </div>

    <div class="mb-3 row justify-content-center align-items-center">
      <label for="_4" class="col-sm-1 col-form-label">大四</label>
      <div class="col-sm-6">
        <!-- 輸入框會顯示原來的公司名稱 -->
        <input type="text" class="form-control" name="4" id="_4" placeholder="職位" value="<?=$four?>">
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <input class="btn btn-primary me-5" type="submit" value="送出">
      <!-- 返回操作的按鈕 -->
      <button class="btn btn-secondary" onclick="history.back();">返回</button>
    </div>
  </form>
</div>
</div>


<?php
require_once "footer.php";
?>
