<?php
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function register($username, $email, $password, $role) {

        $checkQuery = "SELECT id FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
    
        if ($stmt->rowCount() > 0) {
            return ['status' => 'error', 'message' => 'Email already exists'];  // Return error as JSON
        }
    
        $query = "INSERT INTO " . $this->table . " (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
    
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
    
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Sign-up successful!'];  
        }
    
        return ['status' => 'error', 'message' => 'Sign-up failed. Please try again.'];
    }
    
    
    

  
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; 
        }

        return false;
    }
}
?>

