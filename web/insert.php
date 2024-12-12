<?php
session_start();

require_once "header.php";

try {

  require_once 'db.php';
  $sql = "INSERT INTO job (Stu_id, `1`, `2`, `3`, `4`) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);

  $msg="";

  if ($_POST) {

    // insert data

      $Stu_id = $_POST["Stu_id"];
      $one = $_POST["1"];
      $two = $_POST["2"];
      $three = $_POST["3"];
      $four = $_POST["4"];

    $sql = "INSERT INTO job (Stu_id, `1`, `2`, `3`, `4`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $Stu_id, $one, $two, $three, $four);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
      header('location:query.php');
    } else {
      $msg = "無法新增資料";
    }

  }

?>
<div class="container">
  <link rel="stylesheet" href="slay.css">

  <!-- Form within a table for better structure -->
  <form action="insert.php" method="post">
    <table class="table table-bordered table-striped center" style="width:700px;height:700px;">
      <thead>
        <tr>
          <th colspan="5" class="text-center">新增學生資料</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><label for="_Stu_id" class="col-form-label">學號</label></td>
          <td><input type="text" class="form-control" name="Stu_id" id="_Stu_id" placeholder="學生學號" required></td>
        </tr>

        <tr>
          <td><label for="_1" class="col-form-label">大一</label></td>
          <td><input type="text" class="form-control" name="1" id="_1" placeholder="大一職位"></td>
        </tr>

        <tr>
          <td><label for="_2" class="col-form-label">大二</label></td>
          <td><input type="text" class="form-control" name="2" id="_2" placeholder="大二職位"></td>
        </tr>

        <tr>
          <td><label for="_3" class="col-form-label">大三</label></td>
          <td><input type="text" class="form-control" name="3" id="_3" placeholder="大三職位"></td>
        </tr>
        <tr>
          <td><label for="_4" class="col-form-label">大四</label></td>
          <td><input type="text" class="form-control" name="4" id="_4" placeholder="大四職位"></td>
        </tr>
        <tr>
          <td colspan="5" class="text-center">
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
