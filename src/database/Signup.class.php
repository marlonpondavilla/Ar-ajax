<?php
  include_once "dbh.php";

  class Signup extends Dbh{

    public function setUsers($fullName, $email, $password){
      try {
        $passHashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (id, fullName, email, password) values(null, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute([$fullName, $email, $passHashed])){
          $stmt = null; 
          header("location: ../signup.php?error=stmtfailed");
          exit();
        }

        $stmt = null;

      } catch (Exception $e) {
        echo "an exception occured " . $e->getMessage();
      }
    }

    public function emailExists($email){
      $sql = "SELECT * FROM users WHERE email = ?;";
      $stmt = $this->connect()->prepare($sql);

      if(!$stmt->execute([$email])){
        header("location: ../signup.php?error=stmtfailed");
        exit();
      }

      if($stmt->rowCount() > 0){
        return true;
      } else{
        return false;
      }
    }
  }