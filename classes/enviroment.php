<?php

require_once 'database.php';

class Enviroment {
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
    public function insert($typ, $role, $user, $password, $adress){
      try{
        $stmt = $this->conn->prepare("INSERT INTO df_enviroment (typ, role, user, password, adress) VALUES(:typ, :role, :user, :password, :adress)");
        $stmt->bindparam(":typ", $typ);
        $stmt->bindparam(":role", $role);
        $stmt->bindparam(":user", $user);
        $stmt->bindparam(":password", $password);
        $stmt->bindparam(":adress", $adress);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function update($typ, $role, $user, $password, $adress, $id){
        try{
          $stmt = $this->conn->prepare("UPDATE df_enviroment SET typ = :typ, role = :role, user = :user, password = :password, adress = :adress WHERE id = :id");
            $stmt->bindparam(":typ", $typ);
            $stmt->bindparam(":role", $role);
            $stmt->bindparam(":user", $user);
            $stmt->bindparam(":password", $password);
            $stmt->bindparam(":adress", $adress);
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
        $stmt = $this->conn->prepare("DELETE FROM df_enviroment WHERE id = :id");
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
