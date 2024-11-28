<?php
session_start();  // 啟動 session

// 清除所有 session 變量
session_unset();  // 這將清除所有存儲在 $_SESSION 中的資料

// 銷毀 session
session_destroy();  // 銷毀 session 文件，讓 session 完全過期

// 重定向到登入頁面，或者首頁
header("Location: login.php");  // 重定向到登入頁面，或任意你希望跳轉的頁面
exit();  // 停止程式執行
?>
