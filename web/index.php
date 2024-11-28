<?php require_once "header.php";?>

<h1>首頁</h1>

<?php

session_start();

if (!$_SESSION){

  require_once "login.php";

}

?>

<?php require_once "footer.php";?>