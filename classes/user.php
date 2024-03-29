<?php

require_once 'database.php';

class User {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }


    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function insert($name, $email, $phone){
      try{
        $stmt = $this->conn->prepare("INSERT INTO df_users (name, email, phone) VALUES(:name, :email, :phone)");
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":phone", $phone);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($name, $email, $phone, $id){
        try{
          $stmt = $this->conn->prepare("UPDATE df_users SET name = :name, email = :email, phone = :phone WHERE id = :id");
          $stmt->bindparam(":name", $name);
          $stmt->bindparam(":email", $email);
          $stmt->bindparam(":phone", $phone);
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }


    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM df_users WHERE id = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    // Redirect URL method
    public function redirect($url){
      header("Location: $url");
    }
}
?>
