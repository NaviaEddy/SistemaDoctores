<?php

class AdminModel {
    private $database;

    public function __construct($db) {
        $this->database = $db;
    }

    public function validateCredentials($email, $password) {
        $query = $this->database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
        return $query->fetch_assoc();
    }
}
?>
