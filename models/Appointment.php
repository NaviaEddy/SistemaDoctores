<?php

class AppointmentModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getFutureAppointments($today) {
        $query = "SELECT * FROM appointment WHERE appodate >= ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $today); 
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }

    public function getNumberAppointment($id){
        $query = "SELECT * FROM appointment WHERE scheduleid = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }


}

?>
