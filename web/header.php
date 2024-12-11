<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["account"]) && basename($_SERVER['REQUEST_URI']) !== 'login.php') {
  header("Location: login.php");  // 重定向到登入頁面，或任意你希望跳轉的頁面
  exit();  // 停止程式執行
}
?>


<html>

<head>

  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav>
    <ul class="flex-nav">
      <li><a href="people.php">學生名單</a></li>
      <li><a href="query.php">幹部紀錄</a></li>
      <li><a href="fee.php">會費管理</a></li>
      <li><a href="logout.php">登出</a></li>
    </ul>
  </nav>

  <!-- <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="container-fluid">

    <ul class="navbar-nav">
      
      <li class="nav-item">
        <a class="nav-link" href="people.php">學生名單</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="query.php">幹部紀錄</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="fee.php">會費管理</a>
      </li>
    </ul>


    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link" href="logout.php">登出</a>
      </li>
    </ul>
  </div>
</nav> -->

</body>

</html>