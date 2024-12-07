<?php
session_start();

require_once "header.php";

try {

  require_once 'db.php';
  $sql = "INSERT INTO fee_manage (Stu_id, `name`, `pay_date`, `status`) VALUES (?, ?, NOW(), ?)";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);

  $msg="";

  if ($_POST) {

    // insert data

      $Stu_id = $_POST["Stu_id"];
      $name = $_POST["name"];
      $pay_date = $_POST["pay_date"];
      $status = $_POST["status"];

      if ($status == 'Y') {
        // If paid, use current timestamp for pay_date
        $pay_date = "NOW()";
    } else {
        // If not paid, set pay_date as NULL or empty string
        $pay_date = "NULL";  // You can also use an empty string if you prefer
    }

    $sql = "INSERT INTO fee_manage (Stu_id, `name`, `pay_date`, `status`) VALUES (?, ?, $pay_date, ?)";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $Stu_id, $name, $status);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
      header('location:fee.php');
    } else {
      $msg = "無法新增資料";
    }

  }

?>
<div class="container">
  <link rel="stylesheet" href="php.css">

  <!-- Form within a table for better structure -->
  <form action="insert_pay.php" method="post">
    <table class="table table-bordered table-striped" style="width:700px;height:700px;">
      <thead>
        <tr>
          <th colspan="4" class="text-center">新增學生資料</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><label for="_Stu_id" class="col-form-label">學號</label></td>
          <td><input type="text" class="form-control" name="Stu_id" id="_Stu_id" placeholder="學生學號" required></td>
        </tr>

        <tr>
          <td><label for="_name" class="col-form-label">姓名</label></td>
          <td><input type="text" class="form-control" name="name" id="_name" placeholder="姓名"></td>
        </tr>

        <tr>
          <td><label for="_pay_date" class="col-form-label">付款日期</label></td>
          <td><input type="date" class="form-control" name="pay_date" id="_pay_date" placeholder="付款日期"></td>
        </tr>

        <tr>
          <td><label for="_status" class="col-form-label">繳費狀態</label></td>
          <td>
            <!-- 使用 select 來讓使用者選擇 'y' 或 'n' -->
            <select class="form-control" name="status" id="_status">
              <option value="y">已繳費</option>
              <option value="n">未繳費</option>
            </select>
          </td>
        </tr>
        
        <tr>
          <td colspan="4" class="text-center">
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
