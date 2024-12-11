<?php
session_start();//靠這個去記住登入時的資料，LOGIN記得也要
require_once "header.php";

try {

  $Stu_id = "";
  $one = "";
  $two = "";
  $three = "";
  $four = "";



  if ($_GET) {

    require_once 'db.php';

    $action = $_GET["action"]??"";

    if ($action=="confirmed"){

      //delete data

      $Stu_id = $_GET["Stu_id"];

      $sql="delete from job where Stu_id=?";

      $stmt = mysqli_stmt_init($conn);

      mysqli_stmt_prepare($stmt, $sql);

      mysqli_stmt_bind_param($stmt, "s", $Stu_id);

      $result = mysqli_stmt_execute($stmt);

      mysqli_close($conn);

      header('location:query.php');

    }

    else{

      //show data

      $Stu_id = $_GET["Stu_id"];

      $sql="select Stu_id, `1`, `2`, `3`, `4` from job where Stu_id=?";    

      // $result = mysqli_query($conn, $sql);

      $stmt = mysqli_stmt_init($conn);

      mysqli_stmt_prepare($stmt, $sql);

      mysqli_stmt_bind_param($stmt, "s", $Stu_id);

      $res = mysqli_stmt_execute($stmt);

      if ($res){

        mysqli_stmt_bind_result($stmt, $Stu_id, $one, $two, $three, $four);

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
      <td>學生</td>
      <td>大一職位</td>
      <td>大二職位</td>
      <td>大三職位</td>
      <td>大四職位</td>
    </tr>

    <tr>

      <td><?=$Stu_id?></td>

      <td><?=$one?></td>

      <td><?=$two?></td>

      <td><?=$three?></td>

      <td><?=$four?></td>
    </tr>

  </table>

  <div class="d-flex justify-content-center">
  <a href="delete.php?Stu_id=<?=$Stu_id?>&action=confirmed" class="btn btn-danger">刪除</a>
  </div>
  </div>

<?php

require_once "footer.php";

?>