<?php
  include_once "../database/Login.class.php";

  if(isset($_POST['login'])){
    $loginUser = new Login();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginUser->loginUser($email, $password);
  }