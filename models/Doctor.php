<?php

class DoctorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAllDoctors()
    {
        $sql = "SELECT * FROM doctor order by docid desc";
        return $this->database->query($sql);
    }

    public function getDoctorCount()
    {
        $sql = "SELECT * FROM doctor";
        return $this->database->query($sql)->num_rows;
    }

    public function getDoctorByEmail($email) {
        $stmt = $this->database->prepare("SELECT * FROM doctor WHERE docemail = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getDoctor()
    {
        $sql = "SELECT docname, docemail FROM doctor";
        return $this->database->query($sql)->num_rows;
    }

    public function getAllDoctorsWithSpeciality()
    {
        $sql = "SELECT doctor.docid, doctor.docname, doctor.docemail, doctor.doctel, specialties.sname 
            FROM doctor 
            INNER JOIN specialties ON doctor.specialties = specialties.id
            ORDER BY doctor.docid DESC";

        return $this->database->query($sql);
    }

    public function validateCredentials($email, $password) {
        $query = $this->database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
        return $query->fetch_assoc();
    }   
}
