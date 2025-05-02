<?php
include_once "../database/Signup.class.php";

if(isset($_POST['signup'])){
  $signupUser = new Signup();

  $fullName = $_POST['fullName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if($password !== $confirmPassword ){
    header("location: ../signup.php?error=passwordnotmatch&fullname=$fullName&email=$email");
    exit();
  }

  if($signupUser->emailExists($email)){
    header("location: ../signup.php?error=emailalreadyexist&fullname=$fullName&email=$email");
    exit();
  }
  
  $signupUser->setUsers($fullName, $email, $password);
  header("location: ../../index.php?error=none");

}




