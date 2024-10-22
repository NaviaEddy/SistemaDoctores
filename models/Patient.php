<?php

class PatientModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function createPatient($email, $name, $newpassword, $address, $dob, $tele) {
        $sql = "INSERT INTO patient(pemail, pname, ppassword, paddress, pdob, ptel, isActive, lastConnection) VALUES (?, ?, ?, ?, ?, ?, '1', NOW())";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param("ssssss", $email, $name, $newpassword, $address, $dob, $tele);
        return $stmt->execute();
    }

    public function getPatientByEmail($email)
    {
        $sql = "SELECT * FROM patient WHERE pemail = ?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPatientCount()
    {
        $sql = "SELECT * FROM patient";
        return $this->database->query($sql)->num_rows;
    }

    public function validateCredentials($email, $password) {
        $query = $this->database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
        return $query->fetch_assoc();
    }

    public function updateLastConnection($email) {
        $query = "UPDATE patient SET lastConnection = NOW() WHERE pemail = '$email'";
        return $this->database->query($query);
    }
}

?>
