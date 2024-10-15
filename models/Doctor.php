<?php

class DoctorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getDoctorCount()
    {
        $sql = "SELECT * FROM doctor";
        return $this->database->query($sql)->num_rows;
    }

    public function getAllDoctors()
    {
        $sql = "SELECT docname, docemail FROM doctor";
        return $this->database->query($sql);
    }
}

?>
