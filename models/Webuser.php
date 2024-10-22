<?php
class WebuserModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getWebUserByEmail($email) {
        $sql = "SELECT * FROM webuser WHERE email=?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createWebUser($email) {
        $sql = "INSERT INTO webuser VALUES (?, 'p')";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param("s", $email);
        return $stmt->execute();
    }
}
?>
