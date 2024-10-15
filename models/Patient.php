<?php

class PatientModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
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
}

?>
