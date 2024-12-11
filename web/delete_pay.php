<?php
session_start();//靠這個去記住登入時的資料，LOGIN記得也要
require_once "header.php";

try {

  $Stu_id = "";
  $name = "";
  $pay_date= "";
  $status= "";



  if ($_GET) {

    require_once 'db.php';

    $action = $_GET["action"]??"";

    if ($action=="confirmed"){

      //delete data

      $Stu_id = $_GET["Stu_id"];

      $sql="delete from fee_manage where Stu_id=?";

      $stmt = mysqli_stmt_init($conn);

      mysqli_stmt_prepare($stmt, $sql);

      mysqli_stmt_bind_param($stmt, "s", $Stu_id);

      $result = mysqli_stmt_execute($stmt);

      mysqli_close($conn);

      header('location:fee.php');

    }

    else{

      //show data

      $Stu_id = $_GET["Stu_id"];

      $sql="select Stu_id, `name`, `pay_date`, `status` from fee_manage where Stu_id=?";    

      // $result = mysqli_query($conn, $sql);

      $stmt = mysqli_stmt_init($conn);

      mysqli_stmt_prepare($stmt, $sql);

      mysqli_stmt_bind_param($stmt, "s", $Stu_id);

      $res = mysqli_stmt_execute($stmt);

      if ($res){

        mysqli_stmt_bind_result($stmt, $Stu_id, $name, $pay_date, $status);

        mysqli_stmt_fetch($stmt);

      }

    }//confirmed else

    mysqli_close($conn);



  }//$_GET

} catch(Exception $e) {

  echo 'Message: ' .$e->getMessage();

}

?>
  <div class="container mt-5">
  <table class="table table-bordered table-striped">

    <tr>

      <td>學號</td>

      <td>姓名</td>

      <td>付款日期</td>

      <td>繳費狀態</td>

    </tr>

    <tr>

      <td><?=$Stu_id?></td>

      <td><?=$name?></td>

      <td><?=$pay_date?></td>

      <td><?=$status?></td>

    </tr>

  </table>
  <div class="d-flex justify-content-center">
  <a href="delete_pay.php?Stu_id=<?=$Stu_id?>&action=confirmed" class="btn btn-danger">刪除</a>
  </div>
  </div>

<?php

require_once "footer.php";

?>