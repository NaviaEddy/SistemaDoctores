<?php

class AdminModel {
    private $database;

    public function __construct($db) {
        $this->database = $db;
    }

    public function getAdminByEmail($email)
    {
        $sql = "SELECT * FROM admin WHERE aemail = ?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function validateCredentials($email, $password) {
        $query = $this->database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
        return $query->fetch_assoc();
    }
}
?>
