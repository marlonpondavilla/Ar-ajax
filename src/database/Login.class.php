<?php
  session_start();
  include_once "dbh.php";

  class Login extends Dbh{

    public function loginUser($email, $password){
      try {
        $sql = "SELECT email, password FROM users WHERE email = ?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute([$email])){
          $stmt = null;
          header("location: ../../../index.php?error=stmtfailed");
          exit();
        }

        $user = $stmt->fetch();

        if(!$user){
          $stmt = null;
          header("location: ../../../index.php?error=usernotexist&email=$email");
          exit();
        }

        // password hash text
        $passHash = $user['password'];

        if(!password_verify($password, $passHash)){
          $stmt = null;
          header("location: ../../../index.php?error=wrongcredentials&email=$email");
          exit();
        }

        $_SESSION['uid'] = $user['email'];

        $stmt = null;
        header("location: ../../ui/home.php");
        exit();

      } catch (Exception $e) {
        echo "Error fetching users " . $e->getMessage();
      }
    }
  }
